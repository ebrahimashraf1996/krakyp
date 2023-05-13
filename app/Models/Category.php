<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasTranslations, SluggableScopeHelpers;
    use Sluggable;


    protected $table = 'categories';

    public $fillable = ['title', 'slug', 'slug_keyword', 'description', 'image', 'cat_icon', 'free_or_paid', 'user_id', 'parent_id', 'is_featured', 'status'];

    public $translatable = ['title', 'description'];


    public function subCategories() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function mainCategory() {
        return $this->belongsTo(Category::class, 'parent_id','id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tags_categories', 'cat_id', 'tag_id', 'id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'attr_cat', 'cat_id', 'attr_id', 'id', 'id')->withPivot('lft','parent_id', 'type_of', 'main_other');
    }

    public function catpackages() {
        return $this->hasMany(Catpackage::class, 'cat_id', 'id');
    }
    public function scopeActive($q) {
        return $q->where('status', 'active');
    }
    public function scopeMain($q) {
        return $q->where('parent_id', null);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_keyword'
            ]
        ];
    }

}
