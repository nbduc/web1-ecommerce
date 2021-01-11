<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\CartItem;
use App\Models\CustomerData;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getFavourites(){
        $user = User::find(Auth::user()->id);
        $favourites = $user->favourites;
        return view('pages.user.favourites', [
            'favourites' => $favourites,
        ]);
    }

    public function addFavourite(Request $request){
        //Thêm sp vào favourites
        $user = User::find(Auth::user()->id);
        $user->favourites()->create(['product_id' => $request->productId]);
        //Tăng số lượt thích
        $product = Product::find($request->productId);
        $product->likes++;
        $product->save();
        return response()->json([
            'success' => 'Added to your favourites'
        ]);
    }

    public function removeFavourite(Request $request){
        //Remove sp ra favourites
        $user = User::find(Auth::user()->id);
        $user->favourites()->where('product_id', $request->productId)->delete();
        //Tăng số lượt thích
        $product = Product::find($request->productId);
        $product->likes--;
        $product->save();
        return response()->json([
            'success' => 'Removed from your favourites'
        ]);
    }

    public function getCart(){
        $cart = Auth::user()->cart;
        session(['totalQuantity' => $cart->totalQuantity()]);
        return view('pages.user.cart',[
            'cart' => $cart,
        ]);
    }

    public function updateCart(Request $request){
        //Check product existed.
        $product = Product::find($request->productId);
        if($product === null){
            return abort(404);
        }

        $cart = Auth::user()->cart;
        $input = $request->all();

        $messages = [];

        //check product in cart
        if($cart->cartItems()->pluck('product_id')->contains($product->id)){
            foreach($cart->cartItems as $cartItem){
                if($cartItem->product_id == $product->id){
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
                $quantity = $input['quantity'] > 1 ? $input['quantity'] : 1;
            } else {
                $quantity = 1;
            }
            $newCartItem = new CartItem([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
            ]);
            $cart->cartItems()->save($newCartItem);

            $messages += ['success' => 'Added to your cart.'];
        }

        session(['totalQuantity' => $cart->totalQuantity()]);

        return response()->json($messages);
    }

    public function removeFromCart(Request $request){
        $product = Product::find($request->productId);
        if($product === null){
            return abort(404);
        }

        $cart = Auth::user()->cart;

        $cart->cartItems()->where('product_id', $request->productId)->delete();
        session(['totalQuantity' => $cart->totalQuantity()]);
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

        //check email
        $checkUser = User::where('email', $input['email'])->first();
        if($checkUser !== null){
            if($checkUser->id == $user->id){
                $request->session()->flash('error', "That email is existed.");
                return redirect($input['redirectTo']);
            }
        } else {
            $user->update($request->only(['name', 'email']));
            $user->customerData()->update($request->only(['phone', 'ship_address']));
    
            return redirect($input['redirectTo']);
        }

    }

    public function getOrder(Request $request){
        $user = User::find(Auth::user()->id);
        $cart = Auth::user()->cart;
        if($cart->totalQuantity() <= 0){
            return abort(404);
        }

        if($user->customerData->phone === null || $user->customerData->ship_address === null){
            return redirect(route('user.profile.index'));
        }

        return view('pages.user.order',[
            'cart' => $cart,
        ]);
    }

    public function postOrder(Request $request){
        //check cart
        $user = User::find(Auth::user()->id);
        $cart = $user->cart;

        if($cart->totalQuantity() <= 0){
            return response('error', 403);
        }

        //create new order
        $pendingStatus = OrderStatus::select('id')->where('name', 'Pending')->first();
        $order = new Order([
            'ship_date' => date('Y-m-d H:i:s', strtotime('+3 days')),
            'ship_address' => $user->customerData->ship_address,
            'status_id' => $pendingStatus->id,
        ]);
        $user->orders()->save($order);
        foreach($cart->cartItems as $item){
            $orderDetail = new OrderDetail($item->only(['product_id', 'quantity', 'unit_price']));
            $order->orderDetails()->save($orderDetail);
            $item->delete();
        }
        session(['totalQuantity' => $cart->totalQuantity()]);
        return view('pages.user.success-order');
    }
}
