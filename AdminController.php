<?php

namespace App\Http\Controllers;
use App\Models\Antrian;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan daftar antrian
    public function listAntrian()
    {
        $antrian = Antrian::where('status', 'menunggu')->orderBy('created_at')->get();
        return response()->json(['success' => true, 'data' => $antrian]);
    }

    // Memanggil antrian
    public function panggilAntrian($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'dipanggil', 'waktu_dipanggil' => now()]);

        return response()->json(['success' => true, 'message' => "Nomor {$antrian->nomor_antrian} dipanggil"]);
    }

    // Menyelesaikan antrian
    public function selesaiAntrian($id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->update(['status' => 'selesai']);

        return response()->json(['success' => true, 'message' => "Nomor {$antrian->nomor_antrian} selesai"]);
    }
}
