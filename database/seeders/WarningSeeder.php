<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarningSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('warning_reason')->insert([
            [
                'reason'  => 'Spam or misleading content',
                'points' => 20,
            ],
            [
                'reason'  => 'Hateful or abusive content ',
                'points' => 20,
            ],
            [
                'reason'  => 'Harmful or dangerous acts',
                'points' => 20,
            ],
            [
                'reason'  => 'Violent or repulsive content',
                'points' => 50,
            ],
            [
                'reason'  => 'Child abuse',
                'points' => 100,
            ],
            [
                'reason'  => 'Promotes terrorism',
                'points' => 100,
            ],
        ]);
    }
}
