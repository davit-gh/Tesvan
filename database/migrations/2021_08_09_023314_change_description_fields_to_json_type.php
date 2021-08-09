<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDescriptionFieldsToJsonType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->json('description')->nullable()->change();
            $table->json('description_am')->nullable()->change();
            $table->json('description_ru')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->mediumText('description')->nullable()->change();
            $table->mediumText('description_am')->nullable()->change();
            $table->mediumText('description_ru')->nullable()->change();
        });
    }
}
