<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Models\VerificationPhotos;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function createMessage()
    {
        return view('admin.send-message');
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
}
