<x-layout>
    <x-sidebaradmin :userData="$userData" />
    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('daftarPengguna.title') }}</h1>

        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-4">
            
            <!-- Form pencarian -->
            <div class="mb-4">
                <form action="{{ route('admin.pengguna') }}" method="GET" class="flex gap-2">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="{{ __('daftarPengguna.search') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-[#001a5c] transition">
                        <svg xmlns="http://www.w3..org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    @if (request('search'))
                        <a href="{{ route('admin.pengguna') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Informasi jumlah data -->
            <div class="flex justify-between items-center mb-4">
                <p class="text-gray-600">Total: <span class="font-medium">{{ $pengguna->total() }}</span>
                    {{ __('daftarPengguna.pengguna') }}</p>
                <div class="flex space-x-2">
                    <select id="perPage" onchange="changePerPage()"
                        class="px-5 py-1 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                        @foreach ([10, 25, 50, 100] as $value)
                            <option value="{{ $value }}"
                                {{ request('perPage', 10) == $value ? 'selected' : '' }}>
                                {{ $value }} {{ __('daftarPengguna.halaman') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tabel data pengguna -->
            <div class="overflow-auto max-h-[500px]">
                <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50 sticky top-0">
        <tr>
            <th scope="col" class="px-4 py-3 text-left text-[10px] font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'pengguna_id', 'direction' => request('sort') == 'peserta_id' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center space-x-1">
                    <span>No</span>
                    @if (request('sort') == 'pengguna_id')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                        </svg>
                    @endif
                </a>
            </th>

            <th scope="col" class="px-4 py-3 text-left text-[10px] font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'nama', 'direction' => request('sort') == 'nama' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center space-x-1">
                    <span>{{ __('daftarPengguna.name') }}</span>
                    @if (request('sort') == 'nama')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                        </svg>
                    @endif
                </a>
            </th>

            <th scope="col" class="px-4 py-3 text-left text-[10px] font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'email', 'direction' => request('sort') == 'email' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center space-x-1">
                    <span>{{ __('daftarPengguna.email') }}</span>
                    @if (request('sort') == 'email')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                        </svg>
                    @endif
                </a>
            </th>

            <th scope="col" class="px-4 py-3 text-left text-[10px] font-medium text-gray-500 uppercase tracking-wider">
                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction', 'page']), ['sort' => 'level', 'direction' => request('sort') == 'level' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="flex items-center space-x-1">
                    <span>{{ __('daftarPengguna.level') }}</span>
                    @if (request('sort') == 'level')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                        </svg>
                    @endif
                </a>
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($pengguna as $index => $item)
            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 transition text-[14px]">
                <td class="px-4 py-2 text-[14px] text-gray-500 whitespace-nowrap">
                    {{ $pengguna->firstItem() + $index }}
                </td>
                <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $item->nama }}</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ $item->email }}</td>
                <td class="px-4 py-2 whitespace-nowrap">{{ $item->level }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-gray-400 py-4">{{ __('Tidak ada data pengguna.') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $pengguna->appends(request()->except('page'))->links() }}
            </div>
        </div>

        <div class="mt-6 flex justify-center">
            <a href="{{ route('admin.export.pengguna') }}" download
                class="inline-flex items-center px-6 py-3 text-sm font-medium bg-[#00247D] text-white rounded-lg hover:bg-[#001b60] focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                {{ __('daftarPengguna.download') }}
            </a>
            
            <button onclick="toggleModal(true)"
                class="inline-flex items-center px-6 py-3 text-sm font-medium bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition-colors duration-200 shadow-sm hover:shadow-md ml-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Pengguna
            </button>

        </div>

        <!-- Modal Tambah Pengguna -->
<div id="modalAddUser" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Tambah Pengguna</h2>
            <button onclick="toggleModal(false)" class="text-gray-600 hover:text-red-600 text-2xl">&times;</button>
        </div>
        <form action="{{ route('admin.pengguna.tambah') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                <select name="level" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="admin">Admin</option>
                    <option value="peserta">Peserta</option>
                    <option value="ITC">ITC</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(show) {
        const modal = document.getElementById('modalAddUser');
        modal.classList.toggle('hidden', !show);
        modal.classList.toggle('flex', show);
    }
</script>

    </section>

    <script>
        function changePerPage() {
            const perPage = document.getElementById('perPage').value;
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('perPage', perPage);
            window.location.href = currentUrl.toString();
        }
    </script>
</x-layout>
