<?php

namespace App\Http\Controllers;

use App\Models\AiRecomendation;
use App\Services\AiRecommendationService;

class AiRecomendationController extends Controller
{
    protected $service;

    public function __construct(AiRecommendationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $recommendation = AiRecomendation::where('user_id', auth()->id())
            ->where('role', 'user')
            ->where('expires_at', '>', now())
            ->first();

        if (!$recommendation) {
            $recommendation = $this->service->generateRecommendation(auth()->user());
        }

        return view('pages.user.ai-recommendation', compact('recommendation'));
    }

    public function refresh()
    {
        $this->service->generateRecommendation(auth()->user());
        return redirect()->back();
    }
}
