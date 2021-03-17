<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ProductController extends Controller
{
    private $ppp = 3;
    /**
     * Create product from request
     *
     * @param Request $request
     * @return json
     */
    public function CreateProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|max:8',
            'image' => 'required|image',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => $validator->errors()
            ]);
        }
        $product = ProductModel::create($request->except(['image']));
        if($product){
            $imagePath = $request->file('image')->store('product-image','public');
            $product->image = $imagePath;
            $product->update();
        }
        return response()->json([
            'type' => 'success' , 
            'message' => ["Product Created"],
            'product' => $product
        ]);
    }
    public function AllProducts(Request $request){
        $products = ProductModel::orderBy('id','desc')->paginate($this->ppp);
        return response()->json($products);
    }
    public function DeleteProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => "Product id Requried"
            ]);
        }
        $product = ProductModel::find($request->input('id'));
        if(!$product){
            return response()->json([
                'type' => 'error',
                'message' => "Product Not Found!"
            ]);
        }
        if($product->delete()){
            return response()->json([
                'type' => 'success',
                'message' => "Product Deleted!"
            ]);
        }
    }
    /**
     * Get Product by id
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function getProduct(Request $request, $id){
        $product = ProductModel::find($id);
        return response()->json($product);
    }
    public function EditProduct(Request $request,$id){
        $product = ProductModel::find($id);
        if(!$product){
            return response()->json([
                'type' => 'error',
                'message' => "No Product Found!"
            ]);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|max:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'error',
                'message' => $validator->errors()
            ]);
        }
        $product->fill($request->except(['image']));
        if($request->file('image')){
            $imagePath = $request->file('image')->store('product-image','public');
            $product->image = $imagePath;
        }
        $product->update();
        return response()->json([
            'type' => 'success' , 
            'message' => ["Product Updated"],
            'product' => $product
        ]);
    }

}
