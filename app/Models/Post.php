<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function avgRating() {
        return $this->ratingAvg;
    }

    public function ratedBy(User $user) {
        return $this->ratings->contains('user_id', $user->id);
    }

    public function ratingCount() {
        return $this->rating_count;
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }
}
