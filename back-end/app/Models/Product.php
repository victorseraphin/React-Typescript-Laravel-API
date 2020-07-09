<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Authenticatable
{
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'id','name', 'description', 'price', 'category','qty'
  ];
  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'created_at', 'updated_at',
  ];

  static function do_all(){
    $data = Product::orderby('id', 'asc')->get();
    return $data;
  }

  static function do_show($id){
    $data = Product::where('id',$id)->get();
    return $data;
  }

  static function do_save($request, $id = null){
    if($id){
      $data = Product::findOrFail($id);
    }else{
      $data = new Product;
    }
    $data->name  = $request['name'];
    $data->description  = $request['description'];
    $data->price  = $request['price'];
    $data->category  = $request['category'];
    $data->qty  = $request['qty'];
    $data->save();
    return $data;
  }

  static function do_delete($id){
    $data = Product::where('id',$id)->firstOrFail();
    $data->delete();
    return $data;
  }
}
