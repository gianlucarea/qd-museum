<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('description');
            });

        DB::table('artworks')->insert([
            ['room_id' => '1' , 'title' => 'Abbraccio','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor. '],
            ['room_id' => '1' , 'title' => 'Due donne tahitiane','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '1' , 'title' => 'I giocatori di carte','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '2' , 'title' => 'Il terzo stato','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '2' , 'title' => 'Diana e Attione','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '2' , 'title' => 'Il giuramento degli Orazi','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '3' , 'title' => 'Incontro di Leone Magno con Attila','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '3' , 'title' => 'Allegoria del trionfo di venere','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '3' , 'title' => 'Morte del generale Wolfe','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor. '],
            ['room_id' => '4' , 'title' => 'La Danza','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '4' , 'title' => 'Gioconda','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor. '],
            ['room_id' => '4' , 'title' => 'Ballo al Moulin de la Galette','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '5' , 'title' => 'La persistenza della memoria','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '5' , 'title' => 'Ronda di notte','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '5' , 'title' => 'La dama con ermellino','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '6' , 'title' => 'La venere di Urbino','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '6' , 'title' => 'Il ratto di Europa','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '6' , 'title' => 'La nascita di Venere','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '7' , 'title' => 'Una partita a calcio','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '7' , 'title' => 'Partita di pallone','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '7' , 'title' => 'I calciatori','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '8' , 'title' => 'Dinamismo di un calciatore','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '8' , 'title' => 'Due calciatori','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '8' , 'title' => 'Giocatori di calcio','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '9' , 'title' => 'Calciatore che corre con la palla','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '9' , 'title' => 'Sunderland Vs Aston Villa','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
            ['room_id' => '9' , 'title' => 'Il gioco del calcio','description'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam enim risus, rutrum in feugiat vel, feugiat ac ligula. Aenean euismod, libero vel consectetur hendrerit, est sem placerat massa, nec feugiat ipsum ligula non tortor.'],
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artworks');
    }
}
