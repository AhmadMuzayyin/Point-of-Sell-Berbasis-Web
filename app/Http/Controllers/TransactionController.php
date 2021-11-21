<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cek = Transaction::latest('id')->first();

        if ($cek == null) {
            session()->put('no', 1);
        } else {
            if ($cek->no != session()->get('no')) {
                session()->put('no', $cek->no + 1);
            }
        }

        $data = Transaction::where('status', 0)->with('tr_detail')->first();

        return view('admin.transaksi.index', [
            'licenses' => "Ahmad Muzayyin",
            'date' => date('Y'),
            'title' => "Tokoku",
            'user' => Auth::user(),
            'product' => Product::all(),
            'data' => $data,

        ]);
    }

    public function getProduct(Request $request)
    {
        try {

            $data = Product::find($request->id);
            $cek = Transaction::where('no', $request->no)->first();

            if ($cek == null) {
                $transaksi = new Transaction();
                $transaksi->user_id = Auth::user()->id;
                $transaksi->no = $request->no;
                $transaksi->status = 0;
                $transaksi->save();
            }

            if ($cek->no == session()->get('no')) {

                $tr = new TransactionDetails();
                $tr->transactions_id = $cek->id;
                $tr->product_id = $data->id;
                $tr->nama = $data->nama;
                $tr->merek = $data->merek;
                $tr->harga = $data->harga_jual;
                $tr->qty = 1;
                $tr->subtotal = $data->harga_jual;
                $tr->save();

                return response()->json([
                    'data' => $tr,
                ]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateProduct(Request $request)
    {
        $total = $request->val * $request->kue;

        $tr = TransactionDetails::where('id', $request->id)->update([
            'subtotal' => $total,
            'qty' => $request->val,
        ]);


        $transaksi = TransactionDetails::where('id', $request->id)->orderBy('created_at', 'ASC')->firstOrFail();
        $total_hrg = TransactionDetails::where('transactions_id', session()->get('no'))->sum('subtotal');
        $total = Transaction::where('no', session()->get('no'))->update(['total' => $total_hrg]);

        return response()->json([
            'data' => $transaksi,
            'total_hrg' => $total_hrg,
        ]);
    }

    public function selesaiProduct(Request $request)
    {

        $cek = Transaction::with('tr_detail')->where('id', $request->id)->first();

        foreach ($cek->tr_detail as $item) {

            $product = Product::find($item->product_id);
            $product->stok = $product->stok - $item->qty;
            $product->save();
        }

        $cek->status = 1;
        $cek->save();

        session()->forget('no');

        return response()->json([
            'data' => 1,
        ]);
    }

    public function delete(Request $request)
    {
        $tr = TransactionDetails::where('id', $request->id)->delete();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
