<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository {
    public function getProduct($paginate = 10) {
        return Product::paginate($paginate);
    }
    public function insertProduct($data) {
        return Product::insert($data);
    }
    public function updateProduct($id, $data) {
        return Product::where('id', $id)->update($data);
    }
    public function deleteProduct($id) {
        return Product::where('id', $id)->delete();
    }
    public function getProductByStore($id) {
        return Product::where('store_id', $id)->get();
    }
}
