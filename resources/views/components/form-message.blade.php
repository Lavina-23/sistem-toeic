        {{-- form message --}}
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

            <form action="{{ route('send.message') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Pesan</label>
                    <textarea name="message" id="message" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200"></textarea>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Nomor Whatsapp</label>
                    <input type="file" name="excel_numbers" accept=".xls,.xlsx" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200">
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primaryMid transition">
                    Kirim
                </button>
            </form>
        </div>
