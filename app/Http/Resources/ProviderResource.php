<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
		    'id'                    =>  $this->user->id,
			'nome'					=>	$this->user->name,
			'email'					=>	$this->user->email,
			'type'					=>	$this->user->type,
			'nome_responsavel'		=>	$this->nome_responsavel,
			'razao_social'			=>	$this->razao_social,
			'nome_fantasia'			=>	$this->nome_fantasia,
			'cnpj'					=>	$this->cnpj,
			'telefone'				=>	$this->telefone,
			'whatsapp'				=>	$this->whatsapp,
			'facebook'				=>	$this->facebook,
			'instagram'				=>	$this->instagram,
			'site'					=>	$this->site,
			'descricao'				=>	$this->descricao,
			'cep'					=>	$this->cep,
			'endereco'				=>	$this->endereco,
			'numero'				=>	$this->numero,
			'complemento'			=>	$this->complemento,
			'bairro'				=>	$this->bairro,
			'cidade'				=>	$this->cidade,
			'estado'				=>	$this->estado,
			'photo'					=>	$this->photo,
			'uteis_ini'				=>	$this->uteis_ini,
			'uteis_fim'				=>	$this->uteis_fim,
			'sabado_ini'			=>	$this->sabado_ini,
			'sabado_fim'			=>	$this->sabado_fim,
			'domingo_ini'			=>	$this->domingo_ini,
			'domingo_fim'			=>	$this->domingo_fim,
			'feriados_ini'			=>	$this->feriados_ini,
			'feriados_fim'			=>	$this->feriados_fim,
		];
	}
}
