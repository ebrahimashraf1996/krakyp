<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answers';

    public $fillable = ['client_ad_id', 'attr_id','answer_value','answer_type'];



    public function attr() {
        return $this->belongsTo(Attribute::class, 'attr_id', 'id');
    }
    public function clientAd() {
        return $this->belongsTo(Clientad::class, 'client_ad_id', 'id');
    }

}
