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
		$validator = Validator::make($data, [
			'nome' => ['required', 'string', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'Plano de Serviço' obrigatório!"
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		return ServicePlan::create($request->all());
	}

	public function show($id)
	{
		return ServicePlan::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
		$validator = Validator::make($data, [
			'nome' => ['required', 'string', 'max:255'],
		],
		[
			'nome.required'	=>	'Campo Plano de Serviço obrigatório!'
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
