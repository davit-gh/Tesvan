<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('education_category_id');
            $table->string('title');
            $table->string('title_am')->nullable();
            $table->string('title_ru')->nullable();
            $table->mediumText('description');
            $table->mediumText('description_am')->nullable();
            $table->mediumText('description_ru')->nullable();
            $table->string('image');
            $table->string('status');
            $table->dateTime('published_date');
            $table->unsignedInteger('user_id');
            $table->bigInteger('views');
            $table->string('created_by');
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
        Schema::dropIfExists('educations');
    }
}
