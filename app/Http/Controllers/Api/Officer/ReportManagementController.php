<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class ReportManagementController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.Officer.ReportManagement.index');
}

public function show()
{
    return $this->todo('Api.Officer.ReportManagement.show');
}

public function updateStatus()
{
    return $this->todo('Api.Officer.ReportManagement.updateStatus');
}
}
