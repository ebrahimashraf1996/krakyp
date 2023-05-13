<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfoPill extends Model
{
    use HasFactory;

    protected $table = "user_info_pills";

    protected $fillable = ['user_id', 'first_name', 'last_name', 'mobile', 'email', 'state', 'address1', 'address2'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
