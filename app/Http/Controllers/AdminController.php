<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
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
    public function userDetails()
    {
        // $users = User::orderBy('created_at')->paginate(5);
        // return view('admin.showAllUsers')->with('users', $users);
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
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                $data = DB::table('users')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            $output = '';
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <th scope="row">' . $row->id . '</th>
                        <td>' . $row->name . '</td>
                        <td>' . $row->email . '</td>
                        <td>' . $row->description . '</td>
                        <td>' . $row->url . '</td>
                        <td>' . $row->type . '</td>
                        <td>' . $row->created_at . '</td>
                        <td>
                            <a class="btn btn-success" href="" role="button" data-toggle="">Edit</a>
                            <a class="btn btn-success" href="" role="button" data-toggle="">Delete</a>
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
}
