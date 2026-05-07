<?php

namespace App\Http\Controllers\Api\Integration;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class AiRecommendationController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function responsive()
{
    return $this->todo('Api.Integration.AiRecommendation.responsive');
}

public function preventive()
{
    return $this->todo('Api.Integration.AiRecommendation.preventive');
}
}
