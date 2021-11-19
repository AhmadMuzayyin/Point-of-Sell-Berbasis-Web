<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\UploadedFile;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index',[
            'licenses' => "Ahmad Muzayyin",
            'data' => Setting::all(),
            'user' => Auth::user()
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
        // try {
        //     $validator = Validator::make($request->all(), [
        //         'nama' => 'required|string',
        //         'alamat' => 'required|max:200',
        //         'logo' => 'required|file|mimes:jpg,jpeg,png|max:10240'
        //     ]);
            
        //     if ($validator->passes()) {
        //         $file = $request->file('logo');
        //         $fileName = Auth::user()->name.'_'.date('h:i:s').'_'.'logo-toko'.'.'.$file->extension();
        //         Setting::create([
        //             'nama' => $request->nama,
        //             'alamat' => $request->alamat,
        //             'logo' => $fileName,
        //             'nota' => $request->nota
        //         ]);
        //         $file->move(public_path('uploads'), $fileName);

        //         return redirect()->back()->with('success', 'Gambar berhasil diupload!');
        //     }else{
        //         return redirect()->back()->with('error', 'Ekstensi file harus .jpg .jpeg .png!');
        //     }
        // } catch (\Throwable $th) {
        //     $th->getmessage();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string',
                'alamat' => 'required|max:200',
                'logo' => 'required|file|mimes:jpg,jpeg,png|max:10240'
            ]);
            
            if ($validator->passes()) {
                $setting = Setting::find($setting->id);
                $file = $request->file('logo');
                $fileName = Auth::user()->name.'_'.date('h:i:s').'_'.'logo-toko'.'.'.$file->extension();
                dd($fileName);

                $setting->nama = $request->nama;
                $setting->alamat = $request->alamat;
                $setting->logo = $fileName;
                $setting->nota = $request->nota;
                $setting->save();
                // dd($setting);
                
                $file->move(public_path('uploads'), $fileName);

                return response()->json(['success' => 'Data berhasil disimpan!']);
            }else{
                return response()->json(['error' => 'Ekstensi file harus .jpg .jpeg .png!']);
            }
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
