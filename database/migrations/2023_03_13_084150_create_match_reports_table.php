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
        Schema::create('match_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_id')->unique();
            $table->string('fixture_id')->unique();
            $table->string('referee_id')->unique();
            $table->timestamps();

            // $table->foreign('id')
            //       ->references('id')
            //       ->on('fixtures')
            //       ->onDelete('cascade');

            // $table->foreign('referee_id')
            //       ->references('referee_id')
            //       ->on('referees')
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
        Schema::dropIfExists('match_reports');
    }
};
