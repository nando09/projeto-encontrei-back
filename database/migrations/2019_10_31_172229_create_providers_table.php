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
            $table->string('email')->unique()->nullable();
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

			$table->string('photo')->default('products/produto-sem-imagem.png');
            $table->time('uteis_ini')->nullable();
            $table->time('uteis_fim')->nullable();
            $table->time('sabado_ini')->nullable();
            $table->time('sabado_fim')->nullable();
            $table->time('domingo_ini')->nullable();
            $table->time('domingo_fim')->nullable();
            $table->time('feriados_ini')->nullable();
            $table->time('feriados_fim')->nullable();

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
