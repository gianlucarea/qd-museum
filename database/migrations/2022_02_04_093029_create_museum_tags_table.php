<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_id')->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->boolean('available');
        });

        DB::table('museum_tags')->insert([
            ["museum_id" => 1, "code" => "codeXX00XX", "available" => 1],
            ["museum_id" => 1, "code" => "codeXX01XX", "available" => 1],
            ["museum_id" => 1, "code" => "codeXX02XX", "available" => 1],
            ["museum_id" => 2, "code" => "codeXX03XX", "available" => 1],
            ["museum_id" => 2, "code" => "codeXX04XX", "available" => 1],
            ["museum_id" => 2, "code" => "codeXX05XX", "available" => 1],
            ["museum_id" => 3, "code" => "codeXX06XX", "available" => 1],
            ["museum_id" => 3, "code" => "codeXX07XX", "available" => 1],
            ["museum_id" => 3, "code" => "codeXX08XX", "available" => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museum_tags');
    }
}
