<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\View\View;

/**
 * Admin-only "Log Aktivitas" page — audit trail of every create/update/
 * delete performed on the tracked master & transaction tables.
 */
class LogAktivitasController extends Controller
{
    public function index(): View
    {
        $items = ActivityLog::with('user')
            ->orderByDesc('created_at')
            ->limit(500)
            ->get();

        return view('logs.aktivitas.index', compact('items'));
    }
}
