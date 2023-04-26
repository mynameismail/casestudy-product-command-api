<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;

class ProductModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test instance product, it should be instantiated and product created
     */
    public function test_models_can_be_instantiated(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create();
        $count = Product::count();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(1, $count);
    }

    /**
     * Test product belongs to, it should belongs to a category
     */
    public function test_product_belongs_to_category(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create();

        $this->assertNotEmpty($product->category);
    }
}
