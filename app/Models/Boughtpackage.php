<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boughtpackage extends Model
{
    use HasFactory, CrudTrait;

    protected $table = "bought_packages";

    public $fillable = ['title', 'cat_id', 'user_id', 'ads_count', 'full_ads', 'price', 'duration'];

    public function clientAds() {
        return $this->hasMany(Clientad::class, 'user_package_id', 'id');
    }

    public function cat() {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
