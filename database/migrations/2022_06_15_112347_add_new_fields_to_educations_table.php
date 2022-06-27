<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->string('url_slug')->after('title_ru')->nullable();
            $table->string('image_alt_description')->after('image')->nullable();
            $table->text('meta_title')->after('url_slug')->nullable();
            $table->text('meta_title_am')->after('meta_title')->nullable();
            $table->text('meta_title_ru')->after('meta_title_am')->nullable();
            $table->text('meta_description')->after('meta_title_ru')->nullable();
            $table->text('meta_description_am')->after('meta_description')->nullable();
            $table->text('meta_description_ru')->after('meta_description_am')->nullable();
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
            $table->dropColumn('url_slug');
            $table->dropColumn('image_alt_description');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_title_am');
            $table->dropColumn('meta_title_ru');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_description_am');
            $table->dropColumn('meta_description_ru');
        });
    }
}
