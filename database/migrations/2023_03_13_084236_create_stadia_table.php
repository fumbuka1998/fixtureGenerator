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
        Schema::create('stadia', function (Blueprint $table) {
            $table->id();
            $table->string('stadium_id')->unsigned(); 
            $table->string('stadium_name'); 
            $table->string('stadium_location'); 
            $table->string('team_id')->unique();
            $table->timestamps();

            $table->foreign('team_id')
                 ->references('id')
                 ->on('teams')
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
        Schema::dropIfExists('stadia');
    }
};
