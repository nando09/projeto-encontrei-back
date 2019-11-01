<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('nome');
			$table->float('preco', 10, 2);
			$table->string('descricao')->nullable();
			$table->string('formato')->nullable();
			$table->enum('tipo_de_cobranca', ['Única', 'Recorrente'])->nullable();
			$table->enum('tipo_de_precificacao', [1, 2])->nullable();
			$table->enum('disponivel', ['sim', 'não'])->nullable();
			$table->bigInteger('quantidade_max')->nullable();
			$table->bigInteger('garantia')->nullable();
			$table->string('email')->nullable();
			$table->string('categoria')->nullable();
			$table->enum('confirmar_dados', [1, 0])->nullable();
			$table->enum('gratis', [1, 0])->nullable();
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
		Schema::dropIfExists('products');
	}
}
