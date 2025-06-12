@php
    use Illuminate\Support\Str;
@endphp

<x-layout>
    <x-sidebaradmin />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('pengumuman.title') }}</h1>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Enhanced Main Container -->
        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
            <!-- Header Section with Gradient -->
            <div class="flex justify-between items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">📢 {{ __('pengumuman.list') }}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ __('Kelola dan pantau pengumuman sistem') ?? 'Kelola daftar pengumuman' }}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Total Pengumuman</div>
                    <div class="text-2xl font-bold text-blue-600">{{ isset($pengumumans) ? $pengumumans->count() : 0 }}</div>
                </div>
            </div>

            <div class="p-6">
                <!-- Search and Filter Section -->
                <div class="mb-6 space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4 justify-between items-start lg:items-center">
                        <!-- Search Input -->
                        <div class="w-full lg:w-[600px]">
                            <form action="{{ route('pengumuman.index') }}" method="GET" class="flex flex-wrap lg:flex-nowrap gap-2 items-center">
                                <!-- Search Box -->
                                <div class="relative w-[390px]">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="🔍 Cari pengumuman..."
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
                                    <a href="{{ route('pengumuman.index') }}"
                                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-sm hover:shadow-md">
                                        Reset
                                    </a>
                                @endif
                            </form>
                        </div>

                        <!-- Per Page Selector + Add Button -->
                        <div class="flex gap-2 items-center">
                            <!-- Per Page Dropdown -->
                            <div class="mt-0">
                                <select id="perPage" onchange="changePerPage()"
                                    class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[180px]">
                                    @foreach ([10, 25, 50, 100] as $value)
                                        <option value="{{ $value }}" {{ request('perPage', 10) == $value ? 'selected' : '' }}>
                                            {{ $value }} per halaman
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Add Pengumuman Button -->
                            <button onclick="togglePengumumanForm()" id="toggleBtn"
                                class="w-[250px] flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-200 transition-colors duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span id="toggleText" class="ml-2">{{__('pengumuman.addbot')}}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Table -->
                @if(isset($pengumumans) && $pengumumans->count() > 0)
                    <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
                        <table class="min-w-full table-fixed border-collapse bg-white">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                    <th class="w-16 px-3 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        No
                                    </th>
                                    <th class="w-48 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('pengumuman.announce') }}
                                    </th>
                                    <th class="w-64 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('pengumuman.desc') }}
                                    </th>
                                    <th class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('pengumuman.file')}}
                                    </th>
                                    <th class="w-24 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__("pengumuman.status")}}
                                    </th>
                                    <th class="w-48 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{__('pengumuman.aksi')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($pengumumans as $index => $pengumuman)
                                    <tr class="hover:bg-blue-50 transition-colors duration-200 score-row">
                                        <td class="px-3 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                                            <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-bold">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 border-r border-gray-100">
                                            <div class="flex items-center space-x-3">
                                                <div>
                                                    <div class="font-medium text-gray-900 break-words">
                                                        {{ $pengumuman->judul }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        {{-- {{ $pengumuman->created_at->format('d M Y, H:i') }} --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                            <div class="max-w-xs">
                                                @if(strlen($pengumuman->isi) > 100)
                                                    <div id="short-desc-{{ $pengumuman->pengumuman_id }}">
                                                        <span class="truncate">{{ Str::limit($pengumuman->isi, 100) }}</span>
                                                        <button onclick="toggleFullDescription({{ $pengumuman->pengumuman_id }})" 
                                                                class="text-blue-600 hover:text-blue-800 text-sm ml-1">
                                                            {{ __('pengumuman.more') }}
                                                        </button>
                                                    </div>
                                                    <div id="full-desc-{{ $pengumuman->pengumuman_id }}" class="hidden">
                                                        {{ $pengumuman->isi }}
                                                        <button onclick="toggleFullDescription({{ $pengumuman->pengumuman_id }})" 
                                                                class="text-blue-600 hover:text-blue-800 text-sm ml-1">
                                                            {{ __('pengumuman.ttp') }}
                                                        </button>
                                                    </div>
                                                @else
                                                    <span class="truncate">{{ $pengumuman->isi }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                            @if($pengumuman->file)
                                                @php
                                                    $fileExtension = strtolower(pathinfo($pengumuman->file, PATHINFO_EXTENSION));
                                                @endphp

                                                <div class="flex flex-col items-center space-y-2">
                                                    @if($fileExtension === 'pdf')
                                                        <object data="{{ asset('storage/' . $pengumuman->file) }}" type="application/pdf" width="100" height="120">
                                                            <p class="text-gray-500">Preview PDF tidak tersedia.</p>
                                                        </object>
                                                    @else
                                                        <p class="text-gray-500 text-sm">Tidak dapat menampilkan preview.</p>
                                                    @endif

                                                    <a href="{{ asset('storage/' . $pengumuman->file) }}" 
                                                    target="_blank"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs transition-colors">
                                                        👀 Lihat
                                                    </a>
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-sm">{{__('pengumuman.nofile')}}</span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                            @if($pengumuman->status)
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    ❌ Tidak Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    ✅ Aktif
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                            <div class="flex flex-wrap gap-2 justify-center">
                                                <!-- Toggle Status Button -->
                                                <form action="{{ route('pengumuman.toggle-status', ['id' => $pengumuman->pengumuman_id]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="bg-{{ $pengumuman->status == 0 ? 'red' : 'green' }}-500 hover:bg-{{ $pengumuman->status == 0 ? 'red' : 'green' }}-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                            title="{{ $pengumuman->status == 0 ? 'Nonaktifkan' : 'Aktifkan' }} pengumuman">
                                                        {{ $pengumuman->status == 0 ? '❌ ' . __('pengumuman.non') : '✅ ' . __('pengumuman.aktif') }}
                                                    </button>
                                                </form>

                                                <!-- Edit Button -->
                                                <button onclick="openEditModal({{ json_encode($pengumuman) }})"
                                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                        title="Edit pengumuman">
                                                    ✏️ {{__('pengumuman.edit')}}
                                                </button>
                                                
                                                <form action="{{ route('pengumuman.destroy', ['id' => $pengumuman->pengumuman_id]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs transition-colors whitespace-nowrap"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini secara permanen?')"
                                                            title="Hapus pengumuman">
                                                        🗑️ {{__('pengumuman.delete')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Enhanced Pagination -->
                    @if(method_exists($pengumumans, 'links'))
                        <div class="mt-6 flex justify-between items-center">
                            <div class="text-sm text-gray-700">
                                Menampilkan {{ $pengumumans->firstItem() ?? 0 }} - {{ $pengumumans->lastItem() ?? 0 }} dari {{ $pengumumans->total() }} pengumuman
                            </div>
                            <div>
                                {{ $pengumumans->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 text-center mb-6">
                <div class="text-gray-500 mb-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengumuman</h3>
                <p class="text-gray-600">Tambahkan pengumuman pertama Anda untuk peserta.</p>
            </div>
        </div>
        @endif

        <!-- Form Tambah Pengumuman (Hidden by default) -->
        <div id="pengumumanForm" style="display: none;">
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="mr-2">📝</span>
                    {{__('pengumuman.add')}}
                </h2>
                
                <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label for="judul" class="block text-gray-700 mb-2 font-medium">{{__('pengumuman.announce')}} <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" required
                            value="{{ old('judul') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="{{__('pengumuman.jdl')}}...">
                    </div>

                    <div>
                        <label for="isi" class="block text-gray-700 mb-2 font-medium">{{__('pengumuman.desc')}} <span class="text-red-500">*</span></label>
                        <textarea name="isi" id="isi" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical"
                            placeholder="{{__('pengumuman.des')}}">{{ old('isi') }}</textarea>
                        <div class="text-sm text-gray-500 mt-1">{{__('pengumuman.ten')}}</div>
                    </div>

                    <div>
                        <label for="file" class="block text-gray-700 mb-2 font-medium">{{__('pengumuman.select')}} <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="file" name="file" id="file" accept="application/pdf,.doc,.docx,.jpg,.jpeg,.png" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        <div class="text-sm text-gray-500 mt-1">
                            {{__('pengumuman.select')}}
                        </div>
                        <div id="filePreview" class="mt-2 hidden">
                            <div class="flex items-center p-2 bg-gray-50 rounded border">
                                <span id="fileName" class="text-sm text-gray-700"></span>
                                <span id="fileSize" class="text-xs text-gray-500 ml-2"></span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-md">
                            💾 {{__('pengumuman.import')}}
                        </button>
                        <button type="button" onclick="togglePengumumanForm()"
                            class="flex-1 px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors font-semibold shadow-md">
                            ❌ {{__('pengumuman.cancel')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">{{__('pengumuman.edit')}}</h3>
                        <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">{{__('pengumuman.announce')}}</label>
                                <input type="text" name="judul" id="editJudul" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">{{__('pengumuman.desc')}}</label>
                                <textarea name="isi" id="editIsi" rows="4" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">{{__('pengumuman.new')}}</label>
                                <input type="file" name="file" accept="application/pdf,.doc,.docx,.jpg,.jpeg,.png"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                                <div class="text-sm text-gray-500 mt-1">{{__('pengumuman.kosong')}}</div>
                            </div>

                            <div class="flex gap-4 pt-4">
                                <button type="submit"
                                    class="flex-1 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    {{__('pengumuman.save')}}
                                </button>
                                <button type="button" onclick="closeEditModal()"
                                    class="flex-1 px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                    {{__('pengumuman.cancel')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <label for="isi"
                        class="block text-gray-700 mb-2 font-medium">{{ __('pengumuman.desc') }}</label>
                    <textarea name="isi" id="isi" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200"></textarea>
                </div>

                <div>
                    <label for="file"
                        class="block text-gray-700 mb-2 font-medium">{{ __('pengumuman.select') }}</label>
                    <input type="file" name="file" id="file" accept="application/pdf" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200">
                </div>

                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-[#001a5c] transition">
                    Import
                </button>
            </form>
        </div>
    </section>

    <style>
        /* Custom styles for wider table */
        .min-w-full {
            min-width: 1000px;
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
                min-width: 800px;
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
    </style>

    <script>
        function togglePengumumanForm() {
            const form = document.getElementById('pengumumanForm');
            const btn = document.getElementById('toggleBtn');
            const icon = document.getElementById('toggleIcon');
            const text = document.getElementById('toggleText');
            
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
                icon.innerHTML = '❌';
                text.innerHTML = '{{__('pengumuman.close')}}';
                btn.className = 'inline-flex items-center px-6 py-3 bg-red-500 text-white rounded-lg font-semibold shadow-md hover:bg-red-600 transition-all duration-200 transform hover:scale-105';
            } else {
                form.style.display = 'none';
                icon.innerHTML = '➕';
                text.innerHTML = '{{__('pengumuman.addbot')}}';
                btn.className = 'inline-flex items-center px-6 py-3 text-sm font-medium bg-[#00247D] text-white rounded-lg hover:bg-[#001b60] focus:ring-4 focus:ring-blue-200 transition-colors duration-200 hover:scale-105';
            }
        }

        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            
            if (file) {
                preview.classList.remove('hidden');
                fileName.textContent = file.name;
                fileSize.textContent = `(${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            } else {
                preview.classList.add('hidden');
            }
        });

        function toggleFullDescription(id) {
            const shortDesc = document.getElementById('short-desc-' + id);
            const fullDesc = document.getElementById('full-desc-' + id);
            
            if (fullDesc.classList.contains('hidden')) {
                shortDesc.classList.add('hidden');
                fullDesc.classList.remove('hidden');
            } else {
                shortDesc.classList.remove('hidden');
                fullDesc.classList.add('hidden');
            }
        }

        function openEditModal(pengumuman) {
            document.getElementById('editJudul').value = pengumuman.judul;
            document.getElementById('editIsi').value = pengumuman.isi;
            document.getElementById('editForm').action = `/pengumuman/${pengumuman.pengumuman_id}`;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        setTimeout(function() {
            const alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</x-layout>