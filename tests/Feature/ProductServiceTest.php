<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test add product, it should persist add product and return product object correctly
     */
    public function testAdd(): void
    {
        $category = Category::factory()->create();

        $payload = [
            'sku' => 'abc',
            'name' => 'test product',
            'price' => 1000,
            'stock' => 1000,
            'categoryId' => $category->id,
        ];
        
        $product = (new ProductService())->add($payload);
        $count = Product::where('id', $product->id)->count();

        $this->assertNotEmpty($product->id);
        $this->assertEquals($product->sku, $payload['sku']);
        $this->assertEquals($product->name, $payload['name']);
        $this->assertEquals($product->price, $payload['price']);
        $this->assertEquals($product->stock, $payload['stock']);
        $this->assertEquals($product->category_id, $payload['categoryId']);
        $this->assertNotEmpty($product->created_at);
        $this->assertEquals($count, 1);
    }
}
