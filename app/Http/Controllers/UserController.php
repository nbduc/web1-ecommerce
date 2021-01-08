<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\CartItem;
use App\Models\CustomerData;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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

        $messages = [];

        //check product in cart
        if($cart->cartItems()->pluck('product_id')->contains($product['id'])){
            foreach($cart->cartItems as $cartItem){
                if($cartItem->product_id == $product['id']){
                    if(array_key_exists('increment', $input)){
                        $cartItem->quantity += $input['increment'];
                        $messages += ['success' => 'Updated successfully.'];
                    }else if(array_key_exists('descrement', $input)){
                        $cartItem->quantity -= $input['descrement'];
                        if($cartItem->quantity < 1){
                            $cartItem->quantity = 1; 
                        }
                        $messages += ['success' => 'Updated successfully.'];
                    } else if(array_key_exists('quantity', $input)){
                        $cartItem->quantity += $input['quantity'];
                        $messages += ['success' => 'Added to your cart.'];
                    } else if(array_key_exists('updatedQuantity', $input)){
                        $cartItem->quantity = $input['updatedQuantity'];
                        if($cartItem->quantity < 1){
                            $cartItem->quantity = 1; 
                        }
                        $messages += ['success' => 'Updated successfully.'];
                    } else {
                        $cartItem->quantity++;
                        $messages += ['success' => 'Updated successfully.'];
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

            $messages += ['success' => 'Added to your cart.'];
        }

        session(['totalQuantity' => $cart->totalQuantity()]);

        return response()->json($messages);
    }

    public function removeFromCart(Request $request){
        return response()->json([
            'success' => 'Removed from your cart.'
        ]);
    }

    public function getProfile(Request $request){
        return view('pages.user.profile', [
            'redirectTo' => str_replace(url('/'), '', url()->previous()),
        ]);
    }

    public function updateProfile(UpdateUserProfileRequest $request){
        $input = $request->validated();
        $user = User::find(Auth::user()->id);

        $user->update($request->only(['name', 'email']));
        $user->customerData()->update($request->only(['phone', 'ship_address']));

        return redirect($input['redirectTo']);
    }

    public function getOrder(Request $request){
        $cart = Auth::user()->cart;
        return view('pages.user.order',[
            'cart' => $cart,
        ]);
    }

    public function postOrder(Request $request){
        
    }
}
