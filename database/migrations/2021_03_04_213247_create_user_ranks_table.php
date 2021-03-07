<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRanksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('userranks', function (Blueprint $table) {
            $table->id();
            $table->string('rankName')->unique();
            $table->integer('rankValue')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('userranks', function (Blueprint $table) {
            Schema::dropIfExists('userranks');
        });
    }
}
