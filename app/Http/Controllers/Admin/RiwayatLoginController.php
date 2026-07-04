<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use Illuminate\View\View;

/**
 * Admin-only "Riwayat Login" page — history of who logged in/out, when,
 * and from which IP/browser.
 */
class RiwayatLoginController extends Controller
{
    public function index(): View
    {
        $items = LoginLog::with('user')
            ->orderByDesc('login_at')
            ->limit(500)
            ->get();

        return view('logs.login.index', compact('items'));
    }
}
