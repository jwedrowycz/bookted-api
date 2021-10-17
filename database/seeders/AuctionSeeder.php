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
        Auction::factory(300)->create();
    }
}
