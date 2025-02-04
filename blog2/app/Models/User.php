<?php

namespace App\Models;

use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected function avatar(): Attribute{
        return Attribute::make(get: function($value){
            return $value ? '/storage/avatars/' . $value : '/fallback-avatar.jpg';
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // RELATIONSHIPS
    public function feedPosts () {
        // simiular to hasmany method but allows there to be an intermediate table in between the relationship
        // Gives it six arguments 
            // 1 begin with the model that we want o end up with 
            // 2 intermediate table the table that has the data or the relationship that you need to look up beore you get tp Hits Post
            // 3 foreign key on the intermediate table
            // 4 foregin key on the final model that were interested in 
            // 5 the local key User is whats look in this case 
            // 6 the local key on the intermediate table the follow table 
        return $this->hasManyThrough(Post::class, Follow::class, "user_id", "user_id", "id", "followeduser");
    }

    public function followings () {
        // returning the relationship 
        return $this->hasMany(Follow::class, "user_id");
    }

    public function followers () {
        // returning the relationship 
        return $this->hasMany(Follow::class, "followeduser");
    }

    public function posts () {
        // a user has many posts spelling out the relationship
        return $this->hasMany(Post::class, "user_id");
    }
}
