<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
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
            'licenses' => "Ahmad Muzayyin",
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
        return view('admin.barang.tambah',[
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
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:50',
                'merek' => 'required|max:50',
                'category_id' => 'required',
                'hargabeli' => 'required|max:50',
                'hargajual1' => 'required|max:50',
                'hargajual2' => 'required|max:50',
                'stok' => 'required|max:50',
            ]);
            
            if ($validator->passes()) {
                Product::create([
                    'category_id' => $request->category_id,
                    'nama' => $request->nama,
                    'merek' => $request->merek,
                    'harga_beli' => $request->hargabeli,
                    'harga_jual' => $request->hargajual1,
                    'harga_jual_opsi' => $request->hargajual2,
                    'stok' => $request->stok,
                ]);
                return response()->json(['success'=>'Data berhasil disimpan!']);
        }
            return response()->json(['error'=>$validator->errors()->all()]);
    

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
        //
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
        //
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

    public function validasi(Request $request){
        try {
            $category = Category::firstWhere('id', $request->id);

            if ($category->nama == 'Buah' || $category->nama == 'buah') {
                return response()->json(['success' => 'Data kategori adalah buah']);
            }else{
                return response()->json(['error' => "Data kategori bukan buah"]);
            }
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }
}
