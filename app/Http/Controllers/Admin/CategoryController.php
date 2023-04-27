<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'categories' => Category::select('id', 'title', 'description')->get(10),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return response([
            'category' => Category::create($request->validated()),
            'message' => trans('Category Created'),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response([
            'category' => $category,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response([
            'category' => $category->refresh(),
            'message' => trans('Category Updated'),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response([
            'message' => trans('Category Deleted'),
        ], 200);
    }
}
