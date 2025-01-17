<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function indexProduct()
    {
        $paginate = request()->query('paginate') ?? 10;
        $products = (new ProductRepository)->getProduct($paginate);
        return (new Response)->json(1, 'Success Get Data', 200, $products);
    }
    public function getProductByStore()
    {
        Log::info('Get All Product');

        $data = (new ProductRepository)->getProductByStore(auth()->user()->store->id);
        return (new Response)->json(1, 'Success Get Data By Store', 200, $data);
    }
    public function createProductPage()
    {
        return view('products.create');
    }
    public function insertProduct()
    {
        $payload = [
            'product_name' => request('product_name'),
            'product_price' => request('product_price'),
            'product_stock' => request('product_stock'),
            'store_id' => auth()->user()->store->id
        ];
        (new ProductRepository)->insertProduct($payload);
        return (new Response)->web(1, 'Success Insert Data');
    }
    public function updateProductPage($id)
    {
        $product = Product::find($id);
        return view('products.update', compact('product'));
    }
    public function updateProduct($id)
    {
        $payload = [
            'product_name' => request('product_name'),
            'product_price' => request('product_price'),
            'product_stock' => request('product_stock'),
        ];
        (new ProductRepository)->updateProduct($id, $payload);
        return (new Response)->web(1, 'Success Update Data Product with ID ' . $id);
    }

    public function deleteProduct($id)
    {
        (new ProductRepository)->deleteProduct($id);
        return (new Response)->web(1, 'Success Delete Data Product with ID ' . $id);
    }
}
