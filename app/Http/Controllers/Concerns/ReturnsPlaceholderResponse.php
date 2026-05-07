<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Http\JsonResponse;

trait ReturnsPlaceholderResponse
{
    protected function todo(string $feature, array $meta = []): JsonResponse
    {
        return response()->json([
            'feature' => $feature,
            'status' => 'not_implemented',
            'message' => 'Endpoint sudah disiapkan. Logic belum diprogram.',
            'meta' => $meta,
        ]);
    }
}
