<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{

    /**
     *
     */
    public function test_it_returns_a_collection_of_categories(): void
    {
        $categories = factory(Category::class, 2)->create();

        $this->getJson('api/categories')
            ->assertJsonFragment(
                [
                    'slug' => $categories->get(0)->slug
                ],
                [
                    'slug' => $categories->get(1)->slug
                ]
            );
    }

}
