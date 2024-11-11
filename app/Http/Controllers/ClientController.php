<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    protected $counties = [
        'Antrim',
        'Armagh',
        'Carlow',
        'Cavan',
        'Clare',
        'Cork',
        'Derry',
        'Donegal',
        'Down',
        'Dublin',
        'Fermanagh',
        'Galway',
        'Kerry',
        'Kildare',
        'Kilkenny',
        'Laois',
        'Leitrim',
        'Limerick',
        'Longford',
        'Louth',
        'Mayo',
        'Meath',
        'Monaghan',
        'Offaly',
        'Roscommon',
        'Sligo',
        'Tipperary',
        'Tyrone',
        'Waterford',
        'Westmeath',
        'Wexford',
        'Wicklow'
    ];

    protected $types = [
        'Private',
        'Council',
        'Warmer Home',
        'Community'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        if (request()->ajax()) {
            $clients = Client::select([
                'id',
                'name',
                'email',
                'phone',
                'eircode',
                'notes',
                'address1',
                'address2',
                'address3',
                'county'
            ]);

            return datatables()->of($clients)
                ->addColumn('action', function ($client) {
                    $actions = '<a href="/dashboard/client/' . Crypt::encrypt($client->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/client/delete/' . Crypt::encrypt($client->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->addColumn('properties', function ($client) {
                    return '<a title="Properties"  href="/dashboard/property/0?client_id=' . Crypt::encrypt($client->id) . '" class="ml-1" title="Properties">View</a>';
                })
                ->addColumn('batches', function ($client) {
                    return '<a title="Batches"  href="/dashboard/batch?client_id=' . Crypt::encrypt($client->id) . '" class="ml-1" title="Batches">View</a>';
                })
                ->addColumn('address', function ($client) {
                    return format_address(
                        null,
                        $client->address1,
                        $client->address2,
                        $client->address3,
                        $client->county
                    );
                })

                ->rawColumns([
                    'action',
                    'batches',
                    'properties',
                    'address'
                ])
                ->make(true);
        }
        return view('dashboard.client.view-client');
    }

    public function createClient()
    {
        $types = $this->types;
        $counties = $this->counties;
        return view('dashboard.client.create-client', compact('types', 'counties'));
    }

    public function storeClient(Request $request)
    {
        $request->validate([
            'email' => ['nullable', 'string', 'email', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:16'],
            'address1' => ['nullable', 'string', 'max:100'],
            'address2' => ['nullable', 'string', 'max:100'],
            'address3' => ['nullable', 'string', 'max:100'],
            'eircode' => ['required', 'string', 'max:50'],
            'county' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:100']
        ]);

        $created_client = Client::create([
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'eircode' => $request->eircode,
            'county' => $request->county,
            'notes' => $request->notes
        ]);

        if ($created_client->wasRecentlyCreated === true) {
            $details = [
                "body" => "New Client " ."($created_client->name)". " has been created",
                "section" => "Client",
                "route" => "client"
            ];
            newNotification($details);
        }

        return redirect()->route('client');
    }

    public function editClient($id)
    {
        $id = Crypt::decrypt($id);
        $client = Client::find($id);

        $types = $this->types;
        $counties = $this->counties;

        return view('dashboard.client.create-client', compact('client', 'types', 'counties'));
    }

    public function deleteClient($id)
    {
        $id = Crypt::decrypt($id);
        $clientDetails = Client::where('id', $id)->first();
        $deleted = Client::where('id', $id)->delete();

        if($deleted) {
            $details = [
                "body" => "Client " ."($clientDetails->name)". " has been deleted",
                "section" => "Client",
                "route" => "client"
            ];
            newNotification($details);
        }

        return redirect()->route('client');
    }

    public function updateClient(Request $request)
    {
        $request->validate([
            'email' => ['nullable', 'string', 'email', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:16'],
            'address1' => ['nullable', 'string', 'max:100'],
            'address2' => ['nullable', 'string', 'max:100'],
            'address3' => ['nullable', 'string', 'max:100'],
            'eircode' => ['required', 'string', 'max:50'],
            'county' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string', 'max:100'],
        ]);

        $client = Client::where('id', $request->id)->update(
            [
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'eircode' => $request->eircode,
                'county' => $request->county,
                'notes' => $request->notes
            ]
        );

        $clientDetails = Client::where('id', $request->id)->first();

        if ($client > 0) {
            $details = [
                "body" => "Client " ."($clientDetails->name)". " has been updated",
                "section" => "Client",
                "route" => "client"
            ];
            newNotification($details);
        }

        return redirect()->route('client');
    }
}
