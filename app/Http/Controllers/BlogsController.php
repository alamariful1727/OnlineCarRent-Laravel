<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\User;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogFormRequest;

class BlogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
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
        // $blogs = Blog::find(1);
        // $blogs = Blog::find([]);
        // $blogs = Blog::where('id', '3')->get();
        // $blogs = Blog::where('id', '3')->get()->where('password',3);
        // $blogs = Blog::where('id', '3')->get()->where('password',3)->first();
        // $blogs = DB::select('select * from blogs where id = ?', [3]);
        return view('blog.index')->with('blogs', $blogs);
    }

    public function userBlogs()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('blog.index')->with('blogs', $user->blogs);
        // return $user->blogs;
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
    public function store(BlogFormRequest $request)
    {
        // Handle File Upload
        if ($request->hasFile('cover_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/blog_images', $fileNameToStore);
        } else {
            $fileNameToStore = '';
        }

        // create Blog
        $blog = new Blog;
        $blog->user_id = auth()->user()->id;
        $blog->cover_image = $fileNameToStore;
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
    public function update(BlogFormRequest $request, $id)
    {
        // Handle File Upload
        if ($request->hasFile('cover_image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/blog_images', $fileNameToStore);
        }

        // update Blog
        $blog = Blog::find($id);
        $blog->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            $blog->cover_image = $fileNameToStore;
        }
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
        if ($blog->cover_image != '') {
            // Delete Image
            Storage::delete('public/blog_images/' . $blog->cover_image);
        }
        $blog->delete();
        Session::flash('success', 'Blog Deleted!!'); //one time
        return 'success';
    }
}
