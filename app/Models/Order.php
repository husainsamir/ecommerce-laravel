<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];

    // Order Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // All addresses
    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    // Shipping address
    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'shipping');
    }

    // Billing address
    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class)->where('type', 'billing');
    }
}
