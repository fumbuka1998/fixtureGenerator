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
            $table->string('fixture_id');
            $table->string('hometeam_id');
            $table->string('awayteam_id');
            $table->date('time');
            $table->string('commissor_id');
            $table->string('referee_id');
            $table->string('linesman1_id');
            $table->string('linesman2_id');
            $table->string('stadium_id');
            $table->timestamps();
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
