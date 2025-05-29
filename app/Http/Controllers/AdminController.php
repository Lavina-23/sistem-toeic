<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Twilio\Rest\Client;
use App\Models\Pengumuman;
use App\Imports\ScoreImport;
use App\Models\VerificationPhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Peserta::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('no_induk', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        $perPage = $request->input('perPage', 10);

        $peserta = $query->paginate($perPage);

        return view('admin.dashboard', [
            'peserta' => $peserta,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createScores()
    {
        //
        return view('admin.create-scores');
    }

    public function importScores(Request $request)
    {
        //
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ScoreImport, $request->file('file'));
        return back()->with('success', 'Data berhasil diimpor!');
    }

    public function createPengumuman()
    {
        return view('admin.create-pengumuman');
    }

    public function storePengumuman(Request $request)
    {

        $user = Auth::user();
        $registered = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        // Validasi input
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        try {

            // Jika file diunggah, simpan ke storage
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Buat nama file baru berdasarkan judul, contoh: JADWAL TOEIC → JADWAL_TOEIC.pdf
                $namaFile = str_replace(' ', '_', strtoupper($request->judul)) . '.' . $file->getClientOriginalExtension();

                // Simpan file ke folder 'pengumuman' di disk 'public' dengan nama tersebut
                $path = $file->storeAs('pengumuman', $namaFile, 'public');

                $validatedData['file'] = $path;
            }

            // Simpan pengumuman ke database
            Pengumuman::create($validatedData);

            return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'excel_numbers' => 'required|file|mimes:xlsx,xls',
        ]);

        $data = Excel::toArray([], $request->file('excel_numbers'));

        $numbers = collect($data[0])->pluck(0)->filter();

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $sender = env('TWILIO_WHATSAPP_FROM');
        $client = new Client($sid, $token);

        // dd($sid, $token, $sender);
        // dd($numbers);
        // exit;

        foreach ($numbers as $number) {
            $client->messages->create(
                'whatsapp:' . $number,
                [
                    'from' => 'whatsapp:+14155238886',
                    'body' => $request->message,
                ]
            );
        }

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    public function handleMessage(Request $request)
    {
        try {
            $from = $request->input('From');
            $number = str_replace('whatsapp:', '', $from);
            $pesertaNumber = preg_replace('/^\+62|62/', '0', trim($number));

            // Log::info("Nomor dari request: $from");
            // Log::info("Nomor setelah normalisasi: $pesertaNumber");

            $pesertaId = Peserta::where('no_telp', $pesertaNumber)->value('peserta_id');

            if (!$pesertaId) {
                Log::warning("Peserta tidak ditemukan untuk nomor: $pesertaNumber");
                return response('Peserta tidak ditemukan', 404);
            }

            $body = strtolower(trim($request->input('Body')));

            $photoMap = [
                'depan' => 'front',
                'belakang' => 'back',
                'kiri' => 'left',
                'kanan' => 'right'
            ];

            if (!isset($photoMap[$body])) {
                return response('Caption foto tidak dikenali. Kirim dengan teks: depan, belakang, kiri, atau kanan.', 400);
            }

            $photoType = $photoMap[$body];

            $mediaUrl = $request->input('MediaUrl0');
            $mediaType = $request->input('MediaContentType0');

            if (!$mediaUrl || strpos($mediaType, 'image') === false) {
                return response('Tidak ada foto yang dikirim atau format tidak didukung.', 400);
            }

            $twilioSid = config('services.twilio.sid');
            $twilioToken = config('services.twilio.token');

            $response = Http::withBasicAuth($twilioSid, $twilioToken)->get($mediaUrl);

            if (!$response->successful()) {
                Log::error("Failed to download image from Twilio: " . $response->status());
                return response('Gagal mengunduh foto.', 500);
            }

            $imageContent = $response->body();

            $filename = $photoType . '_' . time() . '_' . uniqid() . '.jpg';

            Storage::put('public/verification_photos/' . $filename, $imageContent);

            VerificationPhotos::create([
                'peserta_id' => $pesertaId,
                'photo_type' => $photoType,
                'photo_path' => $filename,
            ]);

            Log::info("Foto $photoType berhasil disimpan untuk peserta ID: $pesertaId");
            return response("Foto $photoType berhasil diterima.", 200);
        } catch (\Exception $e) {
            Log::error("Error in handleMessage: " . $e->getMessage());
            Log::error("Stack trace: " . $e->getTraceAsString());
            return response('Terjadi kesalahan internal.', 500);
        }
    }
    public function exportPDF()
    {
        $peserta = Peserta::all();

        $pdf = Pdf::loadView('admin.peserta_pdf', compact('peserta'));
        return $pdf->download('data_peserta.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
