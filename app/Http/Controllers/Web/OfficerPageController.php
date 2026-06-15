<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DisasterReport;
use App\Enums\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AiRecomendation;
use App\Services\AiRecommendationService;

class OfficerPageController extends Controller
{
    protected $service;

    public function __construct(AiRecommendationService $service)
    {
        $this->service = $service;
    }

    public function home(Request $request)
    {
        \App\Models\DisasterEvent::whereNotNull('expired_at')
            ->where('expired_at', '<=', now())
            ->each(function ($event) {
                \App\Models\DisasterReport::where('disaster_event_id', $event->id)->delete();
                $event->delete();
            });

        $query = DisasterReport::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalReports = (clone $query)->count();
        
        $unhandledReports = (clone $query)->where('status', ReportStatus::Submitted->value)->count();
        
        $activeAreas = (clone $query)->whereIn('status', [
            ReportStatus::Submitted->value, 
            ReportStatus::Verified->value, 
            ReportStatus::InProgress->value
        ])->distinct('location_name')->count('location_name');

        $latestReports = (clone $query)->latest()->take(10)->get();

        $recurringDisasters = DisasterReport::select('location_name', 'type', DB::raw('count(*) as total_occurrences'))
            ->groupBy('location_name', 'type')
            ->havingRaw('count(*) > 1')
            ->orderBy('total_occurrences', 'desc')
            ->take(5)
            ->get();

        $mapQuery = clone $query;
        
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
                        ReportStatus::Submitted->value => '#dc2626',
                        ReportStatus::Verified->value => '#ea580c',
                        ReportStatus::InProgress->value => '#2563eb',
                        ReportStatus::Handled->value => '#16a34a',
                        default => '#64748b',
                    }
                ];
            });

        $recommendation = AiRecomendation::where('user_id', auth()->id())
            ->where('role', 'officer')
            ->where('expires_at', '>', now())
            ->first();

        if (!$recommendation) {
            $recommendation = $this->service->generateRecommendation(auth()->user());
        }

        return view('pages.officer.home', compact(
            'totalReports', 
            'unhandledReports', 
            'activeAreas', 
            'latestReports', 
            'mapData',
            'recurringDisasters',
            'recommendation'
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

    public function refreshAi()
    {
        $this->service->generateRecommendation(auth()->user());
        return redirect()->back();
    }
}