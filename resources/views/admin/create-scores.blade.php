<x-layout>
    <x-sidebaradmin />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{__('scoreAdmin.title')}}</h1>

        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('score.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">{{__('scoreAdmin.file')}}</label>
                    <input type="file" name="file" accept=".xls,.xlsx" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Import
                </button>
            </form>
        </div>
    </section>
</x-layout>
