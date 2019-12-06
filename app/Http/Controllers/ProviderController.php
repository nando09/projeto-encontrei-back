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
			'nomefantasia'	=> ['required', 'string', 'max:255'],
			'email'			=> ['required', 'email', 'max:255', ''],
			'telefone'		=> ['required', 'string', 'max:255'],
			'site'			=> ['required', 'string', 'max:255'],
			'descricao'		=> ['required', 'string', 'max:255'],
		],
		[
			'nomefantasia.required'	=>	"Campo nome é obrigatório!",
			'email.required'		=>	"Campo email obrigatório!",
			'email.email'			=>	"E-mail não esta certo obrigatório!",
			'telefone.required'		=>	"Campo telefone obrigatório!",
			'site.required'			=>	"Campo site obrigatório!",
			'descricao.required'	=>	"Campo descriçção obrigatório!"
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
			'nomefantasia'	=> ['required', 'string', 'max:255'],
			'email'			=> ['required', 'email', 'max:255'],
			'telefone'		=> ['required', 'string', 'max:255'],
			'site'			=> ['required', 'string', 'max:255'],
			'descricao'		=> ['required', 'string', 'max:255'],
		],
		[
			'nomefantasia.required'	=>	"Campo nome é obrigatório!",
			'email.required'		=>	"Campo email obrigatório!",
			'email.email'			=>	"E-mail não esta certo obrigatório!",
			'telefone.required'		=>	"Campo telefone obrigatório!",
			'site.required'			=>	"Campo site obrigatório!",
			'descricao.required'	=>	"Campo descriçção obrigatório!"
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
