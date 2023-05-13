<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;
    
    protected $table = "transactions";
    
    public $fillable = [
            'order_id',
            'trnx_id',
            'pay_order_id',
            'is_success',
            'is_pending',
            'hmac',
            'currency',
            'amount_cents',
            'string_req'
        ];
        
    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
