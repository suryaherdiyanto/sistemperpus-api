<?php

namespace App\Http\Controllers;

use App\User;
use Tymon\JWTAuth\JWTAuth;
use Tymon\Exceptions\JWTException;
use Tymon\Exceptions\TokenExpiredException;
use Tymon\Exceptions\TokenInvalidException;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Validator;

class AuthController extends Controller
{
    use Helpers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $jwt;
    public $validator;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request){
      $credentials = $request->only('email', 'password');
      $validate = Validator::make($credentials, [
        'email' => 'required|email',
        'password' => 'required'
      ]);

      if ($validate->fails()) {
        throw new StoreResourceFailedException("Error Processing Request", $validate->errors());
      }

      try {
        if (!$token = $this->jwt->attempt($credentials)) {
            return $this->response->error('Email or password invalid!', 404);
        }
      } catch (JWTException $e) {
        return $this->response->error('Could not create token!', 500);
      } catch (TokenExpiredException $e) {
        return $this->response->error('Token error : '. $e->getCode(), 500);
      } catch (TokenInvalidException $e) {
        return $this->response->error('Token error : '. $e->getCode(), 500);
      }
      $user = $this->jwt->setToken($token)->authenticate();
      return response()->json([
        'token' => $token,
        'user' => [
          'name' => $user->name,
          'role' => $user->role->name
        ]
      ], 200);

    }

    public function logout(Request $request){
      $token = $this->jwt->getToken();
      $this->jwt->invalidate($token);
      return $this->response->error("The token is successfully removed", 200);
    }
}
