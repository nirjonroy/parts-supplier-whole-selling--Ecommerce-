<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\productColorVariation;
use DB;
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['is_free_shipping'];
    protected $appends = ['averageRating','totalSold'];

    public function getAverageRatingAttribute()
    {
        return $this->avgReview()->avg('rating') ? : '0';
    }

    public function getTotalSoldAttribute()
    {
        return $this->orderProducts()->sum('qty');
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function childCategory(){
        return $this->belongsTo(ChildCategory::class);
    }

    public function seller(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function gallery(){
        return $this->hasMany(ProductGallery::class);
    }

    public function specifications(){
        return $this->hasMany(ProductSpecification::class);
    }

    public function reviews(){
        return $this->hasMany(ProductReview::class);
    }


    public function variants(){
        return $this->hasMany(ProductVariant::class);
    }

    public function activeVariants(){
        return $this->hasMany(ProductVariant::class)->select(['id','name','product_id']);
    }



    public function variantItems(){
        return $this->hasMany(ProductVariantItem::class);
    }

    public function avgReview(){
        // return $this->hasMany(ProductReview::class)->where('status', 1)->select('*', DB::raw('AVG(rating) AS avg_rating'));
        return $this->hasMany(ProductReview::class)->where('status', 1);
    }

    public function variations() {

        return $this->hasMany(ProductVariant::class,'product_id');
    }
  
  	public function colorVariations() {

         return $this->hasMany(productColorVariation::class, 'product_id');
    }

}
