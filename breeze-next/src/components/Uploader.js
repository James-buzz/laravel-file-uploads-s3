'use client';
import {Dashboard} from "@uppy/react";
import Uppy from '@uppy/core';
import { useState } from 'react'
import AwsS3 from '@uppy/aws-s3';

import '@uppy/core/dist/style.min.css';
import '@uppy/dashboard/dist/style.min.css';

const Uploader = () => {
	const [uppy] = useState(() => {
		const uppy = new Uppy();

		uppy.use(AwsS3, {
			endpoint: process.env.NEXT_PUBLIC_BACKEND_UPPY_URL,
			shouldUseMultipart(file) {
				return true;
			},
		});

		return uppy;
	});
	return (
		<Dashboard uppy={uppy} />
	);
}

export default Uploader;
