<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $auctions = Auction::all();
        return [
            'title' => $this->faker->sentence(4),
            'auction_id'  => $this->faker->unique()->numberBetween(1, $auctions->count()),
            'description' => $this->faker->text(),
            'book_condition_id' => $this->faker->numberBetween(1,5),
            'category_id' => $this->faker->numberBetween(1,5),

        ];
    }
}
