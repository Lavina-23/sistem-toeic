<x-layout>
    <x-sidebar :userData="$userData" />
    <section class="p-4 md:ml-64 h-auto mt-0">
        <div class="max-w-full p-6 -mt-4">
            <h1 class="text-4xl font-bold text-primary mb-6 text-center">Request Dokumen TOEIC</h1>

            <div
                class="
            {{-- {{ !is_null($r->peserta_id) ? 'hidden' : '' }} --}}
            w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
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

                <form action="{{ route('store.request-document') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="5" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200"
                            placeholder="Masukkan keteranganmu..."></textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">File Bukti Pendukung</label>
                        <input type="file" name="bukti_pendukung" accept=".png,.jpg,.jpeg,.pdf,.docx"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200">
                    </div>
                    <button type="submit"
                        class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-[#001a5c] transition">
                        Kirim
                    </button>
                </form>
            </div>
            @foreach ($request as $r)
                @if ($r->status == 'pending')
                    <!-- Document Preview Section -->
                    <div class="flex flex-col justify-center items-center md:flex-row gap-5 w-full">
                        <img class="h-[20rem]" src="https://i.ibb.co/tMnDNZmr/score-null.jpg" alt="hero-history"
                            border="0">
                        <div class="flex flex-col gap-2 items-start justify-center max-w-lg h-full">
                            <h1 class="text-3xl font-semibold">Tunggu Ya!</h1>
                            <p class="text-gray-500">Dokumen yang kamu request sedang kami urus</p>
                            <a href="https://itc-indonesia.com/?gad_campaignid=22363183331" target="_blank">
                            </a>
                        </div>
                    </div>
                @elseif ($r->status == 'approved')
                    <div class="bg-white border rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg md:text-xl font-semibold text-primary mb-4">
                            Preview Surat Keterangan
                        </h2>

                        <!-- Preview Container -->
                        <div class="w-full flex flex-col items-center">
                            <div id="document-preview"
                                class="w-full max-w-4xl border border-gray-300 rounded-lg overflow-hidden mb-4 bg-white shadow-inner">
                                <!-- Document Content -->
                                <div class="document-container p-8"
                                    style="font-family: 'Times New Roman', Times, serif; line-height: 1.6; color: #000;">
                                    <!-- Header -->
                                    <div class="header text-center mb-8 pb-4" style="border-bottom: 2px solid #000;">
                                        <h1 class="text-sm font-bold uppercase mb-1" style="letter-spacing: 0.5px;">
                                            Kementerian Pendidikan Tinggi,<br>Sains, dan Teknologi
                                        </h1>
                                        <h2 class="text-sm font-bold uppercase mb-1">Unit Penunjang Akademik Bahasa</h2>
                                        <h3 class="text-sm font-bold uppercase mb-3">Politeknik Negeri Malang</h3>
                                        <div class="text-xs leading-tight">
                                            Jl. Soekarno Hatta No.9 Malang 65141<br>
                                            Telp (0341) 404424 – 404425 Fax (0341) 404420<br>
                                            Laman://www.polinema.ac.id
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="title text-center my-6">
                                        <h4 class="text-sm font-bold underline uppercase">
                                            Surat Keterangan Sudah Mengikuti TOEIC
                                        </h4>
                                    </div>

                                    <!-- Document Number -->
                                    <div class="text-xs text-center mb-5">
                                        Nomor: {{ $letterNumber->full_number ?? '/PL2. UPA BHS/2025' }}
                                    </div>

                                    <!-- Content -->
                                    <div class="content text-xs text-justify" style="line-height: 1.8;">
                                        <div class="mb-4">
                                            <p>Yang bertanda tangan di bawah ini</p>

                                            <div class="mt-3 mb-4">
                                                <table class="w-full">
                                                    <tr>
                                                        <td class="w-8">1.</td>
                                                        <td class="w-48">N a m a</td>
                                                        <td class="w-4 text-center">:</td>
                                                        <td>Atiqah Nurul Asri, S.Pd., M.Pd.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2.</td>
                                                        <td>N I P</td>
                                                        <td class="text-center">:</td>
                                                        <td>197606252005012001</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3.</td>
                                                        <td>Pangkat, golongan, ruang</td>
                                                        <td class="text-center">:</td>
                                                        <td>Penata Tingkat 1/ III D</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td>J a b a t a n</td>
                                                        <td class="text-center">:</td>
                                                        <td>Kepala UPA Bahasa</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <p class="my-5">dengan ini menyatakan dengan sesungguhnya bahwa:</p>

                                        <div class="student-info mb-5">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="w-8">6.</td>
                                                    <td class="w-48">N a m a</td>
                                                    <td class="w-4 text-center">:</td>
                                                    <td class="font-semibold">{{ $peserta->nama ?? 'Nama Peserta' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>7.</td>
                                                    <td>N I M</td>
                                                    <td class="text-center">:</td>
                                                    <td class="font-semibold">{{ $peserta->no_induk ?? 'NIM' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>8.</td>
                                                    <td>Program Studi/Jurusan</td>
                                                    <td class="text-center">:</td>
                                                    <td class="font-semibold">
                                                        {{ $peserta->program_studi ?? 'Program Studi' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>9.</td>
                                                    <td>Tempat, tanggal lahir</td>
                                                    <td class="text-center">:</td>
                                                    <td class="font-semibold">
                                                        {{ $peserta->tgl_lahir ?? 'Tanggal Lahir' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>10.</td>
                                                    <td>A l a m a t</td>
                                                    <td class="text-center">:</td>
                                                    <td class="font-semibold">
                                                        {{ $peserta->alamat_sekarang ?? 'Alamat' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="statement mb-5" style="text-indent: 30px;">
                                            <p>telah mengikuti ujian TOEIC dan mendapat sertifikat yang diterbitkan oleh
                                                ETS
                                                sebanyak
                                                <strong>dua kali</strong> dengan nilai di bawah 400 untuk Program D-III
                                                dan
                                                450 untuk Program D-IV dengan
                                                bukti sertifikat terlampir (dua berkas).
                                            </p>
                                        </div>

                                        <div class="closing mb-8" style="text-indent: 30px;">
                                            <p>Demikian surat keterangan ini dibuat sebagai pengganti syarat pengambilan
                                                ijazah dan agar
                                                dapat dipergunakan sebagaimana mestinya.</p>
                                        </div>
                                    </div>

                        <!-- Signature Section -->
                            <div class="signature-section text-right mt-10">
                                <div class="w-1/2 ml-auto text-center">
                                    <div class="font-bold mb-6">Kepala UPA Bahasa,</div>

                        <!-- Gambar tanda tangan -->
                            <div class="mb-4">
                                <img src="{{ asset('images/ttd.png') }}" alt="Tanda Tangan" 
                                    class="mx-auto h-48 opacity-90" 
                                style="filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.2));">
                            </div>

                        <!-- Nama dan NIP -->
                            <div class="font-bold underline text-lg">Atiqah Nurul Asri, S.Pd., M.Pd.</div>
                                <div class="mt-1 text-xs text-gray-700">NIP. 197606252005012001</div>
                            </div>
                        </div>

                                    <!-- Attachment -->
                                    <div class="attachment mt-8 text-xs">
                                        <strong>Lampiran:</strong><br>
                                        Salinan 2 sertifikat TOEIC yang diterbitkan oleh ETS dan masih berlaku.
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4 mt-4">
                                <button onclick="window.location.href='{{ route('peserta.export.pdf') }}'"
                                        class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-yellowAccent hover:bg-yellow-500 rounded-lg focus:ring-4 focus:ring-yellow-300 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    Download PDF
                                </button>
                            </div>

                                <button onclick="printDocument()"
                                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg focus:ring-4 focus:ring-gray-200 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                        </path>
                                    </svg>
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>
                @elseif ($r->status == 'rejected')
                    <div class="bg-white border rounded-lg shadow-sm p-6 mb-6">
                        <div class="flex flex-col gap-4">
                            <h2 class="text-lg md:text-xl font-semibold text-primary text-center">
                                Status Dokumen Anda
                            </h2>
                            <div
                                class="flex items-center justify-center p-4 bg-red-200 border border-redMain rounded-lg">
                                <svg class="w-6 h-6 text-redMain mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                <span class="text-redMain font-medium">Mohon maaf, permintaan dokumen kamu
                                    ditolak</span>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
        @endforeach
    </section>
</x-layout>
