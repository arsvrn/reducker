<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;

Route::get('/', function () {
    return view ('index');
});

Route::post('/short', [ShortLinkController::class, 'generate']);

Route::get('{code}', [ShortLinkController::class, 'linkRedirect']);
