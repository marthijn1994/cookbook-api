<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * @return object
     */
    public function index(): object
    {
        return CategoryResource::collection(
            Category::parents()->ordered()->with('children')->get()
        );
    }

}
