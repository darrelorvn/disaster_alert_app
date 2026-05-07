<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class EvacuationRouteManagementController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.Officer.EvacuationRouteManagement.index');
}

public function store()
{
    return $this->todo('Api.Officer.EvacuationRouteManagement.store');
}

public function show()
{
    return $this->todo('Api.Officer.EvacuationRouteManagement.show');
}

public function update()
{
    return $this->todo('Api.Officer.EvacuationRouteManagement.update');
}

public function destroy()
{
    return $this->todo('Api.Officer.EvacuationRouteManagement.destroy');
}
}
