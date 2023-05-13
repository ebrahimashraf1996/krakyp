<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catpackage extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    use Sluggable,
        SluggableScopeHelpers;


    protected $table = 'cat_packages';

    public $fillable = ['title','slug', 'slug_keyword', 'description', 'cat_id', 'duration', 'ads_count', 'price', 'discount', 'status'];


    public function category() {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
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
