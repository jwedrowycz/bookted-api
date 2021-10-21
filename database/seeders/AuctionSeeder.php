<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Book;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auction::factory(300)
        ->hasImages(rand(1,8), function (array $attributes, Auction $auction) {
            return [
                'filename' => 'https://source.unsplash.com/random/'. rand(400,1000) . 'x' . rand(500,1900),
                'auction_id' => $auction->id
            ];
        })
        ->create();
    }
}
