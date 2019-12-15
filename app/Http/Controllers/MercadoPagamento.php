<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Payment;

class MercadoPagamento extends Controller
{
	public function ver(){
		SDK::setAccessToken("TEST-549350363018034-120914-b532aabf36877b9d6d38a4b137047a33-185694645");

		$payment = new Payment();

		$payment->transaction_amount = 141;
		$payment->token = "72104f00cf91348bb793456f7b743071";
		$payment->description = "Ergonomic Silk Shirt";
		$payment->installments = 1;
		$payment->payment_method_id = "visa";
		$payment->payer = array(
		  "email" => "larue.nienow@hotmail.com"
		);

		$payment->save();

		return [
			'status'	=>	$payment->status
		];
	}
}
