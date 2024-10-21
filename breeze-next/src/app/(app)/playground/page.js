import Header from '@/app/(app)/Header'

export const metadata = {
    title: 'Playground',
}

export default function Playground() {
    return (
        <>
            <Header title="Playground" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    There's nothing here yet.
                </div>
            </div>
        </>
    )
}
