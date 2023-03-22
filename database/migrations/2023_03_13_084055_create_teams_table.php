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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id')->unsigned();
            $table->string('team_name',50);
            $table->string('team_logo');
            $table->string('email',30);
            $table->unsignedBigInteger('stadium_id');   
            $table->timestamps();

            $table->foreign('stadium_id')
                  ->references('id')
                  ->on('stadia')
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
        Schema::dropIfExists('teams');
    }
};
