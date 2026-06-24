<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('items')->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori sudah ada.',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori sudah ada.',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->items()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki barang!');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
