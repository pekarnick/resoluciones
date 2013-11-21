<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResolucionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resolucions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('numero');
			$table->integer('tipo_id');
			$table->date('fecha');
			$table->string('resuelve');
			$table->text('observaciones');
			$table->text('archivo');
			$table->integer('user_id');
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
		Schema::drop('resolucions');
	}

}
