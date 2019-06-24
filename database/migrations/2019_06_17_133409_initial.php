<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function(Blueprint $table){
            $table->increments('id');
            $table->string('name', 255);
            $table->string('shortname', 255);
            $table->integer('group')->default(1);
            $table->timestamps();
        });

        Schema::create('users_courses', function(Blueprint $table){
            $table->integer('user_id');
            $table->integer('course_id');
            $table->enum('role', ['student', 'professor'])->default('student');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('tests', function(Blueprint $table){
            $table->increments('id');
            $table->string('description', 255);
            $table->integer('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->integer('minutes');
            $table->datetime('start_at');
            $table->datetime('end_at');
            $table->timestamps();
        });

        Schema::create('categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name', 255);
            $table->timestamps();
        });

        Schema::create('questions', function(Blueprint $table){
            $table->increments('id');
            $table->text('description');
            $table->integer('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::create('answers', function(Blueprint $table){
            $table->increments('id');
            $table->text('description');
            $table->boolean('correct')->default(false);
            $table->integer('question_id');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->timestamps();
        });

        Schema::create('test_rules', function(Blueprint $table){
            $table->increments('id');
            $table->integer('test_id');
            $table->integer('category_id');
            $table->integer('num_questions');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::create('solutions', function(Blueprint $table){
            $table->increments('id');
            $table->decimal('total', 5, 2)->default(0);
            $table->boolean('ended')->default(false);
            $table->datetime('end_at');
            $table->integer('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('user_answers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('question_id');
            $table->integer('answer_id');
            $table->integer('user_id');
            $table->integer('solution_id');
            $table->boolean('marked')->default(false);
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('answer_id')->references('id')->on('answers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('solution_id')->references('id')->on('solutions');
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
        Schema::drop('user_answers');
        Schema::drop('solutions');
        Schema::drop('test_rules');
        Schema::drop('answers');
        Schema::drop('questions');
        Schema::drop('categories');
        Schema::drop('tests');
        Schema::drop('users_courses');
        Schema::drop('courses');
    }
}


