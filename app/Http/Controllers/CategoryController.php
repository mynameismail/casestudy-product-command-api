<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\RabbitMQService;

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

        $category = (new CategoryService())->add($validated);

        (new RabbitMQService())->publish('add_category', json_encode($category));

        return response()->json([
            'data' => new CategoryResource($category),
        ], 201);
    }
}
