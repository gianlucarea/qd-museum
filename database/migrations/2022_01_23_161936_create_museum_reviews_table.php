<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuseumReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('museum_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('review_title');
            $table->text('review_text')->default('');
            $table->float('stars');
            $table->timestamp('review_date');
        });

        DB::table('museum_reviews')->insert([
            ['museum_id' => 1, 'user_id' => 7, 'review_title' => 'un gran bel museo', 'review_text' => 'le aspettative erano alte, ma sono state completamente soddisfatte. Davvero un gran bel museo, con ottimo personale ed ottime opere!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['museum_id' => 2, 'user_id' => 7, 'review_title' => 'soddisfacente, ma con qualcosa da migliorare', 'review_text' => 'il museo è ben tenuto ed il personale gentile ed accogliente, ma il modo in cui le opere in sè ed il come sono esposte non è ottimale.', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['museum_id' => 3, 'user_id' => 7, 'review_title' => 'insoddisfatto', 'review_text' => 'È vero che non è il mio genere di museo, ma è davvero mal curato, ed il personale sembra molto disinteressato alle opere e alla gestione del pubblico', 'stars' => 2, 'review_date' => date('2022/02/10')],
            ['museum_id' => 2, 'user_id' => 8, 'review_title' => 'un gran bel museo', 'review_text' => 'le aspettative erano alte, ma sono state completamente soddisfatte. Davvero un gran bel museo, con ottimo personale ed ottime opere!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['museum_id' => 1, 'user_id' => 8, 'review_title' => 'soddisfacente, ma con qualcosa da migliorare', 'review_text' => 'il museo è ben tenuto ed il personale gentile ed accogliente, ma il modo in cui le opere in sè ed il come sono esposte non è ottimale.', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['museum_id' => 3, 'user_id' => 8, 'review_title' => 'insoddisfatto', 'review_text' => 'È vero che non è il mio genere di museo, ma è davvero mal curato, ed il personale sembra molto disinteressato alle opere e alla gestione del pubblico', 'stars' => 2, 'review_date' => date('2022/02/10')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museum_reviews');
    }
}
