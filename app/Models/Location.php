<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;


class Location extends Model
{
    use HasFactory, CrudTrait;


    protected $table = "locations";

    public $fillable = ['name', 'parent_id'];

    public function parentCity() {
        return $this->belongsTo(Location::class, 'parent_id', 'id');
    }

    public function cities() {
        return $this->hasMany(Location::class, 'parent_id', 'id');
    }

}
