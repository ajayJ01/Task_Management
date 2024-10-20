<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::get();
        return view('category.index', compact('category'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $create = Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('category.create')->with('success', 'Category created successfully!');

        } catch (\Exception $e) {
            \Log::error('Category creation failed: ' . $e->getMessage());
            return redirect()->route('category.create')->with('error', 'Category not created due to an error.');
        }
    }

}
