<?php

use Illuminate\Support\Facades\Route;
use Tightenco\NovaGoogleAnalytics\Http\Controllers\MediaTypeLoadedController;
use Tightenco\NovaGoogleAnalytics\Http\Controllers\MostVisitedPagesController;
use Tightenco\NovaGoogleAnalytics\Http\Controllers\PrebidRequestController;
use Tightenco\NovaGoogleAnalytics\Http\Controllers\ReferrerListController;
use Tightenco\NovaGoogleAnalytics\Http\Controllers\TagLoadedController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
 */

Route::get('most-visited-pages', MostVisitedPagesController::class);
Route::get('referrer-list', ReferrerListController::class);
Route::get('tag-loaded', TagLoadedController::class);
Route::get('media-type-loaded', MediaTypeLoadedController::class);
Route::get('prebid-request', PrebidRequestController::class);
