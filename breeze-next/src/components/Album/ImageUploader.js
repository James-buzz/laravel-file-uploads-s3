'use client';
import {Dashboard} from "@uppy/react";
import Uppy from '@uppy/core';
import { useState } from 'react'
import AwsS3 from '@uppy/aws-s3';
import axios from '@/lib/axios';

import '@uppy/core/dist/style.min.css';
import '@uppy/dashboard/dist/style.min.css';

/**
 * Specific component for uploading images to albums
 */
const ImageUploader = ({onSuccess, albumId}) => {
	const [uppy] = useState(() => {
		const uppy = new Uppy({
			restrictions: {
				allowedFileTypes: ['image/*'],
			},
		});

		uppy.use(AwsS3, {
			endpoint: process.env.NEXT_PUBLIC_BACKEND_UPPY_URL,
			shouldUseMultipart(file) {
				return true;
			},
			createMultipartUpload(file, signal) {
				return axios.post('/companion/s3/multipart', {
					filename: file.name,
					type: file.type,
					size: file.data.size,
					metadata: file.meta,
				}, {
					signal,
				}).then((response) => {
					return {
						uploadId: response.data.uploadId,
						key: response.data.key,
					};
				});
			}
		});

		uppy.on('file-added', (file) => {
			uppy.setFileMeta(file.id, { upload_type: 'album', album_id: albumId });
		});

		uppy.on('complete', (result) => {
			onSuccess();
		});

		return uppy;
	});
	return (
		<Dashboard uppy={uppy} />
	);
}

export default ImageUploader;
