<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerguntasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perguntas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('per_nome');
			$table->integer('categoria_id')->unsigned();
			$table->integer('nivel_id')->unsigned();
			$table->integer('resposta_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('categoria_id')->references('id')->on('categorias')->on_delete('restrict');
			$table->foreign('nivel_id')->references('id')->on('niveis')->on_delete('restrict');
			$table->foreign('resposta_id')->references('id')->on('respostas')->on_delete('restrict');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('perguntas', function(Blueprint $table)
		{
			//
		});
	}

}
