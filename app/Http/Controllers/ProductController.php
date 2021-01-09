<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('pages.common.product', [
            'product' => $product,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('q');
        if($search!=""){
            $products = Product::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%');
            })
            ->paginate(20);
            $products->appends(['q' => $search]);
        }
        else{
            $products = Product::paginate(20);
        }
        return view('pages.common.search', [
            'products' => $products,
            'search' => $search,
        ]);

    }

    public function postComment(Request $request){

    }
}
