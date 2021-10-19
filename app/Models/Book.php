<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // protected $with = ['auction', 'category', 'bookCondition'];
    protected $fillable = ['title', 'description', 'publish_date', 'book_condition_id', 'category_id'];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookCondition()
    {
        return $this->belongsTo(BookCondition::class);
    }
}
