<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(20);
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:categories,name'],
            'is_active' => ['nullable','boolean'],
        ]);

        Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success','Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255','unique:categories,name,'.$category->id],
            'is_active' => ['nullable','boolean'],
        ]);

        $category->update([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'is_active' => (bool) $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success','Category updated.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Category deleted.');
    }
}

