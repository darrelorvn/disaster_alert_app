<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class MapEvacuationController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.User.MapEvacuation.index');
}

public function routes()
{
    return $this->todo('Api.User.MapEvacuation.routes');
}

public function shelters()
{
    return $this->todo('Api.User.MapEvacuation.shelters');
}

public function healthFacilities()
{
    return $this->todo('Api.User.MapEvacuation.healthFacilities');
}

public function radius()
{
    return $this->todo('Api.User.MapEvacuation.radius');
}
}
