<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Aws\Result;

/**
 * This service is emulating the Uppy Companion service
 * so you can use Uppy with Laravel rather than running a separate server
 * with companion like express.
 */
interface IUppyCompanionService
{
    /**
     * Returns a presigned URL for uploading a file to S3.
     *
     * @param  string  $uploadKey
     * @param  string  $type
     * @return array{url: string, fields: array, headers: array}
     */
    public function getPresignedUrl(
        string $uploadKey,
        string $type,
    ): array;

    /**
     * Initiates a multipart upload via S3 and returns the upload ID.
     *
     * @param string $fileName The name of the file
     * @param string $type The type of the file i.e. image/jpeg
     * @param array $metadata Additional metadata to store with the file
     *
     * @return array{uploadId: string}
     */
   public function createMultipartUpload(string $fileName, string $type, array $metadata): array;

    /**
     * Retrieves a list of the parts that have been uploaded for a specific multipart upload.
     *
     * @param string $uploadId
     * @param int $partIndex
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#listparts AWS SDK for PHP S3 ListParts
     * @see https://docs.aws.amazon.com/AmazonS3/latest/API/API_ListParts.html Amazon S3 API ListParts
     */
    public function listPartsPage(string $uploadId, int $partIndex = 0): Collection;

    /**
     * Generates a pre-signed URL for uploading a specific part of a multipart upload.
     *
     * @param string $uploadKey
     * @param string $uploadId
     * @param int $partNumber
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.S3.S3Client.html#_createPresignedRequest AWS SDK for PHP S3 CreatePresignedRequest
     */
    public function presignPartURL(string $uploadKey, string $uploadId, int $partNumber): string;

    /**
     * Completes a multipart upload by combining all the parts.
     *
     * @param string $uploadKey
     * @param string $uploadId
     * @param array  $parts
     *
     * @return Result
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#completemultipartupload AWS SDK for PHP S3 CompleteMultipartUpload
     * @see https://docs.aws.amazon.com/AmazonS3/latest/API/API_CompleteMultipartUpload.html Amazon S3 API CompleteMultipartUpload
     */
    public function completeMultipartUpload(string $uploadKey, string $uploadId, array $parts): Result;

    /**
     * Aborts a multipart upload and deletes any parts that have been uploaded.
     *
     * @param string $uploadKey
     * @param string $uploadId
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-s3-2006-03-01.html#abortmultipartupload AWS SDK for PHP S3 AbortMultipartUpload
     * @see https://docs.aws.amazon.com/AmazonS3/latest/API/API_AbortMultipartUpload.html Amazon S3 API AbortMultipartUpload
     */
    public function abortMultipartUpload(string $uploadKey, string $uploadId): void;
}
