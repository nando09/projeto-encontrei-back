<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Http\Controllers\ProviderController;
use App\Provider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
	public function login(Request $request){
		$data  = $request->all();

		$validator = Validator::make($data, [
			'email' => ['required', 'string', 'email', 'max:255'],
			'password' => ['required', 'string'],
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		if (Auth::attempt(["email"=>$data['email'], "password"=>$data['password'], "type" => 'admin'])){
			$user = auth()->user();
			$user->token = $user->createToken($user->email)->accessToken;
			return $user;
		}
		return ["status" => false];
	}

	public function loginWeb(Request $request){
		$data  = $request->all();

		$validator = Validator::make($data, [
			'email' => ['required', 'string', 'email', 'max:255'],
			'password' => ['required', 'string'],
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		if (Auth::attempt(["email"=>$data['email'], "password" =>$data['password'], "type" => 'web'])){
			$provider = new ProviderController();
			$user = auth()->user();
			$user->token = $user->createToken($user->email)->accessToken;
			$user->mais = $provider->show($user->id);

			return $user;
		}else if (Auth::attempt(["email"=>$data['email'], "password"=>$data['password'], "type" => 'admin'])){
			$user = auth()->user();
			$user->token = $user->createToken($user->email)->accessToken;
			return $user;
		}

		return ["status" => false];
	}

	public function loginApp(Request $request){
		$data  = $request->all();

		$validator = Validator::make($data, [
			'email' => ['required', 'string', 'email', 'max:255'],
			'password' => ['required', 'string'],
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		if (Auth::attempt(["email"=>$data['email'], "password"=>$data['password'], "type" => 'app'])){
			$user = auth()->user();
			$user->token = $user->createToken($user->email)->accessToken;
			return $user;
		}
		return ["status" => false];
	}

	public function register(Request $request){
		$data = $request->all();

		$validator = Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		$user =  User::create([
			'name'		=>	$data['name'],
			'email'		=>	$data['email'],
			'password'	=>	Hash::make($data['password']),
			'type'		=>	'admin',
		]);

		$user->token = $user->createToken($user->email)->accessToken;
		return $user;
	}

	public function registerWeb(Request $request){
		$data = $request->all();

		$validator = Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		$user =  User::create([
			'name'		=>	$data['name'],
			'email'		=>	$data['email'],
			'password'	=>	Hash::make($data['password']),
			'type'		=>	'web',
		]);

		if ($user) {
			Provider::create([
			    'id'            =>  $user->id,
				'user_id'		=>	$user->id,
			]);
		}

		$user->token = $user->createToken($user->email)->accessToken;
		return $user;
	}

	public function registerApp(Request $request){
		$data = $request->all();

		$validator = Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

		$user =  User::create([

			'name'		=>	$data['name'],
			'email'		=>	$data['email'],
			'password'	=>	Hash::make($data['password']),
			'type'		=>	'app',
		]);

		$user->token = $user->createToken($user->email)->accessToken;
		return $user;
	}

	public function users($id){
		$user = User::findOrFail($id);
		return $user;
	}

	public function authent(){
	    $id = auth()->user()->id;
		$user = User::findOrFail($id);
		return $user->type;
	}

	public function index(){
	    return User::all();
	}
}
