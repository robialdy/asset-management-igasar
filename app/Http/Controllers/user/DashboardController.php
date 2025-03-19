<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Models\User_Ownership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Staff/Guru | SMK IGAPIN',
            'count_asset' =>  User_Ownership::where('id_user', Auth::user()->id)->whereNot('status', 'Deleted')->count()
        ];
        return view('user.dashboard.index', $data);
    }
}
