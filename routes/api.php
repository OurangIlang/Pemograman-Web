<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| The original PHP-native project did not expose any API endpoints; all
| interaction happened through server-rendered pages. This file is kept
| as part of the standard Laravel structure and is ready for future use.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
