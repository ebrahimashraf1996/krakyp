<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasTranslations;

    protected $table = 'attributes';

    public $fillable = ['title', 'sub_title', 'attr_icon', 'status','type', 'type_of', 'appearance','start', 'end', 'unit'];

    public $translatable = ['title'];


    public function options() {
        return $this->hasMany(Option::class, 'attr_id', 'id');
    }
    public function categories() {
        return $this->belongsToMany(Category::class, 'attr_cat', 'attr_id', 'cat_id', 'id', 'id')->withPivot('lft','parent_id','type_of','main_other');
    }

    public function subAttrs () {
        return $this->hasMany(Attribute::class, 'parent_id', 'id');
    }
}
