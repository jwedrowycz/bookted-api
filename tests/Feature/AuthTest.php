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

    public function test_user_can_register() {
        $response = $this->postJson('/api/register', [
            'name' => 'Jan',
            'username' => 'jankowal',
            'num_phone' => '123345543',
            'email' => 'jan@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'access_token' => true,
                'token_type' => true,
            ]);
    }
    # TODO: REBUILD
    // public function test_user_can_login() { 
    //     $user = User::factory()->create([
    //         'email' => 'test@example.com',
    //         'password' => bcrypt('password'),
    //     ]);

    //     $this->actingAs($user, 'sanctum');

    //     $this->assertAuthenticated();
    // }
}
