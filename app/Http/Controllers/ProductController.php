<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    public function index()
    {
        return Product::all();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'description' => 'required|max:250',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }


    public function show($id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json('Product Not Found');
        }
        return response()->json($product, 200);
    }

    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'description' => 'required|max:250',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $existingProduct = Product::find($id);
        $existingProduct->update($request->all());
        return response()->json($existingProduct, 200);
    }

    
    public function destroy($id)
    {
        $existingProduct = Product::find($id);
        $existingProduct->delete();
        return response()->json(null, 204);
    }
}
