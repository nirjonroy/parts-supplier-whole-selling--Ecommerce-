<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable= ['title','id'];
  
    use HasFactory;
    
    public function pro_variant(){
        return $this->hasMany(ProductVariant::class);
    }
    
}
