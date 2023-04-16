<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $rules = [
            'sku' => 'required|string|max:255|unique:products,sku',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'categoryId' => 'required|uuid',
        ];
        $messages = [
            'required' => ':attribute is empty',
            'string' => ':attribute must be a string',
            'max' => ':attribute length must not more than :max characters',
            'unique' => ':attribute is unique',
            'integer' => ':attribute must be a number',
            'min' => ':attribute must not negative',
            'uuid' => ':attribute must be a UUID',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validated();

        $sku = $validated['sku'];
        $name = $validated['name'];
        $price = $validated['price'];
        $stock = $validated['stock'];
        $categoryId = $validated['categoryId'];
        $createdAt = time();

        $product = new Product;
        $product->sku = $sku;
        $product->name = $name;
        $product->price = $price;
        $product->stock = $stock;
        $product->category_id = $categoryId;
        $product->created_at = $createdAt;
        $product->save();

        return response()->json([
            'data' => new ProductResource($product),
        ]);
    }
}
