<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	public function up()
	{
		Schema::create('answers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('respondent_id')->unsigned();
			$table->integer('question_id')->unsigned();
			$table->integer('original_value')->unsigned();
			$table->integer('corrected_value');
			$table->timestamps();
		});
	}
}
