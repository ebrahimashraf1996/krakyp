<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable=['user_id','order_number','quantity', 'total_amount',
        'first_name', 'last_name','phone','email','country','city','state','address_one','address_two',
        'payment_method','payment_status','status', 'notes'];

    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }

    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }



}
