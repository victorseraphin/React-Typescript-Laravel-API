<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  /**
  * Get a JWT token via given credentials.
  *
  * @param  \Illuminate\Http\Request  $request
  *
  * @return \Illuminate\Http\JsonResponse
  */
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');
    if ($token = auth('api')->attempt($credentials)) {
      return $this->respondWithToken($token);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
  }
  public function register(Request $request)
  {
    $request = $request->json()->all();

    $verificar_email = User::where('email','=',$request['email'])->first();
    if($verificar_email != null){
      return response()->json(['message' => "This email is already registered in the system!"], 404);
    }
    if($request['name'] ==  null){
      return response()->json(['message' => "Enter a name."], 404);
    }
    if($request['email'] ==  null){
      return response()->json(['message' => "Enter an email."], 404);
    }
    if($request['password'] ==  null){
      return response()->json(['message' => "Enter a password."], 404);
    }
    if($request['password_confirm'] ==  null){
      return response()->json(['message' => "Confirm your password."], 404);
    }
    if($request['password'] != $request['password_confirm']){
      return response()->json(['message' => "Password confirmation does not match password!"], 404);
    }

    $data = new User;
    $data->name  = $request['name'];
    $data->email  = $request['email'];
    $data->password  = Hash::make($request['password']);
    $data->save();

    if($data){
      $credentials = array(
        "email" => $request['email'],
        "password" => $request['password']
      );

      if ($token = auth('api')->attempt($credentials)) {
        return $this->respondWithToken($token);
      }
    }else{
      return response()->json(['message' => 'Problem registering new record!'], 404);
    }
  }
  /**
  * Log the user out (Invalidate the token)
  *
  * @return \Illuminate\Http\JsonResponse
  */
  public function logout()
  {
    auth('api')->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }
  public function me()
  {
    return response()->json(auth('api')->user());
  }
  public function refresh()
  {
    return $this->respondWithToken(auth('api')->refresh());
  }


  /**
  * Get the token array structure.
  *
  * @param  string $token
  *
  * @return \Illuminate\Http\JsonResponse
  */
  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60
    ],200);
  }
}
