<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientad extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

//    use Sluggable,
//        SluggableScopeHelpers;

    protected $table = 'client_ads';

    public $fillable = ['title', 'slug', 'description', 'price', 'cover', 'images', 'country_id', 'city_id', 'state_id', 'is_published',
        'status', 'start_date', 'end_date', 'user_id', 'cat_id', 'maincat_id', 'user_package_id','serial_num', 'is_canceled', 'reason_id'];

    public function viewNum () {
        return $this->hasMany(Viewsnum::class, 'client_ad_id', 'id');
    }

    public function cat() {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
    public function mainCat() {
        return $this->belongsTo(Category::class, 'maincat_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userPackage() {
        return $this->belongsTo(Boughtpackage::class, 'user_package_id', 'id');
    }
    public function country() {
        return $this->belongsTo(Location::class, 'country_id', 'id');
    }
    public function city() {
        return $this->belongsTo(Location::class, 'city_id', 'id');
    }
    public function state() {
        return $this->belongsTo(Location::class, 'state_id', 'id');
    }
    public function wish() {
        return $this->hasMany(Wish::class, 'client_ad_id', 'id');
    }
    public function clientAdAttrsAnswers() {
        return $this->hasMany(Answer::class, 'client_ad_id', 'id');
    }
    public function reason() {
        return $this->belongsTo(Reason::class, 'reason_id', 'id');
    }

    public function scopeSlug ($q, $slug) {
        $q->where('slug', $slug);
    }
    public function scopeWiAttrAnswers ($q) {
        $q->with(['clientAdAttrsAnswers' => function($que) {
            $que->with('attr');
        }]);
    }

    public function scopeWiCountry ($q) {
        $q->with(['country' => function($query) {
            $query->select('id', 'name');
        }]);
    }
    public function scopeWiCity ($q) {
        $q->with(['city' => function($query) {
            $query->select('id', 'name');
        }]);
    }
    public function scopeWiState ($q) {
        $q->with(['state' => function($query) {
            $query->select('id', 'name');
        }]);
    }

    public function scopeSeller($q, $id) {
        $q->where('user_id', $id);
    }
    public function scopeOwner($q) {
        $q->with(['user' => function($query) {
            $query->select('id', 'name', 'image', 'status', 'phone', 'email', 'whats_app', 'serial_num');
        }]);
    }
    public function scopePaid($q) {
        $q->where('status', 'paid');
    }
    public function scopeFree($q) {
        $q->where('status', 'free');
    }
    public function scopeNotEnd($q) {
        $q->whereDate('end_date', '>',  date("Y-m-d"));
    }
    public function scopeEnded($q) {
        $q->whereDate('end_date', '<',  date("Y-m-d"));
    }
    public function scopeCanceled($q) {
        $q->where('is_canceled',  '1');
    }
    public function scopeNotCanceled($q) {
        $q->where('is_canceled',  '0');
    }
    public function scopePublished($q) {
        $q->where('is_published', '1');
    }
    public function scopeNotPublished($q) {
        $q->where('is_published', '0');
    }
    public function scopeMine($q) {
        $q->where('user_id', backpack_auth()->user()->id);
    }
    public function scopeSelection($q) {
        $q->select('id', 'title', 'description', 'slug', 'price', 'images','cover', 'is_published', 'status','end_date', 'cat_id', 'user_id', 'country_id', 'city_id', 'state_id', 'created_at', 'is_canceled', 'reason_id', 'serial_num', 'user_package_id');
    }
    public function scopeUserPack($q, $id) {
        $q->where('user_package_id', $id);
    }

//    public function sluggable(): array
//    {
//        return [
//            'slug' => [
//                'source' => 'slug_keyword'
//            ]
//        ];
//    }


}
