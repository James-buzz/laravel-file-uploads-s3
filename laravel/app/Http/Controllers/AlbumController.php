<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AlbumController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $albums = Album::withCount('photos')->get();

        return AlbumResource::collection($albums);
    }

    public function show(Album $album): AlbumResource
    {
        $album->load('photos');
        return new AlbumResource($album);
    }

    public function store(StoreAlbumRequest $request): \Illuminate\Http\Response
    {
        $validated = $request->validated();
        /** @var User $user */
        $user = auth()->user();

        $newAlbum = new Album();
        $newAlbum->display_name = $validated['name'];
        $newAlbum->user_id = $user->id;
        $newAlbum->save();

        return response()->noContent();
    }

    public function destroy(Album $album): \Illuminate\Http\Response
    {
        // TODO: delete images from storage
        $album->delete();
        return response()->noContent();
    }
}
