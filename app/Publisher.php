<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 30/01/18
 * Time: 21:33
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $fillable = [
        'name',
        'address',
        'location',
        'phone',
        'email'
    ];

    public function getNameAttribute($val){
        return strtoupper($val);
    }

    public function getLocationAttribute($val){
        return ucfirst($val);
    }
}