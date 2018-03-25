<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 26/01/18
 * Time: 19:42
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Member extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nickname',
        'full_name',
        'genre',
        'email',
        'phone',
        'address'
    ];

    protected $dates = ['deleted_at'];

    public function getNicknameAttribute($val){
        return ucfirst($val);
    }

    public function getFullNameAttribute($val){
        return ucwords($val);
    }
}