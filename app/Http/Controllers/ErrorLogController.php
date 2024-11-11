<?php

namespace App\Http\Controllers;

use App\Models\ErrorLogs;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ErrorLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function errors()
    {
        return view('errors.common-error');
    }
    public function index()
    {
        if (Auth::user()->email == "bcrretrofit@gmail.com") {
            if (request()->ajax()) {
                $errorlogs = ErrorLogs::select([
                    'id',
                    'error_code',
                    'section',
                    DB::raw('DATE_FORMAT(date, "%d/%m/%Y") as date'),
                    'time',
                    DB::raw('COALESCE(message, "N/A") as message'),
                    'url',
                    DB::raw('COALESCE(property_name, "N/A") as property_name'),
                    DB::raw('COALESCE(name, "N/A") as name'),
                    DB::raw('COALESCE(gen_id, "N/A") as gen_id'),
                ]);
                return datatables()->of($errorlogs)
                    ->addColumn('action', function ($errorlog) {
                        $actions = '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/error-logs/delete/' . Crypt::encrypt($errorlog->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                        return $actions;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('dashboard.error-log.view-errorlog');
        } else {
            return redirect('/');
        }
    }

    public function deleteErrorlog($id)
    {
        $id = Crypt::decrypt($id);
        ErrorLogs::where('id', $id)->delete();
        return redirect()->route('errorlogs');
    }
}
