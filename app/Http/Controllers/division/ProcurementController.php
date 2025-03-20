<?php

namespace App\Http\Controllers\division;

use App\Models\Procurement;
use Illuminate\Http\Request;
use App\Models\Detail_Procurement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProcurementController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengadaan | SMKK IGAPIN',
            'procurements' => Procurement::where('name_division', Auth::user()->division->name)->whereNotIn('status', ['Ditolak', 'Selesai'])->get(),
            'historys' => Procurement::where('name_division', Auth::user()->division->name)->where('status', 'Selesai')->get(),
        ];
        return view('division.procurement.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Request Pengadaan |  SMK IGAPIN',
        ];
        return view('division.procurement.create', $data);
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
            'code' => 'PA' . date('ymdHis'),
            'name_division' => Auth::user()->division->name
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

        return redirect()->route('division.procurement', Auth::user()->division->name)->with('success', 'Data berhasil disimpan!');
    }

    public function view_details($division, $code)
    {
        $procurement = Procurement::where('code', $code)->first();

        $data = [
            'title' => 'Procurement Details | SMK IGAPIN',
            'details' => Detail_Procurement::where('id_procurement', $procurement->id)->whereNot('is_approved', 0)->get()
        ];
        return view('division.procurement.detail', $data);
    }
}
