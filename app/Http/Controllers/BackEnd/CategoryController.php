<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index()
    {
        $layout_data=LandingPage::first();
        $page_name = 'Category';
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('backEnd.category.index', compact(['page_name','layout_data', 'categories']));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the input (without slug)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,block',
        ]);

        // Generate a slug from the name
        $slug = Str::slug($validatedData['name']);

        // Ensure slug is unique by appending a number if needed
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Add the slug to validated data
        $validatedData['slug'] = $slug;
        // Create the Category
        $category = Category::create($validatedData);
        // Response based on the event creation
        if ($category) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['name']} Category added successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['name']} Category added successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['name']} Category added successfully."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Category not added!',
            ], 500);
        }
    }
    public function edit($id)
    {
        $layout_data=LandingPage::first();
        $category = Category::findOrFail($id);
        if ($category) {
            $page_name = 'Category-Edit';
            return view('backEnd.category.edit', compact(['page_name','layout_data', 'category']));
        }
    }
    public function update(Request $request)
    {
        // Find the Category
        $category = Category::findOrFail($request->id);

        // Validate the input (without slug)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,block',
        ]);

        // Update the Category record
        $category->update($validatedData);

        // Response based on the update operation
        if ($category) {
            session()->flash('success', [
                'icon' => 'success',
                'name' => "{$validatedData['name']} Category updated successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "{$validatedData['name']} Category updated successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "{$validatedData['name']} Category update failed."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Category update failed!',
            ], 500);
        }
    }
    
    public function delete(Request $request)
    {
        // Find the event
        $Category = Category::findOrFail($request->Category_id);
        if ($Category) {
            // Delete the event
            $Category->delete();
            session()->flash('success', [
                'icon' => 'success',
                'name' => "Category deleted successfully."
            ]);
            return response()->json([
                'status' => true,
                'message' => "Category deleted successfully.",
            ]);
        } else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Category not found."
            ]);
            return response()->json([
                'status' => false,
                'message' => 'Category not found.',
            ], 500);
        }
    }
}
