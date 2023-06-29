<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;
use App\Traits\Utils;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use ResponseAPI;
    use Utils;
    public function addToWishlist(Request $request)
    {
        $wishlist = Wishlist::where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->pluck('id')->first();

        if ($wishlist) {
            Wishlist::where('id', $wishlist)->where('product_id', $request->product_id)->delete();
            $responseData['status'] = true;
            $responseData['message'] = "Removed From Wishlist Successfully";
            return response()->json($responseData);
        } else {
            $wishlist = Wishlist::create([
                'product_id' => $request->product_id,
                'user_id' => Auth::user()->id,
                'is_favourite' => 1
            ]);
        }


        $responseData['status'] = true;
        $responseData['message'] = "Added To Wishlist Successfully";

        $data = array(
            "product_id" => $wishlist['product_id'],
            "user_id" => $wishlist['user_id']
        );

        $responseData['data'] = $data;
        return response()->json($responseData);
    }

    public function wishlistProducts()
    {
        try {
            $user_id = (Auth::user()->id > 0 ? array(Auth::user()->id) : 0);

            $products = $this->getAllProducts($user_id)
                ->where('user_id', $user_id)
                ->orderBy('id', 'DESC')->get();

            $responseData = $this->getProductLists($products, $user_id);

            return response()->json(['data' => $responseData], 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
