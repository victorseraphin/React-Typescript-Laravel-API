<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $table = Product::do_all();
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
    $table = Product::do_show($id);
    return response()->json($table[0], 200);
  }

  /**
  * Validates input
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function validate_inputs($request)
  {
    if($request['name'] ==  null){
      return "Enter a name.";
    }
    if($request['description'] ==  null){
      return "Enter a description.";
    }
    if($request['category'] ==  null){
      return "Enter a category.";
    }
    if($request['price'] ==  null){
      return "Enter a price.";
    }
    if($request['qty'] ==  null){
      return "Enter a quantity.";
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
      $data = Product::do_save($request);
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
    $validate = $this->validate_inputs($request);
    if(!$validate){
      $data = Product::do_save($request, $id);
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
    $data = Product::do_delete($id);
    if($data){
      return response()->json(['message' => 'Registration deleted successfully.'], 200);
    }else{
      return response()->json(['message' => 'Problem deleting record.'], 404);
    }
  }
}
