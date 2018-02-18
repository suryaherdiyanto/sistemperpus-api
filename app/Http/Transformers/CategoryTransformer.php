<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 01/02/18
 * Time: 22:40
 */
namespace App\Http\Transformers;


use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract {

    public function transform(Category $cat) {
        return [
            'id' => $cat->id,
            'name' => $cat->name
        ];
    }

}