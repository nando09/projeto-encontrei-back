<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $fillable = [
		'nome',
		'email',
		'endereco',
		'endereco2',
		'cidade',
		'estado',
		'cep',
		'confirmar_dados',
	];
}



