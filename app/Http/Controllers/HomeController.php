<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $user = User::find(Auth::user()->id);
        if($user != null && $user->hasRole('Customer')){
            $user = User::find(Auth::user()->id);
            $cart = $user->cart;
            session(['totalQuantity' => $cart->totalQuantity()]);
        }

        $newProducts = Product::newProducts();
        $topSellingProducts = Product::topSellingProducts();
        $mostPopularProducts = Product::mostPopularProducts();

        return view('pages.common.home', [
            'newProducts' => $newProducts,
            'topSellingProducts' => $topSellingProducts,
            'mostPopularProducts' => $mostPopularProducts,
        ]);
    }
}
