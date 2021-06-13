<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::orderBy('date_time','desc')->orderby('updated_at','desc')->paginate(10);
        return response()->json($product,200);
    }
    public function show_category()
    {
        $products = Product::all();
        return response()->json($products,200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'date_time' => 'required'
        ]);
        $product = Product::create([
            'name'        =>  $request->name,
            'category'    =>  $request->category,
            'description' =>  $request->description,
            'date_time'   =>  $request->date_time
        ]);
        return response()->json([
            "message" => "save successfully"
        ],201);
    }
    public function search(Request $request)
    {
        $product = Product::where('name','LIKE',"%{$request->search}%")
        ->orWhere('description','LIKE',"%{$request->search}%")
        ->paginate(10);
        return response()->json($product,200);
    }
    public function edit($id)
    {
         $product = Product::findOrFail($id);
         return response()->json($product,200);
    }
    public function getCategory(Request $request){
        $product = Product::where('category',$request->category)->paginate(10);
        return response()->json($product,200);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'date_time' => 'required'
        ]);
        $product = Product::findOrFail($id)->update([
            'name'        =>  $request->name,
            'category'    =>  $request->category,
            'description' =>  $request->description,
            'date_time'   =>  $request->date_time
        ]);
        return response()->json([
            "message" => "Updated Successfully"
        ],201);
    }
    public function delete($id)
    {
        $product = Product::findOrFail($id)->delete();
        return response()->json(["message"=>"Delete Successfuly"],200);
    }
}
