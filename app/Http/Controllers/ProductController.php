<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Image;
use App\Http\Resources\ProdutoResource;

class ProductController extends Controller
{
	public function index()
	{
		$produto = Product::all();
		return ProdutoResource::collection($produto);
	}

	public function store(Request $request)
	{
		$data = $request->all();

		$validator = Validator::make($data, [
			'nome' => ['required', 'string', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'Nome' obrigatÃ³rio!",
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

        if(!isset($data['provider_id'])) {
			$data['provider_id'] = auth()->user()->id;
        }

		$produto = Product::create($data);

		$image = $request->file('image');
		if ($image) {
            foreach ($image as $key) {
    			$nome = $key->store('products', 'public');
    			Image::create([
    			    'image'         =>  $nome,
    			    'product_id'    =>  $produto->id,
    			]);
            }
		}else{
			Image::create([
			    'product_id'    =>  $produto->id,
			]);
		}

        return $this->show($produto->id);
	}

	public function show($id)
	{
		$produto = Product::findOrFail($id);
		$produto->images;
		return $produto;
	}

	public function update(Request $request, $id)
	{
		$data = $request->all();
// 		return $data;
		$validator = Validator::make($data, [
			'nome' => ['required', 'string', 'max:255'],
		],
		[
			'nome.required'	=>	"Campo 'nome' ¨¦ obrigatorio!!"
		]);

		if ($validator->fails()){
			return $validator->errors();
		}

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

	   return ProdutoResource::collection($products);
	   return $products;
	}
	
	public function excelProducts(Request $request){
		$image = $request->file('file');

        foreach ($image as $key) {
            // return $key;
    		$arquivo = new \DomDocument();
    // 		$nome = $key->store('excelProduct', 'public');
    		$arquivo->load($key);
    		return $arquivo;
    		
    		$linhas = $arquivo->getElementsByTagName("Row");
    		//var_dump($linhas);
    		
    		$primeira_linha = true;
    		
    		foreach($linhas as $linha){
    			if($primeira_linha == false){
    				$nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
    				echo "Nome: $nome <br>";
    				
    				$email = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
    				echo "E-mail: $email <br>";
    				
    				$niveis_acesso_id = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
    				echo "Nivel de Acesso: $niveis_acesso_id <br>";
    				
    				echo "<hr>";
    				
    				//Inserir o usu¨¢rio no BD
    				$result_usuario = "INSERT INTO usuarios (nome, email, niveis_acesso_id) VALUES ('$nome', '$email', '$niveis_acesso_id')";
    				$resultado_usuario = mysqli_query($conn, $result_usuario);
    			}
    			$primeira_linha = false;
    		}

        }

		if ($image) {
			$nome = $key->store('products', 'public');
			Image::create([
			    'image'         =>  $nome,
			    'product_id'    =>  $produto->id,
			]);
		}else{
			Image::create([
			    'product_id'    =>  $produto->id,
			]);
		}

	    return [
	        'status'    =>   'Teste'
	    ];
	}
}
