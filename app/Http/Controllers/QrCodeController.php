<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Detail_Asset;
use App\Models\User_Ownership;
use App\Models\Division_Ownership;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index($code_asset)
    {
        $asset = Asset::where('code_asset', $code_asset)->firstOrFail();

        if(User_Ownership::where('id_asset', $asset->id)->where('status', 'Owned')->first()) {
            $ownership = User_Ownership::where('id_asset', $asset->id)->where('status', 'Owned')->first();
            $status = 'user';
        } elseif(Division_Ownership::where('id_asset', $asset->id)->where('status', 'Owned')->first()) {
            $ownership = Division_Ownership::where('id_asset', $asset->id)->where('status', 'Owned')->first();
            $status = 'division';
        } else {
            $status = null;
            $ownership = null;
        }

        $data = [
            'asset' => $asset,
            'details' => Detail_Asset::where('id_asset', $asset->id)->get(),
            'ownership' => $ownership,
            'status' => $status
        ];
        return view('asset', $data);
    }
}
