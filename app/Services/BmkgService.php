<?php

namespace App\Services;

class BmkgService
{
    /**
     * Fetch and normalize disaster/weather information from BMKG API.
     */
    public function handle(array $payload = []): array
    {
        // TODO: implement fetch and normalize disaster/weather information from bmkg api.
        return [
            'message' => 'BmkgService belum diimplementasikan.',
            'payload' => $payload,
        ];
    }
}
