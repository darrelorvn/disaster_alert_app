<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\ReturnsPlaceholderResponse;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use ReturnsPlaceholderResponse;

    public function show()
{
    return $this->todo('Api.User.Profile.show');
}

public function update()
{
    return $this->todo('Api.User.Profile.update');
}

public function reportHistory()
{
    return $this->todo('Api.User.Profile.reportHistory');
}

public function notificationPreference()
{
    return $this->todo('Api.User.Profile.notificationPreference');
}

public function security()
{
    return $this->todo('Api.User.Profile.security');
}
}
