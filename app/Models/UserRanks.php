<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRanks extends Model {
    use HasFactory;

    protected $fillable = [
        'rankName',
        'rankValue'
    ];
}
