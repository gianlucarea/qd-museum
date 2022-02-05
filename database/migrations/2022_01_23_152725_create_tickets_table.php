<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('visit_date');
            $table->integer('time_slot_number')->default(0);
            $table->boolean('validated')->default(0);
        });

        DB::table('tickets')->insert([
            ['museum_id' => 1, 'user_id' => 7, 'visit_date' => date('2022/03/10'), 'time_slot_number' => 1, 'validated' => 0],
            ['museum_id' => 1, 'user_id' => 8, 'visit_date' => date('2022/03/10'), 'time_slot_number' => 2, 'validated' => 0],
            ['museum_id' => 2, 'user_id' => 7, 'visit_date' => date('2022/03/11'), 'time_slot_number' => 1, 'validated' => 0],
            ['museum_id' => 2, 'user_id' => 8, 'visit_date' => date('2022/03/11'), 'time_slot_number' => 2, 'validated' => 0],
            ['museum_id' => 3, 'user_id' => 7, 'visit_date' => date('2022/03/12'), 'time_slot_number' => 1, 'validated' => 0],
            ['museum_id' => 3, 'user_id' => 8, 'visit_date' => date('2022/03/12'), 'time_slot_number' => 2, 'validated' => 0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
