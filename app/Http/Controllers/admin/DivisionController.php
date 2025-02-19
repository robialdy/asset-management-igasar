<?php

namespace App\Http\Controllers\admin;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Divisi | SMK IGAPIN',
            'divisions' => Division::orderBy('created_at','desc')->get(),
        ];
        return view('admin.division.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Divisi | SMK IGAPIN',
        ];
        return view('admin.division.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:division',
            'description' => 'required'
        ]);

        Division::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('division')->with('success', 'Divisi Berhasil Ditambahkan!');
    }

    public function edit($name)
    {
        $data = [
            'title' => 'Edit Divisi | SMK IGAPIN',
            'division' => Division::where('name', $name)->firstOrFail(),
        ];
        return view('admin.division.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => [
                'required',
                Rule::unique('division')->ignore($id)
            ],
            'description' => 'required',
        ]);

        Division::where('id', $id)->firstOrFail()->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('division')->with('success', 'Divisi Berhasil Diupdate!');
    }

    public function delete($id)
    {
        $division = Division::findOrFail($id);
        $division->delete();

        return redirect()->route('division')->with('success', 'Divisi Berhasil Dihapus!');
    }
}
