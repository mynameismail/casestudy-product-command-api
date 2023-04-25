<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test add category, it should persist add category and return category object correctly
     */
    public function testAdd(): void
    {
        $payload = [
            'name' => 'test category',
        ];

        $category = (new CategoryService())->add($payload);

        $this->assertNotEmpty($category->id);
        $this->assertEquals($category->name, $payload['name']);
        $this->assertNotEmpty($category->created_at);

        $count = Category::where('id', $category->id)->count();
        $this->assertEquals($count, 1);
    }
}
