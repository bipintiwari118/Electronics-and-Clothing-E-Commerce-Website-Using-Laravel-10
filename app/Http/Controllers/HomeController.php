<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class HomeController extends Controller
{

    public function index(Request $request){
        $products=Product::all();
        $products_four=Product::orderBy('created_at', 'asc')->take(4)->get();

        if($request->ajax() && $request->action == "search-product"){
            $products_four=Product::where('sub_category_id',$request->sub_cat_id)->paginate(4);
        }

        $data['subcategories']=SubCategory::all();
        $data['products_four']=$products_four;
        $data['products']=$products;

        if($request->ajax() && $request->action == "search-product"){
            return view('front_product')->with($data);
        }

        return view('index')->with($data);
    }

    public function shop(Request $request){
        $products=Product::paginate(9);


        if($request->ajax()){
            if($request->sub_cat_id){
                $products=Product::where('sub_category_id',$request->sub_cat_id)->paginate(9);
            }
            if($request->cat_id){
                $products=Product::where('category_id',$request->cat_id)->paginate(9);
            }
            if($request->range){
                $products=Product::where('price','<=',$request->range)->paginate(9);
            }

        }

        $data['subcategories']=SubCategory::all();
        $data['categories']=Category::all();
        $data['products']=$products;

        if($request->ajax()){
            return view('shop_product')->with($data);
        }

        return view('shop')->with($data);
    }

    public function shopDetails($productId = null){
        $categories=Category::all();
        $products=Product::all();
        if (!$productId) {
            $product = Product::first(); // Get the first product
        } else {
            $product = Product::findOrFail($productId); // Otherwise, get the product by ID
        }
        return view('shopdetails', compact('product','categories','products'));

    }
}
