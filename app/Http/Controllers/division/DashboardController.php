<?php

namespace App\Http\Controllers\division;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Division | SMK IGAPIN'
        ];
        return view('division.dashboard.index', $data);
    }
}
