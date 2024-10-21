<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Uppy\MultipartController;
use App\Http\Controllers\Uppy\SignpartController;
use App\Http\Controllers\Uppy\CompleteMultipartController;

/**
 * Protected routes
 */

// Uploader
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::options('companion/s3/multipart', [MultipartController::class, 'options']);
    Route::resource('companion/s3/multipart', MultipartController::class)->only([
        'store', 'show', 'destroy'
    ]);
    Route::get('companion/s3/multipart/{uploadId}/{partNumber}', [SignpartController::class, 'show']);
    Route::post('companion/s3/multipart/{uploadId}/complete', [CompleteMultipartController::class, 'post']);
    Route::delete('companion/s3/multipart/{uploadId}', [MultipartController::class, 'destroy']);

    // Albums
    Route::apiResource('albums', AlbumController::class);
    Route::apiResource('albums.photos', PhotoController::class)->shallow();
});
