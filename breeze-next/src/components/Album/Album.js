'use client'

import React, { useState, useEffect } from 'react'
import { useParams, useRouter } from 'next/navigation'
import ImageUploader from '@/components/Album/ImageUploader'
import useAlbum from '@/hooks/album'

const Album = () => {
    const [album, setAlbum] = useState(null)
    const { id } = useParams()
    const router = useRouter()
    const { getAlbum } = useAlbum()

    useEffect(() => {
        fetchAlbumDetails()
    }, [id])

    const fetchAlbumDetails = async () => {
        try {
            const response = await getAlbum(id)
            setAlbum(response.data)
        } catch (error) {
            console.error('Error fetching album details:', error)
        }
    }

    if (!album) {
        return <div>Loading...</div>
    }

    return (
        <>
            <button
                onClick={() => router.back()}
                className="mb-6 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-300"
            >
                Back to Albums
            </button>
            <h1 className="text-3xl font-bold mb-8">{album.display_name}</h1>

            {album.photos && album.photos.length > 0 ? (
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    {album.photos.map((photo) => (
                        <div key={photo.id} className="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src={photo.file_path} alt={photo.title} className="w-full h-48 object-cover" />
                            <div className="p-4">
                                <h3 className="text-lg font-semibold mb-2">{photo.title}</h3>
                                <p className="text-gray-600">{photo.description}</p>
                            </div>
                        </div>
                    ))}
                </div>
            ) : (
                <div className="bg-gray-100 rounded-lg p-8 text-center">
                    <p className="text-xl text-gray-600">No photos in this album yet. Add your first photo below!</p>
                </div>
            )}

            <div className="mt-12">
                <h2 className="text-2xl font-bold mb-4">Add Photo to Album</h2>
                <ImageUploader
                    albumId={id}
                    onSuccess={fetchAlbumDetails}
                />
            </div>
        </>
    )
}

export default Album