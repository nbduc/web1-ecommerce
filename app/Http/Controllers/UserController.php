<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\CartItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('pages.user.profile',[
            'you' => Auth::user(),
        ]);
    }

    public function getFavourites(){
        return view('pages.user.favourites',[
            'you' => Auth::user(),
        ]);
    }

    public function addFavourite(Request $request){
        //Thêm sp vào favourites
        //Tăng số lượt thích
        return response()->json([
            'success' => 'Added to your favourites'
        ]);
    }

    public function removeFavourite(Request $request){
        return response()->json([
            'success' => 'Removed from your favourites'
        ]);
    }

    public function getCart(){
        return view('pages.user.cart',[
            'you' => Auth::user(),
        ]);
    }

    public function addProductToCart(Request $request){
        //Check product existed.

        //Faked product to test.
        $product = ['id' => 1,'name' => 'Samsung Galaxy S21 Ultra', 'price' => 32000000];

        $cart = Auth::user()->cart;

        //check product in cart
        if($cart->cartItems()->pluck('product_id')->contains($product['id'])){
            foreach($cart->cartItems as $cartItem){
                if($cartItem->product_id == $product['id']){
                    $cartItem->quantity++;
                    $cartItem->save();
                    return response()->json([
                        'success1' => 'Added to your cart',
                    ]);
                }
            }
            return response()->json([
                'error' => 'Something went wrong',
            ]);
            //return response()->json($cart->cartItems[0]->product_id == );
        } else {
            $newCartItem = new CartItem([
                'product_id' => $product['id'],
                'quantity' => 1,
                'unit_price' => $product['price'],
            ]);
            $cart->cartItems()->save($newCartItem);
        }


        return response()->json([
            'success' => 'Added to your cart',
        ]);
    }
}
