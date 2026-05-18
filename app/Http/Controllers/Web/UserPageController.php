<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SafetyGuide;
use App\Models\DisasterReport;
use App\Enums\ReportStatus;
use App\Http\Resources\SafetyGuideResource;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function home()
    {
        return view('pages.user.home');
    }

    public function map()
    {
        // Mengambil data laporan bencana aktif untuk ditampilkan di Peta
        $mapData = DisasterReport::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereIn('status', [
                ReportStatus::Submitted->value, 
                ReportStatus::Verified->value, 
                ReportStatus::InProgress->value
            ])
            ->get()
            ->map(function ($report) {
                return [
                    'lat' => $report->latitude,
                    'lng' => $report->longitude,
                    'title' => strtoupper(str_replace('_', ' ', $report->type)),
                    'desc' => $report->location_name,
                    'status' => match($report->status) {
                        ReportStatus::Submitted->value => '#dc2626', // Merah (Darurat)
                        ReportStatus::Verified->value => '#ea580c',  // Oranye (Divalidasi)
                        ReportStatus::InProgress->value => '#2563eb', // Biru (Diproses)
                        default => '#64748b',
                    }
                ];
            });

        // Mengirim variabel $mapData ke tampilan blade
        return view('pages.user.map-evacuation', compact('mapData'));
    }

    public function report()
    {
        return view('pages.user.report-disaster');
    }

    public function safety()
    {
        $guides = SafetyGuide::all();

        return view('pages.user.safety-guide', [
            'guides' => SafetyGuideResource::collection($guides)
        ]);
    }

    public function profile()
    {
        return view('pages.user.profile');
    }
}