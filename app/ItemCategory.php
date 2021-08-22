<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public function products()
    {
        return $this->belongsToMany(
            Product::class
        );
    }
    public function brand_categories()
    {
        return $this->belongsTo(
            BrandCategory::class
        );
    }
}
