<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoroscopeCalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horoscope_calenders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zodiac_id');
            $table->integer('month');
            $table->integer('year');
            $table->tinyInteger('is_sign_generated')->default('0');
            $table->float('average' , 3 , 2 )->default('0.00');
            $table->integer('total_score')->default('0');
            $table->timestamps();

            $table->unique(['zodiac_id', 'month', 'year'], 'unique_combination');

            $table->foreign('zodiac_id')->references('id')->on('zodiacs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horoscope_calenders');
    }
}
