<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeepAnswersTable extends Migration {

	public function up()
	{
		Schema::create('deep_answers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('answer_id')->unsigned();
			$table->integer('deep_question_id')->unsigned();
			$table->boolean('value');
			$table->timestamps();
		});
	}
}
