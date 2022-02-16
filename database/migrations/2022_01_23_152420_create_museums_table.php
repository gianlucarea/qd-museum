<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('description');
            $table->integer('total_time');
            $table->integer('total_visit');
        });

        DB::table('museums')->insert([
            ['name' => 'Museo Storico' , 'address' => 'Via Museo Storico 1 , Roma (RM), Italia' , 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus maximus diam porttitor, finibus ante non, venenatis felis. Fusce neque nisi, venenatis sed neque vitae, lobortis aliquet nibh. Aenean nec diam vitae quam consectetur lobortis id a purus. ', 'total_time' => 43200, 'total_visit' => 23],
            ['name' => 'Museo Nazionale' , 'address' => 'Via Nazionale 10 , Roma (RM), Italia', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus maximus diam porttitor, finibus ante non, venenatis felis. Fusce neque nisi, venenatis sed neque vitae, lobortis aliquet nibh. Aenean nec diam vitae quam consectetur lobortis id a purus. ', 'total_time' => 45100, 'total_visit' => 25],
            ['name' => 'Museo Dello Sport' , 'address' => 'Via Olimpico , Roma (RM), Italia', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus maximus diam porttitor, finibus ante non, venenatis felis. Fusce neque nisi, venenatis sed neque vitae, lobortis aliquet nibh. Aenean nec diam vitae quam consectetur lobortis id a purus. ', 'total_time' => 23200, 'total_visit' => 12],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museums');
    }
}
