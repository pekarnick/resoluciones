<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotResolucionTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resolucion_tag', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('resolucion_id')->unsigned()->index();
			$table->integer('tag_id')->unsigned()->index();
			$table->foreign('resolucion_id')->references('id')->on('resolucions')->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resolucion_tag');
	}

}
