<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasTranslations;

    protected $table = 'options';

    public $fillable = ['val', 'attr_id', 'image'];

    public $translatable = ['val'];

    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attr_id', 'id');
    }
}
