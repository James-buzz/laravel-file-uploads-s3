<?php

use App\Http\Controllers\ListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Uppy\MultipartController;
use App\Http\Controllers\Uppy\SignpartController;
use App\Http\Controllers\Uppy\CompleteMultipartController;

/**
 * Protected routes
 */

Route::get('files', [ListController::class, 'index']);

Route::options('companion/s3/multipart', [MultipartController::class, 'options']);
Route::resource('companion/s3/multipart', MultipartController::class)->only([
    'store', 'show', 'destroy'
]);
Route::get('companion/s3/multipart/{uploadId}/{partNumber}', [SignpartController::class, 'show']);
Route::post('companion/s3/multipart/{uploadId}/complete', [CompleteMultipartController::class, 'post']);
Route::delete('companion/s3/multipart/{uploadId}', [MultipartController::class, 'destroy']);
