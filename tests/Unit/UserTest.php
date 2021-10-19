<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login_endpoint_exist()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
