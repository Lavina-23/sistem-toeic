<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan TOEIC - {{ $peserta->nama ?? 'Peserta' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .document-preview {
            width: 100%;
            max-width: 56rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            overflow: hidden;
            margin-bottom: 1rem;
            background-color: white;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }

        .document-container {
            padding: 2rem;
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.6;
            color: #000;
        }

        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #000;
        }

        .header h1 {
            font-size: 0.875rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
            letter-spacing: 0.5px;
        }

        .header h2 {
            font-size: 0.875rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .header h3 {
            font-size: 0.875rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .header .contact {
            font-size: 0.75rem;
            line-height: 1.25;
        }

        /* Title Styles */
        .title {
            text-align: center;
            margin: 1.5rem 0;
        }

        .title h4 {
            font-size: 0.875rem;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }

        /* Document Number */
        .document-number {
            font-size: 0.75rem;
            text-align: center;
            margin-bottom: 1.25rem;
        }

        /* Content Styles */
        .content {
            font-size: 0.75rem;
            text-align: justify;
            line-height: 1.8;
        }

        .content-section {
            margin-bottom: 1rem;
        }

        .content table {
            width: 100%;
            margin: 0.75rem 0 1rem 0;
        }

        .content table td {
            padding: 0.125rem 0;
            vertical-align: top;
        }

        .content .col-number {
            width: 2rem;
        }

        .content .col-label {
            width: 12rem;
        }

        .content .col-separator {
            width: 1rem;
            text-align: center;
        }

        .content .col-value {
            font-weight: 600;
        }

        .content .paragraph {
            margin: 1.25rem 0;
        }

        .statement {
            margin-bottom: 1.25rem;
            text-indent: 30px;
        }

        .closing {
            margin-bottom: 2rem;
            text-indent: 30px;
        }

        /* Signature Styles */
        .signature-section {
            text-align: right;
            margin-top: 2.5rem;
        }

        .signature-container {
            width: 50%;
            margin-left: auto;
            text-align: center;
        }

        .signature-title {
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .signature-image {
            margin: 1rem auto;
            height: 12rem;
            opacity: 0.9;
            filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.2));
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
            font-size: 1.125rem;
        }

        .signature-nip {
            margin-top: 0.25rem;
            font-size: 0.75rem;
            color: #374151;
        }

        /* Attachment Styles */
        .attachment {
            margin-top: 2rem;
            font-size: 0.75rem;
        }

        .attachment strong {
            font-weight: bold;
        }

        /* Print Styles */
        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .document-preview {
                border: none;
                border-radius: 0;
                box-shadow: none;
                max-width: none;
            }

            .document-container {
                padding: 1rem;
            }

            .signature-image {
                height: 8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="document-preview">
            <div class="document-container">
                <!-- Header -->
                <div class="header">
                    <h1>
                        Kementerian Pendidikan Tinggi,<br>Sains, dan Teknologi
                    </h1>
                    <h2>Unit Penunjang Akademik Bahasa</h2>
                    <h3>Politeknik Negeri Malang</h3>
                    <div class="contact">
                        Jl. Soekarno Hatta No.9 Malang 65141<br>
                        Telp (0341) 404424 – 404425 Fax (0341) 404420<br>
                        Laman://www.polinema.ac.id
                    </div>
                </div>

                <!-- Title -->
                <div class="title">
                    <h4>Surat Keterangan Sudah Mengikuti TOEIC</h4>
                </div>

                <!-- Document Number -->
                <div class="document-number">
                    Nomor: {{ $nomorSurat ?? '421/PL2.13/DL.01/2024' }}
                </div>

                <!-- Content -->
                <div class="content">
                    <div class="content-section">
                        <p>Yang bertanda tangan di bawah ini</p>

                        <table>
                            <tr>
                                <td class="col-number">1.</td>
                                <td class="col-label">N a m a</td>
                                <td class="col-separator">:</td>
                                <td>Atiqah Nurul Asri, S.Pd., M.Pd.</td>
                            </tr>
                            <tr>
                                <td class="col-number">2.</td>
                                <td class="col-label">N I P</td>
                                <td class="col-separator">:</td>
                                <td>197606252005012001</td>
                            </tr>
                            <tr>
                                <td class="col-number">3.</td>
                                <td class="col-label">Pangkat, golongan, ruang</td>
                                <td class="col-separator">:</td>
                                <td>Penata Tingkat 1/ III D</td>
                            </tr>
                            <tr>
                                <td class="col-number">4.</td>
                                <td class="col-label">J a b a t a n</td>
                                <td class="col-separator">:</td>
                                <td>Kepala UPA Bahasa</td>
                            </tr>
                        </table>
                    </div>

                    <p class="paragraph">dengan ini menyatakan dengan sesungguhnya bahwa:</p>

                    <div class="content-section">
                        <table>
                            <tr>
                                <td class="col-number">6.</td>
                                <td class="col-label">N a m a</td>
                                <td class="col-separator">:</td>
                                <td class="col-value">{{ $peserta->nama ?? 'Nama Peserta' }}</td>
                            </tr>
                            <tr>
                                <td class="col-number">7.</td>
                                <td class="col-label">N I M</td>
                                <td class="col-separator">:</td>
                                <td class="col-value">{{ $peserta->no_induk ?? 'NIM' }}</td>
                            </tr>
                            <tr>
                                <td class="col-number">8.</td>
                                <td class="col-label">Program Studi/Jurusan</td>
                                <td class="col-separator">:</td>
                                <td class="col-value">{{ $peserta->program_studi ?? 'Program Studi' }}</td>
                            </tr>
                            <tr>
                                <td class="col-number">9.</td>
                                <td class="col-label">Tempat, tanggal lahir</td>
                                <td class="col-separator">:</td>
                                <td class="col-value">{{ $peserta->tgl_lahir ?? 'Tanggal Lahir' }}</td>
                            </tr>
                            <tr>
                                <td class="col-number">10.</td>
                                <td class="col-label">A l a m a t</td>
                                <td class="col-separator">:</td>
                                <td class="col-value">{{ $peserta->alamat_sekarang ?? 'Alamat' }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="statement">
                        <p>telah mengikuti ujian TOEIC dan mendapat sertifikat yang diterbitkan oleh ETS sebanyak
                            <strong>dua kali</strong> dengan nilai di bawah 400 untuk Program D-III dan
                            450 untuk Program D-IV dengan bukti sertifikat terlampir (dua berkas).
                        </p>
                    </div>

                    <div class="closing">
                        <p>Demikian surat keterangan ini dibuat sebagai pengganti syarat pengambilan
                            ijazah dan agar dapat dipergunakan sebagaimana mestinya.</p>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="signature-section">
                    <div class="signature-container">
                        <div class="signature-title">Kepala UPA Bahasa,</div>

                        <!-- Gambar tanda tangan -->
                        @if(file_exists(public_path('images/ttd.png')))
                            <img src="{{ asset('images/ttd.png') }}" alt="Tanda Tangan" class="signature-image">
                        @else
                            <div style="height: 12rem; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; margin: 1rem 0; font-style: italic; color: #666;">
                                [Tanda Tangan Digital]
                            </div>
                        @endif

                        <!-- Nama dan NIP -->
                        <div class="signature-name">Atiqah Nurul Asri, S.Pd., M.Pd.</div>
                        <div class="signature-nip">NIP. 197606252005012001</div>
                    </div>
                </div>

                <!-- Attachment -->
                <div class="attachment">
                    <strong>Lampiran:</strong><br>
                    Salinan 2 sertifikat TOEIC yang diterbitkan oleh ETS dan masih berlaku.
                </div>
            </div>
        </div>
    </div>
</body>
</html>