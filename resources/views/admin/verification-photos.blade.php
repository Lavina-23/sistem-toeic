<x-layout>
    <x-sidebaradmin />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">💬 Kirim Pesan pada Peserta</h1>
        <x-form-message />

        {{-- verification photos table --}}
        @if (isset($peserta))
            <h1 class="text-3xl font-bold text-gray-800 mb-6">📷 Verifikasi Foto Ruangan Tes Peserta</h1>
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
                {{-- Sortir Dropdown --}}
                <form method="GET" action="{{ route('verification') }}" class="mb-6 flex justify-end">
                    <select name="sortir" id="sortir" onchange="this.form.submit()"
                        class="block w-48 px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                        <option value="semua" {{ $sortir == 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="belum_lengkap" {{ $sortir == 'belum_lengkap' ? 'selected' : '' }}>Belum Lengkap
                        </option>
                        <option value="belum_kirim" {{ $sortir == 'belum_kirim' ? 'selected' : '' }}>Belum Kirim
                        </option>
                    </select>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-primary text-bone text-left">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">No Telepon</th>
                                <th class="px-4 py-2 border">Foto Depan</th>
                                <th class="px-4 py-2 border">Foto Belakang</th>
                                <th class="px-4 py-2 border">Foto Kiri</th>
                                <th class="px-4 py-2 border">Foto Kanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $index => $p)
                                <tr class="border-t hover:bg-gray-50 font-medium">
                                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border">{{ $p['nama'] }}</td>
                                    <td class="px-4 py-2 border">{{ $p['no_telp'] }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($p['front'])
                                            <img src="{{ asset('storage/verification_photos/' . $p['front']) }}"
                                                alt="Front Photo" class="w-16 h-16 object-cover rounded cursor-pointer"
                                                onclick="openModal('{{ asset('storage/verification_photos/' . $p['front']) }}')">
                                        @else
                                            <span class="text-gray-400">No Photo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($p['back'])
                                            <img src="{{ asset('storage/verification_photos/' . $p['back']) }}"
                                                alt="Back Photo" class="w-16 h-16 object-cover rounded cursor-pointer"
                                                onclick="openModal('{{ asset('storage/verification_photos/' . $p['back']) }}')">
                                        @else
                                            <span class="text-gray-400">No Photo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($p['left'])
                                            <img src="{{ asset('storage/verification_photos/' . $p['left']) }}"
                                                alt="Left Photo" class="w-16 h-16 object-cover rounded cursor-pointer"
                                                onclick="openModal('{{ asset('storage/verification_photos/' . $p['left']) }}')">
                                        @else
                                            <span class="text-gray-400">No Photo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if ($p['right'])
                                            <img src="{{ asset('storage/verification_photos/' . $p['right']) }}"
                                                alt="Right Photo" class="w-16 h-16 object-cover rounded cursor-pointer"
                                                onclick="openModal('{{ asset('storage/verification_photos/' . $p['right']) }}')">
                                        @else
                                            <span class="text-gray-400">No Photo</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Modal for viewing full-size images -->
                            <div id="imageModal"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                                <div class="bg-white p-4 rounded-lg max-w-3xl max-h-3xl">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold">Verification Photo</h3>
                                        <button onclick="closeModal()"
                                            class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                                    </div>
                                    <img id="modalImage" src="" alt="Full Size Photo"
                                        class="max-w-full max-h-96 object-contain">
                                </div>
                            </div>

                            <script>
                                function openModal(imageSrc) {
                                    document.getElementById('modalImage').src = imageSrc;
                                    document.getElementById('imageModal').classList.remove('hidden');
                                }

                                function closeModal() {
                                    document.getElementById('imageModal').classList.add('hidden');
                                }

                                // Close modal when clicking outside
                                document.getElementById('imageModal').addEventListener('click', function(e) {
                                    if (e.target === this) {
                                        closeModal();
                                    }
                                });
                            </script>
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
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada file verifikasi</h3>
                <p class="text-gray-600">Silakan buat broadcast permintaan verifikasi kepada peserta!</p>
            </div>
        @endif
    </section>
</x-layout>
