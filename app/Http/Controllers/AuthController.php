<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Tymon\Exceptions\JWTException;
use Tymon\Exceptions\TokenExpiredException;
use Tymon\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request){

    }

    public function logout(){

    }
}
