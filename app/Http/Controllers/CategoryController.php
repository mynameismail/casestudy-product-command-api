<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];
        $messages = [
            'required' => ':attribute is empty',
            'string' => ':attribute must be a string',
            'max' => ':attribute length must not more than :max characters',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $validated = $validator->validated();

        $id = Str::uuid();
        $name = $validated['name'];
        $createdAt = time();

        $category = new Category;
        $category->name = $name;
        $category->created_at = $createdAt;
        $category->save();

        return response()->json([
            'data' => [
                'id' => $category->id,
                'name' => $name,
                'createdAt' => $createdAt,
            ],
        ]);
    }
}
