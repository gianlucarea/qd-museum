<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworkReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artwork_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artwork_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('review_title');
            $table->text('review_text');
            $table->float('stars');
            $table->timestamp('review_date');
        });

        DB::table('artwork_reviews')->insert([
            ['artwork_id' => 1, 'user_id' => 7, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 2, 'user_id' => 7, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 3, 'user_id' => 7, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 4, 'user_id' => 7, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 5, 'user_id' => 7, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 6, 'user_id' => 7, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 7, 'user_id' => 7, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 8, 'user_id' => 7, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 9, 'user_id' => 7, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 10, 'user_id' => 7, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 11, 'user_id' => 7, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 12, 'user_id' => 7, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 13, 'user_id' => 7, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 14, 'user_id' => 7, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 15, 'user_id' => 7, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 16, 'user_id' => 7, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 17, 'user_id' => 7, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 18, 'user_id' => 7, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 19, 'user_id' => 7, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 20, 'user_id' => 7, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 21, 'user_id' => 7, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 22, 'user_id' => 7, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 23, 'user_id' => 7, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 24, 'user_id' => 7, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 25, 'user_id' => 7, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 14, 'user_id' => 8, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 15, 'user_id' => 8, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 16, 'user_id' => 8, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 10, 'user_id' => 8, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 12, 'user_id' => 8, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 13, 'user_id' => 8, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 20, 'user_id' => 8, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 18, 'user_id' => 8, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 19, 'user_id' => 8, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 17, 'user_id' => 8, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 5, 'user_id' => 8, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 2, 'user_id' => 8, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 9, 'user_id' => 8, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 6, 'user_id' => 8, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 7, 'user_id' => 8, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 4, 'user_id' => 8, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 1, 'user_id' => 8, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 8, 'user_id' => 8, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 3, 'user_id' => 8, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 11, 'user_id' => 8, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 22, 'user_id' => 8, 'review_title' => 'stupefacente', 'review_text' => 'Trovarsi di fronte a quest\'opera è stato completamente diverso rispetto a vederla su internet, stupefacente!', 'stars' => 5, 'review_date' => date('2022/02/09')],
            ['artwork_id' => 21, 'user_id' => 8, 'review_title' => 'carino', 'review_text' => 'mi aspettavo di meglio ad essere sincero, ma l\'opera è valida', 'stars' => 3, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 25, 'user_id' => 8, 'review_title' => 'buono', 'review_text' => 'Non eccelle ma rimane comunque su alti livelli, se visitate questo museo dovete assolutamente visitare quest\'opera d\'arte!', 'stars' => 4, 'review_date' => date('2022/02/10')],
            ['artwork_id' => 23, 'user_id' => 8, 'review_title' => 'niente di chè', 'review_text' => 'mi aspettavo di meglio da un\'opera così rinomata, ma devo dire che non è niente di chè', 'stars' => 2, 'review_date' => date('2022/02/08')],
            ['artwork_id' => 24, 'user_id' => 8, 'review_title' => 'non ci siamo', 'review_text' => 'è vero che quest\'opera d\'arte non appartiene al mio genere, ma la composizione, il colore, tutto... non ci siamo proprio', 'stars' => 1, 'review_date' => date('2022/02/09')],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artwork_reviews');
    }
}
