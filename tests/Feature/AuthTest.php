<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    public function test_it_can_acces_the_registration_page()
    {
        $response = $this->get(route('register'));

        $response->assertOk();
    }

    public function test_it_can_acces_the_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertOk();
    }
}
