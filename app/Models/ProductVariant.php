<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function variantItems(){
        return $this->hasMany(ProductVariantItem::class);
    }

    public function activeVariantItems(){
        return $this->hasMany(ProductVariantItem::class)->select(['product_variant_id','name','price','id']);
    }

    public function color(){

        return $this->belongsTo(Color::class);
    }
    public function size(){

        return $this->belongsTo(Size::class);
    }




}
