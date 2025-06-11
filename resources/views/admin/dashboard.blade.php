<x-layout>
    <x-sidebaradmin :userData="$userData" />
    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">👥 {{ __('listPeserta.title') }}</h1>

        <!-- Enhanced Main Container -->
        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
            <!-- Header Section with Gradient -->
            <div
                class="flex justify-between items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{__('listPeserta.list')}}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{__('listPeserta.desc')}}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">{{__('listPeserta.peserta')}}</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $peserta->total() }}</div>
                </div>
            </div>

            <div class="p-6">
                <!-- Enhanced Search and Filter Section -->
                <div class="mb-6 space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Search Input -->
                        <div class="flex-[2]">
                            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex gap-2">
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="🔍 {{ __('listPeserta.search') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <button type="submit"
                                    class="px-6 py-3 bg-[#00247D] text-white rounded-lg hover:bg-[#001b60] focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                                @if (request('search'))
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-sm hover:shadow-md">
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>

                        <!-- Per Page Selector -->
                        <div class="flex gap-3">
                            <select id="perPage" onchange="changePerPage()"
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[180px]">
                                @foreach ([10, 25, 50, 100] as $value)
                                    <option value="{{ $value }}"
                                        {{ request('perPage', 10) == $value ? 'selected' : '' }}>
                                        {{ $value }} {{ __('listPeserta.halaman') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Table -->
                <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
                    <table class="min-w-full table-fixed border-collapse bg-white">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <th
                                    class="w-16 px-3 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'peserta_id', 'direction' => request('sort') == 'peserta_id' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
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
                                <th
                                    class="w-48 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'nama', 'direction' => request('sort') == 'nama' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('listPeserta.name') }}</span>
                                        @if (request('sort') == 'nama')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th
                                    class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'no_induk', 'direction' => request('sort') == 'no_induk' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('listPeserta.ninduk') }}</span>
                                        @if (request('sort') == 'no_induk')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th
                                    class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    {{ __('listPeserta.notelp') }}
                                </th>
                                <th
                                    class="w-40 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'jurusan', 'direction' => request('sort') == 'jurusan' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('listPeserta.jurusan') }}</span>
                                        @if (request('sort') == 'jurusan')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th
                                    class="w-40 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'program_studi', 'direction' => request('sort') == 'program_studi' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('listPeserta.prodi') }}</span>
                                        @if (request('sort') == 'program_studi')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th
                                    class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'kampus', 'direction' => request('sort') == 'kampus' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('listPeserta.kampus') }}</span>
                                        @if (request('sort') == 'kampus')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th
                                    class="w-28 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <a href="{{ route('admin.dashboard', array_merge(request()->except(['sort', 'direction']), ['sort' => 'tgl_lahir', 'direction' => request('sort') == 'tgl_lahir' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>Tanggal Lahir</span>
                                        @if (request('sort') == 'tgl_lahir')
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
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($peserta as $index => $item)
                                <tr class="hover:bg-blue-50 transition-colors duration-200 score-row">
                                    <td class="px-3 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-bold">
                                            {{ ($peserta->currentPage() - 1) * $peserta->perPage() + $loop->iteration }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-semibold text-gray-900 border-r border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div>
                                                <div class="font-medium text-gray-900 truncate"
                                                    title="{{ $item->nama }}">
                                                    {{ $item->nama }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 font-mono">
                                        <span class="px-2 py-1 rounded text-xs font-medium">
                                            {{ $item->no_induk }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 font-mono">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-green-600"></span>
                                            <span>{{ $item->no_telp }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                        <div class="max-w-xs">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ $item->jurusan }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                        <div class="max-w-xs">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $item->program_studi }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $item->kampus }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-orange-600"></span>
                                            <span
                                                class="font-medium">{{ \Carbon\Carbon::parse($item->tgl_lahir)->format('d-m-Y') }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="text-6xl text-gray-300 mb-4">👥</div>
                                            <h3 class="text-xl font-semibold text-gray-600 mb-2">
                                                {{ __('listPeserta.nodata') }}</h3>
                                            @if (request('search'))
                                                <p class="text-sm text-gray-500 mb-4">{{ __('listPeserta.reset') }}
                                                </p>
                                                <a href="{{ route('admin.dashboard') }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                    Reset Pencarian
                                                </a>
                                            @else
                                                <p class="text-sm text-gray-500">{{ __('listPeserta.noregist') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Pagination -->
                <div class="mt-6 flex justify-between items-center">
                    <div class="text-sm text-gray-700">
                        {{__('listPeserta.show')}} {{ $peserta->firstItem() ?? 0 }} - {{ $peserta->lastItem() ?? 0 }} {{__('listPeserta.of') }}
                        {{ $peserta->total() }} {{__('listPeserta.pes') }}
                    </div>
                    <div>
                        {{ $peserta->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <div class="mt-1 flex justify-center">
                <a href="{{ route('admin.export.pdf') }}" download
                    class="inline-flex items-center px-6 py-3 text-sm font-medium bg-primary text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    {{ __('listPeserta.download') }}
                </a>
            </div>
            <div class="mt-1 flex justify-center">
                <a href="{{ route('admin.export.nomor') }}" download
                    class="inline-flex items-center px-6 py-3 text-sm font-medium bg-green-950 text-white rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    {{__('listPeserta.expno')}}
                </a>
            </div>
            <div class="mt-1 flex justify-center">
                <a href="{{ route('admin.export.peserta') }}" download
                    class="inline-flex items-center px-6 py-3 text-sm font-medium bg-green-950 text-white rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    {{ __('listPeserta.expes') }}
                </a>
            </div>
        </div>
    </section>

    <style>
        /* Custom styles for wider table */
        .min-w-full {
            min-width: 1200px;
        }

        /* Ensure table stretches full width */
        .table-fixed {
            table-layout: fixed;
            width: 100%;
        }

        /* Better scrollbar styling */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Enhanced hover effects */
        .score-row:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Better mobile responsiveness */
        @media (max-width: 768px) {
            .min-w-full {
                min-width: 1000px;
            }

            .flex-col {
                flex-direction: column;
            }

            .sm\:flex-row {
                flex-direction: row;
            }
        }

        /* Smooth transitions for all interactive elements */
        * {
            transition: all 0.2s ease-out;
        }

        /* Enhanced badge styles */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
    </style>

    <script>
        function changePerPage() {
            const perPage = document.getElementById('perPage').value;
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('perPage', perPage);
            window.location.href = currentUrl.toString();
        }

        // Add smooth scroll behavior
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading states for buttons
            const buttons = document.querySelectorAll('a[download]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mengunduh...
                    `;

                    // Reset after 3 seconds
                    setTimeout(() => {
                        this.innerHTML = originalText;
                    }, 3000);
                });
            });
        });
    </script>
</x-layout>
