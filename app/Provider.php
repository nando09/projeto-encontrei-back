<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $fillable = [
		'nome',
		'email',
		'nome_responsavel',
		'razao_social',
		'nome_fantasia',
		'cnpj',
		'telefone',
		'whatsapp',
		'facebook',
		'instagram',
		'site',
		'descricao',
		'cep',
		'endereco',
		'numero',
		'complemento',
		'bairro',
		'cidade',
		'estado',
	];
}



