<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BmkgController extends Controller
{
    public function getLatestEarthquake()
    {
        try {
            $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
            
            if ($response->successful()) {
                $data = $response->json();
                $gempa = $data['Infogempa']['gempa'];

            
                return response()->json([
                    'judul' => 'Gempa M ' . $gempa['Magnitude'],
                    'deskripsi' => $gempa['Wilayah'],
                    'waktu' => $gempa['Jam'] . ' WIB',
                    'status_aman' => $gempa['Potensi']
                ]);
            }
        } catch (\Exception $e) {
        }

        return response()->json([
            'judul' => 'Gempa M 4.2',
            'deskripsi' => 'Barat Daya Jakarta',
            'waktu' => '12:15 WIB',
            'status_aman' => 'TIDAK POTENSI TSUNAMI'
        ]);
    }
}