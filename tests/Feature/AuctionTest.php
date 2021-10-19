<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuctionTest extends TestCase
{
    use RefreshDatabase;

    public function testAuctionsReturnsDataInValidFormat() {
    
        $this->json('get', 'api/auctions')
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'price',
                            'created_at',
                            'user' => [
                                'id',
                                'email',
                                'name',
                                'num_phone',
                            ],
                            'book' => [
                                'id',
                                'title',
                                'description',
                                'category',
                                'book_condition',
                            ],
                            'images' => [
                                '*' => [
                                    'id',
                                    'created_at',
                                    'updated_at',
                                    'filename', 
                                    'auction_id'
                                ]
                            ]
                        ]
                    ]
                ]
             );
      }

    public function test_auction_create_requires_auth()
    {
        $response = $this->postJson('/api/auctions', [
            'user_id' => '4',
            'price' => '32',
            'title' => 'Lorem ipsum',
            'description' => 'Test description',
            'book_condition_id' => 4,
            'category_id' => 3,
            'images' => [
                'filename' => 'test',
                'filename' => 'test 2'
            ]
        ]);

        $response
            ->assertStatus(401);
           
    }

    public function test_auction_created_if_auth()
    {
        $user = User::factory()->create([
                    'email' => 'test@example.com',
                    'password' => bcrypt('password'),
                ]);
        
        $token = $user->createToken('access_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer '. $token)->postJson('/api/auctions', [
            'user_id' => '4',
            'price' => '32',
            'title' => 'Lorem ipsum',
            'description' => 'Test description',
            'book_condition_id' => 3,
            'category_id' => 3,
            'images' => [
                'filename' => 'test',
                'filename' => 'test 2'
            ]
        ]);

        $response
            ->assertStatus(201);
           
    }
}
