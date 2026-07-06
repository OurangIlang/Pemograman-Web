<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Auto-generates date-scoped transaction numbers such as:
 *   NP-20260704-001   (Nota Pembelian)
 *   INV-20260704-001  (Invoice Penjualan)
 *   FK-20260704-001   (Faktur)
 *   PO-20260704-001   (Purchase Order / No. Preorder)
 *
 * The sequence resets every calendar day and is scanned WITH trashed
 * rows so a deleted transaction's number is never reused.
 *
 * Usage:
 *   $kodeNota = NotaPembelian::nextDatedId('kode_nota', 'NP');
 *
 * Or, to create the header row and stamp its dated id atomically:
 *   NotaPembelian::createWithDatedId('kode_nota', 'NP', $attributes);
 */
trait GeneratesDatedId
{
    /**
     * Compute the next available dated id for the given column/prefix
     * combination, without persisting anything.
     */
    public static function nextDatedId(string $column, string $prefix, int $pad = 3, ?\DateTimeInterface $date = null): string
    {
        $datePart = ($date ?? now())->format('Ymd');
        $needle = $prefix.'-'.$datePart.'-';

        $query = static::query();
        if (method_exists(static::class, 'withTrashed')) {
            $query = static::withTrashed();
        }

        $max = $query
            ->where($column, 'like', $needle.'%')
            ->pluck($column)
            ->map(function ($value) use ($needle) {
                $suffix = substr((string) $value, strlen($needle));

                return ctype_digit($suffix) ? (int) $suffix : 0;
            })
            ->max();

        $next = ((int) $max) + 1;

        return $needle.str_pad((string) $next, $pad, '0', STR_PAD_LEFT);
    }

    /**
     * Create a new record, stamping $column with a freshly generated,
     * guaranteed-unique dated id. Wrapped in a transaction with a row
     * lock over today's matching rows so two concurrent requests can
     * never be handed the same number.
     *
     * Any value the caller might have passed for $column in
     * $attributes is deliberately overwritten — the number is always
     * server-generated, never trusted from client input.
     */
    public static function createWithDatedId(string $column, string $prefix, array $attributes = [], int $pad = 3): static
    {
        return DB::transaction(function () use ($column, $prefix, $attributes, $pad) {
            $datePart = now()->format('Ymd');
            $needle = $prefix.'-'.$datePart.'-';

            $query = static::query();
            if (method_exists(static::class, 'withTrashed')) {
                $query = static::withTrashed();
            }

            $query->where($column, 'like', $needle.'%')->lockForUpdate()->get([$column]);

            $attributes[$column] = static::nextDatedId($column, $prefix, $pad);

            return static::create($attributes);
        });
    }
}
