<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productColorVariation extends Model
{
    use HasFactory;
  
  protected $fillable = ['product_id', 'color_id', 'var_images'];
  
  public function color(){

        return $this->belongsTo(Color::class);
}
  
  
}
