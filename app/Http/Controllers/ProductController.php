<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function Index(Request $request){
        return view('product.index');
    }
    /**
     * Create Product
     *
     * @param Request $request
     * @return HTML form of product
     */
    public function CreateProduct(Request $request){
        return view('product.new-product');
    }
    public function CreateProductRequest(Request $request){
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|max:8',
            'image' => 'required|image',
        ]);
        $product = ProductModel::create($request->except(['image']));
        if($product){
            $imagePath = $request->file('image')->store('product-image','public');
            $product->image = $imagePath;
            $product->update();
        }
        return redirect()->route('product.edit',['id' => $product->id])->with(['successMessage' => "New Product Created"]);
    }
    public function EditProduct(Request $request,$id){
        $data = [];
        $data['product'] = ProductModel::find($id);
        if(!$data['product']){
            abort(404);
        }
        return view('product.edit-product',$data);
    }
    public function EditProductRequest(Request $request,$id){
        $product = ProductModel::find($id);
        if(!$product){
            abort(404);
        }
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|max:8'
        ]);
        $product->fill($request->except(['image']));
        if($request->file('image')){
            $imagePath = $request->file('image')->store('product-image','public');
            $product->image = $imagePath;
        }
        $product->update();
        return redirect()->route('product.edit',['id' => $product->id])->with(['successMessage' => "Product Updated"]);
    }
}
