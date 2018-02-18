<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 01/02/18
 * Time: 22:27
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function getNameAttribute($val){
        return ucwords($val);
    }
}