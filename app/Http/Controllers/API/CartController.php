<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use App\Models\Cart;
use App\Traits\Utils;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ResponseAPI;
    use Utils;

    public function cart(Request $request, $id)
    {
        $product = Product::find($id);
        $exists = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();
        if (!$exists) {

            $quantity = $request->qty;
            $price = (Auth::user()->userrole_id == 1 ? $product->product_discount : $product->seller_discount);
            $cart_total = $price * $quantity;

            if ($product->current_stock < $quantity) {
                return response()->json(['error' => 'You cannot add more than current stock ' . $product->current_stock . '']);
            }
            Cart::create([
                'product_id' => $id,
                'user_id' => Auth::user()->id,
                'name' => $product->product_name,
                'qty' => $quantity,
                'price' => $price,
                'total' => $cart_total,
                'image' => $product->product_image
            ]);

            $message = "Product added to cart successfully";
            return response()->json(['status' => true, 'message' => $message], 200);
        } else {
            return response()->json(['status' => false, 'error' => 'This product already added in cart']);
        }
    }

    public function cartList()
    {
        $responseData = [];
        $responseData['cart'] = [];

        Cart::join('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->where('current_stock', '<=', 0)
            ->select('carts.*', 'products.current_stock')
            ->delete();

        $cartList = Cart::select('carts.*', 'products.current_stock')
            ->join('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)->get();

        foreach ($cartList as $item) {
            if ($item->qty > $item->current_stock) {
                Cart::findOrFail($item->id)->update([
                    'qty' => $item->current_stock,
                    'total' => $item->current_stock * $item->price
                ]);
            }
        }

        $carts = Cart::join('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->where('current_stock', '>', 0)
            ->select('carts.*', 'products.current_stock', 'products.product_image')
            ->get();

        $cart_total = Cart::join('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->where('current_stock', '>', 0)
            ->select('carts.*', 'products.current_stock')
            ->sum('total');

        $quantity = Cart::join('products', 'products.id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->where('current_stock', '>', 0)
            ->select('carts.*', 'products.current_stock')
            ->sum('qty');


        foreach ($carts as $item) {

            $product = Product::where('id', $item->product_id)->pluck('product_image')->first();
            $products = Product::find($item->product_id);
            $cartDetails['cart_id'] = $item->id;
            $cartDetails['user_id'] = $item->user_id;
            $cartDetails['product_id'] = $item->product_id;
            $cartDetails['name'] = $item->name;
            $cartDetails['qty'] = $item->qty;
            $cartDetails['product_price'] = $products->product_price;
            if ($this->getRoleId(Auth::user()->id) == 2) {
                $cartDetails['product_discount'] = $products->seller_discount;
            } else {
                $cartDetails['product_discount'] = $products->product_discount;
            }
            $cartDetails['available_quantity'] = $products->current_stock;
            $cartDetails['image'] = url($product);

            array_push($responseData['cart'], $cartDetails);
        }

        return response()->json(['data' => $responseData, 'quantity' => $quantity, 'total' => $cart_total], 200);
    }

    public function CartIncrement($id)
    {
        $row = Cart::find($id);
        $product_id = $row->product_id;
        $product = Product::find($product_id);

        $qtys = $row->qty + 1;
        if ($product->current_stock < $qtys) {
            return response()->json(['error' => 'You cannot add more than current stock ' . $product->current_stock . '']);
        }
        $cart_total = $row->price * $qtys;
        Cart::findOrFail($id)->update([
            'qty' => $qtys,
            'total' => $cart_total
        ]);

        $message = "Quantity Increased Successfully";
        return response()->json(['status' => true, 'message' => $message], 200);
    }

    public function CartDecrement($id)
    {
        $row = Cart::find($id);

        $qtys = $row->qty - 1;
        if ($qtys < 1) {
            return response()->json(['error' => 'You cannot remove more than ' . $row->qty . 'product']);
        }

        $cart_total = $row->price * $qtys;
        Cart::findOrFail($id)->update([
            'qty' => $qtys,
            'total' => $cart_total
        ]);
        $message = "Quantity Decreased Successfully";
        return response()->json(['status' => true, 'message' => $message], 200);
    }

    public function cartDelete($id)
    {
        $cartDelete = Cart::find($id);
        $cartDelete->delete();
        $message = "Cart Removed Successfully";
        return response()->json(['status' => true, 'message' => $message], 200);
    }
}
