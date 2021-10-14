<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTable extends Migration
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
            $table->string('name')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_am')->nullable();
            $table->string('position')->nullable();
            $table->string('position_ru')->nullable();
            $table->string('position_am')->nullable();
            $table->integer('place_number')->nullable();
            $table->string('photo')->nullable();
            $table->string('cv')->nullable();
            $table->string('background_color')->nullable();
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
        Schema::dropIfExists('team');
    }
}
