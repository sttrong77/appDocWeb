<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feedbacks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo',70);
			$table->integer('tipo_id')->unsigned();
			$table->text('descricao');
			$table->foreign('tipo_id')->references('id')->on('tipos')->on_delete('restrict');
			
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
		Schema::drop('feedbacks', function(Blueprint $table)
		{
			//
		});
	}

}
