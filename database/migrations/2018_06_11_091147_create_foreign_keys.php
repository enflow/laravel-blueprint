<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('questions', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
        Schema::table('deep_questions', function(Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('respondent_id')->references('id')->on('respondents')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('questions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('deep_answers', function(Blueprint $table) {
			$table->foreign('answer_id')->references('id')->on('answers')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('deep_answers', function(Blueprint $table) {
			$table->foreign('deep_question_id')->references('id')->on('deep_questions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}
}
