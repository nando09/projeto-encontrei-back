<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Customer;
use MercadoPago\Payment;
use MercadoPago\Card;

class MercadoPagamento extends Controller
{
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
}
