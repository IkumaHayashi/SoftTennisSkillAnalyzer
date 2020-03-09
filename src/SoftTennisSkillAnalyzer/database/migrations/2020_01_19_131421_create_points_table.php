<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('end_player_id');
            $table->unsignedBigInteger('point_kind_id');
            $table->boolean('is_winner');
            $table->timestamps();

            $table->index('game_id');

            $table->foreign('game_id')
                  ->references('id')->on('games')
                  ->onDelete('cascade');

            $table->foreign('end_player_id')
                  ->references('id')->on('players')
                  ->onDelete('cascade');

            $table->foreign('point_kind_id')
                  ->references('id')->on('point_kinds')
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
        Schema::dropIfExists('points');
    }
}
