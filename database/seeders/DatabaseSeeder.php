<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        //\App\Models\User::factory(10)->create();
        for ($x = 0; $x < 1000; $x++) {
            DB::table('ratings')->insert([
                'user_id'   => 1,
                'post_id'   => rand(950, 1000),
                'stars'     => rand(1, 10),
            ]);
        }
    }
}
