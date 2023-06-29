<?php

namespace App\Http\Controllers\SELLER;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\State;
use App\Traits\Utils;
use Illuminate\Support\Facades\Auth;

class BuynowController extends Controller
{
  use Utils;
  public function ProductBuyNow($id)
  {
    $out_of_stock = $this->validateOutOfStock(0, Auth::user()->id, $id, 1);
    // dd($out_of_stock);
    if ($out_of_stock) {
      $notification = array(
        'message' => 'Order not placed!. Out of stock. So please try again.',
        'alert-type' => 'error'
      );
      return Redirect()->route('seller.product.shop')->with($notification);
    }
    $state = State::orderby('state_name', 'ASC')->get();

    if (Auth::check()) {
      if (Auth::user()->state_name) {
        $state_name = User::where('state_name', Auth::user()->state_name)->pluck('state_name')->first();
        $s_name = State::where('state_name', $state_name)->first();
        $shipping_charge = State::where('shipping_charge', $s_name->shipping_charge)->pluck('shipping_charge')->first();
        $cod_charge = State::where('cod_charge', $s_name->cod_charge)->pluck('cod_charge')->first();
      } else {
        $shipping_charge = 0;
        $cod_charge = 0;
      }

      if (Auth::check()) {

        $product = Product::with('category')->findOrFail($id);
        $cart_true = 0;
        $quantity = 1;
        $buynow_price = $quantity * $product->seller_discount;
        $product_id = $product->id;
        return view('seller.checkout.checkout_view', compact('product', 'cart_true', 'quantity', 'buynow_price', 'product_id', 'state', 'shipping_charge', 'cod_charge'));
      } else {

        $notification = array(
          'message' => 'You Need to Login First',
          'alert-type' => 'error'
        );

        return redirect()->route('seller.login')->with($notification);
      }
    }
  }

  public function ProductDetailsBuyNow(Request $request, $id)
  {
    $out_of_stock = $this->validateOutOfStock(0, Auth::user()->id, $id, $request->hdbuyqty);
    // dd($out_of_stock);
    if ($out_of_stock) {
      $notification = array(
        'message' => 'Order not placed!. Out of stock. So please try again.',
        'alert-type' => 'error'
      );
      return Redirect()->route('seller.product.shop')->with($notification);
    }
    $state = State::orderby('state_name', 'ASC')->get();

    if (Auth::check()) {
      if (Auth::user()->state_name) {
        $state_name = User::where('state_name', Auth::user()->state_name)->pluck('state_name')->first();
        $s_name = State::where('state_name', $state_name)->first();
        $shipping_charge = State::where('shipping_charge', $s_name->shipping_charge)->pluck('shipping_charge')->first();
        $cod_charge = State::where('cod_charge', $s_name->cod_charge)->pluck('cod_charge')->first();
      } else {
        $shipping_charge = 0;
        $cod_charge = 0;
      }

      if (Auth::check()) {

        $product = Product::with('category')->findOrFail($id);
        $cart_true = 0;
        $quantity = $request->hdbuyqty;
        $buynow_price = $quantity * $product->seller_discount;
        $product_id = $product->id;
        return view('seller.checkout.checkout_view', compact('product', 'cart_true', 'quantity', 'buynow_price', 'product_id', 'state', 'shipping_charge', 'cod_charge'));
      } else {

        $notification = array(
          'message' => 'You Need to Login First',
          'alert-type' => 'error'
        );

        return redirect()->route('seller.login')->with($notification);
      }
    }
  }
}
