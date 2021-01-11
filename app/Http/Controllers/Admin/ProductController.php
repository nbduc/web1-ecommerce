<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::paginate(15);
        
        return view('admin.products.index', [
            'products' => $products,
            'you' => Auth::user()
        ]); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.products.create',['you' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
            $product = new Product(); 
            $product->name=$request->input('name'); 
            $product->description=$request->input('description');
            $product->price=$request->input('price');
            $product->likes=0;
            $product->in_stock=$request->input('in_stock');
            if($request->hasFile('feature_img')){
                $file = $request->file('feature_img'); 
                $extension = $file->getClientOriginalExtension(); 
                $filename=$request->input('name').time().'.'.$extension; 
                $file->move('images/upload/feature_products/',$filename); 
                $product->feature_img=$filename; 
            }
            else
            {
                $product->feature_img="no img";
            }
             
            $product->save(); 
            $products = Product::paginate(15);
            return view('admin.products.index', [
                'products' => $products,
                'you' => Auth::user()
            ]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        if($search!=""){
            $products = Product::where(function ($query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('price', $search)
                ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->paginate(15);
            $products->appends(['search' => $search]);
        }
        else{
            $products = Product::paginate(15);
        }
        return view('admin.products.index', [
            'products' => $products,
            'search' => $search,
            'you' => Auth::user()
        ]);
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.products.show', [
            'products' => Product::find($id),
            'you' => Auth::user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.products.edit', [
            'product' => Product::find($id),
            'you' => Auth::user()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $product = Product::find($id);
        $product->name = Request()->name;
        $product->price = Request()->price;
        $product->in_stock = Request()->in_stock;
        $product->productDetail->display = Request()->display;
        $product->productDetail->front_camera = Request()->front_camera;
        $product->productDetail->rear_camera = Request()->rear_camera;
        $product->productDetail->storage = Request()->storage;
        $product->description = Request()->description;
        $product->productDetail->os = Request()->os;
        $product->update();
        $request->session()->flash('success', "You have edited the product.");

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (Gate::allows('is-me', $id)) {
            $request->session()->flash('error', "You don't have permission to delete this product!");
        } else {
            Product::destroy($id);
            $request->session()->flash('success', "You have deleted the product.");
        }
        return redirect(route('admin.products.index'));
    }
}
