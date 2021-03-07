<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('userranks')->insert([
            [
                'rankName'  => 'banned',
                'rankValue' => 0,
            ],
            [
                'rankName'  => 'user',
                'rankValue' => 1,
            ],
            [
                'rankName'  => 'Premium',
                'rankValue' => 5,
            ],
            [
                'rankName'  => 'Moderator',
                'rankValue' => 500,
            ],
            [
                'rankName'  => 'Admin',
                'rankValue' => 999,
            ],
        ]);
    }
}
