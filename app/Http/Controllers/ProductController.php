<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
   //direct show product list
   public function list(){
    $pizzas = Product::orderBy('created_at', 'desc')->paginate(5);
    return view('admin.product.pizzaList', compact('pizzas'));

   }

   public function createPage(){
    $categories = Category::select('id', 'name')->get();
    
    return view('admin.product.create', compact('categories'));
   }

   //Create Pizza Product
   public function create(Request $request){
    $this->productValidationCheck($request);
    $data = $this->requestProductInfo($request);
    
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;
    
    Product::create($data);
    return redirect()->route('product#list');
   }


   //Request Product Info
   private function requestProductInfo($request){
    return [
        'category_id' => $request->pizzaCategory,
        'name' => $request->pizzaName,
        'description' => $request->pizzaDescription,
        'price' => $request->pizzaPrice,
        'waiting_time' => $request->pizzaWaitingTime,

    ];
   }

   //Validation Check
   private function productValidationCheck($request){
    Validator::make($request->all(), [
        'pizzaName' => 'required|min:5|unique:products,name',
        'pizzaCategory' => 'required',
        'pizzaDescription' => 'required|min:10',
        'pizzaImage' => 'required|mimes:jpg,jpeg,png,webp|file',
        'pizzaPrice' => 'required',
        'pizzaWaitingTime' => 'required'
    ])->validate();
   }
}
