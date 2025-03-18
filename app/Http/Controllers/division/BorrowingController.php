<?php

namespace App\Http\Controllers\division;

use App\Models\Division;
use App\Models\Borrowing;
use App\Models\Division_Ownership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Peminjaman | SMK IGAPIN',
            'borrowings' => Borrowing::where('id_division', Auth::user()->id_division)->where('status', 'Dipinjam')->get(),
            'borrowings_done' => Borrowing::where('id_division', Auth::user()->id_division)->where('status', 'Selesai')->get(),
        ];
        return view('division.borrowing.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Peminjaman | SMK IGAPIN',
            'assets' => Division_Ownership::where('id_division', Auth::user()->division->id)->where('status', 'Owned')->get(),
        ];
        return view('division.borrowing.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset' => 'required',
            'name' => 'required',
            'reason' => 'required',
            'return_date' => 'required',
        ]);

        Borrowing::create([
            'id_division' => Auth::user()->division->id,
            'id_asset' => $request->asset,
            'name' => $request->name,
            'reason' => $request->reason,
            'added_date' => date('Y-m-d'),
            'return_date' => $request->return_date,
            'status' => 'Dipinjam',
        ]);

        Division_Ownership::where('id_asset', $request->asset)->where('status', 'Owned')->update([
            'status' => 'Dipinjam'
        ]);

        return redirect()->route('borrowing', Auth::user()->division->name)->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function updateStatus(Request $request, $division, $id)
    {
        Borrowing::where('id', $id)->update(['status' => 'Selesai']);

        return redirect()->route('borrowing', Auth::user()->division->name)->with('success', 'Peminjaman berhasil diselesaikan!');
    }
}
