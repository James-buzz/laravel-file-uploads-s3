<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Contracts\IUppyCompanionService;
use Aws\Result;
use Aws\S3\S3Client;
use Illuminate\Support\Collection;
use RuntimeException;

class UppyCompanionService implements IUppyCompanionService {
    public const DEFAULT_EXPIRY = '+60 minutes';

    public function __construct(
        protected readonly S3Client $s3Client,
        protected readonly string $s3Bucket,
    ) {}

    public function createMultipartUpload(
        string $fileName,
        string $type,
        array $metadata
    ): array {
        $s3Response = $this->s3Client->createMultipartUpload([
            'Bucket' => $this->s3Bucket,
            'Key' => $fileName,
            'ContentType' => $type,
            'ContentDisposition' => 'inline',
        ]);

        return [
            'uploadId' => $s3Response['UploadId'],
            'key' => $s3Response['Key'],
        ];
    }

    public function listPartsPage(string $uploadId, int $partIndex = 0): Collection
    {
        $parts = collect();

        $currentLoop = 0;
        $maxLoops = 1000;

        do {
            if ($currentLoop++ >= $maxLoops) {
                throw new RuntimeException('Max loops reached');
            }

            $response = $this->s3Client->listParts([
                'Bucket' => $this->s3Bucket,
                'Key' => $uploadId,
                'UploadId' => $uploadId,
                'PartNumberMarker' => $partIndex,
            ]);

            $parts = $parts->concat($response['Parts'] ?? []);
            $partIndex = $response['NextPartNumberMarker'] ?? null;
        } while ($response['IsTruncated'] ?? false);

        return $parts;
    }

    public function presignPartURL(string $uploadKey, string $uploadId, int $partNumber): string
    {
        $response = $this->s3Client->getCommand('UploadPart', [
            'Bucket' => $this->s3Bucket,
            'Key' => $uploadKey,
            'UploadId' => $uploadId,
            'PartNumber' => $partNumber,
            'ChecksumAlgorithm' => 'sha1',
        ]);

        $request = $this->s3Client->createPresignedRequest($response, self::DEFAULT_EXPIRY);

        return (string) $request->getUri();
    }

    public function completeMultipartUpload(string $uploadKey, string $uploadId, array $parts): Result
    {
        return $this->s3Client->completeMultipartUpload([
            'Bucket' => $this->s3Bucket,
            'Key' => $uploadKey,
            'UploadId' => $uploadId,
            'MultipartUpload' => [
                'Parts' => $parts,
            ],
        ]);
    }

    public function abortMultipartUpload(string $uploadKey, string $uploadId): void
    {
        $this->s3Client->abortMultipartUpload([
            'Bucket' => $this->s3Bucket,
            'Key' => $uploadKey,
            'UploadId' => $uploadId,
        ]);
    }
}
