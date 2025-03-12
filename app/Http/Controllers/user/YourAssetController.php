<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Models\User_Ownership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class YourAssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Asset Anda | SMK IGAPIN',
            'ownerships' => User_Ownership::where('id_user', Auth::user()->id)->whereNot('status', 'Deleted')->get()
        ];
        return view('user.your-asset.index', $data);
    }
}
