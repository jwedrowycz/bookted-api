<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'publish_date', 'book_condition_id', 'category_id', 'auction_id'];

    public function getPublishDateAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('Y');
    }

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
