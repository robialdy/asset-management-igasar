<?php

namespace App\Http\Controllers\admin;

use App\Models\Asset;
use App\Models\Division_Ownership;
use App\Models\User_Ownership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard | SMK IGAPIN',
            'count_asset' => Asset::where('status', 'Available')->count(),
            'count_divisi_own' => Division_Ownership::where('status', 'Owned')->count(),
            'count_user_own' => User_Ownership::where('status', 'Owned')->count(),
            'count_user' => User::count(),
        ];
        return view('admin.dashboard.index', $data);
    }
}
