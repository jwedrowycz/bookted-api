<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(30)->create();
        DB::table('users')->insert([
            [
                'name' => 'Jakub',
                'username' => 'admin',
                'num_phone' => '123 345 432',
                'email' => 'admin@example.com',
                'password' => Hash::make('qweqweqwe'),
                'created_at' => Carbon::now(),
            ],               
        ]);
    }
}
