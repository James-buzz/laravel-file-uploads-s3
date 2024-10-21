import Header from '@/app/(app)/Header'
import Album from '@/components/Album/Album'

export const metadata = {
    title: 'Laravel - Album',
}

const AlbumId = () => {
    return (
        <>
            <Header title="Album" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Album />
                </div>
            </div>
        </>
    )
}

export default AlbumId
