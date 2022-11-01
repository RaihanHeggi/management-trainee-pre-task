<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('absents_note', ['WFO','WFH','Sick','On Leave']);
            $table->time('clock_in');
            $table->time('clock_out');
            $table->enum('is_telat', ['0','1'])->nullable();
            $table->enum('is_overwork', ['0','1'])->nullable();
            $table->enum('is_ontime', ['0','1'])->nullable();
            $table->datetime('absents_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absents');
    }
}
