<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Automatically stamps `created_by` on creation and `updated_by` on
 * every update with the currently authenticated user's id — so
 * controllers never need to pass these fields manually and they can
 * never be spoofed via form input (they are not mass-assigned from the
 * request).
 *
 * Usage: `use App\Traits\AutoAudit;` and `use AutoAudit;` inside a model
 * that has `created_by` / `updated_by` columns.
 */
trait AutoAudit
{
    public static function bootAutoAudit(): void
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = $model->created_by ?: Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }
}
