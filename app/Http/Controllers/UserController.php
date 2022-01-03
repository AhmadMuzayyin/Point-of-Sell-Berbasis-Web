<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index', [
            'licenses' => "Ahmad Muzayyin",
            'data' => Setting::all(),
            // 'users' => User::where('status' , '>' , 1)->get(),
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
                'name' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required'
            ]);
            if ($validator->passes()) {
                User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => $request->password,
                    'status' => $request->status
                ]);
                return response()->json(['success' => 'Data berhasil disimpan!']);
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request)
    {
        return view('admin.setting.index', [
            'data' => Setting::all(),
            'user' => Auth::user(),
            'users' => User::where('id',  $request->id)->get(),
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            // dd($request->status);
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:255',
                'username' => 'required|max:255',
                'password' => 'required|max:255',
                'status' => 'required|max:255',
            ]);

            if ($validator->passes()) {
                $setting = User::find($user->id);

                $setting->name = $request->nama;
                $setting->username = $request->username;
                $setting->password = bcrypt($request->password);
                $setting->status = $request->status;
                $setting->save();

                return response()->json(['success' => 'Data berhasil disimpan!']);
            } else {
                return response()->json(['error' => $validator->error->all()]);
            }
        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // dd($user->id);
        User::destroy($user->id);
        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
