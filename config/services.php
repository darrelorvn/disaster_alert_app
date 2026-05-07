<?php

return [
    'bmkg' => [
        'base_url' => env('BMKG_BASE_URL', 'https://data.bmkg.go.id'),
        'api_key' => env('BMKG_API_KEY'),
    ],
    'ai_recommendation' => [
        'driver' => env('AI_RECOMMENDATION_DRIVER', 'placeholder'),
        'api_key' => env('AI_RECOMMENDATION_API_KEY'),
        'base_url' => env('AI_RECOMMENDATION_BASE_URL'),
    ],
    'geofence' => [
        'default_radius_km' => (float) env('GEOFENCE_DEFAULT_RADIUS_KM', 5),
    ],
    'disaster_alert' => [
        'priority_threshold' => env('DISASTER_ALERT_PRIORITY_THRESHOLD', 'high'),
    ],
];
