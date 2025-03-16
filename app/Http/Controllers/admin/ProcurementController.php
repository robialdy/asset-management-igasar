<?php

namespace App\Http\Controllers\admin;

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
            'title' => 'Pengadaan | SMK IGAPIN',
            'procurements' => Procurement::whereNotIn('status', ['Ditolak', 'Selesai'])->get()
        ];
        return view('admin.procurement.index', $data);
    }

    public function confirm($code)
    {
        $procurement = Procurement::where('code', $code)->first();

        $data = [
            'title' => 'Konfirmasi Asset | SMK IGAPIN',
            'detail_procurements' => Detail_Procurement::where('id_procurement', $procurement->id)->where('is_approved', null)->get(),
            'procurement' => $procurement
        ];
        return view('admin.procurement.confirm', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title.*' => 'required|string',
            'amount.*' => 'required|integer',
            'unit.*' => 'required|string',
        ]);

        $detail_ids = $request->detail_id;
        $titles = $request->title;
        $amounts = $request->amount;
        $units = $request->unit;

        Procurement::where('id', $id)->update([
            'status' => 'Proses',
            'id_admin' => Auth::user()->id
        ]);

        foreach ($detail_ids as $key => $detail_id) {
            Detail_Procurement::where('id', $detail_id)->update([
                'title' => $titles[$key],
                'amount' => $amounts[$key],
                'unit' => $units[$key],
                'is_approved' => 1
            ]);
        }

        return redirect()->route('procurement')->with('success', 'Data berhasil diperbarui!');
    }

    public function rejected(Request $request, $id)
    {
        Procurement::where('id', $id)->update([
            'status' => 'Ditolak',
        ]);

        return redirect()->route('procurement')->with('success', 'Data Pengadaan ditolak!');
    }

    // deleted / rejected detail
    public function rejected_details($id)
    {
        $detail_procurement = Detail_Procurement::where('id', $id)->first();
        $procurement = Procurement::where('id', $detail_procurement->id_procurement)->firstOrFail();

        Detail_Procurement::where('id', $id)->update([
            'is_approved' => 0
        ]);

        return redirect()->route('procurement.confirm', $procurement->code)->with('success', 'Salah satu data pengadaa asset dihapus!!');
    }

    public function to_do($code)
    {
        $procurement = Procurement::where('code', $code)->first();

        $data = [
            'title' => 'To-Do List | SMK IGAPIN',
            'detail_procurements' => Detail_Procurement::where('id_procurement', $procurement->id)->where('is_approved', 1)->get(),
            'procurement' => $procurement
        ];
        return view('admin.procurement.to-do', $data);
    }

    public function send_todo(Request $request, $id)
    {
        $procurement = Procurement::where('id', $id)->firstOrFail();

        if ($request->action == 'completed') {
            Procurement::where('id', $id)->update([
                'status' => 'Selesai'
            ]);
        }

        $checkeds = $request->input('is_completed');

        if($checkeds) {
            foreach ($checkeds as $checked) {
                // $checked itu id detail_procurement
                Detail_Procurement::where('id', $checked)->update([
                    'is_completed' => 1
                ]);
            }
        } else {
            Detail_Procurement::where('id_procurement', $id)->where('is_approved', 1)->update([
                'is_completed' => 0
            ]);
        }

        if ($request->action == 'save') {
            return redirect()->route('procurement.to-do', $procurement->code)->with('success', 'Data telah selesai!');
        }

        return redirect()->route('procurement')->with('success', 'Data telah selesai!');
    }
}
