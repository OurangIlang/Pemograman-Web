<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Drop-in replacement for Illuminate\Database\Eloquent\SoftDeletes that
 * additionally stamps `deleted_by` with the currently authenticated
 * user whenever a soft delete happens — satisfying the
 * created_by / updated_by / deleted_by audit-trail requirement without
 * ever issuing a real DELETE against the database.
 *
 * Usage: `use App\Traits\SoftDeletesAudited;` then
 * `use SoftDeletesAudited;` inside the model (do NOT also add Laravel's
 * own SoftDeletes trait — this one already includes it).
 */
trait SoftDeletesAudited
{
    use SoftDeletes;

    /**
     * Perform the actual delete query on this model instance.
     *
     * Overrides SoftDeletes::runSoftDelete() to also persist
     * `deleted_by` in the same UPDATE statement, when the underlying
     * table has that column.
     */
    protected function runSoftDelete()
    {
        $query = $this->newModelQuery()->where($this->getKeyName(), $this->getKey());

        $time = $this->freshTimestamp();

        $columns = [$this->getDeletedAtColumn() => $this->fromDateTime($time)];

        $this->{$this->getDeletedAtColumn()} = $time;

        if ($this->usesTimestamps() && ! is_null($this->getUpdatedAtColumn())) {
            $this->{$this->getUpdatedAtColumn()} = $time;

            $columns[$this->getUpdatedAtColumn()] = $this->fromDateTime($time);
        }

        if ($this->hasDeletedByColumn()) {
            $userId = Auth::id();

            $this->deleted_by = $userId;
            $columns['deleted_by'] = $userId;
        }

        $query->update($columns);

        $this->syncOriginalAttribute($this->getDeletedAtColumn());

        $this->fireModelEvent('trashed', false);
    }

    /**
     * Whether this model's table has a deleted_by column to stamp.
     * Cheap to call repeatedly: results are cached per-table for the
     * lifetime of the request.
     */
    protected function hasDeletedByColumn(): bool
    {
        static $cache = [];

        $table = $this->getTable();

        if (! array_key_exists($table, $cache)) {
            $cache[$table] = \Illuminate\Support\Facades\Schema::hasColumn($table, 'deleted_by');
        }

        return $cache[$table];
    }
}
