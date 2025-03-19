<?php

namespace App\Http\Controllers\division;

use App\Models\Borrowing;
use App\Models\Procurement;
// use Illuminate\Http\Request;
use App\Models\Request;
use App\Models\Division_Ownership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Scalar\MagicConst\Dir;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Division | SMK IGAPIN',
            'count_asset' => Division_Ownership::where('id_division', Auth::user()->id_division)->whereNot('status', 'Deleted')->count(),
            'count_procurement' => Procurement::where('name_division', Auth::user()->division->name)->where('status', 'Proses')->count(),
            'count_issue' => Request::where('division_name', Auth::user()->division->name)->where('status', 'Proses')->count(),
            'count_borrowing' => Division_Ownership::where('id_division', Auth::user()->id_division)->where('status', 'Dipinjam')->count(),
        ];
        return view('division.dashboard.index', $data);
    }
}
