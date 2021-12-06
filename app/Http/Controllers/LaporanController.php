<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.laporan.index', [
            'licenses' => "Ahmad Muzayyin",
            'data' => Setting::all(),
            'user' => Auth::user(),
        ]);
    }

    public function getLaporan(Request $request)
    {
        $product = Product::all();

        if ($request->val == 1) {
            $transaksi = Transaction::with('tr_detail')->where('status', 1)->whereDay('created_at', '=', date('d'))->get();
        }

        if ($request->val == 2) {
            $transaksi = Transaction::with('tr_detail')->where('status', 1)->whereMonth('created_at', '=', date('m'))->get();
        }

        if ($request->val == 3) {
            $transaksi = Transaction::with('tr_detail')->where('status', 1)->whereYear('created_at', '=', date('Y'))->get();
        }

        $qtyPerbarang = [];
        foreach ($transaksi as $tr) {
            foreach ($tr->tr_detail as $data) {
                $qtyPerbarang[$data->product_id] = $data->qty;
            }
        }

        $modalKeseluruhan = [];
        $modalPerbarang = [];
        $rugi = [];
        $laba = [];
        $pendapatan = [];
        $harga_jual = [];
        $stok = [];
        $harga_beli = [];
        foreach ($product as $key => $produk) {
            $stok[$produk->id] = $produk->stok;
            $harga_jual[$produk->id] = $produk->harga_jual;
            $harga_beli[$produk->id] = $produk->harga_beli;
        }

        // Hitung Modal Perbarang, Pendapatan, Laba, Rugi
        foreach ($qtyPerbarang as $key => $qty) {
            $modalKeseluruhan[] = $harga_beli[$key] * ($qty + $stok[$key]);
            $modalPerbarang[] = $harga_beli[$key] * $qty;
            $pendapatan[] = $harga_jual[$key] * $qty;
        }

        foreach ($pendapatan as $key => $pdpt) {
            $pd[$key] = $pdpt;
        }

        foreach ($modalPerbarang as $key => $mdp) {

            if ($mdp < $pd) {
                $laba[] = $pd[$key] - $mdp;
            }

            if ($mdp > $pd) {
                $rugi[] = $pd[$key] - $mdp;
            }
        }

        $totalModalKeseluruhan = array_sum($modalKeseluruhan);
        $totalModalPerbarang = array_sum($modalPerbarang);
        $totalPendapatanKeseluruhan = array_sum($pendapatan);
        $totalLaba = array_sum($laba);
        $totalRugi = array_sum($rugi);

        return response()->json([
            'modal' => $totalModalKeseluruhan,
            'pendapatan' => $totalPendapatanKeseluruhan,
            'laba' => $totalLaba,
            'rugi' => $totalRugi,
        ]);
    }

    public function cetakLaporan(Request $request)
    {
        $product = Product::all();
        $toko = Setting::where('id', 1)->first();

        if ($request->data == 1) {
            $transaksi = Transaction::with('tr_detail')->where('status', 1)->whereDay('created_at', '=', date('d'))->get();
        }

        if ($request->data == 2) {
            $transaksi = Transaction::with('tr_detail')->where('status', 1)->whereMonth('created_at', '=', date('m'))->get();
        }

        if ($request->data == 3) {
            $transaksi = Transaction::with('tr_detail')->where('status', 1)->whereYear('created_at', '=', date('Y'))->get();
        }

        $qtyPerbarang = [];
        foreach ($transaksi as $tr) {
            foreach ($tr->tr_detail as $data) {
                $qtyPerbarang[$data->product_id] = $data->qty;
            }
        }

        $modalKeseluruhan = [];
        $modalPerbarang = [];
        $rugi = [];
        $laba = [];
        $pendapatan = [];
        $harga_jual = [];
        $stok = [];
        $harga_beli = [];
        foreach ($product as $key => $produk) {
            $stok[$produk->id] = $produk->stok;
            $harga_jual[$produk->id] = $produk->harga_jual;
            $harga_beli[$produk->id] = $produk->harga_beli;
        }

        // Hitung Modal Perbarang, Pendapatan, Laba, Rugi
        foreach ($qtyPerbarang as $key => $qty) {
            $modalPerbarang[] = $harga_beli[$key] * $qty;
            $pendapatan[] = $harga_jual[$key] * $qty;
        }

        foreach ($pendapatan as $key => $pdpt) {
            $pd[$key] = $pdpt;
        }

        foreach ($modalPerbarang as $key => $mdp) {

            if ($mdp < $pd) {
                $laba[] = $pd[$key] - $mdp;
            }

            if ($mdp > $pd) {
                $rugi[] = $pd[$key] - $mdp;
            }
        }

        $pdf = PDF::loadView('admin.laporan.cetak_laporan', compact(
            'modalPerbarang',
            'pendapatan',
            'laba',
            'rugi',
            'product',
            'qtyPerbarang',
            'toko',
        ))->setPaper('a4');

        $laporan = '';
        if ($request->data == 1) {
            $laporan = 'Harian';
        }

        if ($request->data == 2) {
            $laporan = 'Bulanan';
        }

        if ($request->data == 3) {
            $laporan = 'Tahunan';
        }

        return $pdf->stream('Laporan ' . $laporan . '.pdf');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //foo
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
