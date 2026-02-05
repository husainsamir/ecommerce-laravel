<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color',
        'size',
        'price',
        'stock_quantity'
    ];

    // Relation: Variant belongs to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
