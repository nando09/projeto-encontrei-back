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
			$table->string('descricao');
			$table->string('formato');
			$table->enum('tipo_de_cobranca', ['Única', 'Recorrente']);
			$table->enum('tipo_de_precificacao', [1, 2]);
			$table->float('preco', 10, 2);
			$table->enum('disponivel', ['sim', 'não']);
			$table->bigInteger('quantidade_max');
			$table->bigInteger('garantia');
			$table->string('email');
			$table->string('categoria');
			$table->enum('confirmar_dados', [1, 0]);
			$table->enum('gratis', [1, 0]);
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
