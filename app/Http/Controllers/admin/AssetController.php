<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Asset | SMK IGAPIN',
            'assets' => Asset::orderBy('created_at', 'desc')->get(),
        ];
        return view('admin.assets.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Asset | SMK IGAPIN',
        ];
        return view('admin.assets.create', $data);
    }
}
