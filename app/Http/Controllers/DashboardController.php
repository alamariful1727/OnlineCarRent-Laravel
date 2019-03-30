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
    public function index()
    {
        return view('dashboard.index');
    }
    public function myblogs()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('blog.index')->with('blogs', $user->blogs);
        // return $user->blogs;
    }
}
