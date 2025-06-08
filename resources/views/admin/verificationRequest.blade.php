<x-layout>
    <x-sidebaradmin />

    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">📋 Verification Requests</h1>
      
        {{-- Verification Requests Table --}}
        @if ($verificationReqs->count() > 0)
            <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Daftar Permintaan Verifikasi</h2>
                    
                    {{-- Filter Form --}}
                    <form method="GET" action="{{ route('verificationReq') }}" class="flex items-center">
                        <label for="filter" class="mr-3 text-sm font-medium text-gray-700">Filter:</label>
                        <select name="filter" id="filter" onchange="this.form.submit()"
                            class="block w-48 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="with_bukti" {{ $filter === 'with_bukti' ? 'selected' : '' }}>Ada Bukti</option>
                            <option value="without_bukti" {{ $filter === 'without_bukti' ? 'selected' : '' }}>Tanpa Bukti</option>
                        </select>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-primary text-bone text-left">
                                <th class="px-4 py-2 border">No</th>
                                <th class="px-4 py-2 border">ID Request</th>
                                <th class="px-4 py-2 border">Nama Peserta</th>
                                <th class="px-4 py-2 border">Keterangan</th>
                                <th class="px-4 py-2 border">Bukti Pendukung</th>
                                <th class="px-4 py-2 border">Tanggal</th>
                                <th class="px-4 py-2 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($verificationReqs as $index => $req)
                                <tr class="border-t hover:bg-gray-50 font-medium">
                                    <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $req['id'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border">
                                        @if($req['nama'])
                                            <div class="font-semibold text-gray-900">{{ $req['nama'] }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ $req['peserta_id'] }}</div>
                                        @else
                                            <span class="text-red-500 font-medium">Peserta tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border max-w-xs">
                                        @if($req['keterangan'])
                                            <div class="truncate" title="{{ $req['keterangan'] }}">
                                                {{ $req['keterangan'] }}
                                            </div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        @if($req['bukti_pendukung'])
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Ada Bukti
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Tidak Ada
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        <div class="text-sm text-gray-900">{{ $req['created_at'] }}</div>
                                    </td>
                                    <td class="px-4 py-2 border text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button type="button" 
                                                    onclick="approveRequest({{ $req['id'] }})"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                    title="Setujui">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>

                                            <button type="button" 
                                                    onclick="rejectRequest({{ $req['id'] }})"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                    title="Tolak">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>

                                            <button type="button"
                                                    onclick="previewBukti({{ $req['id'] }}, '{{ $req['bukti_pendukung'] ?? '' }}')"
                                                    class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                                    title="Preview Bukti">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276a1 1 0 011.447 1.156L18 12l3 6-4.553 2.276a1 1 0 01-1.447-1.156L15 14l-3-6 4.553-2.276z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Footer Info --}}
                <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
                    <div>
                        Menampilkan {{ $verificationReqs->count() }} request
                        @if($filter !== 'all')
                            ({{ $filter === 'with_bukti' ? 'dengan bukti' : 'tanpa bukti' }})
                        @endif
                    </div>
                    @if($filter !== 'all')
                        <a href="{{ route('admin.verification-reqs') }}" 
                           class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Reset Filter
                        </a>
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
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada verification request</h3>
                <p class="text-gray-600">
                    @if($filter === 'with_bukti')
                        Tidak ada request dengan bukti pendukung.
                    @elseif($filter === 'without_bukti')
                        Tidak ada request tanpa bukti pendukung.
                    @else
                        Belum ada verification request yang masuk.
                    @endif
                </p>
            </div>
        @endif

        {{-- Modal for Request Details --}}
        <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg max-w-4xl max-h-screen overflow-y-auto m-4 w-full">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Detail Verification Request</h3>
                    <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">
                        &times;
                    </button>
                </div>
                <div id="modalContent" class="p-6">
                    {{-- Content will be injected here --}}
                </div>
                <div class="flex justify-end p-6 border-t border-gray-200">
                    <button onclick="closeDetailModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
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
            fetch(`/admin/verification-reqs/${requestId}`)
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

        // Close preview modal if click outside content
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('previewBuktiModal');
            if (modal && e.target === modal) {
                closePreviewBukti();
            }
        });
    </script>
</x-layout>
