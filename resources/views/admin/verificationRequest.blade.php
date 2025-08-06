<x-layout>
    <x-sidebaradmin />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{__('verifReq.title')}}</h1>

        <!-- Enhanced Main Container -->
        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden mb-6">
            <!-- Header Section with Gradient -->
            <div
                class="flex justify-between items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{__('verifReq.list')}}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{__('verifReq.kelola')}}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">{{__('verifReq.total')}}</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $verificationReqs->count() }}</div>
                </div>
            </div>

            <div class="p-6">
                <!-- Search and Filter Section -->
                <div class="mb-6 space-y-4">
                    <div class="flex flex-col lg:flex-row gap-4 justify-between items-start lg:items-center">
                        <!-- Search Input (if needed) -->
                        <div class="w-full lg:w-[800px]">
                            <div class="flex-[1]">
                                <form action="{{ route('verificationReq') }}" method="GET" class="flex gap-2">
                                    <div class="relative flex-1">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
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
                                        <a href="{{ route('verificationReq') }}"
                                            class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-sm hover:shadow-md">
                                            {{__('verifReq.reset')}}
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="flex gap-2">
                            <!-- Filter Dropdown -->
                            <form method="GET" action="{{ route('verificationReq') }}" class="flex items-center">
                                <label for="filter" class="mr-3 text-sm font-medium text-gray-700">{{__('verifReq.filter')}}:</label>
                                <select name="filter" id="filter" onchange="this.form.submit()"
                                    class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[180px]">
                                    <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>{{__('verifReq.search1')}}</option>
                                    <option value="with_bukti" {{ $filter === 'with_bukti' ? 'selected' : '' }}>
                                        {{__('verifReq.search2')}}</option>
                                    <option value="without_bukti" {{ $filter === 'without_bukti' ? 'selected' : '' }}>
                                        {{__('verifReq.search3')}}</option>
                                </select>
                            </form>

                            @if ($filter !== 'all')
                                <a href="{{ route('admin.verificationReq') }}"
                                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-sm hover:shadow-md">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                @if ($verificationReqs->count() > 0)
                    <!-- Enhanced Table -->
                    <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
                        <table class="min-w-full table-fixed border-collapse bg-white">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                    <th
                                        class="w-16 px-3 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.no')}}
                                    </th>
                                    <th
                                        class="w-48 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.name')}}
                                    </th>
                                    <th
                                        class="w-64 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.ket')}}
                                    </th>
                                    <th
                                        class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.bukti')}}
                                    </th>
                                    <th
                                        class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.scoren')}}
                                    </th>
                                    <th
                                        class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.scorel')}}
                                    </th>
                                    <th
                                        class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">
                                        {{__('verifReq.tgl')}}
                                    </th>
                                    <th
                                        class="w-40 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        {{__('verifReq.Aksi')}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach ($verificationReqs as $index => $req)
                                    <tr class="hover:bg-blue-50 transition-colors duration-200 score-row">
                                        <td
                                            class="px-3 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-bold">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm font-semibold text-gray-900 border-r border-gray-100">
                                            <div class="flex items-center space-x-3">
                                                <div>
                                                    @if ($req['nama'])
                                                        <div class="font-medium text-gray-900 truncate"
                                                            title="{{ $req['nama'] }}">
                                                            {{ $req['nama'] }}
                                                        </div>
                                                    @else
                                                        <span class="text-red-500 font-medium"> {{__('verifReq.notfound')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                            <div class="max-w-xs">
                                                @if ($req['keterangan'])
                                                    <div class="truncate" title="{{ $req['keterangan'] }}">
                                                        {{ $req['keterangan'] }}
                                                    </div>
                                                @else
                                                    <span class="text-gray-400">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 text-center">
                                            @if ($req['bukti_pendukung'])
                                                <a type="button"
                                                    onclick="previewBukti({{ $req['id'] }}, '{{ $req['bukti_pendukung'] ?? '' }}')"
                                                    class="underline cursor-pointer inline-flex items-center font-medium text-blue-600 hover:text-blue-800 focus:font-bold hover:font-bold transition-colors"
                                                    title="Preview Bukti">
                                                    {{__('verifReq.show')}}
                                                </a>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    {{__('verifReq.nothing')}}
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 text-center">
                                            @if ($req['score_total'])
                                                <span>{{ $req['score_total'] }}</span>
                                            @else
                                                <span>
                                                    0
                                                </span>
                                            @endif
                                        </td>
                                        <td
                                            class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 text-center">
                                            @if ($req['last_score_total'])
                                                <span>{{ $req['last_score_total'] }}</span>
                                            @else
                                                <span>
                                                    0
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100">
                                            <div class="text-sm text-gray-900">{{ $req['created_at'] }}</div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-900">
                                            <div class="flex justify-center space-x-2">
                                                @if ($req['status'] === 'approved')
                                                    <span
                                                        class="inline-flex items-center justify-center min-w-[80px] text-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        ✅ {{__('verifReq.dtrem')}}
                                                    </span>
                                                @elseif ($req['status'] === 'rejected')
                                                    <span
                                                        class="inline-flex items-center justify-center min-w-[80px] text-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        ❌ {{__('verifReq.dtrej')}}
                                                    </span>
                                                @else
                                                    <form
                                                        action="{{ route('update-verification', ['id' => $req['id']]) }}"
                                                        method="POST" id="form-{{ $req['id'] }}">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $req['id'] }}">

                                                        <div id="reason-container-{{ $req['id'] }}"
                                                            class="hidden mb-2">
                                                            <select name="reason"
                                                                class="text-xs border rounded px-2 py-1"
                                                                id="reason-select-{{ $req['id'] }}">
                                                                <option value="">{{__('verifReq.reason')}}</option>
                                                                <option value="Data tidak lengkap">{{__('verifReq.wtb')}}
                                                                </option>
                                                                <option value="Bukti tidak diterima">{{__('verifReq.wob')}}
                                                                </option>
                                                                <option value="Identitas tidak valid">{{__('verifReq.wta')}}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="flex space-x-1">
                                                            <button type="submit" name="status" value="approved"
                                                                onclick="return confirm('Yakin ingin memverifikasi data ini?');"
                                                                class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors"
                                                                title="Setujui">
                                                                <svg class="w-3 h-3" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7"></path>
                                                                </svg>
                                                            </button>

                                                            <button type="button"
                                                                onclick="handleReject({{ $req['id'] }})"
                                                                class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                                                                title="Tolak">
                                                                <svg class="w-3 h-3" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <button type="submit" name="status" value="rejected"
                                                            id="submit-reject-{{ $req['id'] }}"
                                                            class="hidden"></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Enhanced Footer Info -->
                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-sm text-gray-700">
                            {{__('verifReq.show')}} {{ $verificationReqs->count() }} {{__('verifReq.req')}}
                            @if ($filter !== 'all')
                                ({{ $filter === 'with_bukti' ? 'dengan bukti' : 'tanpa bukti' }})
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <div class="text-6xl text-gray-300 mb-4">📋</div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">
                                {{__('verifReq.notyet')}}
                            </h3>
                            <p class="text-sm text-gray-500">
                                @if ($filter === 'with_bukti')
                                    {{__('verifReq.not1')}}
                                @elseif($filter === 'without_bukti')
                                    {{__('verifReq.not2')}}
                                @else
                                    {{__('verifReq.notyet2')}}
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Modal for Bukti Preview -->
        <div id="detailModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg max-w-4xl max-h-screen overflow-y-auto m-4 w-full">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('verifReq.detail') }}</h3>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">
                        &times;
                    </button>
                </div>
                <div id="modalContent" class="p-6">
                    {{-- {{__('verifReq.content')}} --}}
                </div>
                <div class="flex justify-end p-6 border-t border-gray-200">
                    <button onclick="closeDetailModal()"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        {{ __('verifReq.close') }}
                    </button>
                </div>
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
    </style>

    <script>
        function handleReject(id) {
            const reasonContainer = document.getElementById(`reason-container-${id}`);
            const reasonSelect = document.getElementById(`reason-select-${id}`);
            const submitBtn = document.getElementById(`submit-reject-${id}`);

            if (reasonContainer.classList.contains('hidden')) {
                reasonContainer.classList.remove('hidden');
                return;
            }

            if (!reasonSelect.value) {
                alert('Silakan pilih alasan penolakan terlebih dahulu.');
                return;
            }

            if (confirm('Yakin ingin menolak data ini?')) {
                submitBtn.click();
            }
        }

        function approveRequest(requestId) {
            if (confirm('Apakah Anda yakin ingin menyetujui verification request ini?')) {
                fetch(`/admin/verification-reqs/${requestId}/approve`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Request berhasil disetujui!');
                            location.reload();
                        } else {
                            alert('Gagal menyetujui request: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses request');
                    });
            }
        }

        function rejectRequest(requestId) {
            if (confirm('Apakah Anda yakin ingin menolak verification request ini?')) {
                fetch(`/admin/verificationRequest/${requestId}/reject`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Request berhasil ditolak!');
                            location.reload();
                        } else {
                            alert('Gagal menolak request: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses request');
                    });
            }
        }

        function viewDetails(requestId) {
            fetch(`/admin/verificationRequest/${requestId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const req = data.request;
                        let html = `
                            <p><strong>ID Request:</strong> ${req.id}</p>
                            <p><strong>Nama Peserta:</strong> ${req.nama || '-'}</p>
                            <p><strong>Keterangan:</strong> ${req.keterangan || '-'}</p>
                            <p><strong>Tanggal:</strong> ${req.created_at}</p>
                        `;
                        if (req.bukti_pendukung) {
                            html += `
                                <p><strong>Bukti Pendukung:</strong></p>
                                <iframe src="${req.bukti_pendukung_url}" class="w-full h-96 rounded border" frameborder="0"></iframe>
                            `;
                        } else {
                            html += `<p><em>Tidak ada bukti pendukung</em></p>`;
                        }
                        document.getElementById('modalContent').innerHTML = html;
                        document.getElementById('detailModal').classList.remove('hidden');
                    } else {
                        alert('Gagal memuat detail request');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Terjadi kesalahan saat memuat detail');
                });
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('modalContent').innerHTML = '';
        }

        function previewBukti(requestId, buktiFilename) {
            if (!buktiFilename) {
                alert('Tidak ada bukti pendukung untuk ditampilkan.');
                return;
            }

            const modalId = 'previewBuktiModal';
            let modal = document.getElementById(modalId);

            if (!modal) {
                modal = document.createElement('div');
                modal.id = modalId;
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                modal.style.display = 'none';

                modal.innerHTML = `
                    <div class="bg-white rounded-lg max-w-3xl max-h-[80vh] overflow-auto p-4 relative w-full max-w-4xl mx-4">
                        <button onclick="closePreviewBukti()"
                                class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-3xl font-bold leading-none">&times;</button>
                        <iframe src="" frameborder="0" id="previewBuktiFrame" class="w-full h-[70vh] rounded"></iframe>
                    </div>
                `;

                document.body.appendChild(modal);
            }

            const fileUrl = `{{ asset('storage') }}/${buktiFilename}`;
            document.getElementById('previewBuktiFrame').src = fileUrl;

            modal.style.display = 'flex';
        }

        function closePreviewBukti() {
            const modal = document.getElementById('previewBuktiModal');
            if (modal) {
                modal.style.display = 'none';
                document.getElementById('previewBuktiFrame').src = '';
            }
        }

        document.addEventListener('click', function(e) {
            const modal = document.getElementById('previewBuktiModal');
            if (modal && e.target === modal) {
                closePreviewBukti();
            }
        });
    </script>
</x-layout>
