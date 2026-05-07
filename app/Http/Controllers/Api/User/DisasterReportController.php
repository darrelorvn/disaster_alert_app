<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class DisasterReportController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function index()
{
    return $this->todo('Api.User.DisasterReport.index');
}

public function store()
{
    return $this->todo('Api.User.DisasterReport.store');
}

public function show()
{
    return $this->todo('Api.User.DisasterReport.show');
}

public function preview()
{
    return $this->todo('Api.User.DisasterReport.preview');
}
}
