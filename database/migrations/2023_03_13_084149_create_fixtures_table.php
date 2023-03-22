<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->integer('fixture_id');
            $table->integer('hometeam_id');
            $table->integer('awayteam_id');
            $table->date('time');
            $table->integer('commissor_id');
            $table->integer('referee_id');
            $table->integer('linesman1_id');
            $table->integer('linesman2_id');
            $table->integer('stadium_id');
            $table->timestamps();

            // $table->foreign('hometeam_id')
            //       ->references('team_id')
            //       ->on('teams')
            //       ->onDelete('set null');

            // $table->foreign('away_team')
            //       ->references('team_id')
            //       ->on('teams')
            //       ->onDelete('set null');

            // $table->foreign('commissor_id')
            //       ->references('referee_id')
            //       ->on('referees')
            //       ->onDelete('cascade');

            // $table->foreign('referee_id')
            //       ->references('referee_id')
            //       ->on('referees')
            //       ->onDelete('cascade');

            // $table->foreign('linesman1_id')
            //       ->references('referee_id')
            //       ->on('referees')
            //       ->onDelete('cascade');

            // $table->foreign('linesman2_id')
            //       ->references('referee_id')
            //       ->on('referees')
            //       ->onDelete('cascade');

            // $table->foreign('stadium_id')
            //       ->references('id')
            //       ->on('stadia')
            //       ->onDelete('cascade');
                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fixtures');
    }
};
