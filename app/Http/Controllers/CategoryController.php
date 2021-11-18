<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view("admin.kategori.index", [
        'licenses' => "Ahmad Muzayyin",
        'date' => date('Y'),
        'title' => "Tokoku",
        'user' => Auth::user(),
        'data' => Category::all()
        ]);
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
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:50|unique:categories,nama',
            ]);
            // $request->validate([
                // 'nama' => 'required|max:50|unique:categories,nama',
                // ]);
                
            if ($validator->passes()) {
                Category::create([
                    'nama' => ucfirst($request->nama),
                ]);
                return response()->json(['success'=>'Data berhasil ditambahkan.']);
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
     * @param  \App\Models\Category  $kategory
     * @return \Illuminate\Http\Response
     */
    public function show(Kategory $kategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $Category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $p = Product::where('category_id', $category->id)->first();
            if ($p == true) {
                return redirect()->back();
            }
            Category::destroy($category->id);
            return redirect()->back()->with("Data berhasil dihapus!");

        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }
}
