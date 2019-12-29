<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
	protected $fillable = [
	    'id',
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
		'user_id',
		
        'photo',
        'uteis_ini',
        'uteis_fim',
        'sabado_ini',
        'sabado_fim',
        'domingo_ini',
        'domingo_fim',
        'feriados_ini',
        'feriados_fim',
	];

	public function User(){
		return $this->belongsTo(User::class);
	}

}
