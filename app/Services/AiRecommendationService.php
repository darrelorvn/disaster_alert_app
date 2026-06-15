<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\DisasterReport;
use App\Models\DisasterEvent;
use App\Models\AiRecomendation;

class AiRecommendationService
{
    public function generateRecommendation($user)
    {
        $summary = $this->getContext();
        $prompt = $this->buildPrompt($user->role, $summary);

        try {
            $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'), [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

            $text = $response->json('candidates.0.content.parts.0.text');
            if (empty($text)) {
                throw new \Exception('Invalid response from AI');
            }
        } catch (\Exception $e) {
            $text = "Tetap waspada dan pantau informasi terkini dari BMKG dan otoritas setempat.";
        }

        return AiRecomendation::create([
            'user_id' => $user->id,
            'role' => $user->role,
            'recommendation_text' => $text,
            'context_summary' => $summary,
            'generated_at' => now(),
            'expires_at' => now()->addHours(6),
        ]);
    }

    private function getContext()
    {
        $reports = DisasterReport::select('type', 'location_name', 'status', 'occurred_at')
            ->latest()
            ->take(10)
            ->get();

        $events = DisasterEvent::where('status', 'aktif')
            ->latest()
            ->take(5)
            ->get();

        $bmkg = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json')->json();

        return json_encode([
            'reports' => $reports,
            'events' => $events,
            'bmkg' => $bmkg,
        ]);
    }

    private function buildPrompt($role, $context)
    {
        if ($role === 'user') {
            $prompt = "Berikan rekomendasi kewaspadaan, pantauan aman, dan hindari area bahaya berdasarkan konteks berikut: ";
        } elseif ($role === 'officer') {
            $prompt = "Berikan rekomendasi operasional, persiapan logistik, penempatan personel, dan preventif struktural berdasarkan konteks berikut: ";
        } else {
            $prompt = "Berikan rekomendasi berdasarkan konteks berikut: ";
        }

        return $prompt . $context;
    }
}
