<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test instance category, it should be instantiated and category created
     */
    public function test_models_can_be_instantiated(): void
    {
        $category = Category::factory()->create();
        $count = Category::count();

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals(1, $count);
    }
}
