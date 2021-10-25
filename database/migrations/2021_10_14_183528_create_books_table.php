<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->date('publish_date')->nullable();
            $table->foreignId('book_condition_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('auction_id')->constrained()->onDelete('cascade');

            $table->index('category_id');
            $table->index('auction_id');
            $table->index('book_condition_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
