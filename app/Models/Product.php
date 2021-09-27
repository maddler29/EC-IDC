<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 4-4
    public function carts()
    {
        return $this->belongsToMany(
            Cart::class,
            'line_items',
        )->withPivot(['id', 'quantity']);
    }

    public function item_categories()
    {
        return $this->belongsTo(
            ItemCategory::class,
            'item_category_id'
        );
    }

    public function brand_categories()
    {
        return $this->belongsTo(
            BrandCategory::class,
            'brand_category_id'
        );
    }
}
