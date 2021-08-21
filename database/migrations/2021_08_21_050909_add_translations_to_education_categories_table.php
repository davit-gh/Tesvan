<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranslationsToEducationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('education_categories', function (Blueprint $table) {
            $table->string('name_am')->after('name')->nullable();
            $table->string('name_ru')->after('name_am')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('education_categories', function (Blueprint $table) {
            $table->dropColumn('name_am');
            $table->dropColumn('name_ru');
        });
    }
}
