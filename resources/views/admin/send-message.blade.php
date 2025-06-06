<x-layout>
    <x-sidebaradmin />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('scoreAdmin.title') }}</h1>

        @if (isset($photos) && $pengumumans->count() > 0)
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">{{ __('pengumuman.list') }}</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-left">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">{{ __('pengumuman.announce') }}</th>
                                <th class="px-4 py-2 border">{{ __('pengumuman.desc') }}</th>
                                <th class="px-4 py-2 border">File</th>
                                <th class="px-4 py-2 border">Status</th>
                                <th class="px-4 py-2 border text-center min-w-[200px]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumumans as $index => $pengumuman)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border font-medium">{{ $pengumuman->judul }}</td>
                                    <td class="px-4 py-2 border">
                                        <div class="max-w-xs">
                                            {{ Str::limit($pengumuman->isi, 50) }}
                                            @if (strlen($pengumuman->isi) > 50)
                                                <button
                                                    onclick="toggleFullDescription({{ $pengumuman->pengumuman_id }})"
                                                    class="text-blue-600 hover:underline text-sm ml-1">
                                                    Lihat Selengkapnya
                                                </button>
                                                <div id="full-desc-{{ $pengumuman->pengumuman_id }}"
                                                    class="hidden mt-2 p-2 bg-gray-50 rounded text-sm">
                                                    {{ $pengumuman->isi }}
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($pengumuman->file)
                                            <div class="flex flex-col gap-1">
                                                <a href="{{ asset('storage/' . $pengumuman->file) }}" target="_blank"
                                                    class="text-blue-600 underline hover:text-blue-800 text-sm">
                                                    📄 Lihat File
                                                </a>
                                                <span class="text-xs text-gray-500">
                                                    {{ pathinfo($pengumuman->file, PATHINFO_EXTENSION) }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($pengumuman->is_active)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                ✅ {{ __('pengumuman.aktif') }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                ⏸️ {{ __('pengumuman.non') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 border text-center">
                                        <div class="flex flex-wrap justify-center gap-1">
                                            <!-- Toggle Status Button -->
                                            @if (!$pengumuman->is_active)
                                                <form
                                                    action="{{ route('pengumuman.activate', ['id' => $pengumuman->pengumuman_id]) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                        onclick="return confirm('Apakah Anda yakin ingin menampilkan pengumuman ini di laman peserta?')"
                                                        title="Tampilkan pengumuman">
                                                        👁️ Tampilkan
                                                    </button>
                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('pengumuman.deactivate', ['id' => $pengumuman->pengumuman_id]) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-orange-500 hover:bg-orange-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                        onclick="return confirm('Apakah Anda yakin ingin menyembunyikan pengumuman ini dari laman peserta?')"
                                                        title="Sembunyikan pengumuman">
                                                        🔒 Sembunyikan
                                                    </button>
                                                </form>
                                            @endif

                                            <!-- Edit Button -->
                                            <button onclick="openEditModal({{ json_encode($pengumuman) }})"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                title="Edit pengumuman">
                                                ✏️ Edit
                                            </button>

                                            <!-- Delete Button -->
                                            <form
                                                action="{{ route('pengumuman.destroy', ['id' => $pengumuman->pengumuman_id]) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini secara permanen?')"
                                                    title="Hapus pengumuman">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 text-center mb-6">
                <div class="text-gray-500 mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengumuman</h3>
                <p class="text-gray-600">Tambahkan pengumuman pertama Anda untuk peserta.</p>
            </div>
        @endif

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
                <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                    Kirim
                </button>
            </form>
        </div>
    </section>
</x-layout>
