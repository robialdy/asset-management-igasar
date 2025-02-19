<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Staff/Guru | SMK IGAPIN'
        ];
        return view('user.dashboard.index', $data);
    }
}
