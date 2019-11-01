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
			'nome' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'Nome' obrigatório!",
			'email.required'	=>	"Campo 'Email' obrigatório!",
			'email.email'	=>	"Email não é válido!",
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
			'nome' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'Nome' obrigatório!",
			'email.required'	=>	"Campo 'Email' obrigatório!",
			'email.email'	=>	"Email não é valido!",
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
