<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('url_slug')->after('project_name')->nullable();
            $table->string('project_logo_alt_description')->after('project_logo')->nullable();
            $table->text('meta_title')->after('url_slug')->nullable();
            $table->text('meta_description')->after('meta_title')->nullable();
            $table->text('meta_description_am')->after('meta_description')->nullable();
            $table->text('meta_description_ru')->after('meta_description_am')->nullable();
        });



        Schema::table('client_feedbacks', function (Blueprint $table) {
            $table->string('client_photo_alt_description')->after('client_photo')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('url_slug');
            $table->dropColumn('project_logo_alt_description');
            $table->dropColumn('meta_title');
            $table->dropColumn('meta_description');
            $table->dropColumn('meta_description_am');
            $table->dropColumn('meta_description_ru');
        });

        Schema::table('client_feedbacks', function (Blueprint $table) {
            $table->dropColumn('client_photo_alt_description');
        });

    }
}
