<?php

namespace App\Http\Controllers\admin;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Detail_Asset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Asset | SMK IGAPIN',
            'assets_one_unit' => Asset::orderBy('created_at', 'desc')->where('unit', 'one-unit')->get(),
            'assets_many_unit' => Asset::orderBy('created_at', 'desc')->where('unit', 'many-unit')->get(),
        ];
        return view('admin.assets.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Asset | SMK IGAPIN',
            'categorys' => Category::orderBy('created_at', 'desc')->get(),
        ];
        return view('admin.assets.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'code_asset' => 'required',
            'stock'=> 'required',
            'name' => 'required',
            'type' => 'required',
            'category' => 'required',
            'added_date' => 'required',
            'description' => 'required',
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pic_payment' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->input('one_unit_many_unit') === 'one-unit') {
            $request->validate([
                'pic_payment' => 'required'
            ]);
        }

        // SIMPAN GAMBARNYA ASSET
        $picture_name = 'pic_'. Str::slug($request->name). '_' . time() . '.'. $request->file('picture')->getClientOriginalExtension();
        $request->file('picture')->move(public_path('assets/static/images/assets'), $picture_name);

        // SIMPAN GAMBAR BON
        if ($request->hasFile('pic_payment')) {
            $pic_payment_name = 'pic_payment_' . Str::slug($request->name) . '_' . time() . '.' . $request->file('pic_payment')->getClientOriginalExtension();
            $request->file('pic_payment')->move(public_path('assets/static/images/pic_payment'), $pic_payment_name);
        } else {
            $pic_payment_name = null;
        }


        $asset = Asset::create([
            'code_asset' => 'AI' . date('ymdHis'),
            'stock' => $request->stock,
            'name' => $request->name,
            'type' => $request->type,
            'id_category' => $request->category,
            'added_date' => $request->added_date,
            'description' => $request->description,
            'picture' => $picture_name,
            'pic_payment' => $pic_payment_name,
            'status' => 'Available',
            'unit' => $request->one_unit_many_unit
        ]);

        // PROSES TAMBAH DETAIL
        if ($request->one_unit_many_unit == 'one-unit') {
            if ($request->details) {
                foreach($request->details as $detail) {
                    Detail_Asset::create([
                        'id_asset' => $asset->id,
                        'title' => $detail['title'],
                        'description' => $detail['description'],
                    ]);
                }
            }
        }

        return redirect()->route('asset')->with('success', 'Asset berhasil ditambahkan!');
    }

    public function detail($code)
    {
        $asset = Asset::where('code_asset', $code)->firstOrFail();

        $data = [
            'title' => $asset->name . '| SMK IGAPIN',
            'asset' => $asset,
            'details' => Detail_Asset::where('id_asset', $asset->id)->get()
        ];
        return view('admin.assets.detail', $data);
    }

    public function edit($code)
    {
        $asset = Asset::where('code_asset', $code)->firstOrFail();

        $data = [
            'title' => 'Edit Asset | SMK IGAPIN',
            'asset' => Asset::where('code_asset', $code)->firstOrFail(),
            'categorys' => Category::orderBy('created_at', 'desc')->get(),
            'detailAssets' => Detail_Asset::where('id_asset', $asset->id)->get(),
        ];
        return view('admin.assets.edit', $data);
    }

    public function update(Request $request, $id)
    {

        // dd($request->detailNow);

        $asset = Asset::find($id);

        $request->validate([
            'stock' => 'sometimes',
            'name' => 'required',
            'type' => 'required',
            'category' => 'required',
            'added_date' => 'required',
            'description' => 'required',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($asset->unit == 'many-unit') {
            $request->validate([
                'stock' => 'required'
            ]);
        }


        if ($asset->unit == 'one-unit') {
            $stock = 1;
        } else {
            $stock = $request->stock;
        }

        $picture_name = $asset->picture;
        if ($request->hasFile('picture')) {
            $picture_name = 'pic_' . Str::slug($request->name) . '_' . time() . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(public_path('assets/static/images/assets'), $picture_name);

            unlink(public_path('assets/static/images/assets/' . $asset->picture));
        }

        $asset = Asset::find($id)->update([
            'stock' => $stock,
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'added_date' => $request->added_date,
            'description' => $request->description,
            'picture' => $picture_name,
        ]);


        // PROSES TAMBAH DETAIL
        if ($request->one_unit_many_unit == 'one-unit') {

            if($request->detailNow) {
                foreach ($request->detailNow as $detail) {
                    Detail_Asset::find($detail['id'])->update([
                        'title' => $detail['detailNow-title'],
                        'description' => $detail['detailNow-description'],
                    ]);
                }
            }


            if ($request->details) {
                foreach ($request->details as $detail) {
                    Detail_Asset::create([
                        'id_asset' => $asset->id,
                        'title' => $detail['title'],
                        'description' => $detail['description'],
                    ]);
                }
            }
        }

        return redirect()->route('asset')->with('success', 'Asset berhasil diupdate!');
    }

    public function delete($id)
    {
        $asset = Asset::find($id);
        $asset->delete();

        return redirect()->route('asset')->with('success', 'Asset berhasil dihapus!');
    }
}
