<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultDescriptionsTable extends Migration {

	public function up()
	{
		Schema::create('result_descriptions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('key');
			$table->text('content');
		});
	}
}
