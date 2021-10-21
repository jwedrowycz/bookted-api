<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCondition extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function getValueAttribute($value)
    {
        switch($value) {
            case 1:
                return 'Fatalna';
            case 2:
                return 'Zniszczona';
            case 3: 
                return 'Ślady użytkowania';
            case 4:
                return 'Dobra';
            case 5:
                return 'Bardzo dobra';
        }
    }
}
