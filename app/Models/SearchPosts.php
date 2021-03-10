<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SearchPosts extends Model {
    use Searchable;

    public function search() {
        $search = Post::search('asd')->paginate(100);

        return $search;
    }
}
