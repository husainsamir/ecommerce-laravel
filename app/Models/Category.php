<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'url_slug',
        'parent_cat_id',
        'status',
    ];

    // Parent relation
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_cat_id');
    }

    // Children relation
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_cat_id');
    }
}
