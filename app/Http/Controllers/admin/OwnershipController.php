<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Detail_Asset;
use App\Models\Division;
use App\Models\Division_Ownership;
use App\Models\User;
use App\Models\User_Ownership;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class OwnershipController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Ownership | SMK IGAPIN',
            'asset_users' => User_Ownership::orderBy('created_at', 'desc')->where('return_at', '=', null)->get(),
            'asset_divisions' => Division_Ownership::orderBy('created_at', 'desc')->where('return_at', '=', null)->get(),
        ];
        return view('admin.ownership.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Ownership | SMK IGAPIN',
            'users' => User::where('role', 'Staff')->get(),
            'assets' => Asset::where('unit', 'one-unit')->where('status', 'Available')->get(),
            'divisions' => Division::get(),
        ];
        return view('admin.ownership.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'ownership' => 'required',
            'id_asset' => 'required',
            'added_date' => 'required',
        ];

        if ($request->route == 'guru-staff') {
            $rules['attachment'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        $request->validate($rules);

        if ($request->route == 'guru-staff') {
            if ($request->hasFile('attachment')) {
                $attachment = 'pic_attachment_' . time() . '.' . $request->file('attachment')->getClientOriginalExtension();
                $request->file('attachment')->move(public_path('assets/static/images/attachment'), $attachment);
            } else {
                $attachment = null;
            }

            User_Ownership::create([
                'id_user' => $request->ownership,
                'id_asset' => $request->id_asset,
                'added_date' => $request->added_date,
                'attachment' => $attachment
            ]);

            Asset::find($request->id_asset)->update([
                'status' => 'Owned'
            ]);
        } elseif ($request->route == 'division') {
            Division_Ownership::create([
                'id_division' => $request->ownership,
                'id_asset' => $request->id_asset,
                'added_date' => $request->added_date,
            ]);

            Asset::find($request->id_asset)->update([
                'status' => 'Owned'
            ]);
        } else {
            echo 'belum jadi';
        }

        return redirect()->route('ownership')->with('success', 'Kepemilikan Asset berhasil ditambahkan!');
    }

    public function edit($code)
    {
        $asset = Asset::where('code_asset', $code)->firstOrFail();

        $asset_in_user = User_Ownership::where('id_asset', $asset->id)->first();
        $asset_in_division = Division_Ownership::where('id_asset', $asset->id)->first();

        if ($asset_in_user) {
            $ownership = $asset_in_user;
            $key = 'guru-staff';
        } elseif ($asset_in_division) {
            $ownership = $asset_in_division;
            $key = 'division';
        } else {
            echo 'belum ya! ';
        }

        $data = [
            'title' => 'Edit Ownership | SMK IGAPIN',
            'users' => User::where('role', 'Staff')->get(),
            'assets' => Asset::where(function ($query) use ($ownership) {
                $query->where('unit', 'one-unit')
                    ->where('status', 'Available');
            })
                ->orWhere('id', $ownership->id_asset)
                ->get(),
            'divisions' => Division::get(),
            'ownership' => $ownership,
            'key' => $key
        ];
        return view('admin.ownership.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'ownership' => 'required',
            'id_asset' => 'required',
            'added_date' => 'required',
        ];

        if ($request->route == 'guru-staff') {
            $rules['attachment'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate($rules);

        if ($request->route == 'guru-staff') {
            // dd($id);
            $ownership = User_Ownership::where('id', $id)->first();
            if ($request->hasFile('attachment')) {
                $attachment = 'pic_attachment_' . time() . '.' . $request->file('attachment')->getClientOriginalExtension();
                $request->file('attachment')->move(public_path('assets/static/images/attachment'), $attachment);

                if ($ownership->attachment) {
                    unlink(public_path('assets/static/images/attachment/' . $ownership->attachment));
                }
            } else {
                $attachment = null;
            }

            User_Ownership::find($id)->update([
                'id_user' => $request->ownership,
                'id_asset' => $request->id_asset,
                'added_date' => $request->added_date,
                'attachment' => $attachment
            ]);
        } elseif ($request->route == 'division') {
            Division_Ownership::find($id)->update([
                'id_division' => $request->ownership,
                'id_asset' => $request->id_asset,
                'added_date' => $request->added_date,
            ]);
        } else {
            echo 'belum ye!';
        }

        return redirect()->route('ownership')->with('success', 'Kepemilikan Asset berhasil diedit!');
    }

    public function delete($id)
    {
        $ownership = User_Ownership::where('id', $id)->first();


        if ($ownership) {
            $ownership->delete();
            return redirect()->route('ownership')->with('success', 'Kepemilikan Asset berhasil dihapus!');
        }

        $ownership = Division_Ownership::where('id', $id)->first();

        if ($ownership) {
            $ownership->delete();
            return redirect()->route('ownership')->with('success', 'Kepemilikan Asset berhasil dihapus!');
        }

        abort(404);
    }

    public function detail($code_asset)
    {
        $asset = Asset::where('code_asset', $code_asset)->firstOrFail();

        if (User_Ownership::where('id_asset', $asset->id)->first()) {
            $ownership = User_Ownership::where('id_asset', $asset->id)->first();
        } else {
            $ownership = Division_Ownership::where('id_asset', $asset->id)->first();
        }


        $data = [
            'title' => 'Detail Ownership | SMK IGAPIN',
            'ownership' => $ownership,
            'details' => Detail_Asset::where('id_asset', $ownership->id_asset)->get(),
        ];

        return view('admin.ownership.detail', $data);
    }

    public function attachment()
    {
        return view('admin.ownership.attachment');
    }
    public function return_attachment()
    {
        return view('admin.ownership.return_attachment');
    }

    public function return($code_asset)
    {
        $asset = Asset::where('code_asset', $code_asset)->firstOrFail();

        if (User_Ownership::where('id_asset', $asset->id)->first()) {
            $ownership = User_Ownership::where('id_asset', $asset->id)->first();
            $route = 'User';
        } else {
            $ownership = Division_Ownership::where('id_asset', $asset->id)->first();
            $route = 'Division';
        }

        $data = [
            'title' => 'Return | SMK IGASAR PINDAD',
            'ownership' => $ownership,
            'route' => $route
        ];
        return view('admin.ownership.return', $data);
    }

    // cuma berlaku di user aja (divisi gada upload upload an)
    public function return_update(Request $request, $id)
    {

        if ($request->route == 'User') {
            $request->validate([
                'return_attachment' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $ownership = User_Ownership::where('id', $id)->firstOrFail();
            Asset::where('code_asset', $ownership->asset->code_asset)->update([
                'status' => 'Available',
                'notes' => $request->notes,
            ]);

            $name_file = 'pic_return_attch' . time() . '.'. $request->file('return_attachment')->getClientOriginalExtension();
            $request->file('return_attachment')->move(public_path('assets/static/images/return_attachment'), $name_file);

            User_Ownership::where('id', $id)->update([
                'return_attachment' => $name_file,
                'return_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $ownership = Division_Ownership::where('id', $id)->firstOrFail();
            Asset::where('code_asset', $ownership->asset->code_asset)->update([
                'status' => 'Available',
                'notes' => $request->notes,
            ]);

            $name_file = 'pic_return_attch' . time() . '.' . $request->file('return_attachment')->getClientOriginalExtension();
            $request->file('return_attachment')->move(public_path('assets/static/images/return_attachment'), $name_file);

            Division_Ownership::where('id', $id)->update([
                'return_attachment' => $name_file,
                'return_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('ownership')->with('success', 'Kepemilikan Asset berhasil direturn!');
    }
}
