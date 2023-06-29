<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartPageController extends Controller
{
	public function MyCart()
	{
		if (Auth::check()) {
			return view('frontend.cartlist.view_mycart');
		}
	}
	public function GetCartProduct()
	{
		if (Auth::check()) {

			Cart::join('products', 'products.id', 'carts.product_id')
				->where('user_id', Auth::user()->id)
				->where('current_stock', '<=', 0)
				->select('carts.*', 'products.current_stock')
				->delete();

			$cartList = Cart::select('carts.*', 'products.current_stock')
				->join('products', 'products.id', 'carts.product_id')
				->where('user_id', Auth::user()->id)->get();
			// dd($cartList);
			foreach ($cartList as $item) {
				// dd($item);
				$cart_total = round($item->current_stock * $item->price);
				if ($item->qty > $item->current_stock) {
					Cart::findOrFail($item->id)->update([
						'qty' => $item->current_stock,
						'total' => $cart_total
					]);
				}
			}


			$carts = Cart::join('products', 'products.id', 'carts.product_id')
				->where('user_id', Auth::user()->id)
				->where('current_stock', '>', 0)
				->select('carts.*', 'products.current_stock', 'products.product_image')
				->get();

			$cartTotal = Cart::join('products', 'products.id', 'carts.product_id')
				->where('user_id', Auth::user()->id)
				->where('current_stock', '>', 0)
				->select('carts.*', 'products.current_stock')
				->sum('total');

			$cartQty = Cart::join('products', 'products.id', 'carts.product_id')
				->where('user_id', Auth::user()->id)
				->where('current_stock', '>', 0)
				->select('carts.*', 'products.current_stock')
				->count('carts.id');


			return response()->json(array(
				'carts' => $carts,
				'cartQty' => $cartQty,
				'cartTotal' => $cartTotal,

			));
		}
	} //end method 
	public function RemoveCartProduct($rowId)
	{
		$Cart = Cart::findOrFail($rowId);
		$Cart->delete();

		return response()->json(['success' => 'Successfully Remove From Cart']);
	}
	// Cart Increment 
	public function CartIncrement($id)
	{
		$row = Cart::find($id);
		$qtys = $row->qty + 1;
		$totalcart = $row->price * $qtys;
		// $total=
		Cart::findOrFail($id)->update([
			'qty' => $qtys,
			'total' => $totalcart
		]);


		return response()->json('increment');
	} // end mehtod 

	// Cart Decrement  
	public function CartDecrement($id)
	{

		$row = Cart::find($id);
		$qtys = $row->qty - 1;
		$totalcart = $row->price * $qtys;
		Cart::findOrFail($id)->update([
			'qty' => $qtys,
			'total' => $totalcart
		]);

		return response()->json('Decrement');
	} // end mehtod 
}
