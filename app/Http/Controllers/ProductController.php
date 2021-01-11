<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('price', $search)
                ->orWhere('description', 'like', '%'.$search.'%');
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
        $productId = $request['productId'];
        $content = $request['content'];

        $messages = [];
        $user = Auth::user();
        if($user === null){
            $messages += ['warning' => 'You need to be logged in to post a comment'];
            return response()->json($messages);
        }
        $user->comments()->create(['product_id' => $productId, 'content' => $content]);
        
        $messages += ['success' => 'Comment successfully posted'];
        return response()->json($messages);
    }
}
