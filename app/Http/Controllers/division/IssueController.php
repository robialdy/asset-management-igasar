<?php

namespace App\Http\Controllers\division;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\Division_Ownership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ModelRequest;

class IssueController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Issue | SMK IGAPIN',
            'issues' => ModelRequest::orderBy('created_at', 'desc')->whereNotIn('status', ['Selesai', 'Ditolak'])->where('division_name', Auth::user()->division->name)->get()
        ];
        return view('division.issue.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Issue |  SMK IGAPIN',
            'ownerships' => Division_Ownership::where('id_division', Auth::user()->id_division)->whereNotIn('status', ['Issue', 'Deleted'])->get()
        ];

        return view('division.issue.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'asset' => 'required',
            'description' => 'required|min:50'
        ]);

        Division_Ownership::where('id_asset', $request->asset)->where('status', 'Owned')->update([
            'status' => 'Issue'
        ]);

        ModelRequest::create([
            'id_user' => Auth::user()->id,
            'division_name' => Auth::user()->division->name,
            'type' => $request->type,
            'id_asset' => $request->asset,
            'status' => 'Menunggu Konfirmasi',
            'description' => $request->description
        ]);

        return redirect()->route('division.issue', Auth::user()->division->name)->with('success', 'Berhasil menambahkan permintaan!');
    }

    public function edit($division, $code_asset)
    {
        $asset = Asset::where('code_asset', $code_asset)->firstOrFail();

        $data = [
            'title' => 'Edit Issue | SMK IGAPIN',
            'issue' => ModelRequest::where('id_asset', $asset->id)->where('status', 'Menunggu Konfirmasi')->firstOrFail(),
            'ownerships' => Division_Ownership::where('id_division', Auth::user()->id_division)->whereNotIn('status', ['Deleted'])->get(),
        ];
        return view('division.issue.edit', $data);
    }

    public function update(Request $request, $division, $id)
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

        return redirect()->route('division.issue', Auth::user()->division->name)->with('success', 'Issue berhasil diedit!');
    }
}
