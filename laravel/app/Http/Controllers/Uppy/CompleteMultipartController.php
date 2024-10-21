<?php

namespace App\Http\Controllers\Uppy;

use App\Contracts\IUppyCompanionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Uppy\CompleteMultipartRequest;
use App\Managers\UploadManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CompleteMultipartController extends Controller
{
    public function __construct(
        protected readonly IUppyCompanionService $uppyCompanionService,
        protected readonly UploadManager $uploadManager
    ){}

    /**
     * Completes a multipart upload by combining all the parts.
     */
    public function post(CompleteMultipartRequest $request, string $uploadId): JsonResponse {
        $validated = $request->validated();
        $validatedMetadata = $validated['metadata'];

        $unvalidatedMetadata = $request->input('metadata');

        $uploadType = $validatedMetadata['upload_type'];

        $driver = $this->uploadManager->driver($uploadType);
        if ($driver === null) {
            abort(404, 'Upload driver not found');
        }

        $key = $validated['key'];

        $response = $this->uppyCompanionService->completeMultipartUpload(
            $this->encodeURIComponent($key),
            $this->encodeURIComponent($uploadId),
            $validated['parts']
        );

        $driver->onUploadComplete($key, $unvalidatedMetadata);

        Log::debug("Complete Multipart Upload [" . $validated['key'] . "]");

        return response()->json([
            'location' => $response['Location'],
        ]);
    }
}
