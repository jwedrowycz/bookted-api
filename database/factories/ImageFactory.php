<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\AuctionImage;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $auctions = Auction::all();

        return [
            'filename' => 'https://source.unsplash.com/random/'.$this->faker->numberBetween(400,1000) . 'x' . $this->faker->numberBetween(500,1900),
            
        ];
    }
}
