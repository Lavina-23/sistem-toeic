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

    public function exportPDF()
    {
        $peserta = Peserta::all();

        $pdf = Pdf::loadView('admin.peserta_pdf', compact('peserta'));
        return $pdf->download('data_peserta.pdf');
    }
}
