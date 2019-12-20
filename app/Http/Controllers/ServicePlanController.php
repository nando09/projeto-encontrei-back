<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ServicePlan;

class ServicePlanController extends Controller
{
	public function index()
	{
		return ServicePlan::all();
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$data['preco'] = str_replace(".", "", $data['preco']);
		$data['preco'] = str_replace(",", ".", $data['preco']);

		$validator = Validator::make($data, [
			'nome'	=>	['required', 'string', 'max:255'],
			'preco'	=>	['required', 'numeric'],
			'quantidade'	=>	['required', 'numeric']
		],
		[
			'nome.required'	    	=>	"Campo plano de serviço é obrigatório!",
			'preco.required'	    =>	"Campo preço é obrigatório!",
			'preco.numeric'		    =>	"Campo preço dinheiro!",
			'quantidade.required'	=>	"Campo quantidade é obrigatório!",
			'quantidade.numeric'	=>	"Campo quantidade dinheiro!",
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		return ServicePlan::create($data);
	}

	public function show($id)
	{
		return ServicePlan::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$data['preco'] = str_replace(".", "", $data['preco']);
		$data['preco'] = str_replace(",", ".", $data['preco']);

		$validator = Validator::make($data, [
			'nome'	=>	['required', 'string', 'max:255'],
			'preco'	=>	['required', 'numeric'],
			'quantidade'	=>	['required', 'numeric']
		],
		[
			'nome.required'	    	=>	"Campo plano de serviço é obrigatório!",
			'preco.required'    	=>	"Campo preço é obrigatório!",
			'preco.numeric'		    =>	"Campo preço dinheiro!",
			'quantidade.required'	=>	"Campo quantidade é obrigatório!",
			'quantidade.numeric'	=>	"Campo quantidade dinheiro!",
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		$servicePlan = ServicePlan::findOrFail($id);
		$servicePlan->update($data);
		return $servicePlan;
	}

	public function destroy($id)
	{
		$servicePlan = ServicePlan::findOrFail($id);
		$servicePlan->delete();
		return $servicePlan;
	}
}
