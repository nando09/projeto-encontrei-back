<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Provider;

class ProviderController extends Controller
{
	public function index()
	{
		return Provider::all();
	}

	public function store(Request $request)
	{
		$data = $request->all();

		$validator = Validator::make($data, [
			'nomefantasia'		=> ['required', 'string', 'max:255'],
			'nome_responsavel'	=> ['required', 'string', 'max:255'],
			'razao_social'		=> ['required', 'string', 'max:255'],
			'email'				=> ['required', 'email', 'max:255', 'unique:providers'],
			'telefone'			=> ['required', 'string', 'max:255'],
			'descricao'			=> ['required', 'string', 'max:255'],

			'cep'				=> ['required', 'string', 'max:255'],
			'endereco'			=> ['required', 'string', 'max:255'],
			'numero'			=> ['required', 'string', 'max:255'],
			'bairro'			=> ['required', 'string', 'max:255'],
			'cidade'			=> ['required', 'string', 'max:255'],
			'estado'			=> ['required', 'string', 'max:255'],
		],
		[
			'nomefantasia.required'		=>	"Campo nome é obrigatório!",
			'nome_responsavel.required'	=>	"Campo nome responsável é obrigatório!",
			'razao_social.required'		=>	"Campo nome responsável é obrigatório!",
			'email.required'			=>	"Campo email obrigatório!",
			'email.email'				=>	"E-mail não esta certo obrigatório!",
			'telefone.required'			=>	"Campo telefone obrigatório!",
			'descricao.required'		=>	"Campo descrição obrigatório!",
			'cep.required'				=>	"Campo cep obrigatório!",
			'endereco.required'			=>	"Campo endereco obrigatório!",
			'numero.required'			=>	"Campo numero obrigatório!",
			'bairro.required'			=>	"Campo bairro obrigatório!",
			'cidade.required'			=>	"Campo cidade obrigatório!",
			'estado.required'			=>	"Campo estado obrigatório!",
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		return Provider::create($request->all());
	}

	public function show($id)
	{
		return Provider::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$validator = Validator::make($data, [
			'nomefantasia'		=> ['required', 'string', 'max:255'],
			'nome_responsavel'	=> ['required', 'string', 'max:255'],
			'razao_social'		=> ['required', 'string', 'max:255'],
			'telefone'			=> ['required', 'string', 'max:255'],
			'descricao'			=> ['required', 'string', 'max:255'],

			'cep'				=> ['required', 'string', 'max:255'],
			'endereco'			=> ['required', 'string', 'max:255'],
			'numero'			=> ['required', 'string', 'max:255'],
			'bairro'			=> ['required', 'string', 'max:255'],
			'cidade'			=> ['required', 'string', 'max:255'],
			'estado'			=> ['required', 'string', 'max:255'],
		],
		[
			'nomefantasia.required'		=>	"Campo nome é obrigatório!",
			'nome_responsavel.required'	=>	"Campo nome responsável é obrigatório!",
			'razao_social.required'		=>	"Campo nome responsável é obrigatório!",
			'telefone.required'			=>	"Campo telefone obrigatório!",
			'descricao.required'		=>	"Campo descrição obrigatório!",
			'cep.required'				=>	"Campo cep obrigatório!",
			'endereco.required'			=>	"Campo endereco obrigatório!",
			'numero.required'			=>	"Campo numero obrigatório!",
			'bairro.required'			=>	"Campo bairro obrigatório!",
			'cidade.required'			=>	"Campo cidade obrigatório!",
			'estado.required'			=>	"Campo estado obrigatório!",
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		$provider = Provider::findOrFail($id);
		$provider->update($request->all());
		return $provider;
	}

	public function destroy($id)
	{
		$provider = Provider::findOrFail($id);
		$provider->delete();
		return $provider;
	}
}
