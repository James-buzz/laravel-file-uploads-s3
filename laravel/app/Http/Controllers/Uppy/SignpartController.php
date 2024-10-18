<?php

namespace App\Http\Controllers\Uppy;

use App\Contracts\IUppyCompanionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Uppy\SignPartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SignpartController extends Controller
{
    public function __construct(
        protected readonly IUppyCompanionService $uppyCompanionService
    ){}

    /**
     * Presign a part URL for a multipart upload
     */
    public function show(SignPartRequest $request, string $uploadId, int $partNumber): JsonResponse
    {
        $validated = $request->validated();

        $result = $this->uppyCompanionService->presignPartURL(
            $this->encodeURIComponent($validated['key']),
            $this->encodeURIComponent($uploadId),
            $partNumber
        );

        Log::debug('Sign Part Upload [' . $validated['key']. ',' . $partNumber . ']');

        return response()->json([
            'url' => $result,
        ]);
    }
}
