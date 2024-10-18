<?php

namespace App\Http\Controllers\Uppy;

use App\Contracts\IUppyCompanionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Uppy\AbortMultipartRequest;
use App\Http\Requests\Uppy\CreateMultipartRequest;
use App\Http\Requests\Uppy\GetPartsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class MultipartController extends Controller
{
    public function __construct(
        protected readonly IUppyCompanionService $uppyCompanionService
    ){}

    /**
     * Client preflight request
     */
    public function options(): Response
    {
        // Pass with CORS and CSRF header
        return response()->noContent()->withHeaders([
        ]);
    }

    /**
     * Create a new multipart upload
     */
    public function store(CreateMultipartRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $result = $this->uppyCompanionService->createMultipartUpload(
            $validated['filename'],
            $validated['type'],
            $validated['metadata'] ?? []
        );

        Log::debug('Create Multipart Upload [' . $result['key'] . ']');

        return response()->json([
            'uploadId' => $result['uploadId'],
            'key' => $result['key'],
        ]);
    }

    /**
     * Retrieve a list of parts for specific multipart upload
     */
    public function show(GetPartsRequest $request, string $uploadId): JsonResponse
    {
        $validated = $request->validated();

        $parts = $this->uppyCompanionService->listPartsPage(
            $validated['key'],
            $uploadId
        );

        Log::debug('Get Parts Upload [' . $result['key'] . ']');

        return response()->json($parts);
    }

    /**
     * Abort a multipart upload
     */
    public function destroy(AbortMultipartRequest $request, string $uploadId): Response
    {
        $validated = $request->validated();

        $this->uppyCompanionService->abortMultipartUpload(
            $validated['key'],
            $uploadId
        );

        Log::debug('Abort Multipart Upload [' . $validated['key'] . ']');

        return response()->noContent();
    }
}
