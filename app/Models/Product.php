<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 出品中
    const STATE_SELLING = 'selling';
    // 購入済み
    const STATE_BOUGHT = 'bought';

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

    public function getIsStateSellingAttribute()
    {
        return $this->state === self::STATE_SELLING;
    }

    public function getIsStateBoughtAttribute()
    {
        return $this->state === self::STATE_BOUGHT;
    }

    public function selling()
    {
        $this->increment('id', 1);
        $this->state = self::STATE_SELLING;
        $this->save();
    }

    public function buyOut()
    {
        $this->state = self::STATE_BOUGHT;
        $this->save();
    }
}
