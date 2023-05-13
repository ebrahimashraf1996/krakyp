<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogcategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasTranslations;

    protected $fillable=['title','slug','description','status','image'];

    protected $translatable = ['title','description'];


    public function posts() {
        return $this->hasMany(Post::class, 'blogcategory_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','tags_blogs','blog_id', 'tag_id','id', 'id');
    }

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
