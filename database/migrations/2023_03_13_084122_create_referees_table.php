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
        Schema::create('referees', function (Blueprint $table) {
            
            $table->string('referee_id')->unsigned(); 
            $table->string('referee_name');
            $table->string('referee_pic');
            $table->enum('levels', array('FIFA', 'CUF', 'TFF'));
            $table->bigIncrements('role_id');
            $table->timestamps();

            $table->foreign('role_id')
                  ->references('role_id')
                  ->on('referee_roles')
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
        Schema::dropIfExists('referees');
    }
};
