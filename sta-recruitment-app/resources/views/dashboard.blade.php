<x-app-layout>
    @if (session('status'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
                {{ session('status') }}
            </div>
        </div>
    @endif


    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">
                วีดีโอแนะนำคณะ
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 text-center flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำคณะ STA</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 text-center flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำสาขา ComSci</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 text-center flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำสาขา IT</h3>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="aspect-video bg-gray-300 rounded mb-2 text-center flex items-center justify-center text-gray-500">
                        (Video Placeholder)
                    </div>
                    <h3 class="font-semibold text-gray-700">แนะนำสาขา Agri</h3>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>