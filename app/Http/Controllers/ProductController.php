<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProducts()
    {
        $paginate = request()->query('paginate') ?? 10;
        $products = Product::paginate($paginate);
        return response()->json($products);
    }

    public function insertProduct()
    {
        $product = Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'stock' => request('stock'),
        ]);
        return response()->json($product);
    }

    public function updateProduct($id)
    {
        $product = Product::find($id);
        $product->name = request('name');
        $product->price = request('price');
        $product->stock = request('stock');
        $product->save();
        return response()->json($product);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json($product);
    }
}
