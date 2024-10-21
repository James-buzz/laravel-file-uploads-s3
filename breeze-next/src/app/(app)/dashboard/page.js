import Header from '@/app/(app)/Header'

export const metadata = {
    title: 'Dashboard',
}

export default function Albums() {
    return (
        <>
            <Header title="Dashboard" />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    Hello there.
                </div>
            </div>
        </>
    )
}
