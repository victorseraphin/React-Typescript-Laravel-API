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
    $table = Product::orderby('id', 'asc')->get();
    return response()->json($table, 200);
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

    if($request['name'] ==  null){
      return response()->json(['message' => "Enter a name."], 404);
    }
    if($request['description'] ==  null){
      return response()->json(['message' => "Enter a description."], 404);
    }
    if($request['category'] ==  null){
      return response()->json(['message' => "Enter a category."], 404);
    }
    if($request['price'] ==  null){
      return response()->json(['message' => "Enter a price."], 404);
    }
    if($request['qty'] ==  null){
      return response()->json(['message' => "Enter a quantity."], 404);
    }

    $data = new Product;
    $data->name  = $request['name'];
    $data->description  = $request['description'];
    $data->price  = $request['price'];
    $data->category  = $request['category'];
    $data->qty  = $request['qty'];
    $data->save();

    if($data){
      return response()->json(['message' => 'Registration successfully.'], 200);
    }else{
      return response()->json(['message' => 'Problem registering new record.'], 404);
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
    $table = Product::where('id',$id)->get();
    return response()->json($table[0], 200);
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

    if($request['name'] ==  null){
      return response()->json(['message' => "Enter a name."], 404);
    }
    if($request['description'] ==  null){
      return response()->json(['message' => "Enter a description."], 404);
    }
    if($request['category'] ==  null){
      return response()->json(['message' => "Enter a category."], 404);
    }
    if($request['price'] ==  null){
      return response()->json(['message' => "Enter a price."], 404);
    }
    if($request['qty'] ==  null){
      return response()->json(['message' => "Enter a quantity."], 404);
    }

    $data = Product::findOrFail($id);
    $data->name  = $request['name'];
    $data->description  = $request['description'];
    $data->price  = $request['price'];
    $data->category  = $request['category'];
    $data->qty  = $request['qty'];
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
    $data = Product::where('id',$id)->firstOrFail();
    
    $data->delete();
    return response()->json(['message' => 'Registration deleted successfully.'], 200);

  }
}
