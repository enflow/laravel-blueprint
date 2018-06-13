<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRespondentsTable extends Migration {

	public function up()
	{
		Schema::create('respondents', function(Blueprint $table) {
			$table->increments('id');
			$table->uuid('uuid');
			$table->boolean('finished')->default(false);
			$table->timestamps();
		});
	}
}
