<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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
}
