<?php

namespace App\Http\Controllers\Web\Officer;

use App\Http\Controllers\Controller;
use App\Models\HealthCenter;
use Illuminate\Http\Request;

class HealthCenterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_faskes' => 'required|string|max:255',
            'wilayah' => 'required|string|max:255',
            'status' => 'required|in:AKTIF,SIAGA,KRITIS,NON-AKTIF',
        ]);

        HealthCenter::create([
            'nama_faskes' => $request->nama_faskes,
            'jenis_bencana' => $request->jenis_bencana,
            'wilayah' => $request->wilayah,
            'status' => $request->status,
            'deskripsi_bencana' => $request->deskripsi_bencana,
        ]);

        return redirect()->route('officer.kelola-data.faskes')->with('success', 'Data faskes berhasil ditambahkan!');
    }
}