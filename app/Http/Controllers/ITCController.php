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
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class ITCController extends Controller {
    public function index(Request $request)
    {
        $query = Pengguna::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        $perPage = $request->input('perPage', 10);

        $pengguna = $query->paginate($perPage);

        return view('itc.dashboard', [
            'pengguna' => $pengguna,
        ]);
    }
}

