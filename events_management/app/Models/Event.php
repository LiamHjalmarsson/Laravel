<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    // trades 
        // added to classes 
            // use and name of the trade 
            // ones the trade is used within the clas all the methods from a trade will be added to the class 
            // lets you add additional functionalit to the class witout using inheritance         
    use HasFactory;

    protected $fillable = ["name", "description", "start_time", "end_time", "user_id"];

    // relationship to the user 
    public function user (): BelongsTo { // add return typs  :BelongsTo
        return $this->belongsTo(User::class);
    }
    // relationship to the attendees
    public function attendees (): HasMany {
        return $this->hasMany(Attendee::class);
    }
}


// Event Resource controlling json response 