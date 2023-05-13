<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewsnum extends Model
{
    use HasFactory;
    protected $table = "viewsnums";

    public $fillable = ['client_ad_id'];

    public function clientAds() {
        return $this->belongsTo(Clientad::class, 'client_ad_id', 'id');
    }
}
