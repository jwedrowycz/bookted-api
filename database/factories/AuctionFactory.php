<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\AuctionImage;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuctionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Auction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'  => rand(1,10),
            'price' => $this->faker->numberBetween(10,999),
            'views' => $this->faker->numberBetween(0,2000),
            'created_at' => $this->faker->dateTimeBetween('-6 weeks', 'now')
        ];
    }
}
