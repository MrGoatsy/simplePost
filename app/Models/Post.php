<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Post extends Model {
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'content',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function ratingCount() {
        return $this->ratings_count;
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
}
