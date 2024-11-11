<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchemeRequest;
use App\Models\Scheme;
use Illuminate\Support\Facades\Crypt;

class SchemeController extends Controller
{
    function index()
    {
        if (request()->ajax()) {

            $schemes = Scheme::select(['id', 'scheme', 'is_active']);

            return datatables()->of($schemes)
                ->addColumn('actions', function ($scheme) {
                    $actions = '<a href="/dashboard/lookup/scheme/' . Crypt::encrypt($scheme->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    return $actions;
                })
                ->editColumn('is_active', function ($scheme) {
                    return $scheme->is_active ? 'Active' : 'Archived';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.scheme-lookup.view-scheme');
    }

    function create()
    {
        return view('dashboard.scheme-lookup.create-scheme');
    }

    function store(StoreSchemeRequest $request)
    {
        Scheme::insert([
            'scheme' => $request['scheme'],
            'color' => $request['clrscheme'],
            'logo' => $request['namesubmit'],
            'is_active' => $request['is_active']
        ]);
        return redirect()->action([SchemeController::class, 'index']);
    }

    function edit($id)
    {
        $scheme = Scheme::where('id', Crypt::decrypt($id))->first();
        return view('dashboard.scheme-lookup.create-scheme', compact('scheme'));
    }

    function update(StoreSchemeRequest $request, $id)
    {
        Scheme::where('id', $id)->update([
            'scheme' => $request['scheme'],
            'color' => $request['clrscheme'],
            'logo' => $request['namesubmit'],
            'is_active' => $request['is_active'],
        ]);
        return redirect()->action([SchemeController::class, 'index']);
    }
}
