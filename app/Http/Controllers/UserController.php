<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\CartItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);
    }

    public function getFavourites(){
        return view('pages.user.favourites',[
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
        $cart = Auth::user()->cart;

        return view('pages.user.cart',[
            'cart' => $cart,
        ]);
    }

    public function updateCart(Request $request){
        //Check product existed.

        //Faked product to test.
        $product = ['id' => 1,'name' => 'Samsung Galaxy S21 Ultra', 'price' => 32000000];

        $cart = Auth::user()->cart;
        $input = $request->all();

        //check product in cart
        if($cart->cartItems()->pluck('product_id')->contains($product['id'])){
            foreach($cart->cartItems as $cartItem){
                if($cartItem->product_id == $product['id']){
                    if(array_key_exists('increment', $input)){
                        $cartItem->quantity += $input['increment'];
                    }else if(array_key_exists('descrement', $input)){
                        $cartItem->quantity -= $input['descrement'];
                        $cartItem->quantity < 1 ? 1 : $cartItem->quantity;
                    } else if(array_key_exists('quantity', $input)){
                        $cartItem->quantity += $input['quantity'];
                    } else if(array_key_exists('updatedQuantity', $input)){
                        $cartItem->quantity = $input['updatedQuantity'];
                        $cartItem->quantity < 1 ? 1 : $cartItem->quantity;
                    } else {
                        $cartItem->quantity++;
                    }
                    $cartItem->save();
                }
            }
        } else {
            $quantity = 0;
            if(array_key_exists('quantity', $input)){
                $quantity = $input['quantity'] < 1 ? $input['quantity'] : 1;
            } else {
                $quantity = 1;
            }
            $newCartItem = new CartItem([
                'product_id' => $product['id'],
                'quantity' => $quantity,
                'unit_price' => $product['price'],
            ]);
            $cart->cartItems()->save($newCartItem);
        }

        session(['totalQuantity' => $cart->totalQuantity()]);

        return response()->json([
            'success' => 'Added to your cart',
        ]);
    }
}
