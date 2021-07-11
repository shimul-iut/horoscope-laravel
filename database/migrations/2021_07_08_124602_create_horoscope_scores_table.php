<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoroscopeScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horoscope_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('horoscope_calender_id');
            $table->integer('day');
            $table->integer('score');
            $table->string('mark');
            $table->string('prophecy');
            $table->timestamps();

            $table->foreign('horoscope_calender_id')->references('id')->on('horoscope_calenders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horoscope_scores');
    }
}
