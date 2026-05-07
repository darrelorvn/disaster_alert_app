<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class EmergencyPlaceManagementController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.Officer.EmergencyPlaceManagement.index');
}

public function store()
{
    return $this->todo('Api.Officer.EmergencyPlaceManagement.store');
}

public function show()
{
    return $this->todo('Api.Officer.EmergencyPlaceManagement.show');
}

public function update()
{
    return $this->todo('Api.Officer.EmergencyPlaceManagement.update');
}

public function destroy()
{
    return $this->todo('Api.Officer.EmergencyPlaceManagement.destroy');
}
}
