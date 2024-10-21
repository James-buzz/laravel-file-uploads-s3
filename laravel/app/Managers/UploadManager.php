<?php
declare(strict_types=1);

namespace App\Managers;

use App\Contracts\IUploadDriver;
use App\Drivers\UploadManager\AlbumDriver;
use App\Drivers\UploadManager\DefaultUploadDriver;
use Illuminate\Support\Manager;

/**
 * @mixin IUploadDriver
 */
class UploadManager extends Manager {
    public function getDefaultDriver(): IUploadDriver
    {
        return new DefaultUploadDriver();
    }

    public function createAlbumDriver(): AlbumDriver
    {
        return new AlbumDriver();
    }
}
