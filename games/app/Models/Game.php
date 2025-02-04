<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = ["title", "description", "type"];

    protected function image(): Attribute{
        return Attribute::make(get: function($value){
            return $value ? '/storage/games/' . $value : '/default_image.jpg';
        });
    }
}
