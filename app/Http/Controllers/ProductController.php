<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{
	public function index()
	{
		return Product::all();
	}

	public function store(Request $request)
	{
		$data = $request->all();
		$validator = Validator::make($data, [
			'nome' => ['required', 'string', 'max:255'],
			'preco' => ['required', 'string', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'Nome' obrigatório!",
			'preco.required'	=>	"Campo 'Preço' obrigatório!",
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		return Product::create($request->all());
	}

	public function show($id)
	{
		return Product::findOrFail($id);
	}

	public function update(Request $request, $id)
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

		$product = Product::findOrFail($id);
		$product->update($request->all());
		return $product;
	}

	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		$product->delete();
		return $product;
	}
}
