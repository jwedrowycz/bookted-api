<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function test_user_profile_page_can_be_accessed()
    {
        $user = User::factory()->create()->first();

        $response = $this->get('/api/users/' . $user->id);
        $response->assertStatus(200);
    }
}
