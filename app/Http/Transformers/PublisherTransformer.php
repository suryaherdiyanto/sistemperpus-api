<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 30/01/18
 * Time: 22:03
 */

namespace App\Http\Transformers;
use League\Fractal\TransformerAbstract;
use App\Publisher;

class PublisherTransformer extends TransformerAbstract
{

    public function transform(Publisher $pub){
        return [
            'id' => $pub->id,
            'name' => $pub->name,
            'address' => $pub->address,
            'location' => $pub->location,
            'phone' => $pub->phone,
            'email' => $pub->email
        ];
    }

}