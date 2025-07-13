<?php

namespace App\Http\Controllers\Dashboard; // Keep this namespace for your controller


use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryPutRequest; // For the update method
use App\Http\Requests\Category\MyNewCategoryRequest as CatStoreRequest; // IMPORTANT: Changed alias for clarity with Category controller


// Needed if you uncomment image handling and logging (though not currently active in update method)
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $categories = Category::paginate(4);

    // This is equivalent and often preferred for brevity
    return view('dashboard.category.index', compact('categories'));
}

    public function create()
    {
        $category = new Category();
        return view('dashboard.category.create', compact('categories'));
    }

    // IMPORTANT: Use the correct alias for the Store Request
     public function store(CatStoreRequest $request)
    {
        Category::create($request->validated());
        // Redirect to category.index after storing
        return to_route('category.index')->with('success', 'Categoría creada exitosamente!');
    }

    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'));
    }

   public function edit(Category $category) // <--- Corrected: Changed $categories to $category (singular)
{
    // Assuming you just need the single category for editing:
    return view('dashboard.category.edit', compact('category')); // <--- Corrected: compact('category')

    // If you also need all categories for a dropdown (e.g., for a parent category selection):
    // $allCategories = Category::pluck('title', 'id'); // Renamed to avoid confusion with the single $category
    // return view('dashboard.category.edit', compact('category', 'allCategories'));
}
    /**
     * Update the specified resource in storage.
     */
    // IMPORTANT: Use CategoryPutRequest here, not PutRequest if it's for Category
    public function update(CategoryPutRequest $request, Category $category) // Ensure CategoryPutRequest is used
    {
        $category->update($request->validated());
        return to_route('category.index')->with('success', 'Categoría actualizada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // Redirect to the index page after deletion
        return to_route('category.index')->with('success', 'Categoría eliminada exitosamente!');
    }
}