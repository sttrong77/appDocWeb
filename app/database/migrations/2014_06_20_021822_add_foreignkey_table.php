<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignkeyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('feedbacks', function(Blueprint $table)
		{
			$table->integer('usuario_id')->unsigned()->nullable();//obrigatoria
			$table->foreign('usuario_id')->references('id')->on('usuarios');
			
			$table->integer('tipo_id')->unsigned();
			$table->foreign('tipo_id')->references('id')->on('tipos')->on_delete('restrict');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('feedbacks', function(Blueprint $table)
		{
			$table->dropForeign('feedbacks_usuaruio_id_foreign');
			$table->dropColumn('usuario_id');
			
			$table->dropForeign('feedbacks_tipos_id_foreign');
			$table->dropColumn('tipo_id');
			
			
		});
	}

}
