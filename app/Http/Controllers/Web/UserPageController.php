<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SafetyGuide;
use App\Models\DisasterReport;
use App\Models\EmergencyPlace;
use App\Enums\ReportStatus;
use App\Http\Resources\SafetyGuideResource;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserPageController extends Controller
{
    public function home()
    {
        $emergencyPlaces = EmergencyPlace::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status', 'active')
            ->get()
            ->map(function ($place) {
                return [
                    'name' => $place->name,
                    'lat' => $place->latitude,
                    'lng' => $place->longitude,
                    'type' => $place->type->value ?? $place->type,
                    'label' => $place->type->label() ?? $place->type,
                ];
            });

        return view('pages.user.home', compact('emergencyPlaces'));
    }

    public function mapLaporan()
    {
        $mapData = DisasterReport::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereIn('status', [
                ReportStatus::Submitted->value, 
                ReportStatus::Verified->value, 
                ReportStatus::InProgress->value
            ])
            ->get()
            ->map(function ($r) {
                return [
                    'lat' => $r->latitude,
                    'lng' => $r->longitude,
                    'title' => strtoupper(str_replace('_', ' ', $r->type)),
                    'subtitle' => $r->location_name ?? 'Lokasi Bencana',
                    'badge_text' => match($r->status) { 
                        'submitted' => 'DARURAT', 
                        'verified' => 'DIVALIDASI', 
                        'in_progress' => 'DIPROSES', 
                        default => strtoupper($r->status) 
                    },
                    'badge_color' => match($r->status) { 
                        'submitted' => '#dc2626', 
                        'verified' => '#ea580c', 
                        'in_progress' => '#2563eb', 
                        default => '#64748b' 
                    },
                    'badge_bg' => match($r->status) { 
                        'submitted' => '#FEF2F2', 
                        'verified' => '#FFF7ED', 
                        'in_progress' => '#EFF6FF', 
                        default => '#F8FAFC' 
                    },
                    'color' => match($r->status) { 
                        'submitted' => '#dc2626', 
                        'verified' => '#ea580c', 
                        'in_progress' => '#2563eb', 
                        default => '#64748b' 
                    },
                    'details' => $r->occurred_at ? Carbon::parse($r->occurred_at)->diffForHumans() : 'Baru saja',
                ];
            });

        $legend = [
            ['color' => '#dc2626', 'label' => 'Darurat (Baru)'],
            ['color' => '#ea580c', 'label' => 'Divalidasi'],
            ['color' => '#2563eb', 'label' => 'Diproses'],
        ];

        return view('pages.user.map-evacuation', [
            'mapData' => $mapData, 
            'activeTab' => 'laporan', 
            'pageTitle' => 'Daftar Laporan', 
            'legend' => $legend
        ]);
    }

    public function mapShelter()
    {
        $mapData = EmergencyPlace::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereIn('type', ['shelter', 'emergency_post'])
            ->where('status', '!=', 'inactive')
            ->get()
            ->map(function ($place) {
                $typeStr = $place->type->value ?? $place->type;
                return [
                    'lat' => $place->latitude,
                    'lng' => $place->longitude,
                    'title' => $place->name,
                    'subtitle' => $place->area ?? 'Area tidak diketahui',
                    'badge_text' => match($place->status) { 
                        'active' => 'TERSEDIA', 
                        'full' => 'PENUH', 
                        'maintenance' => 'PERBAIKAN', 
                        default => 'NONAKTIF' 
                    },
                    'badge_color' => match($place->status) { 
                        'active' => '#10B981', 
                        'full' => '#EF4444', 
                        'maintenance' => '#F59E0B', 
                        default => '#64748b' 
                    },
                    'badge_bg' => match($place->status) { 
                        'active' => '#ECFDF5', 
                        'full' => '#FEF2F2', 
                        'maintenance' => '#FFFBEB', 
                        default => '#F8FAFC' 
                    },
                    'color' => match($typeStr) { 
                        'shelter' => '#10B981', 
                        'emergency_post' => '#F97316', 
                        default => '#64748b' 
                    },
                    'details' => $place->capacity ? $place->capacity . ' Kapasitas Orang' : 'Kapasitas tidak dicantumkan',
                ];
            });

        $legend = [
            ['color' => '#10B981', 'label' => 'Shelter Aman'],
            ['color' => '#F97316', 'label' => 'Posko Darurat'],
        ];

        return view('pages.user.map-evacuation', [
            'mapData' => $mapData, 
            'activeTab' => 'shelter', 
            'pageTitle' => 'Shelter & Posko', 
            'legend' => $legend
        ]);
    }

    public function mapFaskes()
    {
        $mapData = EmergencyPlace::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereIn('type', ['health_facility', 'health_post'])
            ->where('status', '!=', 'inactive')
            ->get()
            ->map(function ($place) {
                $typeStr = $place->type->value ?? $place->type;
                return [
                    'lat' => $place->latitude,
                    'lng' => $place->longitude,
                    'title' => $place->name,
                    'subtitle' => $place->area ?? 'Area tidak diketahui',
                    'badge_text' => match($place->status) { 
                        'active' => 'OPERASIONAL', 
                        'full' => 'PENUH', 
                        'maintenance' => 'PERBAIKAN', 
                        default => 'NONAKTIF' 
                    },
                    'badge_color' => match($place->status) { 
                        'active' => '#3B82F6', 
                        'full' => '#EF4444', 
                        'maintenance' => '#F59E0B', 
                        default => '#64748b' 
                    },
                    'badge_bg' => match($place->status) { 
                        'active' => '#EFF6FF', 
                        'full' => '#FEF2F2', 
                        'maintenance' => '#FFFBEB', 
                        default => '#F8FAFC' 
                    },
                    'color' => match($typeStr) { 
                        'health_facility' => '#3B82F6', 
                        'health_post' => '#06B6D4', 
                        default => '#3B82F6' 
                    },
                    'details' => $place->contact ? 'Kontak: ' . $place->contact : 'Telepon tidak dicantumkan',
                ];
            });

        $legend = [
            ['color' => '#3B82F6', 'label' => 'Rumah Sakit / Klinik'],
            ['color' => '#06B6D4', 'label' => 'Pos Kesehatan'],
        ];

        return view('pages.user.map-evacuation', [
            'mapData' => $mapData, 
            'activeTab' => 'faskes', 
            'pageTitle' => 'Fasilitas Kesehatan', 
            'legend' => $legend
        ]);
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