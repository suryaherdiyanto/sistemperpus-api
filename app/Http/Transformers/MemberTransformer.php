<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 28/01/18
 * Time: 20:41
 */
namespace App\Http\Transformers;


use League\Fractal\TransformerAbstract;
use App\Member;

class MemberTransformer extends TransformerAbstract {

    public function transform(Member $member){
        return [
            'id' => $member->id,
            'nickname' => $member->nickname,
            'full_name' => $member->full_name,
            'genre' => $member->genre,
            'genre_plain' => ($member->genre === 1) ? 'Laki-laki':'Perempuan',
            'email' => $member->email,
            'phone' => $member->phone,
            'address' => $member->address,
            'deleted_at' => $member->deleted_at,
            'updated_at' => $member->updated_at,
            'created_at' => $member->created_at
        ];
    }

}