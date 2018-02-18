<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 01/02/18
 * Time: 22:31
 */

use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $fillable = [
        'title',
        'total_pages',
        'category_id',
        'author_id',
        'publisher_id',
        'publish_date',
        'description'
    ];

    public function getTitleAttribute($val){
        return strtoupper($val);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function author() {
        return $this->belongsTo(Author::class);
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }
}