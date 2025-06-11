<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Peserta;
use App\Models\Pengguna;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Exports\NoTelpExport;
use App\Exports\PesertaExport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PesertaController extends Controller
{

    public function index()
    {
        $pengumuman = Pengumuman::where('status', 0)->latest()->first();

        return view('peserta.dashboard', [
            "pengumuman" => $pengumuman
        ]);
    }

    public function createPeserta()
    {
        //
        $user = Auth::user();
        $registered = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        return view('peserta.daftar', ['registered' => $registered]);
    }


    public function storePeserta(Request $request)
    {
        $user = Auth::user();
        $registered = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        Log::info('Request data:', $request->all());
        Log::info('Files:', $request->allFiles());

        if ($registered === null) {
            try {
                $validatedData = $request->validate([
                    // 'nama' => 'required|string|max:255',
                    'no_induk' => 'required|string|max:255',
                    'nik' => 'required|string|max:255',
                    'no_telp' => 'required|string|max:255',
                    'alamat_asal' => 'required|string|max:255',
                    'alamat_sekarang' => 'required|string|max:255',
                    'tgl_lahir' => 'required|date',
                    'jurusan' => 'string|max:255',
                    'program_studi' => 'string|max:255',
                    'kampus' => 'required|string|max:255',
                    'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'ktm' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                Log::info('Validation passed:', $validatedData);

                $validatedData['pengguna_id'] = $user->pengguna_id;
                $validatedData['nama'] = $user->nama;
                $validatedData['ktp'] = $request->file('ktp')->store('ktp', 'public');
                $validatedData['ktm'] = $request->file('ktm')->store('ktm', 'public');
                $validatedData['foto'] = $request->file('foto')->store('foto', 'public');

                Peserta::create($validatedData);

                return redirect()->route('peserta.history')->with('success', 'Pendaftaran berhasil!');
            } catch (\Illuminate\Validation\ValidationException $e) {
                Log::error('Validation failed:', $e->errors());
                return back()->withErrors($e->errors())->withInput();
            } catch (\Exception $e) {
                Log::error('Error saving:', $e->getMessage());
                return back()->with('error', 'Terjadi error saat menyimpan: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('peserta.dashboard')->with('error', 'Anda sudah terdaftar!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function showHistory()
    {
        //
        $user = Auth::user();
        $peserta = Peserta::where('pengguna_id', $user->pengguna_id)->first();

        if ($peserta) {
            $score = Score::select('*')
                ->selectRaw('CASE
                WHEN score_total >= last_score_total THEN score_total
                ELSE last_score_total
            END AS highest_score,
            CASE
                WHEN score_r >= last_score_r THEN score_r
                ELSE last_score_r
            END AS highest_score_r,
            CASE
                WHEN score_l >= last_score_l THEN score_l
                ELSE last_score_l
            END AS highest_score_l')
                ->where('no_induk', $peserta->no_induk)
                ->first();
        } else {
            $score = null;
        }

        return view('peserta.riwayat', ['peserta' => $peserta, 'score' => $score]);
    }

    public function requestDokumen()
    {
        $user = Auth::user();
        $peserta = Peserta::where('pengguna_id', $user->pengguna_id)->first();
        $score = Score::where('no_induk', $peserta->no_induk ?? '')->first();

        return view('peserta.requestDokumen', compact('peserta', 'score'));
    }

    public function exportPeserta()
    {
        $pesertas = Peserta::with('pengguna')->whereDoesntHave('score')->get()->map(function ($peserta) {
            return [
                'nama'              => $peserta->pengguna->nama,
                'no_induk'          => $peserta->no_induk,
                'nik'               => $peserta->nik,
                'no_telp'           => (string) $peserta->no_telp,
                'tgl_lahir'         => $peserta->tgl_lahir,
                'alamat_asal'       => $peserta->alamat_asal,
                'alamat_sekarang'   => $peserta->alamat_sekarang,
                'jurusan'           => $peserta->jurusan,
                'program_studi'     => $peserta->program_studi,
                'kampus'            => $peserta->kampus,
            ];
        })->toArray();

        return Excel::download(new PesertaExport($pesertas), 'data_peserta.xlsx');
    }


    public function exportNoTelp()
    {
        $no_telp = Peserta::whereNotNull('no_telp')
            ->where('no_telp', '!=', '')
            ->pluck('no_telp')
            ->unique()
            ->map(function ($phone) {
                $phone = preg_replace('/[^0-9]/', '', $phone);

                if (substr($phone, 0, 2) === '08') {
                    return '+62' . substr($phone, 1);
                }

                if (substr($phone, 0, 1) === '8') {
                    return '+62' . $phone;
                }

                return '+62' . ltrim($phone, '0');
            })
            ->values()
            ->toArray();

        return Excel::download(new NoTelpExport($no_telp), 'data_no_telp.xlsx');
    }
}
