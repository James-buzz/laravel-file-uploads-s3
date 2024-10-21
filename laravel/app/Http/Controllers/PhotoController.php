<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class PhotoController extends Controller
{
    public function destroy(Photo $photo): \Illuminate\Http\Response
    {
        return response()->noContent();
    }
}
