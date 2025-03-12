<?php

namespace App\Http\Controllers\user;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\User_Ownership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ModelRequest;

class IssueController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Issue | SMK IGAPIN',
            'issues' => ModelRequest::orderBy('created_at', 'desc')->whereNotIn('status', ['Selesai', 'Ditolak'])->where('division_name', null)->get()
        ];
        return view('user.issue.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Issue Create | SMK IGAPIN',
            'ownerships' => User_Ownership::where('id_user', Auth::user()->id)->where('status', '!=', 'Issue')->get(),
        ];
        return view('user.issue.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'asset' => 'required',
            'description' => 'required|min:50'
        ]);

        User_Ownership::where('id_asset', $request->asset)->where('status', 'Owned')->update([
            'status' => 'Issue'
        ]);

        ModelRequest::create([
            'id_user' => Auth::user()->id,
            'type' => $request->type,
            'id_asset' => $request->asset,
            'status' => 'Menunggu Konfirmasi',
            'description' => $request->description
        ]);

        return redirect()->route('issue')->with('success', 'Berhasil menambahkan permintaan!');
    }

    public function edit($code_asset)
    {
        $asset = Asset::where('code_asset', $code_asset)->firstOrFail();

        $data = [
            'title' => 'Edit Issue | SMK IGAPIN',
            'issue' => ModelRequest::where('id_asset', $asset->id)->where('status', 'Menunggu Konfirmasi')->firstOrFail(),
            'ownerships' => User_Ownership::where('id_user', Auth::user()->id)->get(),
        ];
        return view('user.issue.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'asset' => 'required',
            'description' => 'required|min:50'
        ]);

        ModelRequest::where('id', $id)->update([
            'type' => $request->type,
            'id_asset' => $request->asset,
            'description' => $request->description
        ]);

        return redirect()->route('issue')->with('success', 'Issue berhasil diedit!');
    }
}
