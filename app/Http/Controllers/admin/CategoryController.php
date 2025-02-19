<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Category | SMK IGAPIN',
            'categorys' => Category::orderBy('created_at','desc')->get(),
        ];
        return view('admin.category.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Category | SMK IGAPIN',
        ];
        return view('admin.category.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return redirect()->route('category')->with('success', 'Category Berhasil Ditambahkan');
    }

    public function edit($name)
    {
        $data = [
            'title' => 'Create Category | SMK IGAPIN',
            'category' => Category::where('name', $name)->firstOrFail(),
        ];
        return view('admin.category.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::where('id', $id)->firstOrFail()->update([
            'name' => $request->name
        ]);
        return redirect()->route('category')->with('success', 'Category Berhasil Diupdate');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category')->with('success', 'Category Berhasil Dihapus');
    }
}



