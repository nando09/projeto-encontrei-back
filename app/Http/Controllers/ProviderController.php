<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provider;

class ProviderController extends Controller
{
	public function index()
	{
		return Provider::all();
	}

	public function store(Request $request)
	{
		return Provider::create($request->all());
	}

	public function show($id)
	{
		return Provider::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
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
