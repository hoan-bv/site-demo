<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
//        return true;
        Schema::create('titles', function(Blueprint $table) {
            $table->id();
            $table->string('lang_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
//        Schema::dropIfExists('titles');
    }
}
