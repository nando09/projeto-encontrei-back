<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Customer;
use MercadoPago\Payment;
use MercadoPago\Card;

class MercadoPagamento extends Controller
{
	private $url = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions?email=encontreiapp@encontrei.online&token=329F4D51585A47F19B641919EDBCD7C9";
	private $email;
	private $url_pagSeguro;
	private $token;
	private $url_notificacao;

	// public function ver(){
	public function ver(Request $request){
		$id = auth()->user()->id;

		$data = $request->all();
		// return $data;
		SDK::setAccessToken("TEST-549350363018034-122415-210d43ea3d012567456c0c78cbedc7fc-185694645");

		$payment = new Payment();

		$payment->transaction_amount = $data['transaction_amount'];
		$payment->token = $data['token'];
		$payment->description = "Ergonomic Silk Shirt";
		$payment->installments = $data['installments'];
		$payment->payment_method_id = $data['payment_method_id'];
		$payment->payer = array(
		  "email" => $data['email']
		);

		$payment->save();

		// if ($payment->status == 'approved') {
		// 	$this->salvarCard($data['email'], $data['token']);
		// }

		return [
			'status'	=>	$payment->status,
			'detail'	=>	$payment->status_detail,
			'user_id'	=>	$id
		];
	}

	private function salvarCard($email, $token){
		SDK::setAccessToken("TEST-549350363018034-122415-210d43ea3d012567456c0c78cbedc7fc-185694645");

		$customer = new Customer();
		$customer->email = $email;
		$customer->save();

		$card = new Card();
		$card->token = $token;
		$card->customer_id = $customer->id();
		$card->save();
	}

	private function confPagSeguro(){
		$sandbox = true;
		if ($sandbox) {
			// https://ws.sandbox.pagseguro.uol.com.br/?email=email&token=token
			$this->url_pagSeguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/";
			$this->email = 'encontreiapp@encontrei.online';
			$this->token = '329F4D51585A47F19B641919EDBCD7C9';
			$this->url_notificacao = 'https://encontrei.online/';
		}else{
			// https://ws.pagseguro.uol.com.br/?email=email&token=token
			$this->url_pagSeguro = "https://ws.pagseguro.uol.com.br/v2/";
			$this->email = 'encontreiapp@encontrei.online';
			$this->token = '';
		}
	}
	
	public function teste(Request $request){
	    $this->confPagSeguro();
	    $Dados = $request->all();

        $DadosArray["email"] = $this->email;
        $DadosArray["token"] = $this->token;

        $DadosArray['paymentMode'] = 'default';
        $DadosArray['paymentMethod'] = $Dados['paymentMethod'];
        //$DadosArray['receiverEmail'] = $Dados['receiverEmail'];
        $DadosArray['receiverEmail'] = $this->email;
        $DadosArray['currency'] = $Dados['currency'];
        $DadosArray['extraAmount'] = $Dados['extraAmount'];
        $DadosArray['itemId1'] = $Dados['itemId1'];
        $DadosArray['itemDescription1'] = $Dados['itemDescription1'];
        $DadosArray['itemAmount1'] = $Dados['itemAmount1'];
        $DadosArray['itemQuantity1'] = $Dados['itemQuantity1'];
        $DadosArray['notificationURL'] = $this->url_notificacao;
        $DadosArray['reference'] = $Dados['reference'];
        $DadosArray['senderName'] = $Dados['creditCardHolderName'];
        $DadosArray['senderCPF'] = $Dados['creditCardHolderCPF'];
        $DadosArray['senderAreaCode'] = $Dados['senderAreaCode'];
        $DadosArray['senderPhone'] = $Dados['senderPhone'];
        $DadosArray['senderEmail'] = $Dados['senderEmail'];
        $DadosArray['senderHash'] = $Dados['hashCartao'];
        $DadosArray['shippingAddressRequired'] = $Dados['shippingAddressRequired'];
        // $DadosArray['shippingAddressStreet'] = $Dados['shippingAddressStreet'];
        // $DadosArray['shippingAddressNumber'] = $Dados['shippingAddressNumber'];
        // $DadosArray['shippingAddressComplement'] = $Dados['shippingAddressComplement'];
        // $DadosArray['shippingAddressDistrict'] = $Dados['shippingAddressDistrict'];
        // $DadosArray['shippingAddressPostalCode'] = $Dados['shippingAddressPostalCode'];
        // $DadosArray['shippingAddressCity'] = $Dados['shippingAddressCity'];
        // $DadosArray['shippingAddressState'] = $Dados['shippingAddressState'];
        // $DadosArray['shippingAddressCountry'] = $Dados['shippingAddressCountry'];
        // $DadosArray['shippingType'] = $Dados['shippingType'];
        // $DadosArray['shippingCost'] = $Dados['shippingCost'];
        $DadosArray['creditCardToken'] = $Dados['tokenCartao'];
        $DadosArray['installmentQuantity'] = $Dados['qntParcelas'];
        $Dados['valorParcelas'] = number_format($Dados['valorParcelas'], 2, '.', '');
        $DadosArray['installmentValue'] = $Dados['valorParcelas'];
        $DadosArray['noInterestInstallmentQuantity'] = $Dados['noIntInstalQuantity'];
        $DadosArray['creditCardHolderName'] = $Dados['creditCardHolderName'];
        $DadosArray['creditCardHolderCPF'] = $Dados['creditCardHolderCPF'];
        // $DadosArray['creditCardHolderBirthDate'] = $Dados['creditCardHolderBirthDate'];
        // $DadosArray['creditCardHolderAreaCode'] = $Dados['senderAreaCode'];
        // $DadosArray['creditCardHolderPhone'] = $Dados['senderPhone'];

        $DadosArray['billingAddressStreet'] = $Dados['billingAddressStreet'];
        $DadosArray['billingAddressNumber'] = $Dados['billingAddressNumber'];
        $DadosArray['billingAddressComplement'] = $Dados['billingAddressComplement'];
        $DadosArray['billingAddressDistrict'] = $Dados['billingAddressDistrict'];
        $DadosArray['billingAddressPostalCode'] = $Dados['billingAddressPostalCode'];
        $DadosArray['billingAddressCity'] = $Dados['billingAddressCity'];
        $DadosArray['billingAddressState'] = $Dados['billingAddressState'];
        $DadosArray['billingAddressCountry'] = $Dados['billingAddressCountry'];

        $buildQuery = http_build_query($DadosArray);
        $url = $this->url_pagSeguro . "transactions";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
        $retorno = curl_exec($curl);
        curl_close($curl);
        $xml = simplexml_load_string($retorno);

        $retorna = ['erro' => true, 'dados' => $xml];
        header('Content-Type: application/json');

	    return $retorna;
	}

	public function urlPagSeguro(){
		$curl = curl_init($this->url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$retorno = curl_exec($curl);
		curl_close($curl);

		$xml = simplexml_load_string($retorno);
		$session = json_encode($xml);
		return $session;
	}
}
