<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        if (request()->ajax()) {
            $users = User::where('role', 'admin')->select(['id', 'firstname', 'lastname', 'email', 'usertype']);
            return datatables()->of($users)
                ->addColumn('action', function ($user) {
                    $actions = '<a href="/dashboard/user/' . Crypt::encrypt($user->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/user/delete/' . Crypt::encrypt($user->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.admin.view-users');
    }

    public function createUser()
    {
        return view('dashboard.admin.create-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'usertype' => ['required'],
        ]);

        $user = User::create(
            [
                'usertype' => $request->usertype,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->usertype == 'Admin' ? 'admin' : 'user',
            ]
        );

        if ($user->wasRecentlyCreated === true) {
            if($request->usertype == 'Admin'){
                $details = [
                    "body" => "Admin " ."($request->firstname $request->lastname)". " has been added",
                    "section" => "Admin",
                    "route" => "user"
                ];
                newNotification($details);
            }else{
                $details = [
                    "body" => "User " ."($request->firstname $request->lastname)". " has been added",
                    "section" => "Admin",
                    "route" => "user"
                ];
                newNotification($details);
            }
        }

        return redirect()->route('user');
    }

    public function editUser($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        return view('dashboard.admin.create-user', compact('user'));
    }

    public function deleteUser($id)
    {
        $id = Crypt::decrypt($id);

        $auth_user_id = Auth::user()->id;

        if ($auth_user_id == $id) {
            abort(404, 'You cannot delete currently logged user!');
        }

        $userDetails = User::where('id', $id)->first();
        $user = User::where('id', $id)->delete();

        if($user) {
            $details = [
                "body" => "Admin " ."($userDetails->firstname $userDetails->lastname)". " has been deleted",
                "section" => "Admin",
                "route" => "user"
            ];
            newNotification($details);
        }
        return redirect()->route('user');
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'usertype' => ['required'],
        ]);

        $updateData = [
            'usertype' => $request->usertype,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'usertype' => $request->usertype,
            'role' => $request->usertype == 'Admin' ? 'admin' : 'user',
        ];

        if (isset($request->password)) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user = User::where('id', $request->id)->update($updateData);
        if ($user > 0) {
            $details = [
                "body" => "Admin " ."($request->firstname $request->lastname)". " has been updated",
                "section" => "Admin",
                "route" => "user"
            ];
            newNotification($details);
        }
        return redirect()->route('user');
    }
}
