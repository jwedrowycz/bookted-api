<?php

namespace Tests\Feature;

use App\Http\Resources\AuctionResource;
use App\Models\Auction;
use App\Models\Book;
use App\Models\BookCondition;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuctionTest extends TestCase
{
    use RefreshDatabase;

    public function test_auctions_route_can_be_accessed()
    {
        $response = $this->get('/api/auctions');

        $response->assertStatus(200);
    }

    public function test_get_all_auctions()
    {
        $response = $this->getJson('/api/auctions');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'data' => ['*' => [
                    'id',
                    'price',
                    'views',
                    'created_at',
                    'user' => [
                        'id',
                        'username',
                        'name',
                        'created_at',
                        'phone',
                        'last_login_at'
                    ],
                    'book' => [
                        'id',
                        'title',
                        'description',
                        'category',
                        'book_condition',
                        'publish_date',
                    ],
                    'images' => [
                        '*'
                ]]
                ]
            ]
        );
    }

    public function test_auction_and_book_can_be_created()
    {
        $bookCondition = BookCondition::create([
            'value' => 1,
        ]);

        $category = Category::create([
            'name' => 'Kryminał'
        ]);

        $user = User::factory()->create()->first();
        
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/auctions',
        [
            'title' => 'Test Auction',
            'description' => 'Test auction\'s description',
            'publish_date' => Carbon::now(),
            'book_condition_id' => $bookCondition->id,
            'category_id' => $category->id,
            'price' => 332,
            'user_id' => $user->id,
            'images' => [
                'file' => new \Illuminate\Http\UploadedFile(resource_path('test-files/kotek.jpg'), 'kotek.jpg', null, null, true),
            ],
        ]);

        $response
            ->assertStatus(201);
            
    }

    public function test_auction_can_be_deleted_by_author()
    {
        $bookCondition = BookCondition::create([
            'value' => 1,
        ]);

        $category = Category::create([
            'name' => 'Kryminał'
        ]);
        $user = User::factory()->create()->first();
        $auction = Auction::factory()->create(['user_id' => $user->id])->first();
        $book = Book::factory()->create([
            'category_id'=>$category->id,
            'book_condition_id' => $bookCondition->id,
            'auction_id' => $auction->id
            ])->first();
            
        $response = $this->deleteJson('api/auctions/' . $auction->id);

        $response->assertStatus(204);
    }
}
