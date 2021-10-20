<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function testUserReturnsDataInValidFormat() {
    
        $this->json('get', 'api/users')
             ->assertStatus(Response::HTTP_OK)
             ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'username',
                            'email',
                            'created_at',
                            'auctions' => [
                                'id',
                                'price',
                                'created_at',
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
                ]
             );
      }
}
