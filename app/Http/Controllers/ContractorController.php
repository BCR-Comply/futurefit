<?php

namespace App\Http\Controllers;

use App\Models\ContractorProperty;
use App\Models\JobLookup;
use App\Models\Surveyor;
use App\Models\User;
use App\Models\Config;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContractorRequest;
use App\Http\Requests\UpdateEmergencyDetailRequest;
use DB;
class ContractorController extends Controller
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
        $this->middleware('admin', ['except' => ['updateEmergencyDetail']]);
    }
    public function checkDefaultContractor(Request $request)
    {
        // dd($request->all());
        $default_contractor = User::where('role', 'contractor')
            ->where('is_default_contractor', 1)
            ->orderBy('created_at','desc')->first();
            // dd($default_contractor);
        if($default_contractor){
            return response()->json(['success'=>true,'data'=>$default_contractor,'message'=>'Default contractor is avaialble']);
        }else{
            return response()->json(['success'=>false,'data'=>null,'message'=>'Default contractor is not avaialble']);
        }
    }
    public function index()
    {
        if (request()->ajax()) {
            $contractor = User::where('role', 'contractor')->select(['id', 'firstname', 'email', 'company', 'phone', 'jobs', 'address1', 'address2', 'address3']);
            return datatables()->of($contractor)
                ->addColumn('action', function ($contractor) {
                    $actions = '<a href="/dashboard/contractor/' . $contractor->id . '?return_url=property.archived&show=true" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="show"> <i class="text-white mdi mdi-eye"></i></a>';
                    $actions .= '<a href="/dashboard/contractor/' . $contractor->id . '?return_url=property.archived" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/contractor/delete/' . Crypt::encrypt($contractor->id) . '?return_url=property.archived" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->addColumn('address', function ($contractor) {

                    return format_address(
                        null,
                        $contractor->address1,
                        $contractor->address2,
                        $contractor->address3,
                        $contractor->county,
                        null
                    );
                })
                ->make(true);
        }
        return view('dashboard.contractor.view-contractor');
    }

    public function createContractor()
    {
        $show = false;
        $counties = $this->counties;
        return view('dashboard.contractor.create-contractor', get_defined_vars());
    }

    public function storeContractor(StoreContractorRequest $request)
    {
        $safe_pass_photo = '';

        if ($request->hasFile('contractor_safe_pass_photo')) {

            $uploadedFile = $request->file('contractor_safe_pass_photo');

            $filename = explode(
                    '.',
                    $uploadedFile->getClientOriginalName()
                )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            $file = Storage::disk('public')->putFileAs(
                '/',
                $uploadedFile,
                $filename
            );

            $safe_pass_photo = $file;
        }

        $contractor = User::create(
            [
                'usertype' => 'User',
                'role' => 'contractor',
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
                'jobs' => implode(', ', $request->skills ?? []),
                'contractor_next_of_kin_name' => $request->contractor_next_of_kin_name,
                'contractor_safe_pass_photo' => $safe_pass_photo,
                'contractor_next_of_kin_phone' => $request->contractor_next_of_kin_phone,
                'contractor_safe_pass_expiry' => $request->contractor_safe_pass_expiry,
                'contractor_medical_issue' => $request->contractor_medical_issue,
                'contractor_agree_to_health_and_safety_procedure' => $request->contractor_agree_to_health_and_safety_procedure,
                'is_default_contractor' => $request->is_default_contractor
            ]
        );

        if ($contractor->wasRecentlyCreated === true) {
            $details = [
                "body" => "Contractor " ."($contractor->firstname)". " has been added",
                "section" => "Contractor",
                "route" => "contractor"
            ];
            newNotification($details);
        }

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
                    'contractor_id' => $contractor->id
                ]
            );
        }
        if($request->needChangeDefault != "" && $request->needChangeDefault != null){
            $contractorNeedChange = User::where('id', $request->needChangeDefault)->first();
            $contractorNeedChange->is_default_contractor = 0;
            $contractorNeedChange->update();
        }
        $config = Config::first();

        $details = [
            'client_name' => $contractor->firstname,
            'title' => 'Contractor Login Details',
            'email' => $request->email,
            'password' => $request->password,
            'login_url' => env('APP_URL', 'https://futurefit.bcrcomply.com').'/login',
            'template' => 'mail.contractor-onboarding',
            'config' => $config
        ];

        \Mail::to($details['email'])->send(new \App\Mail\Mailer($details));

        return redirect()->route('contractor');
    }

    public function editContractor($contractor_id)
    {
        $show = isset($_GET['show']) ? $_GET['show'] : false;
        $contractor = User::where('id', $contractor_id)->first();

        $counties = $this->counties;

        $jobs = JobLookup::where('type', 'contractor_job')->get();

        return view(
            'dashboard.contractor.create-contractor',get_defined_vars()
        );
    }

    public function deleteContractor($id)
    {
        $id = Crypt::decrypt($id);

        $auth_user_id = Auth::user()->id;

        if ($auth_user_id == $id) {
            abort(404, 'You cannot delete currently logged user!');
        }
        $contDetails = User::where('id', $id)->first();
        $contractor = DB::table('tbl_user')->where('contractor_id', $id)->delete();
        $contractor = User::where('id', $id)->delete();

        if($contractor) {
            $details = [
                "body" => "Contractor " ."($contDetails->firstname)". " has been deleted",
                "section" => "Contractor",
                "route" => "contractor"
            ];
            newNotification($details);
        }
        return redirect()->route('contractor');
    }

    public function updateContractor(StoreContractorRequest $request)
    {
        $updateData = [
            'usertype' => 'User',
            'role' => 'contractor',
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
            'jobs' => implode(', ', $request->skills ?? []),
            'contractor_next_of_kin_name' => $request->contractor_next_of_kin_name,
            'contractor_next_of_kin_phone' => $request->contractor_next_of_kin_phone,
            'contractor_safe_pass_expiry' => $request->contractor_safe_pass_expiry,
            'contractor_medical_issue' => $request->contractor_medical_issue,
            'contractor_agree_to_health_and_safety_procedure' => $request->contractor_agree_to_health_and_safety_procedure,
            'is_default_contractor' => $request->is_default_contractor
        ];

        if ($request->hasFile('contractor_safe_pass_photo')) {

            $uploadedFile = $request->file('contractor_safe_pass_photo');

            $filename = explode(
                    '.',
                    $uploadedFile->getClientOriginalName()
                )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            $file = Storage::disk('public')->putFileAs(
                '/',
                $uploadedFile,
                $filename
            );

            $updateData['contractor_safe_pass_photo'] = $file;
        }

        if (isset($request->password)) {
            $updateData['password'] = Hash::make($request->password);

            $config = Config::first();

            $details = [
                'client_name' => $updateData['firstname'],
                'title' => 'Contractor Login Details',
                'email' => $request->email,
                'password' => $request->password,
                'login_url' => env('APP_URL', 'https://futurefit.bcrcomply.com').'/login',
                'template' => 'mail.contractor-detail-change',
                'config' => $config
            ];


            \Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
        }

        $contractor = User::where('id', $request->id)->update($updateData);
        if($request->needChangeDefault != "" && $request->needChangeDefault != null){
            $contractorNeedChange = User::where('id', $request->needChangeDefault)->first();
            $contractorNeedChange->is_default_contractor = 0;
            $contractorNeedChange->update();
        }
        if ($contractor > 0) {
            $details = [
                "body" => "Contractor " ."($request->firstname)". " has been updated",
                "section" => "Contractor",
                "route" => "contractor"
            ];
            newNotification($details);
        }

        return redirect()->route('contractor');
    }

    function updateEmergencyDetail(UpdateEmergencyDetailRequest $request)
    {

        $updateData = [
            'contractor_next_of_kin_name' => $request->contractor_next_of_kin_name,
            'contractor_next_of_kin_phone' => $request->contractor_next_of_kin_phone,
            'contractor_safe_pass_expiry' => $request->contractor_safe_pass_expiry,
            'contractor_medical_issue' => $request->contractor_medical_issue,
            'contractor_agree_to_health_and_safety_procedure' => $request->contractor_agree_to_health_and_safety_procedure,
        ];

        if ($request->hasFile('contractor_safe_pass_photo')) {

            $uploadedFile = $request->file('contractor_safe_pass_photo');

            $filename = explode(
                    '.',
                    $uploadedFile->getClientOriginalName()
                )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            $file = Storage::disk('public')->putFileAs(
                '/',
                $uploadedFile,
                $filename
            );

            $updateData['contractor_safe_pass_photo'] = $file;
        }

        User::where('id', Auth()->user()->id)->update($updateData);

        return redirect()->back();
    }

}
