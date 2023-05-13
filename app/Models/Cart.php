<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable=['user_id','pack_id','order_id','quantity','price','amount','status'];


    public function userPack()
    {
        return $this->belongsTo(Catpackage::class, 'pack_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

}
