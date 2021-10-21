<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create()->first();

        $response = $this->postJson('/api/login', [
            'login' => $user->username,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Jan',
            'username' => 'jankowal',
            'email' => 'jan@example.com',
            'num_phone' => '123345567',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
        $response->assertStatus(201);
    }
}
