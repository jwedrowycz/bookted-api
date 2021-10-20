<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    // protected $with = ['user', 'book', 'images'];

    protected $fillable = ['user_id', 'book_id', 'price'];

    protected $dates = ['created_at', 'updated_at'];
    
    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->diffForHumans();
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
