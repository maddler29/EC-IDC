<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenderCategory extends Model
{
    public function brand_categories()
    {
        return $this->hasMany(
            BrandCategory::class,
            'gender_id'
        );
    }

    public function item_categories()
    {
        return $this->hasMany(
            ItemCategory::class,
            'gender_id'
        );
    }
}
