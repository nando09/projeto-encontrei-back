<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'nome',
		'descricao',
		'formato',
		'tipo_de_cobranca',
		'tipo_de_precificacao',
		'preco',
		'disponivel',
		'quantidade_max',
		'garantia',
		'email',
		'categoria',
		'confirmar_dados',
		'gratis',
	];
}
