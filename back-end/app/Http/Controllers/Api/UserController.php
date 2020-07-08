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
    $table = User::get();
    return response()->json(['table' => $table], 200);
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
      return response()->json(['message' => 'Registration successfully.'], 200);
    }else{
      return response()->json(['message' => 'Problem registering new record!'], 404);
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $table = User::where('id',$id)->get();
    return response()->json(['table' => $table], 200);
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
    $verificar_email = User::where('email','=',$request['email'])->where('id','!=',$id)->first();
    if($verificar_email != null){
      return response()->json(['message' => "This email is already registered in the system."], 404);
    }
    if($request['name'] ==  null){
      return response()->json(['message' => "Enter a name."], 404);
    }
    if($request['email'] ==  null){
      return response()->json(['message' => "Enter an email."], 404);
    }
    if($request['password'] !=  null and $request['password_confirm'] !=  null){
      if($request['password'] ==  null){
        return response()->json(['message' => "Enter a password."], 404);
      }
      if($request['password_confirm'] ==  null){
        return response()->json(['message' => "Confirm your password."], 404);
      }
      if($request['password'] != $request['password_confirm']){
        return response()->json(['message' => "Password confirmation does not match the password!"], 404);
      }
    }

    $data = User::findOrFail($id);
    $data->name  = $request['name'];
    $data->email  = $request['email'];
    $data->password  = Hash::make($request['password']);
    $data->save();

    if($data){
      return response()->json(['message' => 'Registration changed successfully.'], 200);
    }else{
      return response()->json(['message' => 'Problem changing record.'], 404);
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
    $data = User::where('id',$id)->firstOrFail();
    $data->delete();

    if($data){
      return response()->json(['message' => 'Record deleted successfully.'], 200);
    }else{
      return response()->json(['message' => 'Registration cannot be deleted.'], 404);
    }
  }
}
