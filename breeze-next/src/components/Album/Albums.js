'use client'

import React, { useState, useEffect } from 'react'
import Link from 'next/link'
import useAlbum from '@/hooks/album'

const Albums = () => {
    const [albums, setAlbums] = useState([])
    const [newAlbumName, setNewAlbumName] = useState('')
    const { getAlbums, addAlbum } = useAlbum()

    useEffect(() => {
        fetchAlbums()
    }, [])

    const fetchAlbums = async () => {
        try {
            const response = await getAlbums()
            setAlbums(response.data.data)
        } catch (error) {
            console.error('Error fetching albums:', error)
        }
    }

    const handleAddAlbum = async (e) => {
        e.preventDefault()
        try {
            await addAlbum(newAlbumName)
            setNewAlbumName('')
            fetchAlbums()
        } catch (error) {
            console.error('Error adding album:', error)
        }
    }

    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-3xl font-bold mb-8">Your Albums</h1>

            {albums.length > 0 ? (
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    {albums.map((album) => (
                        <Link href={`/albums/id/${album.id}`} key={album.id}>
                            <div className="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div className="p-6">
                                    <h3 className="text-xl font-semibold mb-2">{album.display_name}</h3>
                                    <p className="text-gray-600">{album.photo_count} photos</p>
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>
            ) : (
                <div className="bg-gray-100 rounded-lg p-8 text-center">
                    <p className="text-xl text-gray-600">No albums yet. Create your first album below!</p>
                </div>
            )}

            <div className="mt-12">
                <h2 className="text-2xl font-bold mb-4">Create New Album</h2>
                <form onSubmit={handleAddAlbum} className="flex gap-4">
                    <input
                        type="text"
                        value={newAlbumName}
                        onChange={(e) => setNewAlbumName(e.target.value)}
                        placeholder="Album name"
                        className="flex-grow p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    <button type="submit" className="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-300">
                        Add Album
                    </button>
                </form>
            </div>
        </div>
    )
}

export default Albums