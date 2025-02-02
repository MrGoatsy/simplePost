<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail {
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'rank',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRank() {
        return $this->rank;
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function getReceivedRatings() {
        return $this->hasManyThrough(Rating::class, Post::class);
    }

    /*public function likes() {
        return $this->hasMany(Like::class);
    }

    public function getReceivedLikes() {
        return $this->hasManyThrough(Like::class, Post::class);
    }*/
}
