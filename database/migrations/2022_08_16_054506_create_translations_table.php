<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
//        return true;
        Schema::create('translations', function(Blueprint $table) {
            $table->id();
            $table->foreignId('lang_id')->constrained('languages');
            $table->foreignId('title_id')->constrained('titles');
            $table->string('content');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
//        Schema::dropIfExists('translations');
    }
}
