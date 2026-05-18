<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DisasterReport;
use App\Enums\ReportStatus;
use Illuminate\Http\Request;

class OfficerPageController extends Controller
{
    public function home(Request $request)
    {
        // 1. Inisialisasi Query Dasar
        $query = DisasterReport::query();

        // 2. Terapkan Filter jika ada parameter dari URL (?type=... & status=...)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 3. Hitung KPI Dashboard berdasarkan filter
        $totalReports = (clone $query)->count();
        
        $unhandledReports = (clone $query)->where('status', ReportStatus::Submitted->value)->count();
        
        $activeAreas = (clone $query)->whereIn('status', [
            ReportStatus::Submitted->value, 
            ReportStatus::Verified->value, 
            ReportStatus::InProgress->value
        ])->distinct('location_name')->count('location_name');

        // 4. Ambil Laporan Terbaru untuk Tabel
        $latestReports = (clone $query)->latest()->take(10)->get();

        // 5. Ambil Data Peta
        $mapQuery = clone $query;
        
        // Jika petugas tidak memfilter status spesifik, peta hanya tampilkan yang masih aktif saja
        if (!$request->filled('status')) {
            $mapQuery->whereIn('status', [
                ReportStatus::Submitted->value, 
                ReportStatus::Verified->value, 
                ReportStatus::InProgress->value
            ]);
        }

        $mapData = $mapQuery->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($report) {
                return [
                    'lat' => $report->latitude,
                    'lng' => $report->longitude,
                    'title' => strtoupper(str_replace('_', ' ', $report->type)),
                    'desc' => $report->location_name,
                    'status' => match($report->status) {
                        ReportStatus::Submitted->value => '#dc2626', // Merah
                        ReportStatus::Verified->value => '#ea580c',  // Oranye
                        ReportStatus::InProgress->value => '#2563eb', // Biru
                        ReportStatus::Handled->value => '#16a34a',    // Hijau
                        default => '#64748b',                         // Abu-abu
                    }
                ];
            });

        return view('pages.officer.home', compact(
            'totalReports', 
            'unhandledReports', 
            'activeAreas', 
            'latestReports', 
            'mapData'
        ));
    }

    public function manageData()
    {
        return view('pages.officer.kelola-data.manage-data');
    }

    public function profile()
    {
        return view('pages.officer.profile');
    }
}