<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderProducts(){
        return $this->hasMany(OrderProduct::class);
    }

    public function orderAddress(){
        return $this->hasOne(OrderAddress::class);
    }

    public function scopeActive($query)
    {
        $admin = Auth::guard('admin')->user();
        if($admin->admin_type !== 1)
        {
            return $query->where('assign_id', $admin->id);
        }
    }
    public function assign(){

        return $this->belongsTo(User::class,'assign_user_id');
    }

    public function courier(){

        return $this->belongsTo(Courier::class);
    } 
}
