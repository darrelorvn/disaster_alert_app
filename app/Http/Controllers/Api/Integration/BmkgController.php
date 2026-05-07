<?php

namespace App\Http\Controllers\Api\Integration;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class BmkgController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function status()
{
    return $this->todo('Api.Integration.Bmkg.status');
}

public function latest()
{
    return $this->todo('Api.Integration.Bmkg.latest');
}

public function sync()
{
    return $this->todo('Api.Integration.Bmkg.sync');
}
}
