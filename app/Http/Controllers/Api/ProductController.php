<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //return Product::all();
        return response(Product::all() , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $product = Product::create($input);

        return response([
            'data' => $product,
            'message' => 'product created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
        $product->update($input);


        return response([
            'data' => $product,
            'message' => 'product updated'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response([
            "message" =>"product silindi"
        ]);
    }
    public function custom1(){
        //return Product::select('id','name','price')->orderBy('created_at','desc')->take(5)->get();
        return Product::selectRaw('id as product_id,name as product_name')->orderBy('created_at','desc')->take(5)->get(); //isimleri özelleştirmek için
    }

    public function custom2(){

        $products= Product::orderBy('created_at','desc')->take(5)->get(); //2.yöntem isimleri özelleştirmek için
        $mapped=$products->map(function ($product){
            return [
                'product_id' =>$product['id'],
                'product_name' =>$product['name'],
                'product_price' =>$product['price'] * 1.03
            ];
        });

        return $mapped->all();
    }
    public function report1(){
        return DB::table('category_products as cp')
            ->selectRaw('c.name, COUNT(*) as total')
            ->join('categories as c', 'c.id', '=', 'cp.category_id')
            ->join('products as p', 'p.id', '=', 'cp.product_id')
            ->groupBy('c.name')
            ->orderByRaw('COUNT(*) DESC')
            ->get();
    }
}
