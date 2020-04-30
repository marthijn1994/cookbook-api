<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    /**
     *
     */
    public function test_it_has_many_children(): void
    {
        $category = factory(Category::class)->create();
        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    /**
     *
     */
    public function test_it_can_fetch_only_parents(): void
    {
        $category = factory(Category::class)->create();
        $category->children()->save(
            factory(Category::class)->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }

    /**
     *
     */
    public function test_it_is_orderable_by_a_numbered_order(): void
    {
        $category = factory(Category::class)->create(['order' => 2]);
        $anotherCategory = factory(Category::class)->create(['order' => 1]);

        $this->assertEquals($anotherCategory->name, Category::ordered()->first()->name);
    }

}
