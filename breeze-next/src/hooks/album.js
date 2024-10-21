import axios from '@/lib/axios'

const useAlbum = () => {
    const getAlbum = async id => {
        return await axios.get('/albums/' + id)
    }

    const getAlbums = async () => {
        return await axios.get('/albums')
    }

    const addAlbum = async name => {
        return await axios.post('/albums', { name })
    }

    return {
        getAlbum,
        getAlbums,
        addAlbum,
    }
}

export default useAlbum
