<?php

namespace App\Drivers\UploadManager;

use App\Contracts\IUploadDriver;

class DefaultUploadDriver implements IUploadDriver
{
    public function authoriseUpload(string $userId, string $originalFileName, array $fileMetadata): bool
    {
        return false;
    }

    public function getFilePath(string $originalFileName, array $fileMetadata): string
    {
        return "";
    }

    public function onUploadComplete(array $fileMetadata): void
    {
        // TODO: Implement onUploadComplete() method.
    }
}
