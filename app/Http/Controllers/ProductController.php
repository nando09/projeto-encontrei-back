<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
	public function index()
	{
		return Product::all();
	}

	public function store(Request $request)
	{
		return Product::create($request->all());
	}

	public function show($id)
	{
		return Product::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
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
