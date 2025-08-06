<x-layout>
    <x-sidebaritc />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{__('verifFoto.title')}}</h1>
        <x-form-message />

        {{-- Verification Photos Table --}}
        @if (isset($peserta))
            <!-- Verification Photos Management -->
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
                <div class="flex justify-between items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{__('verifFoto.verif')}}</h2>
                        <p class="text-sm text-gray-600 mt-1">{{__('verifFoto.kelola')}}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-gray-600">{{__('verifFoto.total')}}</div>
                        <div class="text-2xl font-bold text-blue-600">{{ count($peserta) }}</div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Search and Filter Section -->
                    <div class="mb-6 space-y-4">
                        <div class="flex flex-col lg:flex-row gap-4">
                            <!-- Search Input -->
                            <div class="flex-[2]">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="searchInput" placeholder="🔍 {{__('verifFoto.search')}}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <!-- Filter Section -->
                            <div class="flex flex-wrap gap-3 flex-[2]">
                                <form method="GET" action="{{ route('verification') }}" class="flex gap-3">
                                    <select name="sortir" id="sortir" onchange="this.form.submit()"
                                        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[220px]">
                                        <option value="semua" {{ $sortir == 'semua' ? 'selected' : '' }}>📋 {{__('verifFoto.all')}}</option>
                                        <option value="belum_lengkap" {{ $sortir == 'belum_lengkap' ? 'selected' : '' }}>⚠️ {{__('verifFoto.lengkap')}}</option>
                                        <option value="belum_kirim" {{ $sortir == 'belum_kirim' ? 'selected' : '' }}>❌ {{__('verifFoto.belum')}}</option>
                                    </select>
                                </form>
                                <select id="statusFilter"
                                    class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[220px]">
                                    <option value="">🏷️ {{__('verifFoto.status')}}</option>
                                    <option value="complete">✅ {{__('verifFoto.lengkap')}}</option>
                                    <option value="incomplete">⚠️ {{__('verifFoto.tdklngkap')}}</option>
                                    <option value="empty">❌ {{__('verifFoto.blmlngkap')}}</option>
                                </select>
                            </div>
                        </div>

                    <!-- Enhanced Table -->
                    <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
                        <table class="min-w-full table-fixed border-collapse bg-white">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                    <th class="w-16 px-3 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.no') }}</th>
                                    <th class="w-48 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.nama') }}</th>
                                    <th class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.no_telp') }}</th>
                                    <th class="w-28 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.status') }}</th>
                                    <th class="w-24 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.foto_depan') }} </th>
                                    <th class="w-24 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.foto_belakang') }}</th>
                                    <th class="w-24 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.foto_kiri') }}</th>
                                    <th class="w-24 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{ __('verifFoto.foto_kanan') }}</th>
                                    <th class="w-28 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{ __('verifFoto.progress') }}</th>
                                </tr>
                            </thead>
                            <tbody id="verificationTableBody" class="bg-white divide-y divide-gray-100">
                                @foreach ($peserta as $index => $p)
                                    @php
                                        $photoCount = 0;
                                        $photos = ['front', 'back', 'left', 'right'];
                                        foreach($photos as $photo) {
                                            if($p[$photo]) $photoCount++;
                                        }
                                        $progressPercentage = ($photoCount / 4) * 100;
                                        
                                        $statusClass = 'bg-red-100 text-red-800';
                                        $statusText = __('verifFoto.blmlngkap');
                                        $statusIcon = '❌';
                                        
                                        if($photoCount == 4) {
                                            $statusClass = 'bg-green-100 text-green-800';
                                            $statusText = __('verifFoto.lengkap');
                                            $statusIcon = '✅';
                                        } elseif($photoCount > 0) {
                                            $statusClass = 'bg-yellow-100 text-yellow-800';
                                            $statusText = 'Tidak Lengkap';
                                            $statusIcon = '⚠️';
                                        }
                                    @endphp
                                    <tr class="hover:bg-blue-50 transition-colors duration-200 verification-row" 
                                        data-name="{{ strtolower($p['nama']) }}" 
                                        data-phone="{{ $p['no_telp'] }}" 
                                        data-status="{{ $photoCount == 4 ? 'complete' : ($photoCount > 0 ? 'incomplete' : 'empty') }}">
                                        <td class="px-3 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                                            <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-bold">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm font-semibold text-gray-900 border-r border-gray-100">
                                            <div class="flex items-center space-x-3">
                                                
                                                <div>
                                                    <div class="font-medium text-gray-900 truncate" title="{{ $p['nama'] }}">
                                                        {{ $p['nama'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 font-mono">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-green-600"></span>
                                                <span>{{ $p['no_telp'] }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-center border-r border-gray-100">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                                <span class="mr-1">{{ $statusIcon }}</span>
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        @foreach(['front' => '📸', 'back' => '📸', 'left' => '📸', 'right' => '📸'] as $direction => $icon)
                                            <td class="px-4 py-4 text-sm text-center border-r border-gray-100">
                                                @if ($p[$direction])
                                                    <div class="relative group">
                                                        <img src="{{ asset('storage/verification_photos/' . $p[$direction]) }}"
                                                            alt="{{ ucfirst($direction) }} Photo" 
                                                            class="w-16 h-16 object-cover rounded-lg cursor-pointer shadow-md hover:shadow-lg transition-shadow duration-200 mx-auto border-2 border-green-200"
                                                            onclick="openModal('{{ asset('storage/verification_photos/' . $p[$direction]) }}', '{{ $p['nama'] }}', '{{ ucfirst($direction) }}')">
                                                        <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                                            <span class="text-white text-xs">✓</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto border-2 border-dashed border-gray-300">
                                                        <span class="text-gray-400 text-2xl">{{ $icon }}</span>
                                                    </div>
                                                    <div class="text-xs text-gray-400 mt-1">{{__('verifFoto.blmada')}}</div>
                                                @endif
                                            </td>
                                        @endforeach
                                        <td class="px-4 py-4 text-sm text-center">
                                            <div class="flex flex-col items-center space-y-2">
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="bg-gradient-to-r from-blue-500 to-green-500 h-2 rounded-full transition-all duration-300" 
                                                         style="width: {{ $progressPercentage }}%"></div>
                                                </div>
                                                <div class="text-xs font-medium">
                                                    <span class="text-gray-700">{{ $photoCount }}/4</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        @php
                            $totalPeserta = count($peserta);
                            $lengkap = 0;
                            $tidakLengkap = 0;
                            $belumAda = 0;
                            
                            foreach($peserta as $p) {
                                $count = 0;
                                foreach(['front', 'back', 'left', 'right'] as $direction) {
                                    if($p[$direction]) $count++;
                                }
                                
                                if($count == 4) $lengkap++;
                                elseif($count > 0) $tidakLengkap++;
                                else $belumAda++;
                            }
                        @endphp
                        
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-bold">👥</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">{{__('verifFoto.total')}}</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $totalPeserta }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-600 font-bold">✅</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">{{__('verifFoto.ftlngkp')}}</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $lengkap }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <span class="text-yellow-600 font-bold">⚠️</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">{{__('verifFoto.tdklngkap')}}</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $tidakLengkap }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-red-600 font-bold">❌</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-500">{{__('verifFoto.blmada')}}</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $belumAda }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 text-center mb-6">
                <div class="text-center py-16">
                    <div class="text-6xl text-gray-300 mb-4">📷</div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">{{__('verifFoto.notyet')}}</h3>
                    <p class="text-gray-500 mb-4">{{__('verifFoto.buatbc')}}</p>
                    <div class="text-sm text-gray-400">
                        <p>{{__('verifFoto.4sudut')}}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Modal for viewing full-size images -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg max-w-4xl max-h-5xl w-full mx-4 overflow-hidden shadow-2xl">
                <div class="flex justify-between items-center p-4 bg-gray-50 border-b">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">{{__('verifFoto.foto')}}</h3>
                        <p class="text-sm text-gray-600" id="modalSubtitle">{{__('verifFoto.detail')}}</p>
                    </div>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold p-2 rounded-full hover:bg-gray-200 transition-colors">
                        ×
                    </button>
                </div>
                <div class="p-4 bg-gray-50 flex justify-center items-center" style="min-height: 400px;">
                    <img id="modalImage" src="" alt="Full Size Photo" class="max-w-full max-h-96 object-contain rounded-lg shadow-lg">
                </div>
                <div class="p-4 bg-gray-50 border-t">
                    <div class="flex justify-center">
                        <button onclick="closeModal()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            {{__('verifFoto.close')}}
                        </button>
                    </div>
                </div>
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
        .verification-row:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Image hover effects */
        .verification-row img:hover {
            transform: scale(1.05);
        }
        
        /* Progress bar animation */
        .progress-bar {
            transition: width 0.3s ease-in-out;
        }
        
        /* Better mobile responsiveness */
        @media (max-width: 768px) {
            .min-w-full {
                min-width: 1000px;
            }
        }
    </style>

    <!-- Enhanced JavaScript for Search and Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('.verification-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value;

                rows.forEach(row => {
                    const name = row.dataset.name;
                    const phone = row.dataset.phone;
                    const status = row.dataset.status;

                    const matchesSearch = name.includes(searchTerm) || phone.includes(searchTerm);
                    const matchesStatus = !selectedStatus || status === selectedStatus;

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });

        function openModal(imageSrc, participantName, direction) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalTitle').textContent = `Foto ${direction} - ${participantName}`;
            document.getElementById('modalSubtitle').textContent = `Foto verifikasi ruangan tes dari sudut ${direction.toLowerCase()}`;
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

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</x-layout>