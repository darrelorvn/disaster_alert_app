<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class HealthFacilityManagementController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.Officer.HealthFacilityManagement.index');
}

public function store()
{
    return $this->todo('Api.Officer.HealthFacilityManagement.store');
}

public function show()
{
    return $this->todo('Api.Officer.HealthFacilityManagement.show');
}

public function update()
{
    return $this->todo('Api.Officer.HealthFacilityManagement.update');
}

public function destroy()
{
    return $this->todo('Api.Officer.HealthFacilityManagement.destroy');
}
}
