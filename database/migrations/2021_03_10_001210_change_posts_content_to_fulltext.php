<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePostsContentToFulltext extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('fulltext', function (Blueprint $table) {
            DB::statement('ALTER TABLE posts ADD FULLTEXT search(content)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('fulltext', function (Blueprint $table) {
            //
        });
    }
}
