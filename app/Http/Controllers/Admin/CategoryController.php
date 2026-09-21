<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', ['categories' => Category::withCount('perfumes')->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:categories,name'], 'description' => ['nullable', 'string', 'max:1000']]);
        Category::create([...$data, 'slug' => Str::slug($data['name']), 'is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:categories,name,'.$category->id], 'description' => ['nullable', 'string', 'max:1000']]);
        $category->update([...$data, 'slug' => Str::slug($data['name']), 'is_active' => $request->boolean('is_active')]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->perfumes()->exists()) {
            return back()->with('error', 'Move or delete the perfumes in this category first.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted.');
    }
}
