<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Detail_Procurement;
use App\Models\Procurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcurementController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengadaan | SMK IGAPIN',
            'procurements' => Procurement::where('id_user', Auth::user()->id)->whereNot('status', 'Ditolak')->get()
        ];
        return view('user.procurement.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Request Pengadaan | SMK IGAPIN'
        ];
        return view('user.procurement.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.*' => 'required|string',
            'amount.*' => 'required|integer',
            'unit.*' => 'required|string',
        ]);

        $procurement = Procurement::create([
            'id_user' => Auth::user()->id,
            'status' => 'Menunggu Konfirmasi',
            'reason' => $request->reason,
            'code' => 'PA' . date('ymdHis')
        ]);


        $titles = $request->title;
        $amounts = $request->amount;
        $units = $request->unit;

        foreach ($titles as $key => $title) {
            Detail_Procurement::create([
                'title' => $title,
                'amount' => $amounts[$key],
                'unit' => $units[$key],
                'id_procurement' => $procurement->id,
            ]);
        }

        return redirect()->route('user.procurement')->with('success', 'Data berhasil disimpan!');
    }

    public function view_details($code)
    {
        $procurement = Procurement::where('code', $code)->first();

        $data = [
            'title' => 'Procurement Details | SMK IGAPIN',
            'details' => Detail_Procurement::where('id_procurement', $procurement->id)->get()
        ];
        return view('user.procurement.detail', $data);
    }
}
