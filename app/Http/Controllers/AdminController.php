<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            // dd(auth()->user()->type);
            if (auth()->user()->type != 'admin') {
                return redirect('/')->with('error', 'Restricted page for user!!');
            }
            return $next($request);
        });
    }
    public function index()
    {
        return view('admin.index');
    }
}
