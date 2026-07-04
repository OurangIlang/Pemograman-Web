<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;

/**
 * Automatically records an ActivityLog row whenever a model using this
 * trait is created, updated, or deleted.
 *
 * Usage: `use App\Traits\LogsActivity;` and add `use LogsActivity;`
 * inside the model class. Nothing else is required — the hooks attach
 * themselves via Eloquent's `boot{TraitName}` convention.
 */
trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            $model->recordActivity('Tambah '.$model->activityLogLabel(), null, $model->attributesToArray());
        });

        static::updated(function ($model) {
            $changes = $model->getChanges();
            unset($changes['updated_at'], $changes['updated_by']);

            if (empty($changes)) {
                return;
            }

            $original = array_intersect_key($model->getOriginal(), $changes);

            // Soft-delete restore/trash is handled by its own hooks below,
            // not as a generic "Ubah" (edit) entry.
            if (array_key_exists('deleted_at', $changes)) {
                return;
            }

            $model->recordActivity('Ubah '.$model->activityLogLabel(), $original, $changes);
        });

        static::deleted(function ($model) {
            $aktivitas = method_exists($model, 'trashed') && $model->trashed()
                ? 'Hapus (Soft Delete) '.$model->activityLogLabel()
                : 'Hapus '.$model->activityLogLabel();

            $model->recordActivity($aktivitas, $model->attributesToArray(), null);
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->recordActivity('Pulihkan '.$model->activityLogLabel(), null, $model->attributesToArray());
            });
        }
    }

    /**
     * Human-friendly model name used in activity log labels, e.g.
     * "Tambah Barang", "Ubah Bahan Baku", "Hapus Customer".
     */
    public function activityLogLabel(): string
    {
        return class_basename($this);
    }

    /**
     * Persist one activity_logs row for the given action.
     */
    public function recordActivity(string $aktivitas, ?array $dataLama, ?array $dataBaru): void
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id' => $user->id ?? null,
            'nama_user' => $user->name ?? 'System',
            'role' => $user->role ?? '-',
            'aktivitas' => $aktivitas,
            'tabel' => $this->getTable(),
            'record_id' => (string) $this->activityLogRecordId(),
            'data_lama' => $dataLama !== null ? json_encode($dataLama) : null,
            'data_baru' => $dataBaru !== null ? json_encode($dataBaru) : null,
            'ip_address' => RequestFacade::ip(),
            'user_agent' => RequestFacade::userAgent(),
        ]);
    }

    /**
     * The identifier to store on the log row. Falls back to the model's
     * primary key; models with a composite/no primary key (e.g. pivot
     * style detail tables) may override this method.
     */
    protected function activityLogRecordId(): string
    {
        return (string) ($this->getKey() ?? '-');
    }
}
