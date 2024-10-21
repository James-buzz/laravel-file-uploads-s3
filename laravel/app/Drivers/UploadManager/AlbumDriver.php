<?php
declare(strict_types=1);

namespace App\Drivers\UploadManager;

use App\Contracts\IUploadDriver;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AlbumDriver implements IUploadDriver
{
    public function authoriseUpload(string $userId, string $originalFileName, array $fileMetadata): bool
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = File::extension($originalFileName);

        if (!in_array($ext, $allowedExtensions)) {
            return false;
        }

        if (!isset($fileMetadata['album_id'])) {
            return false;
        }

        $albumId = $fileMetadata['album_id'];

        $exists = Album::where('id', $albumId)
            ->where('user_id', $userId)
            ->first();

        if (!$exists) {
            return false;
        }

        return true;
    }

    public function getFilePath(string $originalFileName, array $fileMetadata): string
    {
        return 'album/' . $fileMetadata['album_id'] . '/' . $originalFileName;
    }

    public function onUploadComplete(string $fileKey, array $fileMetadata): void
    {
        $albumId = $fileMetadata['album_id'];
        $fileName = $fileMetadata['file_name'] ?? 'unknown';

        $photo = new Photo();
        $photo->display_name = $fileName;
        $photo->file_path = $fileKey;
        $photo->album_id = $albumId;
        $photo->save();
    }
}
