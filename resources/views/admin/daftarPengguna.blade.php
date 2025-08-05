<x-layout>
    <x-sidebaradmin :userData="$userData" />
    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">👤 {{ __('daftarPengguna.title') }}</h1>

        <!-- Enhanced Main Container -->
        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
            <!-- Header Section with Gradient -->
            <div class="flex justify-between items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ __('daftarPengguna.title') }}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ __('Kelola dan pantau data pengguna yang terdaftar') ?? 'Kelola daftar pengguna sistem' }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">{{ __('daftarPengguna.pengguna') }}</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $pengguna->total() }}</div>
                </div>
            </div>

            <div class="p-6">
                <!-- Search and Filter Section -->
                <div class="mb-6 space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4 justify-between items-start lg:items-center">
                        <!-- Search Input -->
                        <div class="w-full lg:w-[600px]">
                            <form action="{{ route('admin.pengguna') }}" method="GET" class="flex gap-2">
                                <!-- Search Box -->
                                <div class="relative w-[430px]">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder=" 🔍 {{ __('daftarPengguna.search') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- Search Button -->
                                <button type="submit"
                                    class="px-6 py-3 bg-[#00247D] text-white rounded-lg hover:bg-[#001b60] focus:ring-4 focus:ring-blue-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>

                                <!-- Reset Button -->
                                @if (request('search'))
                                    <a href="{{ route('admin.pengguna') }}"
                                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-sm hover:shadow-md">
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>

                        <!-- Per Page Selector + Add Button -->
                        <div class="flex gap-2">
                            <!-- Per Page Dropdown -->
                            <select id="perPage" onchange="changePerPage()"
                                class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[180px]">
                                @foreach ([10, 25, 50, 100] as $value)
                                    <option value="{{ $value }}" {{ request('perPage', 10) == $value ? 'selected' : '' }}>
                                        {{ $value }} {{ __('daftarPengguna.halaman') }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Add User Button -->
                            <button onclick="toggleModal(true)"
                                class="w-[211px] flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('daftarPengguna.add') ?? 'Tambah' }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Table -->
                <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
                    <table class="min-w-full table-fixed border-collapse bg-white">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <th class="w-16 px-3 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.pengguna', array_merge(request()->except(['sort', 'direction']), ['sort' => 'pengguna_id', 'direction' => request('sort') == 'pengguna_id' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>No</span>
                                        @if (request('sort') == 'pengguna_id')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="w-48 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.pengguna', array_merge(request()->except(['sort', 'direction']), ['sort' => 'nama', 'direction' => request('sort') == 'nama' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('daftarPengguna.name') }}</span>
                                        @if (request('sort') == 'nama')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="w-64 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                    <a href="{{ route('admin.pengguna', array_merge(request()->except(['sort', 'direction']), ['sort' => 'email', 'direction' => request('sort') == 'email' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('daftarPengguna.email') }}</span>
                                        @if (request('sort') == 'email')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                                <th class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <a href="{{ route('admin.pengguna', array_merge(request()->except(['sort', 'direction']), ['sort' => 'level', 'direction' => request('sort') == 'level' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="flex items-center space-x-1 hover:text-gray-700 transition-colors">
                                        <span>{{ __('daftarPengguna.level') }}</span>
                                        @if (request('sort') == 'level')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ request('direction') == 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                            </svg>
                                        @endif
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($pengguna as $index => $item)
                                <tr class="hover:bg-blue-50 transition-colors duration-200 score-row">
                                    <td class="px-3 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                                        <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-bold">
                                            {{ ($pengguna->currentPage() - 1) * $pengguna->perPage() + $loop->iteration }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm font-semibold text-gray-900 border-r border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <div>
                                                <div class="font-medium text-gray-900 truncate" title="{{ $item->nama }}">
                                                    {{ $item->nama }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                        <div class="flex items-center space-x-2">
                                            
                                            <span class="truncate">{{ $item->email }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        <span class="inline-flex items-center justify-center min-w-[100px] text-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $item->level == 'admin' ? 'bg-red-100 text-red-800' : 
                                            ($item->level == 'itc' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                                            
                                            @if ($item->level == 'admin')
                                                👩🏻‍💻 Admin
                                            @elseif ($item->level == 'itc')
                                                👩🏻‍✈️ ITC
                                            @else
                                                👤 Pengguna
                                            @endif
                                            
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="text-6xl text-gray-300 mb-4">👤</div>
                                            <h3 class="text-xl font-semibold text-gray-600 mb-2">
                                                {{ __('Tidak ada data pengguna.') }}
                                            </h3>
                                            @if (request('search'))
                                                <p class="text-sm text-gray-500 mb-4">Coba ubah kata kunci pencarian Anda</p>
                                                <a href="{{ route('admin.pengguna') }}"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                                    Reset Pencarian
                                                </a>
                                            @else
                                                <p class="text-sm text-gray-500">Belum ada pengguna yang terdaftar</p>
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
                        Menampilkan {{ $pengguna->firstItem() ?? 0 }} - {{ $pengguna->lastItem() ?? 0 }} dari {{ $pengguna->total() }} pengguna
                    </div>
                    <div>
                        {{ $pengguna->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Modal Tambah Pengguna -->
<div id="modalAddUser" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 transition-opacity duration-300 ease-in-out flex justify-center items-center">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform scale-95 opacity-0 transition-transform transition-opacity duration-300 ease-in-out"
         id="modalContent" role="dialog" aria-modal="true" tabindex="-1">
        
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200 rounded-t-xl">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">{{ __('daftarPengguna.add') ?? 'Tambah Pengguna' }}</h2>
                <button onclick="toggleModal(false)" class="text-gray-600 hover:text-red-600 text-2xl transition">&times;</button>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.pengguna.tambah') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">NIM/NIDN/NIP</label>
                <input type="text" name="no_induk" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="nama" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                <select name="level" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="admin">Admin</option>
                    <option value="peserta">Peserta</option>
                    <option value="ITC">ITC</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="toggleModal(false)"
                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
    </section>

    <style>
        /* Custom styles for wider table */
        .min-w-full {
            min-width: 800px;
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
                min-width: 600px;
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

        /* Modal animation */
        #modalAddUser.flex {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <script>
        function changePerPage() {
            const perPage = document.getElementById('perPage').value;
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('perPage', perPage);
            window.location.href = currentUrl.toString();
        }

        function toggleModal(show) {
        const modal = document.getElementById('modalAddUser');
        const content = document.getElementById('modalContent');

        if (show) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {
            content.classList.add('scale-95', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }
    }

        // Add loading states for buttons
        document.addEventListener('DOMContentLoaded', function() {
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

            // Close modal when clicking outside
            document.getElementById('modalAddUser').addEventListener('click', function(e) {
                if (e.target === this) {
                    toggleModal(false);
                }
            });
        });
    </script>
</x-layout>