<?php
/**
 * Created by PhpStorm.
 * User: surya
 * Date: 01/02/18
 * Time: 22:46
 */
namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Transformers\CategoryTransformer;
use Dingo\Api\Routing\Helpers;
use Dingo\Api\Exception\StoreResourceFailedException;
use Validator;

class CategoryController extends Controller {

    use Helpers;

    private $category;
    private $per_page;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function index(Request $request){
        $this->per_page = ($request->has('per_page') ? $request->get('per_page'):10);
        $categories = $this->category->orderBy('name')->paginate($this->per_page);
        return $this->response->paginator($categories, new CategoryTransformer());
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validate->fails()){
            throw new StoreResourceFailedException("Terjadi kesalahan", $validate->errors());
        }

        $this->category->create($request->all());

        return response()->json([
            'message' => 'Category berhasil ditambahkan'
        ], 201);
    }

    public function update($id, Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validate->fails()){
            throw new StoreResourceFailedException("Terjadi kesalahan", $validate->errors());
        }

        $this->category->find($id)->update($request->all());
        return response()->json([
            "message" => 'Category berhasil disimpan'
        ], 200);
    }

    public function delete($id){
        $this->category->destroy($id);
        return response()->json([
            "message" => 'Category berhasil disimpan'
        ], 200);
    }
}