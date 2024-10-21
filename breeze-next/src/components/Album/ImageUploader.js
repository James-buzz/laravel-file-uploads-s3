'use client'
import { Dashboard } from '@uppy/react'
import Uppy from '@uppy/core'
import { useState } from 'react'
import '@uppy/core/dist/style.min.css'
import '@uppy/dashboard/dist/style.min.css'
import AxiosAwsS3Plugin from '@/lib/uppy/AxiosAwsS3Plugin'

/**
 * Specific component for uploading images to albums
 */
const ImageUploader = ({ onSuccess, albumId }) => {
    const [uppy] = useState(() => {
        const uppy = new Uppy({
            restrictions: {
                allowedFileTypes: ['image/*'],
            },
            fetchOptions: {
                withCredentials: true,
            },
        })

        uppy.use(AxiosAwsS3Plugin, {
            endpoint: process.env.NEXT_PUBLIC_BACKEND_UPPY_URL,
			// TODO: Direct uploads not enabled for now.
			shouldUseMultipart: () => false,
        })

        uppy.on('file-added', file => {
            uppy.setFileMeta(file.id, {
                upload_type: 'album',
                album_id: albumId,
                file_name: file.name,
            })
        })

        uppy.on('complete', () => {
            onSuccess()
        })

        return uppy
    })
    return <Dashboard uppy={uppy} />
}

export default ImageUploader
