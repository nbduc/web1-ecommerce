<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display',
        'front_camera',
        'rear_camera',
        'storage',
        'os',
        'product_id',
    ];

    public function product(){
        $this->belongsTo(Product::class);
    }
}
