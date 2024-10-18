<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'files' => Storage::disk(config('uppy-companion.disk'))->allFiles()
        ]);
    }
}
