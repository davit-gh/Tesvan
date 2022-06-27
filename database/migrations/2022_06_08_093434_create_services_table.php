<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('meta_title');
            $table->string('meta_title_am')->nullable();
            $table->string('meta_title_ru')->nullable();
            $table->string('link');
            $table->mediumText('meta_description');
            $table->mediumText('meta_description_am')->nullable();
            $table->mediumText('meta_description_ru')->nullable();
            $table->unsignedInteger('service_category_id');
            $table->string('title');
            $table->string('title_am')->nullable();
            $table->string('title_ru')->nullable();
            $table->mediumText('description');
            $table->mediumText('description_am')->nullable();
            $table->mediumText('description_ru')->nullable();
            $table->string('logo');
            $table->mediumText('benefit');
            $table->mediumText('benefit_am')->nullable();
            $table->mediumText('benefit_ru')->nullable();
            $table->mediumText('approach');
            $table->mediumText('approach_am')->nullable();
            $table->mediumText('approach_ru')->nullable();
            $table->text('service_faq_desc');
            $table->string('status');
            $table->dateTime('published_date');
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('views');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('service_faqs', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->text('answer');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('services');
        Schema::dropIfExists('service_faqs');
    }
}
