<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotsVisit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slots_visit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_id')->constrained();
            $table->string('description');
            $table->integer('slot_number');
        });

        DB::table('time_slots_visit')->insert([
            ['museum_id' => 1, 'description' => 'morning (from 8:00 to 12:00)', 'slot_number' => 1],
            ['museum_id' => 1, 'description' => 'afternoon (from 13:30 to 19:00)', 'slot_number' => 2],
            ['museum_id' => 2, 'description' => 'morning (from 8:30 to 12:30)', 'slot_number' => 1],
            ['museum_id' => 2, 'description' => 'afternoon (from 14:00 to 18:00)', 'slot_number' => 2],
            ['museum_id' => 3, 'description' => 'morning (from 9:00 to 13:00)', 'slot_number' => 1],
            ['museum_id' => 3, 'description' => 'afternoon (from 14:30 to 19:30)', 'slot_number' => 2]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_slots_visit');
    }
}
