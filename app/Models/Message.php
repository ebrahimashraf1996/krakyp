<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    public $fillable=['name','message','email','phone','reason','read_at','serial_num'];

    public function getReasonAttribute($val) {
        if ($val == 'report_post') {
            return 'إبلاغ عن إعلان';
        }
        if ($val == 'explain') {
            return 'استفسار';

        }
        if ($val == 'report_seller') {
            return 'إبلاغ عن بائع';

        }
        return null;
    }

}
