<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $fillable = [
		'nomefantasia',
		'email',
		'cep',
		'endereco',
		'bairro',
		'cidade',
		'estado',
		'telefone',
		'site',
		'whatsapp',
		'facebook',
		'instagram',
		'descricao',
	];
}



