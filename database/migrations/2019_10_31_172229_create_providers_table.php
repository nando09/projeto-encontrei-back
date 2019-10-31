<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nome');
			$table->string('email');
			$table->string('endereco')->nullable();
			$table->string('endereco2')->nullable();
			$table->string('cidade')->nullable();
			$table->string('estado')->nullable();
			$table->bigInteger('cep')->nullable();
			$table->enum('confirmar_dados', [1, 0]);
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
		Schema::dropIfExists('providers');
	}
}
