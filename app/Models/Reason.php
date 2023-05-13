<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = "reasons";

    public $fillable = ['reason_val'];

    public function clientAd() {
        return $this->hasMany(Clientad::class, 'reason_id', 'id');
    }

}
