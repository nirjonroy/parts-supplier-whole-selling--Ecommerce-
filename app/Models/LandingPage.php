<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function images() {

        return $this->hasMany(LandingPageSlider::class);
    }
}
