<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'likes',
        'in_stock',
        'feature_img',
    ];

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function favourites(){
        return $this->hasMany(Favourite::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    public function productDetail(){
        return $this->hasOne(ProductDetails::class);
    }

    public function productImages(){
        return $this->hasMany(ProductImages::class);
    }

    public static function newProducts(){
        return Product::orderBy('created_at', 'desc')->take(10)->get();
    }

    public static function topSellingProducts(){
        return Product::whereIn('id', 
            OrderDetail::select('product_id', DB::raw('sum(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->take(10)
            ->pluck('product_id')->toArray()
        )->get();
    }

    public static function mostPopularProducts(){
        return Product::whereIn('id', 
            Favourite::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->pluck('product_id')->toArray()
        )->get();
    }

    public function favouritesCount(){
        return $this->favourites->count();
    }

    public function commentsCount(){
        return $this->comments->count();
    }
}
