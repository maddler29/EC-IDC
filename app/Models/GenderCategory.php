<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenderCategory extends Model
{
    public function brand_categories()
    {
        return $this->hasMany(
            BrandCategory::class
        );
    }

    public function item_categories()
    {
        return $this->hasMany(
            ItemCategory::class
        );
    }
}
