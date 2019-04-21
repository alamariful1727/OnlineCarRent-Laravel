<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     if (auth()->user()->type != 'admin') {
        //         return redirect('/')->with('error', 'Restricted page for user!!');
        //     }
        //     return $next($request);
        // });
    }
    public function index()
    {
        return view('admin.index');
    }
    // Dealing with users
    public function addUser()
    {
        return view('admin.addUser');
    }
    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $url = Str::limit(Hash::make($request->password), 20);
        $url = join("", explode("/", $url));
        // create user
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->url = $url;
        $user->save();

        return redirect()->route('admin.userDetails')->with('success', 'New user created NAME: ' . $request->name);
    }
    public function userDetails()
    {
        return view('admin.userDetails');
    }
    public function getUsersInfo(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('users')
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('url', 'like', '%' . $query . '%')
                    ->orWhere('type', 'like', '%' . $query . '%')
                    ->orWhere('created_at', 'like', '%' . $query . '%')
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = DB::table('users')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            $index = $total_row;
            $output = '';
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <th scope="row">' . $index-- . '</th>
                        <td>' . $row->name . '</td>
                        <td>' . $row->email . '</td>
                        <td>' . $row->description . '</td>
                        <td>' . $row->url . '</td>
                        <td>' . $row->type . '</td>
                        <td>' . $row->created_at . '</td>
                        <td>
                            <a class="btn btn-info" href="/admin/user-details/' . $row->id . '/editUser" role="button" data-toggle="">Edit</a>
                            <a class="btn btn-danger" href="/admin/user-details/' . $row->id . '/deleteUser" role="button" data-toggle="">Delete</a>
                        </td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="8">No data found!!</td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.editUser')->with('user', $user);
    }
    public function updateUser(Request $request, $id)
    {
        // dd($request);
        $user = User::find($id);
        // check URL
        if ($user->url != trim($request->url)) {
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
            // $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $fileNameToStore = $user->id . '__' . time() . '.' . $extension;
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

        return redirect()->route('admin.userDetails')->with('success', 'User ID:' . $id . ' has been updated.');
    }
    public function deleteUser($id)
    {
        // update Blog
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.userDetails')->with('success', 'User ID:' . $id . ' has been Deleted.');
    }
    // Dealing with users ENDS

    // Dealing with Blogs
    public function blogDetails()
    {
        return view('admin.blogDetails');
    }
    public function getBlogsInfo(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('blogs')
                    ->join('users', 'blogs.user_id', '=', 'users.id')
                    ->where('type', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%')
                    ->orWhere('body', 'like', '%' . $query . '%')
                    ->orWhere('blog_created_at', 'like', '%' . $query . '%')
                    ->orWhere('blog_updated_at', 'like', '%' . $query . '%')
                    ->orderBy('bid', 'desc')
                    ->get();
            } else {
                $data = DB::table('blogs')
                    ->join('users', 'blogs.user_id', '=', 'users.id')
                    ->orderBy('bid', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            $index = $total_row;
            $output = '';
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <th scope="row">' . $index-- . '</th>
                        <td>' . $row->type . '</td>
                        <td>' . $row->email . '</td>
                        <td>' . $row->body . '</td>
                        <td>' . $row->blog_created_at . '</td>
                        <td>' . $row->blog_updated_at . '</td>
                        <td>
                            <a class="btn btn-info" href="/admin/user-details/' . $row->id . '/editUser" role="button" data-toggle="">Edit</a>
                            <a class="btn btn-danger" href="/admin/user-details/' . $row->id . '/deleteUser" role="button" data-toggle="">Delete</a>
                        </td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="7">No data found!!</td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }
    // Dealing with Blogs ENDS
}
