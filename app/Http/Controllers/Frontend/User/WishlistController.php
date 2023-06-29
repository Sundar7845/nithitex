<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function ViewWishlist()
    {
        if (Auth::check()) {
            return view('frontend.wishlist.view_wishlist');
        } else {
            return view('auth.login');
        }
    }

    public function GetWishlistProduct()
    {
        if (Auth::check()) {

            $wishlist = Wishlist::with('product')
                ->join('products', 'products.id', 'wishlists.product_id')
                ->where('user_id', Auth::user()->id)
                ->where('products.current_stock', '>', 0)
                ->select('wishlists.id', 'products.product_name', 'products.product_image', 'wishlists.user_id', 'wishlists.product_id', 'products.seller_discount',  'products.product_discount')
                ->get();
            $wishlistQty = Wishlist::join('products', 'products.id', 'wishlists.product_id')
            ->where('user_id', Auth::user()->id)
            ->where('products.current_stock', '>', 0)
            ->count('wishlists.id');

            return response()->json(array(
                'wishlist' => $wishlist,
                'wishlistQty' => $wishlistQty,
                'userrole_id' => Auth::user()->userrole_id

            ));
        } else {
            return view('auth.login');
        }
    } // end mehtod 
    public function RemoveWishlistProduct($id)
    {

        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();
        return response()->json(['success' => 'Product successfully removed from wishlist']);
    }
}
