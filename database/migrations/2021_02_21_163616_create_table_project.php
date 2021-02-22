<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_logo');
            $table->text("project_overview");
            $table->text("project_challenge");
            $table->text("project_solution");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('project_objectives', function (Blueprint $table) {
            $table->id();
            $table->text('objective');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });

        Schema::create('project_results', function (Blueprint $table) {
            $table->id();
            $table->text('result');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });

        Schema::create('client_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->text('client_feedback');
            $table->string('client_photo');
            $table->string('client_name');
            $table->string('client_position');
            $table->string('client_website');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->timestamps();
        });

        Schema::create('technology_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_objectives');
        Schema::dropIfExists('project_results');
        Schema::dropIfExists('client_feedback');
        Schema::dropIfExists('technology_tools');
    }
}
