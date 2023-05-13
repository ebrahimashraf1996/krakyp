<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable=['image_alt','image','url','status'];

    public function getImageAttribute($val) {
        if ($val !== null) {
            $val = str_ireplace('[', '', $val);
            $val = str_ireplace(']', '', $val);
            $val = str_ireplace('\\\\', '/', $val);
            $val = str_ireplace('"', '', $val);
            return $val;
        }
        return null;
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }



}
