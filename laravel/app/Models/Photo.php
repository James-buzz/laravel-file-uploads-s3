<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    protected $fillable = [
        'file_path',
        'display_name',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
