<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($url)
    {
        $user = User::where('url', $url)->first();
        if ($user != null) {
            return view('dashboard.index')->with('user', $user);
        }
        return redirect('/')->with('error', 'Sorry, no user found in <strong>/$url</strong>');
    }
}
