<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 26/01/18
 * Time: 20:08
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Member;
use Dingo\Api\Routing\Helpers;
use App\Http\Transformers\MemberTransformer;
use Validator;
use Dingo\Api\Exception\StoreResourceFailedException;

class MemberController extends Controller
{
    use Helpers;

    private $member;

    public function __construct(){
        $this->member = new Member();
    }

    public function index(Request $request){
        $per_page = $request->get('per_page');
        if ($request->get('trashed') == true)
            $members = $this->member->withTrashed()->paginate(($per_page) ? $per_page : 10);
        else
            $members = $this->member->paginate(($per_page) ? $per_page : 10);
        return $this->response->paginator($members, new MemberTransformer());
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'nickname' => 'required',
            'full_name' => 'required',
            'genre' => 'integer|max:2',
            'email' => 'email',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        if ($validate->fails()){
            throw new StoreResourceFailedException('Terjadi kesalahan: ', $validate->errors());
        }

        $this->member->create($request->all());

        return response()->json([
            'message' => 'Member berhasil ditambahkan!'
        ], 201);
    }

    public function update($id, Request $request){
        $validate = Validator::make($request->all(), [
            'nickname' => 'required',
            'full_name' => 'required',
            'genre' => 'integer|max:2',
            'email' => 'email',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        if ($validate->fails()){
            throw new StoreResourceFailedException('Terjadi kesalahan: ', $validate->erros());
        }

        $this->member->find($id)->update($request->all());
        return response()->json([
            'message' => "Member berhasil disimpan"
        ], 200);
    }

    public function delete($id){
        $this->member->destroy($id);
        return response()->json([
            'message' => 'Member berhasil dihapus!'
        ], 200);
    }
}