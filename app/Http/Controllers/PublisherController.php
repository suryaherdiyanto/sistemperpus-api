<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 30/01/18
 * Time: 21:32
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Publisher;
use Dingo\Api\Routing\Helpers;
use App\Http\Transformers\PublisherTransformer;
use Validator;
use Dingo\Api\Exception\StoreResourceFailedException;

class PublisherController extends Controller
{
    use Helpers;

    private $publisher;
    private $per_page;

    public function __construct(Publisher $publisher){
        $this->publisher = $publisher;
    }

    public function index(Request $request){
        $this->per_page = ($request->has('per_page') ? $request->get('per_page'):10);
        $publishers = $this->publisher;

        $publishers = $publishers->orderBy('name')->paginate($this->per_page);
        return $this->response->paginator($publishers, new publisherTransformer());
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'location' => 'required',
            'phone' => 'required|numeric',
            'email' => 'email',
        ]);

        if ($validate->fails()){
            throw new StoreResourceFailedException('Terjadi kesalahan: ', $validate->errors());
        }

        $this->publisher->create($request->all());

        return response()->json([
            'message' => 'penerbit berhasil ditambahkan!'
        ], 201);
    }

    public function update($id, Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'location' => 'required',
            'phone' => 'required|numeric',
            'email' => 'email',
        ]);

        if ($validate->fails()){
            throw new StoreResourceFailedException('Terjadi kesalahan: ', $validate->errors());
        }

        $this->publisher->find($id)->update($request->all());
        return response()->json([
            'message' => "penerbit berhasil disimpan"
        ], 200);
    }

    public function delete($id){
        $this->publisher->destroy($id);
        return response()->json([
            'message' => 'penerbit berhasil dihapus!'
        ], 200);
    }
}