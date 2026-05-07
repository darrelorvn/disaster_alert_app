<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.Officer.Dashboard.index');
}

public function statistics()
{
    return $this->todo('Api.Officer.Dashboard.statistics');
}

public function map()
{
    return $this->todo('Api.Officer.Dashboard.map');
}

public function feed()
{
    return $this->todo('Api.Officer.Dashboard.feed');
}
}
