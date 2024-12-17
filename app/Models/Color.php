<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];  
    use HasFactory;
    
    public function pro_color(){
        return $this->hasMany(productColorVariation::class);
    }
    
}
