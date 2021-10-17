<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rates')->insert([
            ['value'=> 1],
            ['value' => 2],
            ['value' => 3],
            ['value' => 4],
            ['value' => 5],
        ]);
    }
}
