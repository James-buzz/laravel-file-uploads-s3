import AwsS3 from '@uppy/aws-s3'
import axios from '@/lib/axios'

/**
 * This utility plugin is Overriding the default AwsS3 plugin to use Axios instead of Fetch API.
 * This is because Axios.js is already configured with the necessary headers and interceptors for Laravel Sanctum.
 */
export default class AxiosAwsS3Plugin extends AwsS3 {
	getUploadParameters(file, options){
		return axios
			.post('/companion/s3/params', {
				filename: file.name,
				type: file.type,
				metadata: file.meta,
			}, {
				signal: options.signal,
			})
			.then(response => {
				return {
					method: 'PUT',
					url: response.data.url,
					fields: response.data.fields,
					headers: response.data.headers,
				}
			})
	}
    createMultipartUpload(file, signal) {
        return axios
            .post(
                '/companion/s3/multipart',
                {
                    filename: file.name,
                    type: file.type,
                    size: file.data.size,
                    metadata: file.meta,
                },
                {
                    signal,
                },
            )
            .then(response => {
                return {
                    uploadId: response.data.uploadId,
                    key: response.data.key,
                    url: response.data.url,
                    headers: response.data.headers || {},
                }
            })
    }

    listParts(file, { key, uploadId, signal }) {
        return axios
            .get(`/companion/s3/multipart/${uploadId}`, {
                params: { key },
                signal,
            })
            .then(response => response.data.parts)
    }

    completeMultipartUpload(file, { key, uploadId, parts, signal }) {
        return axios
            .post(
                `/companion/s3/multipart/${uploadId}/complete`,
                {
                    key,
                    parts,
                    metadata: file.meta,
                },
                {
                    signal,
                },
            )
            .then(response => response.data)
    }

    abortMultipartUpload(file, { key, uploadId, signal }) {
        return axios
            .delete(`/companion/s3/multipart/${uploadId}`, {
                data: { key },
                signal,
            })
            .then(() => {})
    }

    signPart(file, { uploadId, key, partNumber, signal }) {
        return axios
            .get(`/companion/s3/multipart/${uploadId}/${partNumber}`, {
                params: { key },
                signal,
            })
            .then(response => response.data)
    }
}
