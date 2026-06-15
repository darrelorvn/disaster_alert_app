<?php

namespace App\Http\Controllers;

use App\Models\AiRecomendation;
use App\Services\AiRecommendationService;

class AiRecomendationOfficerController extends Controller
{
    protected $service;

    public function __construct(AiRecommendationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $recommendation = AiRecomendation::where('user_id', auth()->id())
            ->where('role', 'officer')
            ->where('expires_at', '>', now())
            ->first();

        if (!$recommendation) {
            $recommendation = $this->service->generateRecommendation(auth()->user());
        }

        return view('pages.officer.ai-recommendation', compact('recommendation'));
    }

    public function refresh()
    {
        $this->service->generateRecommendation(auth()->user());
        return redirect()->back();
    }
}
