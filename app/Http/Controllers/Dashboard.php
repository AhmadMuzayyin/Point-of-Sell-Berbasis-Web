<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'licenses' => "Ahmad Muzayyin",
            'date' => date('Y'),
            'title' => "Tokoku",
            'user' => Auth::user(),
        ]);
    }
}
