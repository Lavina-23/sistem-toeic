<x-layout>
    <x-sidebaradmin :userData="$userData" />
    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('listPeserta.title') }}</h1>

        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-4">
            <!-- Form pencarian -->
            <div class="mb-4">
                <form action="{{ route('admin.dashboard') }}" method="GET" class="flex gap-2">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="{{__('listPeserta.search')}}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    @if (request('search'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Informasi jumlah data -->
            <div class="flex justify-between items-center mb-4">
                <p class="text-gray-600">Total: <span class="font-medium">{{ $peserta->total() }}</span> {{__('listPeserta.peserta')}}</p>
                <div class="flex space-x-2">
                    <select id="perPage" onchange="changePerPage()"
                        class="px-5 py-1 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @foreach ([10, 25, 50, 100] as $value)
                            <option value="{{ $value }}"
                                {{ request('perPage', 10) == $value ? 'selected' : '' }}>
                                {{ $value }} {{__('listPeserta.halaman')}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tabel data peserta -->
            <div class="overflow-auto max-h-[500px]">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'peserta_id', 'direction' => request('sort') == 'peserta_id' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center space-x-1">
                                    <span>No</span>
                                    @if (request('sort') == 'peserta_id')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'nama', 'direction' => request('sort') == 'nama' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center space-x-1">
                                    <span>{{__('listPeserta.name')}}</span>
                                    @if (request('sort') == 'nama')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'no_induk', 'direction' => request('sort') == 'no_induk' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center space-x-1">
                                    <span>{{__('listPeserta.ninduk')}}</span>
                                    @if (request('sort') == 'no_induk')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('listPeserta.notelp')}}
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'jurusan', 'direction' => request('sort') == 'jurusan' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center space-x-1">
                                    <span>{{__('listPeserta.jurusan')}}</span>
                                    @if (request('sort') == 'jurusan')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'program_studi', 'direction' => request('sort') == 'program_studi' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center space-x-1">
                                    <span>{{__('listPeserta.prodi')}}</span>
                                    @if (request('sort') == 'program_studi')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                        </svg>
                                    @endif
                                </a>
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'kampus', 'direction' => request('sort') == 'kampus' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                    class="flex items-center space-x-1">
                                    <span>{{__('listPeserta.kampus')}}</span>
                                    @if (request('sort') == 'kampus')
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
                        @forelse($peserta as $index => $item)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 transition">
                                <td class="px-4 py-2 whitespace-nowrap">
                                    {{ ($peserta->currentPage() - 1) * $peserta->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap font-medium text-gray-900">
                                    {{ $item->nama }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    {{ $item->no_induk }}
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    {{ $item->no_telp }}
                                </td>
                                <td class="px-4 py-2 whitespace-normal break-words max-w-xs">
                                    {{ $item->jurusan }}
                                </td>
                                <td class="px-4 py-2 whitespace-normal break-words max-w-xs">
                                    {{ $item->program_studi }}
                                </td>
                                <td class="px-4 py-2 whitespace-normal break-words max-w-xs">
                                    {{ $item->kampus }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-lg font-medium">{{__('listPeserta.nodata')}}</p>
                                        @if (request('search'))
                                            <p class="text-sm">{{__('listPeserta.reset')}}</p>
                                        @else
                                            <p class="text-sm">{{__('listPeserta.noregist')}}</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $peserta->appends(request()->except('page'))->links() }}
            </div>
        </div>
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
