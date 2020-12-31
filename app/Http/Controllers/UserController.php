<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //
        
    }
}
