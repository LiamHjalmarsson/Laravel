<?php

namespace App\Models;

use App\Models\User;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Searchable;
    
    protected $fillable = ["title", "body", "user_id"];

    // function name for search mathers 
    public function toSearchableArray() {
        // spellout what in this database row should be searchable what are we searching through 

        // need to o to .env file
        return [
            "title" => $this->title,
            "body" => $this->body,
        ]; 
    }

    // Reaching the user of the post 
    public function user () {
        // in the body of the function we reterun a relationship
        // this represent sort of the blog post class as a whole
        return $this->belongsTo(User::class, "user_id"); // first the blog that the post class belongs to A blog post belongs to a user
    }

}
