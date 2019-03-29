<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use DB;
use Illuminate\Support\Facades\Session;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $blogs = Blog::all();
        // $blogs = Blog::orderBy('id', 'desc')->get();
        $blogs = Blog::orderBy('updated_at', 'desc')->paginate(5);
        // $blogs = Blog::orderBy('id', 'desc')->take(2)->get();
        // $blogs = Blog::where('id', '3')->get();
        // $blogs = DB::select('select * from blogs where id = ?', [3]);
        return view('blog.index')->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // create Blog
        $blog = new Blog;
        $blog->body = $request->input('body');
        $blog->save();

        return redirect('/blog')->with('success', 'Blog created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Blog::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // update Blog
        $blog = Blog::find($id);
        $blog->body = $request->input('body');
        $blog->save();
        Session::flash('success', 'Blog Updated!!'); //one time
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // update Blog
        $blog = Blog::find($id);
        $blog->delete();
        Session::flash('success', 'Blog Deleted!!'); //one time
        return 'success';
    }
}
