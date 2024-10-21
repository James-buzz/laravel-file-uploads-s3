<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'display_name' => $this->display_name,
            'photo_count' => $this->photos->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'photos' => $this->whenLoaded('photos', PhotoResource::collection($this->photos)),
        ];
    }
}
