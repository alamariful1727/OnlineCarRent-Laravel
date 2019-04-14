<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserFormRequest;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
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
        return redirect('/')->with('error', 'Sorry, no user found in /' . $url);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('dashboard.edit')->with('user', $user);
    }
    public function update(Request $request, $id)
    {
        // check URL
        if (auth()->user()->url != $request->url) {
            $this->validate($request, [
                'url' => 'required|max:30|min:5|unique:users'
            ]);
        }
        // Handle File Upload
        if ($request->hasFile('cover_image')) {
            $this->validate($request, [
                'cover_image' => 'image|nullable|max:1999'
            ]);
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/user_images', $fileNameToStore);
        }
        //check others
        $this->validate($request, [
            'name' => 'required|max:191|min:4',
            'description' => 'required|max:191|min:10'
        ]);
        // update user
        $url = join("", explode("/", $request->url));
        $user = User::find($id);
        $user->name = $request->name;
        $user->description = $request->description;
        $user->url = $url;
        if ($request->hasFile('cover_image')) {
            $user->image = $fileNameToStore;
        }
        $user->save();

        return redirect('/' . $url)->with('success', 'Profile updated');
    }
}
