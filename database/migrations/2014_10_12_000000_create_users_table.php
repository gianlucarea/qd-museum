<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['name' => 'Fabio' , 'surname' => 'Capitanio' , 'username' => 'FabCap' ,   'email' => 'fabio.capitanio@gmail.com', 'password' => Hash::make('password'), 'role' => '3'],
            ['name' => 'Daniele' , 'surname' => 'Fossemò' , 'username' => 'DanieleF198'   , 'email' => 'daniele.fossemo@outlook.it', 'password' => Hash::make('password'), 'role' => '3'],
            ['name' => 'Gianluca' , 'surname' => 'Rea' , 'username' => 'gianrea' ,  'email' => 'reagianluca97@gmail.com', 'password' => Hash::make('password'), 'role' => '3'],
            ['name' => 'Aldo' , 'surname' => 'Baglio' , 'username' => 'AldoBaglio' ,  'email' => 'Aldo.Baglio@outlook.it', 'password' => Hash::make('Sforza10'),'role' => '2'],
            ['name' => 'Giovanni' , 'surname' => 'Storti' , 'username' => 'Giovanni10' ,  'email' => 'Giovanni.Storti@outlook.it', 'password' => Hash::make('Sforza11'),'role' => '2'],
            ['name' => 'Giacomo' , 'surname' => 'Poretti' , 'username' => 'Giacomo5' , 'email' => 'Giacomo.Poretti@outlook.it', 'password' => Hash::make('Gambapersa92'),'role' => '2'],
            ['name' => 'Massimo' , 'surname' => 'Barbero' , 'username' => 'Barbero10' ,  'email' => 'massimo.barbero@outlook.it', 'password' => Hash::make('password1'),'role' => '1'],
            ['name' => 'Domenico' , 'surname' => 'Eco' , 'username' => 'EcoDomo10' ,  'email' => 'domenico.eco@outlook.it', 'password' => Hash::make('password2'),'role' => '1'],
            ['name' => 'Giuseppe' , 'surname' => 'Leone' , 'username' => 'Leone1000' , 'email' => 'giuseppe.leone@outlook.it', 'password' => Hash::make('password3'),'role' => '1'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
