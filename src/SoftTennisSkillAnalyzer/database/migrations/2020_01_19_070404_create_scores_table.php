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
            $table->unsignedBigInteger('player1_1_id');
            $table->unsignedBigInteger('player1_2_id');
            $table->unsignedBigInteger('player2_1_id');
            $table->unsignedBigInteger('player2_2_id');
            $table->text('note');
            $table->timestamps();
            
            $table->index('user_id');

            $table->foreign('player1_1_id')
                  ->references('id')->on('players')
                  ->onDelete('cascade');
            $table->foreign('player1_2_id')
                ->references('id')->on('players')
                ->onDelete('cascade');
            $table->foreign('player2_1_id')
                    ->references('id')->on('players')
                    ->onDelete('cascade');
            $table->foreign('player2_2_id')
                ->references('id')->on('players')
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
