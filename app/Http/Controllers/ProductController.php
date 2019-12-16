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
		
		$data['preco'] = str_replace(".", "", $data['preco']);
		$data['preco'] = str_replace(",", ".", $data['preco']);

		if ($validator->fails()){
			return $validator->errors();
		}

		return Product::create($data);
	}

	public function show($id)
	{
		return Product::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
// 		return $data;
		$validator = Validator::make($data, [
			'nome' => ['required', 'string', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'Plano de Serviço' obrigatório!"
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		$data['preco'] = str_replace(".", "", $data['preco']);
		$data['preco'] = str_replace(",", ".", $data['preco']);

		$product = Product::findOrFail($id);
		$product->update($data);
		return $product;
	}

	public function destroy($id)
	{
		$product = Product::findOrFail($id);
		$product->delete();
		return $product;
	}
	
	public function productsProvider($id){
	   // return $id;
	    $products = Product::where([
	           ['provider_id', '=', $id]
	   ])->get();
	   
	   return $products;
	}
}
