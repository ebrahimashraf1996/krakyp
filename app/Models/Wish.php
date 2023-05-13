<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'client_ad_id'];

    public function clientAd()
    {
        return $this->belongsTo(Clientad::class, 'client_ad_id', 'id');
    }

    public static function wishCount()
    {
        if (backpack_auth()->check())
            return Wish::where('user_id', backpack_auth()->user()->id)->count();
        return 0;
    }
}
