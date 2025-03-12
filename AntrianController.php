<?php

namespace App\Http\Controllers;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function daftarAntrian(Request $request)
    {
        $lastAntrian = Antrian::whereDate('created_at', today())->orderBy('id', 'desc')->first();
        $nomorAntrian = $lastAntrian ? 'A' . str_pad((int) substr($lastAntrian->nomor_antrian, 1) + 1, 3, '0', STR_PAD_LEFT) : 'A001';

        $antrian = Antrian::create([
            'user_id' => auth()->id() ?? null, // Bisa tanpa login
            'nomor_antrian' => $nomorAntrian,
            'jenis_layanan' => $request->jenis_layanan ?? 'umum',
            'status' => 'menunggu',
        ]);

        return response()->json(['success' => true, 'data' => $antrian]);
    }
}