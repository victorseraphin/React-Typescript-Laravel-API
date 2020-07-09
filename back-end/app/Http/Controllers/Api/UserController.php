<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $table = User::do_all();
    return response()->json($table, 200);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $table = User::do_show($id);
    return response()->json($table[0], 200);
  }

  /**
  * Validates input
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function validate_inputs($request, $id = null)
  {
    if($id){
      $verificar_email = User::where('email','=',$request['email'])->where('id','!=',$id)->first();
    }else{
      $verificar_email = User::where('email','=',$request['email'])->first();
    }
    if($verificar_email != null){
      return "This email is already registered in the system!";
    }
    if($request['name'] ==  null){
      return "Enter a name.";
    }
    if($request['email'] ==  null){
      return "Enter an email.";
    }
    if($request['password'] ==  null){
      return "Enter a password.";
    }
    if($request['password_confirm'] ==  null){
      return "Confirm your password.";
    }
    if($request['password'] != $request['password_confirm']){
      return "Password confirmation does not match password!";
    }
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $request = $request->json()->all();
    $validate = $this->validate_inputs($request);
    if(!$validate){
      $data = User::do_save($request);
      if($data){
        return response()->json(['message' => 'Registration successfully.'], 200);
      }else{
        return response()->json(['message' => 'Problem registering new record.'], 404);
      }
    }else{
      return response()->json(['message' => $validate], 404);
    }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $request = $request->json()->all();
    $validate = $this->validate_inputs($request, $id);
    if(!$validate){
      $data = User::do_save($request, $id);
      if($data){
        return response()->json(['message' => 'Registration changed successfully.'], 200);
      }else{
        return response()->json(['message' => 'Problem changing record.'], 404);
      }
    }else{
      return response()->json(['message' => $validate], 404);
    }
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    if($id =! 1){
      $data = User::do_delete($id);
      if($data){
        return response()->json(['message' => 'Registration deleted successfully.'], 200);
      }else{
        return response()->json(['message' => 'Problem deleting record.'], 404);
      }
    }else{
      return response()->json(['message' => 'This user cannot be deleted.'], 404);
    }
  }
}
