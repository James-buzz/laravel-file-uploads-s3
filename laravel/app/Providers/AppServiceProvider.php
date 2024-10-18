<?php

namespace App\Providers;

use App\Contracts\IUppyCompanionService;
use App\Http\Services\UppyCompanionService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Filesystem\AwsS3V3Adapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUppyCompanionService::class, function () {
            $disk = Storage::disk(config('uppy-companion.disk'));
            $bucket = config('uppy-companion.bucket');

            if (!($disk instanceof AwsS3V3Adapter)) {
                throw new InvalidArgumentException("The specified disk is not an S3 disk.");
            }

            $client = $disk->getClient();
            return new UppyCompanionService($client, $bucket);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
