<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function add($payload): Product
    {
        $product = new Product;
        $product->sku = $payload['sku'];
        $product->name = $payload['name'];
        $product->price = $payload['price'];
        $product->stock = $payload['stock'];
        $product->category_id = $payload['categoryId'];
        $product->created_at = time();
        $product->save();

        return $product;
    }
}
