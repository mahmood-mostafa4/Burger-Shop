<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(){
        return view('checkout');
    }


public function place_order(REQUEST $request){

if ($request->session()->has('cart')) {

    $name = $request->input('name');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $address = $request->input('address');
    $city = $request->input('city');

    $cost = $request->session()->get('total');

    $status = 'not_paid';

    $date = date('Y-m-d h:i:s');

    $cart = $request->session()->get('cart');

    if(Auth::check()){
        $user_id = Auth::id();
    }else{
        $user_id = 0;
    }

    $order_id = DB::table('orders')->InsertGetId([
        'user_id'=>$user_id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'cost' => $cost,
        'status' => $status,
        'date' => $date

    ] , 'id');


        foreach($cart as $id => $product){
            $product = $cart[$id];
            $product_id = $product['id'];
            $product_name = $product['name'];
            $product_price = $product['price'];
            $product_quantity = $product['quantity'];
            $product_image = $product['image'];

            DB::table('order_items')->insert([
                'order_id' => $order_id,
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity,
                'product_image' => $product_image,
                'order_date' => $date,

            ]);
        };

        $request->session()->put('order_id', $order_id);

        return view('payment');

} else {
    return redirect('checkout');
}
}


}
