<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class SafetyGuideController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.User.SafetyGuide.index');
}

public function show()
{
    return $this->todo('Api.User.SafetyGuide.show');
}

public function videos()
{
    return $this->todo('Api.User.SafetyGuide.videos');
}

public function news()
{
    return $this->todo('Api.User.SafetyGuide.news');
}
}
