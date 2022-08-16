<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //        echo PHP_EOL;
        //        print_r($this->getConnection());
        //        echo PHP_EOL;
        //        die;
        Schema::create('notifications', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user', 'id');
            $table->integer('status')->default(0);
            $table->foreignId('notifiable_id');
            $table->string('notifiable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('notifitions');
    }
}
