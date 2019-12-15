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
			$table->string('nome_responsavel');
			$table->string('razao_social');
			$table->string('nome_fantasia');
			$table->string('cnpj')->nullable();
			$table->string('telefone');
			$table->string('whatsapp')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('site')->nullable();
			$table->string('descricao');
			$table->string('cep')->nullable();
			$table->string('endereco')->nullable();
			$table->string('numero')->nullable();
			$table->string('complemento')->nullable();
			$table->string('bairro')->nullable();
			$table->string('cidade')->nullable();
			$table->string('estado')->nullable();

            $table->unsignedBigInteger('service_plan_id')->nullable();
            $table->foreign('service_plan_id')
                ->references('id')
                ->on('service_plans');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
