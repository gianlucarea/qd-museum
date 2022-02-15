<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitRoute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_route', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('artwork_list');
            $table->string('descrizione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit_route');
    }
}
