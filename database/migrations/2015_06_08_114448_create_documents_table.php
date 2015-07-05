<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('reference');
			$table->string('customer');
			$table->string('street_address')->nullable();
			$table->string('street_name')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('postcode')->nullable();
			$table->string('currency', 3);
			$table->integer('value');
			$table->string('path')->nullable();
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
		Schema::drop('documents');
	}

}
