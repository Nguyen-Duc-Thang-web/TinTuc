<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AdvertisementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('categories')->group(function () {
    Route::get('/',                    [CategoryController::class, 'index']);
    Route::post('create',              [CategoryController::class, 'create']);
    Route::get('{slug}/show',          [CategoryController::class, 'show']);
    Route::put('{slug}/update',        [CategoryController::class, 'update']);
    Route::delete('{slug}/delete',     [CategoryController::class, 'delete']);
});

Route::prefix('advertisements')->group(function () {
    Route::get('/',                    [AdvertisementController::class, 'index']);
    Route::post('create',              [AdvertisementController::class, 'create']);
    Route::get('{id}/show',            [AdvertisementController::class, 'show']);
    Route::put('{id}/update',          [AdvertisementController::class, 'update']);
    Route::delete('{id}/delete',       [AdvertisementController::class, 'delete']);
    Route::get('trashed',              [AdvertisementController::class, 'trashed']);
    Route::patch('{id}/restore',       [AdvertisementController::class, 'restore']);
    Route::delete('{id}/force-delete', [AdvertisementController::class, 'forceDelete']);
});

Route::prefix('contacts')->group(function () {
    Route::get('/',                    [ContactController::class, 'index']);
    Route::post('create',              [ContactController::class, 'create']);
    Route::get('{id}/show',            [ContactController::class, 'show']);
    Route::delete('{id}/delete',       [ContactController::class, 'delete']);
});

Route::prefix('faqs')->group(function () {
    Route::get('/',                    [FaqController::class, 'index']);
    Route::post('create',              [FaqController::class, 'create']);
    Route::get('{id}/show',            [FaqController::class, 'show']);
    Route::put('{id}/update',          [FaqController::class, 'update']);
    Route::delete('{id}/delete',       [FaqController::class, 'delete']);
});
Route::get('notifications', [HomeController::class, 'getNotifications']);