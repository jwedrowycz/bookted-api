<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Book;
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
        $books = Book::all();
        return [
            'user_id'  => rand(1,10),
            'book_id'  => $this->faker->unique()->numberBetween(1, $books->count())
        ];
    }
}
