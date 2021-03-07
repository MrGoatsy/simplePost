<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class addPosts extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        \App\Models\Post::factory(1000)->create(['user_id' => 1]);
    }
}
