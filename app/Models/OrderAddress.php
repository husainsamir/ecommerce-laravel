<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'type',          // shipping | billing
        'full_address',
        'city',
        'state',
        'zip_code',
    ];

    // Relation → Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
