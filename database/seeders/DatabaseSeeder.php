<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RateSeeder::class,
            CategorySeeder::class,
            BookConditionSeeder::class,
            UserSeeder::class,
            BookSeeder::class,
            AuctionSeeder::class,
        ]);
    }
}
