<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'image',
        'description',
        'price',
        'stock_quantity',
        'status',
    ];

    public function category()
{
    return $this->belongsTo(Category::class, 'category_id','id');
}

 public function variants()
{
    return $this->hasMany(ProductVariant::class, 'product_id');
}

 public function images()
{
    return $this->hasMany(ProductImage::class);
}

  public function carts()
    {
        return $this->hasMany(Cart::class);
    }

}
