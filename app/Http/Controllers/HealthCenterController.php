<?php

namespace App\Http\Controllers;

use App\Models\HealthCenter;
use Illuminate\Http\Request;

class HealthCenterController extends Controller
{
    /**
     * Menampilkan daftar fasilitas kesehatan di halaman petugas.
     */
    public function index()
    {
        $healthCenters = HealthCenter::all();

        
        return view('pages.officer.kelola-data.fasilitas-kesehatan', compact('healthCenters'));
    }

    /**
     * Menyimpan data fasilitas kesehatan baru yang diinput oleh petugas.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'nama_faskes'       => 'required|string|max:255',
            'jenis_bencana'     => 'nullable|string|max:255',
            'wilayah'           => 'required|string|max:255',
            'status'            => 'required|in:AKTIF,SIAGA,KRITIS,NON-AKTIF',
            'deskripsi_bencana' => 'nullable|string',
        ]);

        
        HealthCenter::create([
            'nama_faskes'       => $request->nama_faskes,
            'jenis_bencana'     => $request->jenis_bencana,
            'wilayah'           => $request->wilayah,
            'status'            => $request->status,
            'deskripsi_bencana' => $request->deskripsi_bencana,
        ]);

        
        return redirect()->route('officer.kelola-data.faskes')->with('success', 'Data pusat kesehatan berhasil ditambahkan!');
    }
}