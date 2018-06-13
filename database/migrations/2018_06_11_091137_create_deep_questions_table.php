<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeepQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('deep_questions', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->string('key');
			$table->boolean('inverse');
			$table->text('text');
			$table->text('explanation')->nullable();
		});
	}
}
