<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::with('parent')->get(); // Load categories with their parent category
        return view('categories.index', compact('categories'));
    }

    // Show form to create a new category
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get(); // Get top-level categories for the parent dropdown
        return view('categories.create', compact('parentCategories'));
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id', // Ensure parent_id exists in categories table
        ]);

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // Show the form to edit an existing category
    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')->get(); // Get top-level categories for parent dropdown
        return view('categories.edit', compact('category', 'parentCategories'));
    }

    // Update an existing category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        // Delete the category and its relationships
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}

