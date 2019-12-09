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
            $table->engine = 'InnoDB';
			$table->bigIncrements('id');
			$table->string('nome')->nullable();
			$table->string('email')->unique();
			$table->string('nome_responsavel')->nullable();
			$table->string('razao_social')->nullable();
			$table->string('nome_fantasia')->nullable();
			$table->string('cnpj')->nullable();
			$table->string('telefone')->nullable();
			$table->string('whatsapp')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('site')->nullable();
			$table->string('descricao')->nullable();
			$table->string('cep')->nullable();
			$table->string('endereco')->nullable();
			$table->string('numero')->nullable();
			$table->string('complemento')->nullable();
			$table->string('bairro')->nullable();
			$table->string('cidade')->nullable();
			$table->string('estado')->nullable();
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
