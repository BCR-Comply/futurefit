<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\PropertySurveyor;
use Illuminate\Http\Request;
use App\Models\Surveyor;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class SurveyorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        if (request()->ajax()) {
            $surveyors = Surveyor::select([
                'user_id',
                'email',
                'full_name',
                'phone_number',
                'appname',
                'is_access'
            ]);
            return datatables()->of($surveyors)
                ->addColumn('action', function ($surveyor) {
                    $actions = '<a href="/dashboard/appuser/' . Crypt::encrypt($surveyor->user_id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/appuser/delete/' . Crypt::encrypt($surveyor->user_id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.surveyor.view-surveyor');
    }

    public function createSurveyor()
    {
        $getAllP = Property::where('status','!=','complete')->get();
        return view('dashboard.surveyor.create-surveyor',compact("getAllP"));
    }

    public function storeSurveyor(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'appname' => ['required'],
        ]);
        $contractor = User::create(
            [
                'usertype' => 'User',
                'role' => 'surveyor',
                'firstname' => $request->full_name,
                'lastname' => '',
                'phone' => $request->phone_number,
                'eircode' => "",
                'address1' => "",
                'address2' => "",
                'address3' => "",
                'county' => "",
                'company' => "",
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jobs' => "[]",
                'contractor_next_of_kin_name' => "",
                'contractor_safe_pass_photo' => "",
                'contractor_next_of_kin_phone' => "",
                'contractor_safe_pass_expiry' => "",
                'contractor_medical_issue' => "",
                'contractor_agree_to_health_and_safety_procedure' => "",
                'is_default_contractor' => ""
            ]
        );
        if(isset($request->is_access) && $request->is_access == "1"){
            $isAccess = 1;
        }else{
            $isAccess = 0;
        }
        $surveyor = Surveyor::create(
            [
                'role' => 2,
                'full_name' => $request->full_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'contractor_id' => $contractor->id,
                'password' => Hash::make($request->password),
                'appname' => $request->appname,
                'is_access' => $isAccess,
                'status' => 1
            ]
        );
        if ($surveyor->wasRecentlyCreated === true) {
            if($request->appname == 'Lite'){
                $body = "App user " ."($request->full_name)". " has been added to Lite App";
            }else{
                $body = "App user " ."($request->full_name)". " has been added to Main App";
            }
            $details = [
                "body" => $body,
                "section" => "App User",
                "route" => "surveyor"
            ];
            newNotification($details);
        }
        if($isAccess === 1){
            $getAllP = Property::where('status','!=','complete')->get();
            foreach($getAllP as $getP){
                $checkIsExist = PropertySurveyor::where('property_id',$getP->id)->where('surveyor_id',$request->id)->first();
                if(!$checkIsExist){
                    $req = new Request();
                    $req->merge([
                        'surveyor_id' => $surveyor->user_id,
                        'property_id' => $getP->id,
                        'survey_date' => date('Y-m-d'),
                    ]);
                    $this->assignSurveyorDynamic($req);
                }else{
                    continue;
                }
            }
        }
        if(isset($request->property_ids)){
            $allProp = Property::whereIn('id',$request->property_ids)->get();
            foreach($allProp as $getP){
                $checkIsExist = PropertySurveyor::where('property_id',$getP->id)->where('surveyor_id',$request->id)->first();
                if(!$checkIsExist){
                    $req = new Request();
                    $req->merge([
                        'surveyor_id' => $surveyor->user_id,
                        'property_id' => $getP->id,
                        'survey_date' => date('Y-m-d'),
                    ]);
                    $this->assignSurveyorDynamic($req);
                }else{
                    continue;
                }
            }
        }
        return redirect()->route('surveyor');
    }

    public function editSurveyor($id)
    {
        $id = Crypt::decrypt($id);
        $surveyor = Surveyor::where('user_id', $id)->with('properties.batch')->first();
        $getAllP = Property::where('status','!=','complete')->get();
        return view('dashboard.surveyor.create-surveyor', compact('surveyor','getAllP'));
    }

    public function deleteSurveyor($id)
    {
        $id = Crypt::decrypt($id);
        $surveyorDetails = Surveyor::where('user_id', $id)->first();
        $surveyor = Surveyor::where('user_id', $id)->delete();
        if($surveyor) {
            $details = [
                "body" => "App user " ."($surveyorDetails->full_name)". " has been deleted",
                "section" => "App User",
                "route" => "surveyor"
            ];
            newNotification($details);
        }
        return redirect()->route('surveyor');
    }

    public function updateSurveyor(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_user,email,' . $request->id . ',user_id'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'appname' => ['required'],
            'password' => ['nullable', 'string', 'max:255'],
        ]);
        $updateData2 = [
            'firstname' => $request->full_name,
            'phone' => $request->phone_number,
            'email' => $request->email,
        ];
        if(isset($request->is_access) && $request->is_access == "1"){
            $isAccess = 1;
        }else{
            $isAccess = 0;
        }
        $updateData = [
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'appname' => $request->appname,
            'is_access' => $isAccess,
            'status' => 1
        ];

        if (isset($request->password)) {
            $updateData['password'] = Hash::make($request->password);
            $updateData2['password'] = Hash::make($request->password);
        }

        $surveyor = Surveyor::where('user_id', $request->id)->update($updateData);
        $surveyor2 = Surveyor::where('user_id', $request->id)->first();
        $contractor = User::where('id', $surveyor2->contractor_id)->update($updateData2);
        if ($surveyor > 0) {
            if($request->appname == 'Lite'){
                $body = "App user " ."($request->full_name)". " has been assigned to a Property (Lite App)";
            }else{
                $body = "App user " ."($request->full_name)". " has been assigned to a Property (Main App)";
            }
            $details = [
                "body" => $body,
                "section" => "App User",
                "route" => "surveyor"
            ];
            newNotification($details);
        }
        if($isAccess === 1){
            $getAllP = Property::where('status','!=','complete')->get();
            foreach($getAllP as $getP){
                $checkIsExist = PropertySurveyor::where('property_id',$getP->id)->where('surveyor_id',$request->id)->first();
                if(!$checkIsExist){
                    $req = new Request();
                    $req->merge([
                        'surveyor_id' => $request->id,
                        'property_id' => $getP->id,
                        'survey_date' => date('Y-m-d'),
                    ]);
                    $this->assignSurveyorDynamic($req);
                }else{
                    continue;
                }
            }
        }else{
            $getAllP = Property::where('status','!=','complete')->get();
            foreach($getAllP as $getP){
                $checkIsExist = PropertySurveyor::where('property_id',$getP->id)->where('surveyor_id',$request->id)->delete();
            }
            if(isset($request->property_ids)){
                $allProp = Property::whereIn('id',$request->property_ids)->get();
                foreach($allProp as $getP){
                    $checkIsExist = PropertySurveyor::where('property_id',$getP->id)->where('surveyor_id',$request->id)->first();
                    if(!$checkIsExist){
                        $req = new Request();
                        $req->merge([
                            'surveyor_id' => $request->id,
                            'property_id' => $getP->id,
                            'survey_date' => date('Y-m-d'),
                        ]);
                        $this->assignSurveyorDynamic($req);
                    }else{
                        continue;
                    }
                }
            }
        }
        return redirect()->route('surveyor');
    }
    public function assignSurveyorDynamic(Request $request)
    {
        $data = [
            'surveyor_id' => $request['surveyor_id'],
            'property_id' => $request['property_id'],
            'survey_date' => $request['survey_date'],
        ];

        PropertySurveyor::create($data);

        return true;
    }

    public function searchProperty(Request $request){
        $keyword = $request->value;
        $Properties = Property::select('id')
            ->selectRaw("CONCAT_WS(', ',
                NULLIF(COALESCE(properties.house_num, ''), ''),
                NULLIF(properties.address1, 'null'),
                NULLIF(properties.address2, 'null'),
                NULLIF(properties.address3, 'null'),
                NULLIF(properties.county, ''),
                NULLIF(properties.eircode, '')
            ) AS address")
            ->whereRaw("
                CONCAT_WS(', ',
                    NULLIF(COALESCE(house_num, ''), ''),
                    NULLIF(address1, 'null'),
                    NULLIF(address2, 'null'),
                    NULLIF(address3, 'null'),
                    NULLIF(county, '')
                ) like ?", ["%{$keyword}%"])
            ->get();
        return response()->json(["success" => true, "data" => $Properties]);
    }
}
