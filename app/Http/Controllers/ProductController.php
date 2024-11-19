<?php


namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display the form to create a product
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Destroy a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Remove product from the database
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    // Store a new product
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        'categories' => 'required|array',
    ]);

    // Store the product image
    $imagePath = $request->file('image')->store('products', 'public');

    // Create the product
    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    // Sync categories
    $product->categories()->sync($request->categories);

    return response()->json(['success' => true]);
    }

    // Display products with filters and pagination
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply category filter if provided
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Apply price sorting if provided
        if ($request->has('sort_by_price')) {
            $query->orderBy('price', $request->sort_by_price);
        }

        // Paginate the products
        $products = $query->with('categories')->paginate(10); // Eager load categories

        // Get all categories for the filter dropdown
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // API endpoint for fetching products (with filters and sorting)
    public function apiIndex(Request $request)
    {
        $query = Product::query();

        // Apply category filter if provided
        if ($request->has('category') && $request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Apply price sorting if provided
        if ($request->has('sort_by_price')) {
            $query->orderBy('price', $request->sort_by_price);
        }

        // Fetch and return products as JSON
        $products = $query->with('categories')->get();

        return response()->json($products);
    }
}
