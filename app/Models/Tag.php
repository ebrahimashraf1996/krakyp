<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        Sluggable,
        SluggableScopeHelpers,
        HasTranslations;

    protected $fillable = ['title', 'slug', 'slug_keyword', 'status'];

    protected $translatable = ['title'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_keyword'
            ]
        ];
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }


    public function setting()
    {
        return $this->belongsToMany(Setting::class, 'tags_settings', 'tag_id', 'setting_id', 'id', 'id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'tags_categories', 'tag_id', 'cat_id', 'id', 'id');
    }


}
