<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    // 👇 AGAR table ka naam coupons NAHI hai
    protected $table = 'offers'; // ❗ apne actual table name ke hisaab se

    protected $primaryKey = 'id'; // ensure lowercase id

    public $timestamps = true; // agar created_at / updated_at hai

    protected $fillable = [
        'coupon_code',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'description',
        'status',
    ];
}
