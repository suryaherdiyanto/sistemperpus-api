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
use phpDocumentor\Reflection\Types\Object_;
use Validator;
use Dingo\Api\Exception\StoreResourceFailedException;

class MemberController extends Controller
{
    use Helpers;

    private $member;
    private $per_page;

    public function __construct(Member $member){
        $this->member = $member;
    }

    public function index(Request $request){
        $this->per_page = ($request->has('per_page') ? $request->get('per_page'):15);
        $members = $this->member;
        if ($request->get('trashed') == 'true'){
            $members = $members->onlyTrashed()->paginate($this->per_page);
            return $this->response->paginator($members, new MemberTransformer());
        }

        if ($request->get('q'))
            $members = $members
                ->where('nickname', 'like', '%'.$request->get('q').'%')
                ->orWhere('email', 'like', '%'.$request->get('q').'%');

        $members = $members->orderBy('nickname')->paginate($this->per_page);
        return $this->response->paginator($members, new MemberTransformer());
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'nickname' => 'required',
            'full_name' => 'required',
            'genre' => 'integer|max:2',
            'email' => 'required|email',
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
            throw new StoreResourceFailedException('Terjadi kesalahan: ', $validate->errors());
        }

        $this->member->find($id)->update($request->except(['deleted_at','updated_at','created_at']));
        return response()->json([
            'message' => "Member berhasil disimpan"
        ], 200);
    }

    public function delete($id, Request $request){
        if ($request->has('restore')){
            $this->member->onlyTrashed()->where('id', $id)->restore();
            return response()->json([
                'message' => 'Member berhasil direstore'
            ], 200);
        }
        $this->member->destroy($id);
        return response()->json([
            'message' => 'Member berhasil dihapus!'
        ], 200);
    }
}