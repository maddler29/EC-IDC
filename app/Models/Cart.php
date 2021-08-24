<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // 4-4
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'line_items',
         )->withPivot(['id', 'quantity']);
    }

}
