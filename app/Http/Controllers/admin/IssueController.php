<?php

namespace App\Http\Controllers\admin;

use App\Models\Asset;
use App\Models\Division_Ownership;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ModelRequest;
use App\Models\User_Ownership;

class IssueController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Issue | SMK IGAPIN',
            'issues' => ModelRequest::orderBy('created_at', 'desc')->whereNotIn('status', ['Selesai', 'Ditolak'])->get()
        ];
        return view('admin.issue.index', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        $modelRequest = ModelRequest::where('id', $id)->first();

        ModelRequest::where('id', $id)->update([
            'status' => $request->status,
            'id_admin' => Auth::user()->id
        ]);

        if ($request->status == 'Ditolak') {
            if(User_Ownership::where('id_asset', $modelRequest->asset->id)->where('status', 'Issue')->first()) {
                User_Ownership::where('id_asset', $modelRequest->asset->id)->where('status', 'Issue')->update([
                    'status' => 'Owned'
                ]);
            } else {
                Division_Ownership::where('id_asset', $modelRequest->asset->id)->where('status', 'Issue')->update([
                    'status' => 'Owned'
                ]);
            }
        }

        return redirect()->route('admin.issue')->with('success', 'Konfirmasi '. $request->status .' dikirim!');
    }

    public function repair($code)
    {
        $asset = Asset::where('code_asset', $code)->firstOrFail();

        $data = [
            'title' => 'Repair | SMK IGAPIN',
            'issue' => ModelRequest::where('id_asset', $asset->id)->where('status', 'Proses')->firstOrFail(),
        ];
        return view('admin.issue.repair', $data);
    }

    public function repairUpdate(Request $request, $id)
    {
        $request->validate([
            'solution_pic' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $requestAsset = ModelRequest::where('id', $id)->firstOrFail();

        if (User_Ownership::where('id_asset', $requestAsset->id_asset)->where('id_user', $requestAsset->id_user)->where('status', 'Issue')->first()) {
            User_Ownership::where('id_asset', $requestAsset->id_asset)->where('id_user', $requestAsset->id_user)->where('status', 'Issue')->update([
                'status' => 'Owned',
            ]);
        } else {
            Division_Ownership::where('id_asset', $requestAsset->id_asset)->where('status', 'Issue')->update([
                'status' => 'Owned',
            ]);
        }


        // PROSES GAMBAR
        $pic_name = 'pic_solution_' .  Str::slug($requestAsset->asset->name) . '_' . time() . '.' . $request->file('solution_pic')->getClientOriginalExtension();
        $request->file('solution_pic')->move(public_path('assets/static/images/solution_pic/'), $pic_name);

        ModelRequest::where('id', $id)->update([
            'status' => 'Selesai',
            'solution_pic' => $pic_name,
        ]);

        return redirect()->route('admin.issue')->with('success', 'Upload Bukti Perbaikan berhasil!');
    }
}
