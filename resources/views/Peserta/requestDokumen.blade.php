<x-layout>
    <x-sidebar :userData="$userData" />
    <section class="p-4 md:ml-64 h-auto mt-0">
        <div class="max-w-full p-6 -mt-4">
            <h1 class="text-4xl font-bold text-teal-900 mb-6 text-center">Request Dokumen TOEIC</h1>

            <!-- Status Card -->
            <div class="bg-white border rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-col gap-4">
                    <h2 class="text-lg md:text-xl font-semibold text-teal-700 text-center">
                        Status Dokumen Anda
                    </h2>
                    @if($peserta && $score)
                        <div class="flex items-center justify-center p-4 bg-green-50 border border-green-200 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-green-800 font-medium">Dokumen siap untuk diunduh</span>
                        </div>
                    @else
                        <div class="flex items-center justify-center p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <span class="text-yellow-800 font-medium">Data tidak lengkap atau belum memenuhi syarat</span>
                        </div>
                    @endif
                </div>
            </div>

            @if($peserta && $score)
            <!-- Document Preview Section -->
            <div class="bg-white border rounded-lg shadow-sm p-6 mb-6">
                <h2 class="text-lg md:text-xl font-semibold text-teal-700 mb-4">
                    Preview Surat Keterangan
                </h2>
                
                <!-- Preview Container -->
                <div class="w-full flex flex-col items-center">
                    <div id="document-preview" class="w-full max-w-4xl border border-gray-300 rounded-lg overflow-hidden mb-4 bg-white shadow-inner">
                        <!-- Document Content -->
                        <div class="document-container p-8" style="font-family: 'Times New Roman', Times, serif; line-height: 1.6; color: #000;">
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
                                Nomor: ….…./PL2. UPA BHS/2024
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
                                            <td class="font-semibold">{{ $peserta->nama ?? 'Nama Peserta' }}</td>
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
                                            <td class="font-semibold">{{ $peserta->program_studi ?? 'Program Studi' }}</td>
                                        </tr>
                                        <tr>
                                            <td>9.</td>
                                            <td>Tempat, tanggal lahir</td>
                                            <td class="text-center">:</td>
                                            <td class="font-semibold">{{ $peserta->tgl_lahir ?? 'Tanggal Lahir' }}</td>
                                        </tr>
                                        <tr>
                                            <td>10.</td>
                                            <td>A l a m a t</td>
                                            <td class="text-center">:</td>
                                            <td class="font-semibold">{{ $peserta->alamat_sekarang ?? 'Alamat' }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="statement mb-5" style="text-indent: 30px;">
                                    <p>telah mengikuti ujian TOEIC dan mendapat sertifikat yang diterbitkan oleh ETS sebanyak 
                                    <strong>dua kali</strong> dengan nilai di bawah 400 untuk Program D-III dan 450 untuk Program D-IV dengan 
                                    bukti sertifikat terlampir (dua berkas).</p>
                                </div>

                                <div class="closing mb-8" style="text-indent: 30px;">
                                    <p>Demikian surat keterangan ini dibuat sebagai pengganti syarat pengambilan ijazah dan agar 
                                    dapat dipergunakan sebagaimana mestinya.</p>
                                </div>
                            </div>

                            <!-- Signature Section -->
                            <div class="signature-section text-right mt-10">
                                <div class="w-1/2 ml-auto">
                                    <div class="font-bold mb-16">Kepala UPA Bahasa,</div>
                                    <div class="font-bold underline">Atiqah Nurul Asri, S.Pd., M.Pd.</div>
                                    <div class="mt-1 text-xs">NIP. 197606252005012001</div>
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
                        <button onclick="generatePDF()" class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg focus:ring-4 focus:ring-teal-200 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download PDF
                        </button>
                        
                        <button onclick="printDocument()" class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-lg focus:ring-4 focus:ring-gray-200 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Print
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Information Section -->
            <div class="bg-white border rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-lg md:text-xl font-semibold text-teal-700 mb-4">Informasi Penting</h2>

                <div class="space-y-4 text-sm font-normal text-gray-600">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">Surat keterangan ini hanya dapat diunduh jika Anda telah memenuhi semua persyaratan yang ditentukan.</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">Pastikan data Anda sudah lengkap dan benar sebelum mengunduh dokumen.</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">Dokumen yang diunduh memiliki format PDF dan dapat digunakan untuk keperluan administrasi.</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">Jika terdapat masalah dengan dokumen, silakan hubungi admin melalui kontak yang tersedia.</p>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-white border rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-lg md:text-xl font-semibold text-teal-700 mb-4">
                    Informasi Kontak
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">Telepon</p>
                            <p class="text-sm text-gray-500">(0341) 404424 – 404425</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">Email</p>
                            <p class="text-sm text-gray-500">toeic@polinema.ac.id</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">Jam Operasional</p>
                            <p class="text-sm text-gray-500">Senin - Jumat, 08:00 - 16:00</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">Lokasi</p>
                            <p class="text-sm text-gray-500">Jl. Soekarno Hatta No.9 Malang 65141</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    </script>
</x-layout>



    

                    
