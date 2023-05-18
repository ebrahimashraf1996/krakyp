<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeChild extends Model
{
    use HasFactory;

    protected $table = "attr_cat";

    protected $fillable = ['cat_id', 'attr_id', 'parent_id', 'lft', 'rgt', 'depth', 'type_of', 'main_other'];

    public function subAttrs() {
        return $this->hasMany(AttributeChild::class, 'parent_id', 'id');
    }
    public function mainAttr() {
        return $this->belongsTo(AttributeChild::class, 'parent_id', 'id');
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attr_id', 'id');
    }
    public function category() {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }




}
