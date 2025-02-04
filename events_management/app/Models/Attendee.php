<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id'];

    // realtion to the user
    public function user (): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // relation to the event 
    public function event () : BelongsTo {
        return $this->belongsTo(Event::class);
    }
}
