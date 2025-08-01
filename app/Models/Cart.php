<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
