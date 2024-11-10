<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    public function index(){
        $products=Product::with(['category', 'subcategory'])->paginate(10);
        return view('admin-panel.products.list',compact('products'));
    }
    public function create(){
        $categories=Category::all();
        $sub_categories=SubCategory::all();
        return view('admin-panel.products.create',compact('categories','sub_categories'));
    }
    public function store(Request $request){
        if($request->file('image')){
            $image=$request->file('image');
            $img_name=time().rand(100000,900000).$image->getClientOriginalName();
            $image->move('uploads/products/',$img_name);
            $img_name='uploads/products/'.$img_name;
        }
        $product=new Product();
        $product->title=$request->title;
        $product->price=$request->price;
        $product->discount_price=$request->discount_price;
        $product->description=$request->description;
        $product->category_id=$request->category_id;
        $product->sub_category_id=$request->sub_category_id;
        $product->image=$img_name ?? null;
        $product->save();
        return redirect('products/list');

    }

    public function addCart(Request $request){

        $cart=Cart::where('user_id',Auth::id())->where('product_id',$request->prod_id)->first();
        if(!$cart){
            $cart=new Cart();
            $cart->product_id=$request->prod_id;
            $cart->user_id= Auth::id();
            $cart->save();
        }

        $cart_count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        return response()->json(['success'=>true, 'cart_count'=>$cart_count ,'message'=>'Product added to cart successfully.']);
    }

    public function cart(){
        $carts=Cart::where('user_id',Auth::id())->get();

        return view('cart',compact('carts'));
    }


    public function updateCart(Request $request){

        $cart=Cart::find($request->cart_id);

            $cart->quantity=$request->quantity;
            $cart->save();


        $cart_count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        return response()->json(['success'=>true, 'cart_count'=>$cart_count,'message'=>' Cart Updated successfully.']);
    }

    public function removeCart(Request $request){
        $cart=Cart::find($request->cart_id);

        $cart->delete();
        $cart_count = Auth::check() ? Cart::where('user_id', Auth::id())->count() : 0;
        return response()->json(['success'=>true, 'cart_count'=>$cart_count,'message'=>'Product remove successfully.']);

    }

    public function totalPayout(Request $request){
        $carts=  Cart::where('user_id', Auth::id())->get();
        $total_payout=0;
        foreach($carts as $cart){
            $total_payout=$total_payout + ($cart->quantity * $cart->product->discount_price);
        };


        return response()->json(['success'=>true, 'total_payout'=>$total_payout]);

    }

    public function checkOut(){
        $carts=Cart::where('user_id',Auth::id())->where('quantity','!=',0)->get();
        $total_payout=0;
        foreach($carts as $cart){
            $total_payout=$total_payout + ($cart->quantity * $cart->product->discount_price);
        };

        return view('checkout',compact('carts','total_payout'));
    }


}
