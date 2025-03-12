<?php

namespace App\Http\Controllers\division;

use App\Http\Controllers\Controller;
use App\Models\Division_Ownership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionAssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Division Asset | SMK IGAPIN',
            'ownerships' => Division_Ownership::where('id_division', Auth::user()->id_division)->whereNot('status', 'Deleted')->get()
        ];
        return view('division.division-asset.index', $data);
    }
}
