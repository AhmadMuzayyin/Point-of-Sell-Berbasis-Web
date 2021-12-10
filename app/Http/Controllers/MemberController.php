<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index', [
            'data' => Setting::all(),
            'member' => Member::all(),
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idMember = random_int(10000, 999999);
        $id = Member::where('id_member', $idMember)->first();
        if ($id != null) {
            $id = $id + 100;
        } else {
            $id = $idMember;
        }
        return view('admin.member.tambah', [
            'data' => Setting::all(),
            'user' => Auth::user(),
            'memberID' => $id
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
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
                'kontak' => 'required',
                'masa' => 'required'
            ]);
            // dd($validator);
            if ($validator->passes()) {
                Member::create([
                    'id_member' => $request->id,
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'kontak' => $request->kontak,
                    'masa_berlaku' => $request->masa
                ]);
                return response()->json(['success' => 'Data member berhasil ditambahkan.']);
            }
            return response()->json(['error' => $validator->error->all()]);
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
                'kontak' => 'required',
                'masa' => 'required'
            ]);
            if ($validator->passes()) {
                $id = Member::where('id_member', $request->id)->first();
                // dd($id->id);

                $m = Member::find($id->id);

                $m->nama = $request->nama;
                $m->alamat = $request->alamat;
                $m->kontak = $request->kontak;
                $m->masa_berlaku = $request->masa;
                $m->save();

                return response()->json(['success' => 'Data member berhasil diperbarui.']);
            }
            return response()->json(['error' => $validator->error->all()]);
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        try {
            Member::destroy($member->id);
            return response()->json(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    public function cetak()
    {
        return view('admin.member.cetak', [
            'member' => Member::all(),
            'toko' => Setting::first()
        ]);
    }
    public function cetakMember(Member $member)
    {
        // dd($member->id_member);
        return view('admin.member.cetak', [
            'member' => Member::where('id_member', $member->id_member)->get()
        ]);
    }
}
