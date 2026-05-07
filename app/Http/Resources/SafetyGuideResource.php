<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SafetyGuideResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // TODO: map only fields needed by the frontend/mobile app.
        return parent::toArray($request);
    }
}
