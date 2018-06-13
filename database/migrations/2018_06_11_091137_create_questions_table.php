<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->string('key');
			$table->integer('order');
			$table->string('label');
			$table->string('text');
			$table->integer('deeprate')->default(75);
			$table->string('result_term');
			$table->text('explanation');
		});
	}
}
