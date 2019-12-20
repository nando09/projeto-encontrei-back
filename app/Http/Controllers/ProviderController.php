<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Provider;
use App\User;
use App\Http\Resources\ProviderResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GeoController;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function userLog(){
		$id = Auth::user()->id;
		$user = $this->show($id);
		return $user;
    }

	public function index()
	{
	    $provider = DB::table('providers as p')
	        ->select('u.id as id','u.name as nome','u.email as email','u.type as type','p.nome_responsavel as nome_responsavel','p.razao_social as razao_social','p.nome_fantasia as nome_fantasia','p.cnpj as cnpj','p.telefone as telefone','p.whatsapp as whatsapp','p.facebook as facebook','p.instagram as instagram','p.site as site','p.descricao as descricao','p.cep as cep','p.endereco as endereco','p.numero as numero','p.complemento as complemento','p.bairro as bairro','p.cidade as cidade','p.estado as estado')
            ->join('users as u', 'u.id', '=', 'p.user_id')
            ->where([
                ['u.type', '=', 'web']
            ])->get();

// 		$provider = Provider::all();
		return $provider;
	}

	public function store(Request $request)
	{
		$data = $request->all();

		$validator = Validator::make($data, [
			'name'		        =>	['required', 'string', 'max:255'],
			'nome_fantasia'		=>  ['required', 'string', 'max:255'],
			'nome_responsavel'	=>  ['required', 'string', 'max:255'],
			'razao_social'		=>  ['required', 'string', 'max:255'],
			'email'				=>  ['required', 'email', 'max:255', 'unique:providers'],
			'telefone'			=>  ['required', 'string', 'max:255'],
			'descricao'			=>  ['required', 'string', 'max:255'],

			'cep'				=>  ['required', 'string', 'max:255'],
			'endereco'			=>  ['required', 'string', 'max:255'],
			'numero'			=>  ['required', 'string', 'max:255'],
			'bairro'			=>  ['required', 'string', 'max:255'],
			'cidade'			=>  ['required', 'string', 'max:255'],
			'estado'			=>  ['required', 'string', 'max:255'],
			'password' 			=>  ['required', 'string', 'min:6', 'confirmed'],
		],
		[
		    'name.required'             =>  "Campo nome é obrigatório!",
			'nome_fantasia.required'	=>	"Campo nome fantasia é obrigatório!",
			'nome_responsavel.required'	=>	"Campo nome responsável é obrigatório!",
			'razao_social.required'		=>	"Campo razão social é obrigatório!",
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
			'password.required'			=>	"Campo senha obrigatório!",
			'password.min'				=>	"Senha no minimo 6 !",
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

		$provider = Provider::create([
			'nome_responsavel'		=>	$data['nome_responsavel'],
			'razao_social'			=>	$data['razao_social'],
			'email'		            =>	$data['email'],
			'nome_fantasia'			=>	$data['nome_fantasia'],
			'cnpj'					=>	$data['cnpj'],
			'telefone'				=>	$data['telefone'],
			'whatsapp'				=>	$data['whatsapp'],
			'facebook'				=>	$data['facebook'],
			'instagram'				=>	$data['instagram'],
			'site'					=>	$data['site'],
			'descricao'				=>	$data['descricao'],
			'cep'					=>	$data['cep'],
			'endereco'				=>	$data['endereco'],
			'numero'				=>	$data['numero'],
			'complemento'			=>	$data['complemento'],
			'bairro'				=>	$data['bairro'],
			'cidade'				=>	$data['cidade'],
			'estado'				=>	$data['estado'],
			'user_id'				=>	$user->id,
		]);

		$user = $this->show($user->id);
		return $user;
	}

	public function show($id)
	{
		$provider = Provider::where([
			['user_id', '=', $id]
		])->get();

		$provi = ProviderResource::collection($provider);
		return $provi[0];
	}

	public function update(Request $request, $id)
	{
		$id = Auth::user()->id;
		$data = $request->all();

		$validator = Validator::make($data, [
			'nome_fantasia'		=> ['required', 'string', 'max:255'],
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
			'nome_fantasia.required'		=>	"Campo nome fantasia é obrigatório!",
			'nome_responsavel.required'	=>	"Campo nome responsável é obrigatório!",
			'razao_social.required'		=>	"Campo razão social é obrigatório!",
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

		$user = User::findOrFail($id);

        $user->update([
			'name'		=>	$data['nome'],
			'email'		=>	$data['email'],
        ]);

		$provider = Provider::where([
			['user_id', '=', $id]
		])->get();

		$provider[0]->update([
			'nome_responsavel'		=>	$data['nome_responsavel'],
			'razao_social'			=>	$data['razao_social'],
			'nome_fantasia'			=>	$data['nome_fantasia'],
			'email'			        =>	$data['email'],
			'cnpj'					=>	$data['cnpj'],
			'telefone'				=>	$data['telefone'],
			'whatsapp'				=>	$data['whatsapp'],
			'facebook'				=>	$data['facebook'],
			'instagram'				=>	$data['instagram'],
			'site'					=>	$data['site'],
			'descricao'				=>	$data['descricao'],
			'cep'					=>	$data['cep'],
			'endereco'				=>	$data['endereco'],
			'numero'				=>	$data['numero'],
			'complemento'			=>	$data['complemento'],
			'bairro'				=>	$data['bairro'],
			'cidade'				=>	$data['cidade'],
			'estado'				=>	$data['estado'],
		]);

		$user = auth()->user();
		$user->token = $user->createToken($user->email)->accessToken;
		$user->mais = $this->show($user->id);

		return $user;
	}

	public function destroy($id)
	{
		$provider = User::findOrFail($id);
		$provider->delete();
		return $provider;
	}
	
	public function geoLocal (Request $request){
	    $data = $request->all();
	   // return $data;
	    $geo = new GeoController('AIzaSyCnkTESIDLrPPu97QgdDRKS_MWaywLub5Y');
        $dados = $geo->geoLocal($data['endereco']);

        return [
            'status'    =>  $dados
        ];
	}
}
