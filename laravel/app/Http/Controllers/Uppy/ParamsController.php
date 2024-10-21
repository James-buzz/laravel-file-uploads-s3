<?php

namespace App\Http\Controllers\Uppy;

use App\Contracts\IUppyCompanionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Uppy\ParamsRequest;
use App\Managers\UploadManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParamsController extends Controller
{
    public function __construct(
        protected readonly IUppyCompanionService $uppyCompanionService,
        protected readonly UploadManager $uploadManager
    ){}

    public function index(ParamsRequest $request): JsonResponse
    {
        $user = auth()->user();

        $validated = $request->validated();
        $validatedMetadata = $validated['metadata'];

        $metadata = $request['metadata'];

        $uploadType = $validatedMetadata['upload_type'];

        $driver = $this->uploadManager->driver($uploadType);
        if ($driver === null) {
            abort(404, 'Upload driver not found');
        }

        $authorised = $driver->authoriseUpload($user->id, $validated['filename'], $metadata);
        if (!$authorised) {
            abort(403, 'Upload not allowed');
        }

        $filePath = $driver->getFilePath($validated['filename'], $metadata);

        $result = $this->uppyCompanionService->getPresignedUrl(
            $filePath,
            $validated['type'],
        );

        return response()->json([
            'method' => 'PUT',
            'url' => $result['url'],
            'fields' => $result['fields'],
            'headers' => $result['headers']
        ]);
    }
}
