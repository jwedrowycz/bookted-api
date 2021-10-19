<?php

namespace Tests\Feature;

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
}
