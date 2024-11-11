<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Surveyor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\Config;

class HeaBerAssessorController extends Controller
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

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        if (request()->ajax()) {
            $assessor = User::where(
                'role',
                'hea/ber-assessor'
            )->select(['id',
                'firstname',
                'email',
                'company',
                'phone',
                'address1',
                'address2',
                'address3'
            ]);

            return datatables()->of($assessor)
                ->addColumn('action', function ($assessor) {
                    $actions = '<a href="/dashboard/assessor/' . Crypt::encrypt($assessor->id) . '?show=true" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="show"> <i class="text-white mdi mdi-eye"></i></a>';
                    $actions .= '<a href="/dashboard/assessor/' . Crypt::encrypt($assessor->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/assessor/delete/' . Crypt::encrypt($assessor->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->addColumn('address', function ($assessor) {
                    return format_address(
                        null,
                        $assessor->address1,
                        $assessor->address2,
                        $assessor->address3,
                        $assessor->county,
                        null
                    );
                })
                ->make(true);
        }
        return view('dashboard.hea-ber-assessor.view-assessor');
    }

    public function createAssessor()
    {
        $show = false;
        $counties = $this->counties;
        return view('dashboard.hea-ber-assessor.create-assessor', get_defined_vars());
    }

    public function storeAssessor(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'firstname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'eircode' => ['required', 'string', 'max:255'],
            'address1' => ['nullable', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'address3' => ['nullable', 'string', 'max:255'],
            'county' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
        ]);

        $assessor = User::create(
            [
                'usertype' => 'User',
                'role' => 'hea/ber-assessor',
                'firstname' => $request->firstname,
                'lastname' => '',
                'phone' => $request->phone,
                'eircode' => $request->eircode,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'county' => $request->county,
                'company' => $request->company,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jobs' => implode(', ', $request->skills ?? [])
            ]
        );

        $surveyor = Surveyor::where('email', $request->email)->first();

        if (!$surveyor) {
            Surveyor::create(
                [
                    'role' => 2,
                    'full_name' => $request->firstname,
                    'phone_number' => $request->phone,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'appname' => 'Lite',
                    'status' => 1,
                    'assessor_id' => $assessor->id
                ]
            );
        }

        $config = Config::first();

//        TODO: Change email template
        $details = [
            'client_name' => $request->firstname,
            'title' => 'Assessor Login Details',
            'email' => $request->email,
            'password' => $request->password,
            'login_url' => env('APP_URL', 'http://bcr-retrofit.bcrcomply.com').'/login',
            'template' => 'mail.assessor-onboarding',
            'config' => $config
        ];

        \Mail::to($details['email'])->send(new \App\Mail\Mailer($details));

        if ($assessor->wasRecentlyCreated === true) {
            $details = [
                "body" => "Assessor " ."($assessor->firstname)". " has been added",
                "section" => "Assessor",
                "route" => "assessor"
            ];
            newNotification($details);
        }

        return redirect()->route('assessor');
    }

    public function editAssessor($id)
    {
        $show = isset($_GET['show']) ? $_GET['show'] : false;
        $id = Crypt::decrypt($id);
        $assessor = User::where('id', $id)->with('assessor_properties')->first();

        $counties = $this->counties;

        return view(
            'dashboard.hea-ber-assessor.create-assessor',get_defined_vars()
        );
    }

    public function deleteAssessor($id)
    {
        $id = Crypt::decrypt($id);

        $auth_user_id = Auth::user()->id;

        if ($auth_user_id == $id) {
            abort(404, 'You cannot delete currently logged user!');
        }
        $assessorDetails = User::where('id', $id)->first();
        $assessor = User::where('id', $id)->delete();
        if($assessor) {
            $details = [
                "body" => "Assessor " ."($assessorDetails->firstname)". " has been deleted",
                "section" => "Assessor",
                "route" => "assessor"
            ];
            newNotification($details);
        }
        return redirect()->route('assessor');
    }

    public function updateAssessor(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $request->id],
            'firstname' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'eircode' => ['required', 'string', 'max:255'],
            'address1' => ['nullable', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'address3' => ['nullable', 'string', 'max:255'],
            'county' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
        ]);

        $updateData = [
            'usertype' => 'User',
            'role' => 'hea/ber-assessor',
            'firstname' => $request->firstname,
            'lastname' => '',
            'phone' => $request->phone,
            'eircode' => $request->eircode,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'county' => $request->county,
            'company' => $request->company,
            'email' => $request->email,
            'jobs' => implode(', ', $request->skills ?? [])
        ];

        if (isset($request->password)) {
            $updateData['password'] = Hash::make($request->password);

            $config = Config::first();

            $details = [
                'client_name' => $request->firstname,
                'title' => 'Assessor Login Details',
                'email' => $request->email,
                'password' => $request->password,
                'login_url' => env('APP_URL', 'http://bcr-retrofit.bcrcomply.com').'/login',
                'template' => 'mail.assessor-detail-change',
                'config' => $config
            ];

            \Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
        }

        $assessor = User::where('id', $request->id)->update($updateData);
        if ($assessor > 0) {
            $details = [
                "body" => "Assessor " ."($request->firstname)". " has been updated",
                "section" => "Assessor",
                "route" => "assessor"
            ];
            newNotification($details);
        }

        return redirect()->route('assessor');
    }
}
