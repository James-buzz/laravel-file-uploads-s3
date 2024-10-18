<?php

namespace App\Http\Controllers\Uppy;

use App\Contracts\IUppyCompanionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Uppy\CompleteMultipartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CompleteMultipartController extends Controller
{
    public function __construct(
        protected readonly IUppyCompanionService $uppyCompanionService
    ){}

    /**
     * Completes a multipart upload by combining all the parts.
     */
    public function post(CompleteMultipartRequest $request, string $uploadId): JsonResponse {
        $validated = $request->validated();

        $response = $this->uppyCompanionService->completeMultipartUpload(
            $this->encodeURIComponent($validated['key']),
            $this->encodeURIComponent($uploadId),
            $validated['parts']
        );

        Log::debug("Complete Multipart Upload [" . $validated['key'] . "]");

        return response()->json([
            'location' => $response['Location'],
        ]);
    }
}
