<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Setting extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;

    use HasFactory;
    use HasTranslations;

    protected $table = 'settings';
    protected $translatable = ['title', 'type', 'short_des','description','address'];

    protected $fillable=['title', 'usd','type','short_des','description','image','rights','general_bg','search_bg', 'terms', 'address','phone','email','logo','about_us_image','facebook','twitter','linkedin','behance','instagram','whatsapp', 'map', 'snap_chat', 'youtube', 'skype'];

    public function tags() {
        return $this->belongsToMany('App\Models\Tag','tags_settings','setting_id', 'tag_id','id', 'id');
    }



}
