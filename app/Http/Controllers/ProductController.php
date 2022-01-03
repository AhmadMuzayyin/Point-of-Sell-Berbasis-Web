<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        return view('admin.barang.index', [
            'data' => Setting::all(),
            'user' => Auth::user(),
            'product' => Product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.barang.tambah', [
            'licenses' => "Ahmad Muzayyin",
            'data' => Setting::all(),
            'user' => Auth::user(),
            'product' => Product::all(),
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:50',
                'merek' => 'required|max:50',
                'category_id' => 'required',
                'hargabeli' => 'required|max:50',
                'hargajual1' => 'required|max:50',
                'hargajual2' => 'required|max:50',
                'diskon' => 'required|max:50',
                'stok' => 'required|max:50',
            ]);
            // dd($validator);

            if ($validator->passes()) {
                Product::create([
                    'category_id' => $request->category_id,
                    'nama' => ucfirst($request->nama),
                    'merek' => ucfirst($request->merek),
                    'diskon' => $request->diskon,
                    'harga_beli' => $request->hargabeli,
                    'harga_jual' => $request->hargajual1,
                    'harga_jual_opsi' => $request->hargajual2,
                    'stok' => $request->stok,
                ]);
                return response()->json(['success' => 'Data berhasil disimpan!']);
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            // return redirect('category')->with('success', 'Data Berhasil ditambahkan!');

        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.barang.tambah', [
            'product' => $product,
            'data' => Setting::all(),
            'user' => Auth::user(),
            'category' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            $p = Product::find($product->id);

            $p->category_id = $request->category_id;
            $p->nama = $request->nama;
            $p->merek = $request->merek;
            $p->diskon = $request->diskon;
            $p->harga_beli = $request->hargabeli;
            $p->harga_jual = $request->hargajual1;
            $p->harga_jual_opsi = $request->hargajual2;
            $p->stok = $request->stok;
            $p->save();
            return response()->json(['success' => 'Data barang berhasil di update']);

        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }

    public function validasi(Request $request)
    {
        try {
            $category = Category::firstWhere('id', $request->id);

            if ($category->jenis == 'Buah' || $category->jenis == 'buah') {
                return response()->json(['success' => 'Data kategori adalah buah']);
            } else {
                return response()->json(['error' => "Data kategori bukan buah"]);
            }
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }

    public function cekHarga()
    {
        try {
            $category = Category::where('jenis', 'Buah')->get();
            foreach ($category as $d) {
                $price = Product::firstWhere('category_id', $d->id);
                $created = new Carbon($price->created_at);
                $updated = new Carbon($price->updated_at);
                if (date('Y-m-d') > $created->toDateString() && date('Y-m-d') > $updated->toDateString()) {
                    $price->harga_jual = $price->harga_jual_opsi;
                    $price->save();

                    // Notification::create([
                    //     'id_notif' => 1,
                    //     'message' => 'Data barang berhasil di update',
                    //     'status' => 0
                    // ]);
                    return response()->json(['success' => 'Data barang berhasil diperbarui!']);
                }else{
                    return response()->json(['error' => 'Data barang tidak ada yang diperbarui!']);
                }
            }
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }

    public function cekstok(){
        try {
            $stok = Product::where('stok', 0)->get();
            $n = Notification::where('status', 0)->get();
            foreach ($n as $a) {
                $cek = Notification::where('id_notif', $a->id_notif)->get();
                // dd( $cek);
                if ($cek) {
                    foreach ($stok as $s) {
                        Notification::create([
                            'id_notif' => $a->id_notif+1,
                            'message' => "Stok ".$s->nama." kosong",
                            'status' => 0
                        ]);
                    }
                }
            }
            
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }
}
