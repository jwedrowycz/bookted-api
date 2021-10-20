<?php

namespace Tests\Feature;

use App\Models\Auction;
use App\Models\BookCondition;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuctionTest extends TestCase
{
    use RefreshDatabase;

    public function test_auctions_route_can_be_accessed()
    {
        # Arrange
        $bookCondId = BookCondition::factory()->create(['value' => 1]);
        $categoryId = Category::factory()->create(['name' => 'Kryminał'])
        $auction = Auction::factory()->create();
    }
}
