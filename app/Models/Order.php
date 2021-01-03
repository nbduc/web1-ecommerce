<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ship_date',
        'ship_address',
        'status_id',
    ];

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function status(){
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}
