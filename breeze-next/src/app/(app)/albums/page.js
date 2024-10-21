import Header from '@/app/(app)/Header'
import AlbumsComponent from '@/components/Album/Albums'

export const metadata = {
    title: 'Albums',
}

export default function Albums() {
    return (
        <>
            <Header title="Albums" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <AlbumsComponent/>
                </div>
            </div>
        </>
    )
}