<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumTagUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum_tag_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_tag_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('piano'); // WARNING: if choose from string to integer warn Daniele
            $table->string('posX');  // DO YOU HAVE READ, YEAH?!
            $table->string('posY');  // IF YOU DON'T: C'mon dude!
            $table->unique(['museum_tag_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museum_tag_user');
    }
}
