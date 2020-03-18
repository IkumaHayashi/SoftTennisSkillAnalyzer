<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organization1_id');
            $table->unsignedBigInteger('player1_a_id');
            $table->unsignedBigInteger('player1_b_id');
            $table->unsignedBigInteger('organization2_id');
            $table->unsignedBigInteger('player2_a_id');
            $table->unsignedBigInteger('player2_b_id');
            $table->string('note', 200)->default('');
            $table->dateTime('match_day')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('game_numbers')->default(7);
            $table->timestamps();
            
            $table->index('user_id');

            $table->foreign('player1_a_id')
                  ->references('id')->on('players')
                  ->onDelete('cascade');
            $table->foreign('player1_b_id')
                ->references('id')->on('players')
                ->onDelete('cascade');
            $table->foreign('player2_a_id')
                    ->references('id')->on('players')
                    ->onDelete('cascade');
            $table->foreign('player2_b_id')
                ->references('id')->on('players')
                ->onDelete('cascade');
            $table->foreign('organization1_id')
                    ->references('id')->on('organizations')
                    ->onDelete('cascade');
            $table->foreign('organization2_id')
                    ->references('id')->on('organizations')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
