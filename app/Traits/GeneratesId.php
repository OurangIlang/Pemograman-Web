<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Auto-generates a sequential, zero-padded primary key for master-data
 * models, e.g. BB001, BB002, ... for Bahan Baku.
 *
 * Requirements this satisfies:
 *  - The ID is never entered manually by the user.
 *  - The ID is unique (derived from the highest existing numeric suffix,
 *    scanned WITH trashed/soft-deleted rows so numbers are never reused).
 *  - If a record is deleted, the next generated number simply continues
 *    counting up — it never goes back and reuses a "freed" number.
 *
 * Usage:
 *   class BahanBaku extends Model
 *   {
 *       use GeneratesId;
 *
 *       public static function idPrefix(): string { return 'BB'; }
 *   }
 *
 * Then, instead of BahanBaku::create($data):
 *   BahanBaku::createWithAutoId($data);
 *
 * Or, to just preview the next id (e.g. to display on a create form):
 *   BahanBaku::nextId();
 */
trait GeneratesId
{
    /**
     * The fixed prefix for this model's IDs, e.g. "BB", "BRG", "CUST".
     */
    abstract public static function idPrefix(): string;

    /**
     * How many digits the numeric part is padded to. 3 by default
     * (BB001), but automatically grows past 999 (BB1000) so the
     * sequence never breaks.
     */
    public static function idPadding(): int
    {
        return 3;
    }

    /**
     * Compute the next available ID for this model, without persisting
     * anything. Safe to call repeatedly for display purposes (e.g. to
     * show the id that WILL be used on a create form) — the actual
     * value used at save time is always recomputed inside
     * createWithAutoId() under a row lock, so a stale preview value
     * shown on screen can never cause a collision.
     */
    public static function nextId(): string
    {
        $prefix = static::idPrefix();
        $pad = static::idPadding();
        $key = (new static)->getKeyName();

        $query = static::query();
        if (method_exists(static::class, 'withTrashed')) {
            $query = static::withTrashed();
        }

        $max = $query
            ->where($key, 'like', $prefix.'%')
            ->pluck($key)
            ->map(function ($value) use ($prefix) {
                $suffix = substr((string) $value, strlen($prefix));

                return ctype_digit($suffix) ? (int) $suffix : 0;
            })
            ->max();

        $next = ((int) $max) + 1;

        return $prefix.str_pad((string) $next, $pad, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new record with a freshly generated, guaranteed-unique
     * primary key. Wrapped in a transaction with a row lock over the
     * existing matching rows so two concurrent requests can never be
     * handed the same ID.
     *
     * Any 'id' style column the caller might have passed in
     * $attributes is deliberately overwritten — per the "ID tidak boleh
     * diinput manual" requirement, the primary key is always
     * server-generated, never trusted from client input.
     */
    public static function createWithAutoId(array $attributes = []): static
    {
        return DB::transaction(function () use ($attributes) {
            $prefix = static::idPrefix();
            $key = (new static)->getKeyName();

            $query = static::query();
            if (method_exists(static::class, 'withTrashed')) {
                $query = static::withTrashed();
            }

            // Lock every row that could affect the next-number
            // computation so a concurrent request has to wait for this
            // transaction to commit before it can compute its own id.
            $query->where($key, 'like', $prefix.'%')->lockForUpdate()->get([$key]);

            $attributes[$key] = static::nextId();

            return static::create($attributes);
        });
    }
}
