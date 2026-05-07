<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.User.Home.index');
}

public function activeDisasters()
{
    return $this->todo('Api.User.Home.activeDisasters');
}

public function latestReports()
{
    return $this->todo('Api.User.Home.latestReports');
}

public function nearbyQuickActions()
{
    return $this->todo('Api.User.Home.nearbyQuickActions');
}
}
