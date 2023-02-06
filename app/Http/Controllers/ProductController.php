<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->filter(request(['search']))
                            ->where('warehouse_quantity', '!=', 0)
                            ->where('store_quantity', '!=', 0)
                            ->get();
        $p = collect();

        foreach ($products as $j=>$product){
            $prices = explode(".", $product->price);
            $kg = explode(".", $product->kg);
            $store_quantity = explode(".", $product->store_quantity);
            $warehouse_quantity = explode(".", $product->warehouse_quantity);
            

            foreach($prices as $i=>$price){
                $product->price = $prices[$i];
                $product->kg = $kg[$i];
                $product->store_quantity = $store_quantity[$i];
                $product->warehouse_quantity = $warehouse_quantity[$i];
                $p->push($product->toArray());

            }
        }


        return view('admin.products.index', [
            'products' => $p
        ]);
    }
}
