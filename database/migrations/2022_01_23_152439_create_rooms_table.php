<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_id')->constrained();
            $table->integer('height');
            $table->integer('width');
            $table->integer('length');
        });

        DB::table('rooms')->insert([
            ['museum_id' => '1' , 'height' => '1','width'=>'300','length'=>'300' ],
            ['museum_id' => '1' , 'height' => '1','width'=>'300','length'=>'300' ],
            ['museum_id' => '1' , 'height' => '2','width'=>'300','length'=>'300' ],
            ['museum_id' => '2' , 'height' => '5','width'=>'50','length'=>'50' ],
            ['museum_id' => '2' , 'height' => '5','width'=>'50','length'=>'50' ],
            ['museum_id' => '2' , 'height' => '5','width'=>'50','length'=>'50' ],
            ['museum_id' => '3' , 'height' => '5','width'=>'50','length'=>'50' ],
            ['museum_id' => '3' , 'height' => '5','width'=>'50','length'=>'50' ],
            ['museum_id' => '3' , 'height' => '5','width'=>'50','length'=>'50' ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
