<?php

namespace App\Contracts;

interface IUploadDriver
{
    public function authoriseUpload(string $userId, string $originalFileName, array $fileMetadata): bool;

    public function onUploadComplete(string $fileKey, array $fileMetadata): void;

    public function getFilePath(string $originalFileName, array $fileMetadata): string;
}
