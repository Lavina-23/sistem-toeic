<?php

namespace App\Http\Controllers;

use App\Imports\ScoreImport;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Twilio\Rest\Client;

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
