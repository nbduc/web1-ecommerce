<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetails; 
use App\Models\ProductImages; 
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
            $productDetail = new ProductDetails(); 
            $productImages = new ProductImages(); 
            $productImages2 = new ProductImages();
            $productImages3 = new ProductImages();
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
            //add product detail database
            $productDetail->display = $request->input('display'); 
            $productDetail->front_camera = $request->input('front_camera');
            $productDetail->rear_camera = $request->input('rear_camera'); 
            $productDetail->storage = $request->input('storage');
            $productDetail->os=$request->input('os'); 
            $productDetail->product_id=$product->id; 
            // add product imgs database
            //sup1
            if($request->hasFile('sup_img1')){
                $file = $request->file('sup_img1'); 
                $extension = $file->getClientOriginalExtension(); 
                $filename=$request->input('name').time().'.'.$extension; 
                $file->move('images/upload/product_imgs/',$filename); 
                $productImages->url=$filename;
                $productImages->product_id=$product->id;; 
                $productImages->save();
            }
            else
            {   $productImages->product_id=$product->id;;
                $productImages->url="no img";
                $productImages->save();
            }
            //sup2
            if($request->hasFile('sup_img2')){
                $file = $request->file('sup_img2'); 
                $extension = $file->getClientOriginalExtension(); 
                $filename=$request->input('name').time().'.'.$extension; 
                $file->move('images/upload/product_imgs/',$filename); 
                $productImages2->url=$filename;
                $productImages2->product_id=$product->id; 
                $productImages2->save();
            }
            else
            {   $productImages2->product_id=$product->id;;
                $productImages2->url="no img";
                $productImages2->save();
            }
            //sup3
            if($request->hasFile('sup_img3')){
                $file = $request->file('sup_img3'); 
                $extension = $file->getClientOriginalExtension(); 
                $filename=$request->input('name').time().'.'.$extension; 
                $file->move('images/upload/product_imgs/',$filename); 
                $productImages3->url=$filename;
                $productImages3->product_id=$product->id; 
                $productImages3->save();
            }
            else
            {   $productImages3->product_id=$product->id;;
                $productImages3->url="no img";
                $productImages3->save();
            }
             
            $productDetail->save(); 
             
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
