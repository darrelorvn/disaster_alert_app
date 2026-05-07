<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function show()
{
    return $this->todo('Api.Officer.Profile.show');
}

public function update()
{
    return $this->todo('Api.Officer.Profile.update');
}

public function security()
{
    return $this->todo('Api.Officer.Profile.security');
}

public function notification()
{
    return $this->todo('Api.Officer.Profile.notification');
}

public function support()
{
    return $this->todo('Api.Officer.Profile.support');
}
}
