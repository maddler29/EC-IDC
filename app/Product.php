<?php

namespace App;

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
            ItemCategory::class
        );
    }
}
