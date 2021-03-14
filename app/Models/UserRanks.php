<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRanks extends Model {
    use HasFactory;

    protected $fillable = [
        'rankName',
        'rankValue'
    ];

    public function getRankName(User $user) {
        $query = DB::table('userranks')->where('rankValue', $user->rank)->first();

        return $query;
    }
}
