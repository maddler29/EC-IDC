<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BrandCategory extends Model
{
    public function products()
    {
        return $this->belongsTo(
            Product::class
        );
    }
    public function item_categories()
    {
        return $this->hasMany(
            ItemCategory::class
        );
    }
    public function gender_categories()
    {
        return $this->belongsTo(
            GenderCategory::class
        );
    }
}
