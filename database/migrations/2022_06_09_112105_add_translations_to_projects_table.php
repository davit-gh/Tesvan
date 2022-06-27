<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTranslationsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('project_overview_am')->after('project_overview')->nullable();
            $table->text('project_overview_ru')->after('project_overview_am')->nullable();
            $table->text('project_challenge_am')->after('project_challenge')->nullable();
            $table->text('project_challenge_ru')->after('project_challenge_am')->nullable();
            $table->text('project_solution_am')->after('project_solution')->nullable();
            $table->text('project_solution_ru')->after('project_solution_am')->nullable();
        });
        Schema::table('project_objectives', function (Blueprint $table) {
            $table->text('objective_am')->after('objective')->nullable();
            $table->text('objective_ru')->after('objective_am')->nullable();
        });
        Schema::table('project_results', function (Blueprint $table) {
            $table->text('result_am')->after('result')->nullable();
            $table->text('result_ru')->after('result_am')->nullable();
        });
        Schema::table('client_feedbacks', function (Blueprint $table) {
            $table->text('client_feedback_am')->after('client_feedback')->nullable();
            $table->text('client_feedback_ru')->after('client_feedback_am')->nullable();
            $table->string('client_name_am')->after('client_name')->nullable();
            $table->string('client_name_ru')->after('client_name_am')->nullable();
            $table->string('client_position_am')->after('client_position')->nullable();
            $table->string('client_position_ru')->after('client_position_am')->nullable();
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
            $table->dropColumn('project_overview_am');
            $table->dropColumn('project_overview_ru');
            $table->dropColumn('project_challenge_am');
            $table->dropColumn('project_challenge_ru');
            $table->dropColumn('project_solution_am');
            $table->dropColumn('project_solution_ru');
        });
        Schema::table('project_objectives', function (Blueprint $table) {
            $table->dropColumn('objective_am');
            $table->dropColumn('objective_ru');
        });
        Schema::table('project_results', function (Blueprint $table) {
            $table->dropColumn('result_am');
            $table->dropColumn('result_ru');
        });
        Schema::table('client_feedbacks', function (Blueprint $table) {
            $table->dropColumn('client_feedback_am');
            $table->dropColumn('client_feedback_ru');
            $table->dropColumn('client_name_am');
            $table->dropColumn('client_name_ru');
            $table->dropColumn('client_position_am');
            $table->dropColumn('client_position_ru');
        });
    }
}
