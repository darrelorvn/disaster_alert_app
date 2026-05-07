<?php

namespace Tests\Feature;

use Tests\TestCase;

class ArchitectureRouteRegistrationTest extends TestCase
{
    public function test_user_home_route_is_registered(): void
    {
        $this->get('/user/home')->assertOk();
    }

    public function test_officer_home_route_is_registered(): void
    {
        $this->get('/petugas/home')->assertOk();
    }
}
