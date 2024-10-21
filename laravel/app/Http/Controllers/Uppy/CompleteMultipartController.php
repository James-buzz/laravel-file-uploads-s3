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

        $uploadType = $validated['metadata']['upload_type'];

        $driver = $this->uploadManager->driver($uploadType);
        if ($driver === null) {
            abort(404, 'Upload driver not found');
        }

        $response = $this->uppyCompanionService->completeMultipartUpload(
            $this->encodeURIComponent($validated['key']),
            $this->encodeURIComponent($uploadId),
            $validated['parts']
        );

        $driver->onUploadComplete($validated['metadata']);

        Log::debug("Complete Multipart Upload [" . $validated['key'] . "]");

        return response()->json([
            'location' => $response['Location'],
        ]);
    }
}
