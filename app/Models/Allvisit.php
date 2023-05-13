<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allvisit extends Model
{
    use HasFactory;
    protected $fillable = [ 'ip_address','country','city','state', 'created_at' ];

    public $timestamps = true;
}
