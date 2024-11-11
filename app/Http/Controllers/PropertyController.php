<?php

namespace App\Http\Controllers;
use App\Models\TableUser;
use Exception;
use ZipArchive;
use Illuminate\Support\Str;
use App\Models\Appointment;
use App\Models\LeadEmail;
use App\Models\AssessorProperty;
use App\Models\Batch;
use App\Models\Ber;
use App\Models\Client;
use App\Models\Config;
use App\Models\ContractorProperty;
use App\Models\File;
use App\Models\Form;
use App\Models\Inspection;
use App\Models\JobLookup;
use App\Models\Measure;
use App\Models\PostWorkLog;
use App\Models\Property;
use App\Models\PropertyNote;
use App\Models\PropertySurveyor;
use App\Models\Reminder;
use App\Models\RiskSafetyForm;
use App\Models\Scheme;
use App\Models\SnagRecord;
use App\Models\Surveyor;
use App\Models\ThirdPartyForm;
use App\Models\User;
use App\Models\UserPropSigninOut;
use App\Models\Variaton;
use App\Models\VariatonDoc;
use App\Models\WorkOrder;
use App\Notifications\ContractorJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Node\Block\Document;
use App\Http\Requests\StoreAssessorContractRequest;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\StoreFinancialRequest;
use App\Http\Requests\StoreMeasureRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\StorePropertyRequest;
use App\Models\PhotoFolderName;
use App\Http\Requests\UpdateContractorPropertyUnits;
use App\Models\PhotoUploads;
use Illuminate\Support\Facades\URL;
use App\Models\ReportConfig;
use Illuminate\Support\Facades\Auth;
class PropertyController extends Controller
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
        'Wicklow',
    ];

    private $contractor_jobs = [];

    private $jobs = [];

    protected $hea_ber_assessor_jobs = [];

    protected $contact_status = [
        'Pending',
        'Accepted',
        'Rejected',
        'Complete',
        'Variation',
        'In-Progress',
    ];

    protected $assessor_contact_status = [
        'Pending',
        'Accepted',
        'Rejected',
        'Complete',
        'In-Progress',
    ];

    protected $assessor_jobs = [
        'HEA Surveyor',
        'BER Assessor',
    ];

    protected $hea_status = [
        'HLI Requested',
        'HLI Submitted',
        'Quotation Sent',
        'Contract Signed',
        'Measures Allocated',
        'Measures Complete',
        'QA',
        'Pending',
        'N/A',
    ];

    protected $contractor_status = [
        'Measures Allocated',
        'Measures Completed',
        'QA Complete',
        'Pending',
    ];

    protected $property_status = [
        'pending' => 'Pending',
        'completed' => 'Completed',
        'in-progress' => 'In-progress',
        'referred-to-employee' => 'Referred to employee',
        'unsuitable' => 'Unsuitable',
        'survey-complete' => 'Survey Complete',
        'lost' => 'Lost',
        'quoted' => 'Quoted',
    ];

    public function __construct()
    {
        $actual_link = "$_SERVER[REQUEST_URI]";
        if(!str_contains($actual_link,'print')){
        $this->middleware('auth', ['except' => ['report','snag_report']]);
        $this->middleware('admin', ['except' => ['report','snag_report']]);
        }
        $contractor_jobs = JobLookup::where('type', 'contractor_job')->with('documents')->get();

        foreach ($contractor_jobs->toArray() as $value) {
            $this->jobs[$value['id']]['title'] = $value['title'];

            $this->jobs[$value['id']]['documents'] = array_map(function ($document) {
                return $document['title'];
            }, $value['documents']);
        }

        $assessor_jobs = JobLookup::where('type', 'assessor_job')->with('documents')->get();

        foreach ($assessor_jobs->toArray() as $value) {
            $this->hea_ber_assessor_jobs[$value['id']]['title'] = $value['title'];

            $this->hea_ber_assessor_jobs[$value['id']]['documents'] = array_map(function ($document) {
                return $document['title'];
            }, $value['documents']);
        }
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
    }

    public function index(Request $request, $scheme_id = 0)
    {

        if (request()->ajax()) {

            $properties = null;

            $archived = $scheme_id == 909090909090 ? 1 : 0;

            $client_id = $request->query('client_id');
            $batch_id = $request->query('batch_id');

            if ($client_id && $batch_id) {
                $properties = Property::where('archived', $archived)->where('client_id', Crypt::decrypt($client_id))->where('batch_id', Crypt::decrypt($batch_id))->with('client')->with('batch.scheme');
            } else if (!$client_id && $batch_id) {
                $properties = Property::where('archived', $archived)->where('batch_id', Crypt::decrypt($batch_id))->with('client')->with('batch.scheme');
            } else if ($client_id && !$batch_id) {
                $properties = Property::where('archived', $archived)->where('client_id', Crypt::decrypt($client_id))->with('client')->with('batch.scheme');
            } else {
                $properties = Property::where('archived', $archived)->with('client')->with('batch.scheme');
            }

            if (!empty($request->get('property_start_date_filter'))) {
                $properties->where('properties.start_date', '>=', $request->get('property_start_date_filter'));
            }

            if (!empty($request->get('property_end_date_filter'))) {
                $properties->where('properties.end_date', '<=', $request->get('property_end_date_filter'));
            }

            if ($scheme_id && $scheme_id != 909090909090) {
                $properties->whereHas('batch.scheme', function ($q) use ($scheme_id) {
                    $q->where('id', $scheme_id);
                });
            }
            $leads_scheme = Scheme::where('scheme', 'Leads')->first();
            if ($leads_scheme && $leads_scheme->id != $scheme_id) {
                $properties->whereHas('batch.scheme', function ($q) use ($scheme_id, $leads_scheme) {
                    $q->where('id', '!=', $leads_scheme->id);
                });
            }
            return datatables()->of($properties)
                ->addColumn('action', function ($property) use ($scheme_id) {
                    $actions = '<a href="/dashboard/property/show/' . Crypt::encrypt($property->id) . '?back=' . $scheme_id . '" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="show"> <i class="text-white mdi mdi-eye"></i></a>';
                    $actions .= '<a href="/dashboard/property/edit/' . Crypt::encrypt($property->id) . '?back=' . $scheme_id . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/property/delete/' . Crypt::encrypt($property->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->addColumn('client', function ($property) {
                    return isset($property->client) ? $property->client->name : '';
                })
                ->addColumn('scheme', function ($property) {
                    return isset($property->batch) ? $property->batch->scheme->scheme : '';
                })
                ->addColumn('ref', function ($property) {
                    return isset($property->batch) ? $property->batch->our_ref : '';
                })
                ->addColumn('batch', function ($property) {
                    return isset($property->batch) ? $property->batch->our_ref : '';
                })
                ->editColumn('status', function ($property) {
                    return ucfirst($property->status);
                })
                ->addColumn('address', function ($property) {
                    return format_address(
                        $property->house_num,
                        $property->address1,
                        $property->address2,
                        $property->address3,
                        $property->county
                    );
                })
                ->addColumn('start_date', function ($property) {
                    return date('d/m/Y', strtotime($property->start_date));
                })
                ->addColumn('end_date', function ($property) {
                    return date('d/m/Y', strtotime($property->end_date));
                })
                ->filterColumn('address', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT( COALESCE(house_num, ''),', ',COALESCE(address1, ''),', ',COALESCE(address2, ''),', ',COALESCE(address3,''), ', ', COALESCE(county, '')) like ?", ["%{$keywords}%"]);
                })
                ->make(true);
        }

        $scheme = Scheme::find($scheme_id);

        $title = $scheme_id == 0 ? 'properties' : ($scheme_id == 909090909090 ? 'Archived' : @$scheme->scheme);

        $batches = Batch::select(['id', 'our_ref'])->get();

        $property_status = $this->property_status;

        return view(
            'dashboard.property.view-property',
            compact(
                'title',
                'scheme_id',
                'batches',
                'property_status'
            )
        );
    }

    public function createProperty(Request $request)
    {

        $clients = Client::select(['id', 'name', 'email'])->groupBy('email')->get();
        $batches = Batch::select(['id', 'our_ref', 'scheme_id'])->get();
        $counties = $this->counties;

        $hea_status = $this->hea_status;
        $contractor_status = $this->contractor_status;

        $back = $request->query('back');

        $_bers = Ber::all();

        $bers = [];

        foreach ($_bers as $ber_item) {
            $bers[] = $ber_item['scale'];
        }

        $property_status = $this->property_status;

        return view(
            'dashboard.property.create-property',
            compact(
                'clients',
                'batches',
                'counties',
                'back',
                'hea_status',
                'contractor_status',
                'bers',
                'property_status'
            )
        );
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
    public function storeProperty(StorePropertyRequest $request)
    {
        $client_id = $request->client_id;

        if ($request->client_select_type == 'select_from_clients') {

            $request->validate([
                'client_id' => ['required', 'numeric'],
            ]);

            $client_id = $request->client_id;
        } else if ($request->client_select_type == 'use_above_client') {

            $created_client = Client::create([
                'email' => $request->email,
                'name' => $request->wh_fname . ' ' . $request->wh_lname,
                'phone' => $request->phone1,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'eircode' => $request->eircode,
                'county' => $request->county,
                'notes' => $request->notes,
            ]);

            $client_id = $created_client->id;
        } else if ($request->client_select_type == 'create_new_client') {

            $request->validate([
                'client_email' => ['nullable', 'string', 'email', 'max:100'],
                'client_name' => ['required', 'string', 'max:100'],
                'client_phone' => ['nullable', 'string', 'max:16'],
                'client_address1' => ['required', 'string', 'max:100'],
                'client_address2' => ['nullable', 'string', 'max:100'],
                'client_address3' => ['nullable', 'string', 'max:100'],
                'client_eircode' => ['required', 'string', 'max:50'],
                'client_county' => ['required', 'string', 'max:50'],
                'client_notes' => ['nullable', 'string', 'max:100'],
            ]);

            $created_client = Client::create([
                'email' => $request->client_email,
                'name' => $request->client_name,
                'phone' => $request->client_phone,
                'address1' => $request->client_address1,
                'address2' => $request->client_address2,
                'address3' => $request->client_address3,
                'eircode' => $request->client_eircode,
                'county' => $request->client_county,
                'notes' => $request->client_notes,
            ]);

            $client_id = $created_client->id;
        }

        $created_property = Property::create([
            'client_id' => $client_id,
            'batch_id' => $request->batch_id,
            'house_num' => $request->house_num,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'address3' => $request->address3,
            'county' => $request->county,
            'eircode' => $request->eircode,
            'wh_fname' => $request->wh_fname,
            'wh_lname' => $request->wh_lname,
            'phone1' => $request->phone1,
            'phone2' => $request->phone2,
            'wh_mprn' => $request->wh_mprn,
            'archived' => $request->archived ? 1 : 0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'hea_status' => $request->hea_status,
            'contractor_status' => $request->contractor_status,
            'status' => $request->status,
            'email' => $request->email,
            'pre_ber' => $request->pre_ber,
            'post_ber' => $request->post_ber,
            'wh_ref' => $request->wh_ref,
        ]);

        $address = format_address(
            $created_property->house_num,
            $created_property->address1,
            $created_property->address2,
            $created_property->address3,
            $created_property->county,
            $created_property->eircode
        );

        $preFolder = PhotoFolderName::where("name","Pre-Works BER Photos")->first();
        $postFolder = PhotoFolderName::where("name","Post-Works BER Photos")->first();

        if($preFolder == null){
            PhotoFolderName::create(['name' => "Pre-Works BER Photos"]);
        }if($postFolder == null){
            PhotoFolderName::create(['name' => "Post-Works BER Photos"]);
        }
        $pId = $created_property->id;
        $getUsers = TableUser::where('is_access',1)->get();
        foreach($getUsers as $gUsr){
        $isAccess = intval($gUsr->is_access);
            if($isAccess === 1){
                $check = PropertySurveyor::where('property_id',$pId)->where('surveyor_id',$gUsr->user_id)->first();
                if(!$check){
                    $ssSave = new PropertySurveyor();
                    $ssSave->surveyor_id = $gUsr->user_id;
                    $ssSave->property_id = $pId;
                    $ssSave->survey_date = date('Y-m-d');
                    $ssSave->today_date_status = 0;
                    $ssSave->save();
                }

            }
        }
        if ($created_property->wasRecentlyCreated === true) {
            $details = [
                "body" => "New Property has been created: ".$address,
                "section" => "Property",
                "route" => "property"
                // "property_id" => $created_property->id
            ];
            newNotification($details);

            $cname = $created_property->client->name;
            $details = [
                "body" => "Client " ."($cname)". " has been added to a Property: ".$address,
                "section" => "Client",
                "route" => "client"
            ];
            newNotification($details);

            $details = [
                "body" => "Property " ."($address)". " has been added to Batch: ".$created_property->batch->our_ref,
                "section" => "Property",
                "route" => "property"
                // "property_id" => $created_property->id
            ];
            newNotification($details);
        }

        return redirect(route('property.show', Crypt::encrypt($created_property->id)));
    }

    public function editProperty(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $property = Property::where('id', $id)->with('batch.scheme')->first();

        $clients = Client::select(['id', 'name', 'email'])->groupBy('email')->get();
        $batches = Batch::select(['id', 'our_ref', 'scheme_id'])->get();
        $counties = $this->counties;

        $hea_status = $this->hea_status;
        $contractor_status = $this->contractor_status;

        $back = $request->query('back');
        $_bers = Ber::all();

        $bers = [];

        foreach ($_bers as $ber_item) {
            $bers[] = $ber_item['scale'];
        }

        $property_status = $this->property_status;

        return view(
            'dashboard.property.create-property',
            compact(
                'property',
                'clients',
                'batches',
                'counties',
                'back',
                'hea_status',
                'contractor_status',
                'bers',
                'property_status'
            )
        );
    }

    public function deleteProperty($id)
    {
        $id = Crypt::decrypt($id);

        $getPropertyDetails = Property::where('id', $id)->first();
        $address = format_address(
            $getPropertyDetails->house_num,
            $getPropertyDetails->address1,
            $getPropertyDetails->address2,
            $getPropertyDetails->address3,
            $getPropertyDetails->county,
            $getPropertyDetails->eircode
        );

        $deleted = Property::where('id', $id)->delete();

        if($deleted) {
            $details = [
                "body" => "Property has been deleted: ".$address,
                "section" => "Property",
                "route" => "property"
            ];
            newNotification($details);
        }
        return redirect()->back();
    }
    public function updateMeaStatus(Request $request)
    {
        $check = ContractorProperty::where('property_id',$request->pid)->where('id',$request->cid)->first();
        if($check){
            $update = ContractorProperty::where('property_id',$request->pid)->where('id',$request->cid)->first();
            $update->status = $request->status;
            if($update->update()){
                if($request->status == "Complete"){
                    $dataNew = ContractorProperty::where('id', $request->cid)->first();

                    $checkAllMeasure = ContractorProperty::where('property_id', $dataNew->property_id)->count();
                    $checkCompleteMeasure = ContractorProperty::where('property_id', $dataNew->property_id)->where('status','Complete')->count();

                    if($checkAllMeasure === $checkCompleteMeasure){
                        DB::table('properties')->where('id',$dataNew->property_id)->update(['status' => "completed"]);
                    }
                }
                return response()->json(['success'=>true,'message'=>"Record update successfully."]);
            }else{
                return response()->json(['success'=>false,'message'=>"Record update failed."]);
            }
        }else{
            return response()->json(['success'=>false,'message'=>"Record not found."]);
        }
        // dd($request->all(),$check);
    }
    public function updateProperty(StorePropertyRequest $request)
    {
        $oldValue = Property::where('id', $request->id)->first();
        if($oldValue && $oldValue->client_id != null && $oldValue->client_id != "" && $oldValue->client_id == intval($request->client_id)){
            $checkCl = Client::where('id',$oldValue->client_id)->first();
            $client_id = $oldValue->client_id;
            if($checkCl){
                if ($request->client_select_type == 'select_from_clients') {

                    $request->validate([
                        'client_id' => ['required', 'numeric'],
                    ]);
    
                    $client_id = $request->client_id;
                } else if ($request->client_select_type == 'use_above_client') {
    
                    $created_client = Client::where('id', $checkCl->id)->update([
                        'email' => '',
                        'name' => $request->wh_fname . ' ' . $request->wh_lname,
                        'phone' => $request->phone1,
                        'address1' => $request->address1,
                        'address2' => $request->address2,
                        'address3' => $request->address3,
                        'eircode' => $request->eircode,
                        'county' => $request->county,
                        'notes' => $request->notes,
                    ]);
    
                    $client_id = $checkCl->id;
                } else if ($request->client_select_type == 'create_new_client') {
                    $created_client = Client::where('id', $checkCl->id)->update([
                        'email' => $request->client_email,
                        'name' => $request->client_name,
                        'phone' => $request->client_phone,
                        'address1' => $request->client_address1,
                        'address2' => $request->client_address2,
                        'address3' => $request->client_address3,
                        'eircode' => $request->client_eircode,
                        'county' => $request->client_county,
                        'notes' => $request->client_notes,
                    ]);
                    $client_id = $checkCl->id;
                }
            }
        }else{
            $client_id = $request->client_id;

            if ($request->client_select_type == 'select_from_clients') {

                $request->validate([
                    'client_id' => ['required', 'numeric'],
                ]);

                $client_id = $request->client_id;
            } else if ($request->client_select_type == 'use_above_client') {

                $created_client = Client::create([
                    'email' => '',
                    'name' => $request->wh_fname . ' ' . $request->wh_lname,
                    'phone' => $request->phone1,
                    'address1' => $request->address1,
                    'address2' => $request->address2,
                    'address3' => $request->address3,
                    'eircode' => $request->eircode,
                    'county' => $request->county,
                    'notes' => $request->notes,
                ]);

                $client_id = $created_client->id;
            } else if ($request->client_select_type == 'create_new_client') {

                $request->validate([
                    'client_email' => ['nullable', 'string', 'email', 'max:100'],
                    'client_name' => ['required', 'string', 'max:100'],
                    'client_phone' => ['nullable', 'string', 'max:16'],
                    'client_address1' => ['required', 'string', 'max:100'],
                    'client_address2' => ['nullable', 'string', 'max:100'],
                    'client_address3' => ['nullable', 'string', 'max:100'],
                    'client_eircode' => ['required', 'string', 'max:50'],
                    'client_county' => ['required', 'string', 'max:50'],
                    'client_notes' => ['nullable', 'string', 'max:100'],
                ]);

                $created_client = Client::create([
                    'email' => $request->client_email,
                    'name' => $request->client_name,
                    'phone' => $request->client_phone,
                    'address1' => $request->client_address1,
                    'address2' => $request->client_address2,
                    'address3' => $request->client_address3,
                    'eircode' => $request->client_eircode,
                    'county' => $request->client_county,
                    'notes' => $request->client_notes,
                ]);

                $client_id = $created_client->id;
            }
        }
        $property = Property::where('id', $request->id)->update(
            [
                'client_id' => $client_id,
                'batch_id' => $request->batch_id,
                'house_num' => $request->house_num,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'address3' => $request->address3,
                'county' => $request->county,
                'eircode' => $request->eircode,
                'wh_fname' => $request->wh_fname,
                'wh_lname' => $request->wh_lname,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
                'wh_mprn' => $request->wh_mprn,
                'archived' => $request->archived ? 1 : 0,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'hea_status' => $request->hea_status,
                'contractor_status' => $request->contractor_status,
                'status' => $request->status,
                'email' => $request->email,
                'pre_ber' => $request->pre_ber,
                'post_ber' => $request->post_ber,
                'wh_ref' => $request->wh_ref,
            ]
        );
        $getPropertyDetails = Property::where('id', $request->id)->first();

        $address = format_address(
            $getPropertyDetails->house_num,
            $getPropertyDetails->address1,
            $getPropertyDetails->address2,
            $getPropertyDetails->address3,
            $getPropertyDetails->county,
            $getPropertyDetails->eircode
        );

            $pId = $request->id;
            $getUsers = TableUser::where('is_access',1)->get();
            foreach($getUsers as $gUsr){
            $isAccess = intval($gUsr->is_access);
                if($isAccess === 1){
                    $check = PropertySurveyor::where('property_id',$pId)->where('surveyor_id',$gUsr->user_id)->first();
                    if(!$check){
                        $ssSave = new PropertySurveyor();
                        $ssSave->surveyor_id = $gUsr->user_id;
                        $ssSave->property_id = $pId;
                        $ssSave->survey_date = date('Y-m-d');
                        $ssSave->today_date_status = 0;
                        $ssSave->save();
                    }

                }
            }

        if ($property > 0) {
            $details = [
                "body" => "Property has been updated: ".$address,
                "section" => "Property",
                "route" => "property"
            ];
            newNotification($details);

            if($oldValue->batch_id != $getPropertyDetails->batch_id){
                $details = [
                    "body" => "Property " ."($address)". " has been added to Batch: ".$getPropertyDetails->batch->our_ref,
                    "section" => "Property",
                    "route" => "property"
                ];
                newNotification($details);
            }

            if($getPropertyDetails->status == "completed") {
                $details = [
                    "body" => "Property has has been completed: ".$address,
                    "section" => "Property",
                    "route" => "property"
                ];
                newNotification($details);
            }
        }

        $back = $request->query('back');

        return redirect()->route('property.show', Crypt::encrypt($request->id));
    }

    public function showProperty(Request $request, $id)
    {
        $appointments = $emailDatas = [];
        $id = Crypt::decrypt($id);

        $property = Property::where('id', $id)->with('batch.scheme')->with('measures.job_lookup:id,title')->with('user_signin_out')->with('user_signin_out.users')->with('snags')->first();
        // dd($property->user_signin_out);
        $contractors = ContractorProperty::where('property_id', $id)
            ->with('contractor')
            ->with('document')
            ->with('word_orders')
            ->with('variation.documents')
            ->with('surveyor')
            ->with('post_work_log')
            ->with('job_lookup:id,title')
            // ->where('end_date','!=',null)
            // ->where('start_date','!=',null)
            ->get();
        $surveyors = Surveyor::select(['full_name', 'user_id'])->get();
        $inspections = Inspection::where('fk_property_id', $id)
            ->with('form')
            ->with('property')
            ->with('property.client')
            ->get()
            ->sortByDesc("id");

        $third_party_forms = ThirdPartyForm::where('fk_property_id', $id)->orderBy('archived')->get();
        $appointments = Appointment::where('property_id', $id)->orderBy('id', 'DESC')->get();
        $emailDatas = LeadEmail::where('fk_property_id',$id)->orderBy('id', 'DESC')->get();
        $reminders = Reminder::where('property_id', $id)->orderBy('reminders.id', 'DESC')->get();
        $currentDateTimestamp = strtotime(date('Y-m-d'));
        $nextDayTimestamp = $currentDateTimestamp + 24 * 60 * 60; // Add 1 day (24 hours * 60 minutes * 60 seconds)

        $nextDay = date('Y-m-d', $nextDayTimestamp);

        $start = date('1970-01-01');
        $end = date('3000-12-31');

        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d');
        $time = date('H:i');
        $currentTime = date('Y-m-d H:i');
        $remindersss = Reminder::select('reminders.*')
        ->selectRaw("CONCAT_WS(', ',
        COALESCE(properties.house_num, ''),
        NULLIF(properties.address1, 'null'),
        NULLIF(properties.address2, 'null'),
        NULLIF(properties.address3, 'null'),
        COALESCE(properties.county, ''),
        COALESCE(properties.eircode, '')
        ) AS address")
        ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
        ->where('reminders.property_id', $id)
        ->whereNotNull('reminders.when_time')
        ->where('reminders.status','Pending')
        ->whereNotNull('reminders.due_time')
        ->whereNotNull('reminders.due_date')
        ->whereBetween('reminders.due_date',[$start,$end])
        ->orderBy('reminders.id', 'DESC')
        // ->whereDate('reminders.due_date', '>=', $date)
        ->get();
        $reminderss = [];
        $reminderss = $remindersss->filter(function ($reminder) use ($currentTime) {
            $dueDateTime = calculateDueDateTime($reminder->due_date, $reminder->due_time, $reminder->when_time);
            return strtotime($currentTime) >= strtotime($dueDateTime) && $reminder->when_time != null;
        });

        $remindersCount = sizeOf($remindersss->filter(function ($reminder) use ($currentTime) {
            $dueDateTime = calculateDueDateTime($reminder->due_date, $reminder->due_time, $reminder->when_time);
            return strtotime($currentTime) >= strtotime($dueDateTime) && $reminder->when_time != null && $reminder->is_read == 1;
        }));
        $reminderss = $reminderss->values();
        // foreach ($reminderss as $reminder) {
        //     $reminder->is_read = 1;
        //     $reminder->update();
        // }

        $assessors = AssessorProperty::where('property_id', $id)
            ->with('assessor')
            ->with('document')
            ->with('work_orders')
            ->with('surveyor')
            ->with('job_lookup:id,title')
            ->with('work_orders')
            ->get();

        $counties = $this->counties;

        $contractor_jobs = $this->jobs;

        $processed_contracts = [];
        $processed_assessor_contracts = [];
        $assigned_jobs = [];
        $post_work_log_count = 0;

        foreach ($contractors as $contract) {

            $documents = [];
            $remaining_documents = [];

            $assigned_jobs[$contract['job_id']] = $contract['status'];

            foreach ($contract['document'] as $document) {
                $documents[] = $document['document'];
            }

            if (isset($contractor_jobs[$contract['job_id']]['documents'])) {
                foreach ($contractor_jobs[$contract['job_id']]['documents'] as $document) {
                    if (!in_array($document, $documents)) {
                        $remaining_documents[] = $document;
                    }
                }
            }

            if (isset($contract->job_lookup->library_documents) && !empty($contract->job_lookup->library_documents)) {
                if (!isset($contractor_jobs[$contract['job_id']]['library_documents'])) {
                    $contractor_jobs[$contract['job_id']]['library_document_id'] = [];
                    $contractor_jobs[$contract['job_id']]['library_documents'] = [];
                }
                foreach ($contract->job_lookup->library_documents as $library_doc) {
                    if (!in_array($library_doc->file, $contractor_jobs[$contract['job_id']]['library_document_id'])) {
                        $contractor_jobs[$contract['job_id']]['library_document_id'][] = $library_doc->file;
                        array_push($contractor_jobs[$contract['job_id']]['library_documents'], array('id' => $library_doc->id, 'name' => $library_doc->document, 'job_document_type' => ucfirst($library_doc->job_document_type->title ?? '')));
                    }
                }
            }
            $contract['remaining_documents'] = $remaining_documents;

            $processed_contracts[] = $contract;

            $post_work_log_count += sizeof(array_filter($contract->post_work_log->toArray(), function ($option) {
                return $option['status'] == 'Opened';
            }));
        }

        foreach ($assessors as $assessor) {

            $documents = [];
            $remaining_documents = [];

            foreach ($assessor['document'] as $document) {
                $documents[] = $document['document'];
            }

            if (isset($this->hea_ber_assessor_jobs[$assessor['job_id']]['documents'])) {
                foreach ($this->hea_ber_assessor_jobs[$assessor['job_id']]['documents'] as $document) {
                    if (!in_array($document, $documents)) {
                        $remaining_documents[] = $document;
                    }
                }
            }

            $assessor['remaining_documents'] = $remaining_documents;

            $processed_assessor_contracts[] = $assessor;
        }

        $contractors = $processed_contracts;
        $assessors = $processed_assessor_contracts;

        $hea_status = $this->hea_status;
        $contractor_status = $this->contractor_status;

        $property_status = $this->property_status;
        $snags = $property->snags;
        $back = $request->query('back');
        $folderList = [];
        $folderLists = DB::table('photo_folder_names')->select('*')->orderBy('id', 'asc')->get();
        $getfolders = PhotoUploads::select('photo_uploads.fk_section_id','photo_folder_names.name as fk_section_name')
        ->join('photo_folder_names','photo_folder_names.id','photo_uploads.fk_section_id')
        ->where('photo_uploads.fk_property_id',$id)
        ->groupBy('fk_section_id', 'fk_section_name')
        ->get();

        $post_work_logs = PostWorkLog::select('post_works_logs.*','properties.house_num','properties.address1','properties.address2','properties.address3','properties.county','properties.eircode')
        ->leftjoin('contractor_property','contractor_property.id','post_works_logs.fk_contractor_property_id')
        ->leftjoin('properties','properties.id','contractor_property.property_id')
        ->with('contractor_property')->orderBy('post_works_logs.id', 'desc')
        ->where('contractor_property.property_id', $id)
        ->get();
        return view(
            'dashboard.property.show-property1',
            compact(
                'property',
                'counties',
                'contractors',
                'surveyors',
                'inspections',
                'appointments',
                'emailDatas',
                'contractor_jobs',
                'third_party_forms',
                'reminders',
                'remindersCount',
                'reminderss',
                'back',
                'assessors',
                'hea_status',
                'contractor_status',
                'assigned_jobs',
                'post_work_log_count',
                'property_status',
                'snags',
                'folderLists',
                'getfolders',
                'post_work_logs'
            )
        );
    }

    public function assignContractor($property_id, $contract_id = null)
    {
        $contractors = User::where('role', 'contractor')->get();
        $surveyors = Surveyor::get();

        $contract = null;

        if ($contract_id) {
            $contract = ContractorProperty::where('id', $contract_id)->with('contractor')->first();
        }

        $contractor_jobs = $this->jobs;

        $contact_status = $this->contact_status;

        return view(
            'dashboard.property.assign-contractor',
            compact(
                'contractors',
                'property_id',
                'contractor_jobs',
                'contract',
                'contact_status',
                'surveyors'
            )
        );
    }

    public function storeContract(StoreContractRequest $request)
    {
        $contract = ContractorProperty::create([
            'contractor_id' => $request->contractor_id,
            'property_id' => $request->property_id,
            'notes' => $request->notes,
            'job_id' => $request->job_id,
            'cost' => $request->cost ?? 0.0,
            'paid' => $request->paid ?? 0.0,
            'our_price' => $request->our_price ?? 0.0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'surveyor_id' => $request->surveyor_id,
        ]);
        // Sending Email
        $contractor_property = ContractorProperty::where('id', $contract->id)->with('property')->with('contractor')->with('job_lookup:id,title')->first();
        $is_measure_alreadt_exist = Measure::where('property_id',$request->property_id)->where('job_id',$request->job_id)->first();

        if (!$is_measure_alreadt_exist) {
            $measure = Measure::create([
                'property_id' => $request->property_id,
                'job_id' => $request->job_id
            ]);
        }

        // auto assign surveyor
        $surveyor = Surveyor::where('email', $contractor_property->contractor->email)->first();
        if (empty($surveyor)) {
            $surveyor = Surveyor::create([
                'role' => 2,
                'full_name' => $contractor_property->contractor->firstname . ' ' . $contractor_property->contractor->lastname,
                'email' => $contractor_property->contractor->email,
                'password' => $contractor_property->contractor->password,
                'phone_number' => $contractor_property->contractor->phone,
                'status' => 1,
                'appname' => 'Lite',
                'created_date' => $contractor_property->contractor->created_at,
                'company' => 'BCR',
            ]);
        }

        PropertySurveyor::create([
            'property_id' => $request->property_id,
            'surveyor_id' => $surveyor->user_id,
            'survey_date' => $request->start_date,
            'today_date_status' => ($request->start_date == date('Y-m-d')) ? 1 : 0,
        ]);

        $address = format_address(
            $contractor_property->property->house_num,
            $contractor_property->property->address1,
            $contractor_property->property->address2,
            $contractor_property->property->address3,
            $contractor_property->property->county,
            $contractor_property->property->eircode
        );

        $email = $contractor_property->contractor->email;
        $job = $contractor_property['job_lookup']['title'] ?? '';

        $notification_details = ['assigned_job' => $job, 'property_id' => $request->property_id, 'property_address' => $address];
        User::find($request->contractor_id)->notify(new ContractorJob($notification_details));

        $config = Config::first();

        $details = [
            'name' => $contractor_property->contractor->firstname,
            'title' => 'Contractor Job Assignment',
            'assigned_job' => $job,
            'property_address' => $address,
            'email' => $contractor_property->contractor->email,
            'password' => $contractor_property->contractor->password,
            'template' => 'mail.job-assignment',
            'config' => $config,
        ];

        \Mail::to($email)->send(new \App\Mail\Mailer($details));

        $conName = $contractor_property->contractor->firstname;
        if ($contract->wasRecentlyCreated === true) {
            $details = [
                "body" => "Contractor " ."($conName)". " has been added to Measure: ".$job,
                "section" => "Property",
                "sub_section" => "con",
                "property_id" => $request->property_id,
                "route" => "property.show"
            ];
            newNotification($details);
        }

        $back_url = $request->query('back_url');

        return redirect()->route($back_url, Crypt::encrypt($request->property_id));
    }

    public function updateContract(StoreContractRequest $request)
    {
        ContractorProperty::where('id', $request->contract_id)->update([
            'contractor_id' => $request->contractor_id,
            'property_id' => $request->property_id,
            'notes' => $request->notes,
            'job_id' => $request->job_id,
            'cost' => $request->cost ?? 0.0,
            'paid' => $request->paid ?? 0.0,
            'our_price' => $request->our_price ?? 0.0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'surveyor_id' => $request->surveyor_id,
            'units' => $request->units
        ]);
        $contractor_property = ContractorProperty::where('id', $request->contract_id)->with('property')->with('contractor')->with('job_lookup:id,title')->first();
        $is_measure_alreadt_exist = Measure::where('property_id',$request->property_id)->where('job_id',$request->job_id)->first();

        if (!$is_measure_alreadt_exist) {
            $measure = Measure::create([
                'property_id' => $request->property_id,
                'job_id' => $request->job_id
            ]);
        }
        // auto assign surveyor
        $surveyor = Surveyor::where('email', $contractor_property->contractor->email)->first();
        if (empty($surveyor)) {
            $surveyor = Surveyor::create([
                'role' => 2,
                'full_name' => $contractor_property->contractor->firstname . ' ' . $contractor_property->contractor->lastname,
                'email' => $contractor_property->contractor->email,
                'password' => $contractor_property->contractor->password,
                'phone_number' => $contractor_property->contractor->phone,
                'status' => 1,
                'appname' => 'Lite',
                'created_date' => $contractor_property->contractor->created_at,
                'company' => 'BCR'
            ]);
        }

        PropertySurveyor::create([
            'property_id' => $request->property_id,
            'surveyor_id' => $surveyor->user_id,
            'survey_date' => $request->start_date,
            'today_date_status' => ($request->start_date == date('Y-m-d')) ? 1 : 0
        ]);

        $config = Config::first();
        $address = format_address(
            $contractor_property->property->house_num,
            $contractor_property->property->address1,
            $contractor_property->property->address2,
            $contractor_property->property->address3,
            $contractor_property->property->county,
            $contractor_property->property->eircode
        );
        $job = $contractor_property['job_lookup']['title'] ?? '';
        $email = $contractor_property->contractor->email;
        $details = [
            'name' => $contractor_property->contractor->firstname,
            'title' => 'Contractor Job Assignment',
            'assigned_job' => $job,
            'property_address' => $address,
            'email' => $contractor_property->contractor->email,
            'password' => $contractor_property->contractor->password,
            'template' => 'mail.job-assignment',
            'config' => $config,
        ];

        \Mail::to($email)->send(new \App\Mail\Mailer($details));
        $back_url = $request->query('back_url');

        return redirect()->route($back_url, Crypt::encrypt($request->property_id));
    }

    public function deleteContract($id)
    {
        $id = Crypt::decrypt($id);
        ContractorProperty::where('id', $id)->delete();
        return redirect()->back();
    }

    public function assignSurveyor(Request $request)
    {
        $data = [
            'surveyor_id' => $request['surveyor_id'],
            'property_id' => $request['property_id'],
            'survey_date' => $request['survey_date'],
        ];

        PropertySurveyor::create($data);

        return json_encode($data);
    }

    public function removeSurveyor($property_id)
    {
        if ($property_id) {
            PropertySurveyor::where('id', $property_id)->delete();
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }

    public function getSurveyors($property_id)
    {
        $result = PropertySurveyor::where('property_id', $property_id)->with('surveyor')->get();
        $surveyors = [];
        foreach ($result as $entry) {
            if (isset($entry['surveyor'])) {
                $surveyors[] = [
                    'id' => $entry['id'],
                    'survey_date' => date("d/m/Y", strtotime($entry['survey_date'])),
                    'name' => $entry['surveyor']['full_name'],
                    'today_date_status' => $entry['today_date_status'],
                ];
            }
        }

        return json_encode($surveyors);
    }

    public function addThirdPartyForm(Request $request)
    {
        $getPropertyDetails = Property::where('id', $request['property_id'])->first();
        $address = format_address(
            $getPropertyDetails->house_num,
            $getPropertyDetails->address1,
            $getPropertyDetails->address2,
            $getPropertyDetails->address3,
            $getPropertyDetails->county,
            $getPropertyDetails->eircode
        );
        if ($request->hasFile('third-party-files')) {

            foreach ($request->file('third-party-files') as $uploadedFile) {
                $filename = explode(
                    '.',
                    $uploadedFile->getClientOriginalName()
                )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                if (in_array($uploadedFile->getClientOriginalExtension(), ['php', 'phtml', 'asp', 'exe'])) {
                    abort('401', 'This file type is not allowed');
                }

                $file = Storage::disk('public')->putFileAs(
                    '/',
                    $uploadedFile,
                    $filename
                );

                $filename = $file;

                $thirdP = ThirdPartyForm::create([
                    'file_path' => $filename,
                    'notes' => $request['notes'],
                    'supplied_by' => $request['supplied-by'],
                    'fk_property_id' => $request['property_id'],
                    'type' => $request['type'],
                ]);
                if ($thirdP->wasRecentlyCreated === true) {
                    if($getPropertyDetails->batch->scheme->scheme == "Leads"){
                        $details = [
                            "body" => "3rd Party Forms Document " ."($filename)". " has been added to Lead: ".$address,
                            "section" => "Lead",
                            "sub_section" => "threepdf",
                            "property_id" => $request->property_id,
                            "route" => "lead.show"
                        ];
                    }else{
                        $details = [
                            "body" => "3rd Party Forms Document " ."($filename)". " has been added to Property: ".$address,
                            "section" => "Property",
                            "sub_section" => "threepdf",
                            "property_id" => $request->property_id,
                            "route" => "property.show"
                        ];
                    }
                    newNotification($details);
                }
            }
        }

        return redirect()->back();
    }

    public function changeThirdPartyStatus($id, $status)
    {

        $thirdPDetails = ThirdPartyForm::where('id', $id)->first();
        $thirdP = ThirdPartyForm::where('id', $id)->update([
            'archived' => $status == 'Active' ? 0 : 1,
        ]);
        if ($thirdP > 0) {
            if($status == 'Active'){
                $body = "3rd Party Forms Document " ."($thirdPDetails->file_path)". " has been unarchived ";
            }else{
                $body = "3rd Party Forms Document " ."($thirdPDetails->file_path)". " has been Archived ";
            }
            $property = Property::where('id', $thirdPDetails->fk_property_id)->first();
            if($property->batch->scheme->scheme == "Leads"){
                $details = [
                    "body" => $body,
                    "section" => "Lead",
                    "sub_section" => "threepdf",
                    "property_id" => $thirdPDetails->fk_property_id,
                    "route" => "lead.show"
                ];
            }else{
                $details = [
                    "body" => $body,
                    "section" => "Property",
                    "sub_section" => "threepdf",
                    "property_id" => $thirdPDetails->fk_property_id,
                    "route" => "property.show"
                ];
            }
            newNotification($details);
        }
        return redirect()->back();
    }

    public function uploadWorkOrder(Request $request)
    {
        if ($request->hasFile('work-order-file')) {

            $uploadedFile = $request->file('work-order-file');

            $file_path = explode(
                '.',
                $uploadedFile->getClientOriginalName()
            )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            $file_name = $uploadedFile->getClientOriginalName();

            if (in_array($uploadedFile->getClientOriginalExtension(), ['php', 'phtml', 'asp', 'exe'])) {
                abort('401', 'This file type is not allowed');
            }

            $file = Storage::disk('public')->putFileAs(
                '/',
                $uploadedFile,
                $file_path
            );

            $file_path = $file;

            $data = [
                'file_path' => $file_path,
                'status' => 'Active',
                'date' => date('Y-m-d H:i:s'),
                'file_name' => $file_name,
            ];

            if (isset($request['assessor_id'])) {
                $data['fk_assessor_property_id'] = $request['assessor_id'];
                $data['fk_contractor_property_id'] = 0;
            } else {
                $data['fk_contractor_property_id'] = $request['contract_id'];
                $data['fk_assessor_property_id'] = 0;
            }

            WorkOrder::create($data);
        }

        return redirect()->back();
    }

    public function changeWorkOrderStatus($id, $status)
    {

        WorkOrder::where('id', $id)->update([
            'status' => $status == 'Active' ? 'Active' : 'Archived',
        ]);

        return redirect()->back();
    }
    public function reportEdit(Request $request, $inspection_id)
    {
        // dd($request->all(), $inspection_id);
        $backs = 8;
        $data = $contractors = [];
        $back = $request->query('back');
        $data = Inspection::where('id', $inspection_id)
            ->with('property.client')
            ->with('property.measures.job_lookup:id,title')
            ->with('risk_safety_form')
            ->first();
        $contractors = ContractorProperty::where('property_id', $data->property->id)
            ->with('contractor')
            ->get();
        $template = 'dashboard.property.reports.safty-report-edit';
        return view($template, compact('data', 'backs', 'back', 'contractors'));
    }
    public function sendPdfClient(Request $request,$inspection_id)
    {
        $inspData = Inspection::where('id', $inspection_id)
            ->with('form')
            ->with('property.client')
            ->first();
            if($inspData){
            $cdata = $inspData->property->client;
            $config = Config::first();
            $file = asset('futurefitapi/public/assets/uploads/inspection_pdf').$inspData->pdf_filename;
            $details = [
                'name' => $inspData->name,
                'title' => $inspData->form->name.' PDF',
                'email' => $cdata->email,
                'file' => $file,
                'config' => $config,
                'template' => 'mail.pdf-sent',
            ];
            \Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
            return redirect()->back()->with('success','PDF Sent to '.$inspData->name.' Successfully.');
        }else{
            return redirect()->back()->with('error','User not Found.');
        }
    }
    public function property_report(Request $request, $inspection_id, $mode = 'view')
    {
        $template = '';
        $data = [];
        $type = DB::table('inspections')->where('id',$inspection_id)->first()->fk_forms_id;
        if ($type == 13) { //Progress Report

            $query = "SELECT
                        inspections.date_inspected AS date_inspected,
                        clients.NAME AS client_name,
                        inspections.NAME AS surveyed_by,
                        inspections.signature AS signature,
                        CONCAT(
                            COALESCE(properties.house_num, ''),
                            CASE WHEN properties.house_num IS NOT NULL THEN ', ' ELSE '' END,
                            COALESCE(properties.address1, ''),
                            CASE WHEN properties.address1 IS NOT NULL THEN ', ' ELSE '' END,
                            COALESCE(properties.address2, ''),
                            CASE WHEN properties.address2 IS NOT NULL THEN ', ' ELSE '' END,
                            COALESCE(properties.address3, ''),
                            CASE WHEN properties.address3 IS NOT NULL THEN ', ' ELSE '' END,
                            COALESCE(properties.county, ''),
                            CASE WHEN properties.county IS NOT NULL THEN ', ' ELSE '' END,
                            COALESCE(properties.eircode, '')
                        ) AS address,
                        progress_report.note AS note,
                        progress_report.photos1 AS photo1,
                        progress_report.photos2 AS photo2,
                        progress_report.photos3 AS photo3,
                        progress_report.photos4 AS photo4,
                        progress_report.photos5 AS photo5,
                        progress_report.photos6 AS photo6,
                        progress_report.photos7 AS photo7,
                        progress_report.photos8 AS photo8,
                        progress_report.photos9 AS photo9,
                        progress_report.photos10 AS photo10,
                        progress_report.type AS report_type,
                        inspections.fk_property_id AS fk_property_id
                    FROM
                        inspections
                        JOIN properties ON properties.id = inspections.fk_property_id
                        JOIN clients ON clients.id = properties.client_id
                        JOIN progress_report ON progress_report.fk_inspection_id = inspections.id
                    WHERE
                        inspections.id = " . $inspection_id;

            $result = DB::select($query);

            $data = [
                'date_inspected' => '',
                'client_name' => '',
                'surveyed_by' => '',
                'signature' => '',
                'address' => '',
                'note' => '',
                'photo1' => '',
                'photo2' => '',
                'photo3' => '',
                'photo4' => '',
                'photo5' => '',
                'photo6' => '',
                'photo7' => '',
                'photo8' => '',
                'photo9' => '',
                'photo10' => '',
                'report_type' => '',
                'fk_property_id' => '',
            ];

            foreach ($result as $value) {
                $data['date_inspected'] = $value->date_inspected;
                $data['client_name'] = $value->client_name;
                $data['surveyed_by'] = $value->surveyed_by;
                $data['signature'] = $value->signature;
                $data['address'] = $value->address;
                $data['note'] = $value->note;
                $data['photo1'] = $value->photo1;
                $data['photo2'] = $value->photo2;
                $data['photo3'] = $value->photo3;
                $data['photo4'] = $value->photo4;
                $data['photo5'] = $value->photo5;
                $data['photo6'] = $value->photo6;
                $data['photo7'] = $value->photo7;
                $data['photo8'] = $value->photo8;
                $data['photo9'] = $value->photo9;
                $data['photo10'] = $value->photo10;
                $data['report_type'] = $value->report_type;
                $data['fk_property_id'] = $value->fk_property_id;
            }

            // $template = 'dashboard.property.progress-report';
            $template = 'dashboard.property.progress-report1';
        } else if ($type == 12) { //Pre Works Inspection

            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('build_details')
                ->with('wall_insulation')
                ->with('external_insulation1')
                ->with('external_insulation2')
                ->with('attic_insulation')
                ->with('heating_upgrade')
                ->with('grand_total')
                ->with('grant_and_credits')
                ->with('additional_photo_and_note')
                ->with('additional_drawing_and_photo')
                ->with('addtitional_building_detail')
                ->with('internal_insulation')
                ->first();

            $template = 'dashboard.property.inspection-report1';
        } else if ($type == 22) { //OSS Quotation

            $data = Inspection::where('id', $inspection_id)
                ->with('property.batch.scheme')
                ->with('oss_template')
                ->with('oss_cost')
                ->first();

            $template = 'dashboard.property.oss-template2';
        } else if ($type == 24) { //Fuel Quotation

            $data = Inspection::where('id', $inspection_id)
                ->with('property.batch.scheme')
                ->with('fuel_template')
                ->with('fuel_cost')
                ->first();

            $template = 'dashboard.property.oss-template1';
        } else if ($type == 23) { //Hosuing Quotation

            $data = Inspection::where('id', $inspection_id)
                ->with('property.batch.scheme')
                ->with('housing_template')
                ->with('housing_cost')
                ->first();

            $template = 'dashboard.property.oss-template1';
        } else if ($type == 25) { //Better Energy Homes QA
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('bre_photo_inspection_items.bre_question')
                ->with('bre_photo_inspection_items.bre_item')
                ->with('bre_photo_inspection_items.bre_area')
                ->with('bre_snag')
                ->with('bre_snag.comments')
                ->with('bre_snag.comments.comment_reply')
                ->first();
            $groupedData = $data->bre_photo_inspection_items->groupBy('type');

            unset($data->bre_photo_inspection_items);

            $data['bre_photo_inspection_items'] = $groupedData;

            $template = 'dashboard.property.better-energy-homes-report1';
        } else if ($type == 21) { // Installer Progress Report
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('photo_inspection_items.question')
                ->with('photo_inspection_items.item.area')
                ->first();

            $template = 'dashboard.property.installer-progress-report1';
        } else if ($type == 7) { // CWI Survey
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('ws_Additional_property_detail')
                ->with('ws_building_details')
                ->with('ws_building_type')
                ->with('ws_condition_of_inner_leaf')
                ->with('ws_insulation_present_in_cavity')
                ->with('ws_new_build_cavity')
                ->with('ws_services_in_the_cavity')
                ->with('ws_condition_of_outer_leaf')
                ->with('ws_ventilation_through_the_cavity')
                ->first();

            $template = 'dashboard.property.cwi-survey1';
        } else if ($type == 14) { // EWI Installer Progress Report
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('sir_base_coat_complete')
                ->with('sir_boarding_complete')
                ->with('sir_drawings_photographs')
                ->with('sir_finish_coat_complete')
                ->with('sir_job_complete')
                ->with('sir_preparation_complete')
                ->first();

            $template = 'dashboard.property.ewi-installer1';
        } else if ($type == 26) { // Contractors QA
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('cqa_photo_inspection_items.cqa_question')
                ->with('cqa_photo_inspection_items.cqa_area')
                ->first();

            $template = 'dashboard.property.contractors-qa';
        } else if ($type == 6) { // Roof Survey
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('rs_additional_property_detail')
                ->with('rs_building_details')
                ->with('rs_coomments_photographs')
                ->with('rs_roof_conditions')
                ->with('rs_roof_services')
                ->with('rs_roof_types')
                ->with('rs_roof_ventilation')
                ->with('rs_spray_plan_for_roof')
                ->first();

            $template = 'dashboard.property.reports.roof-survey1';
        } else if ($type == 15) { // terreco Survey
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('property.contract.contractor')
                ->with('terraco_forms')
                ->first();
            // dd($data);
            $template = 'dashboard.property.reports.terreco-survey';
        } else if ($type == 55) {
            $data = [];
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('risk_safety_form')
                ->with('property.contract.contractor')
                ->with('property.measures.job_lookup:id,title')
                ->first();
            // dd($data);
            $template = 'dashboard.property.reports.safty-report';
        } else if ($type == 57) {
            $data = [];
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('pre_risk_safety_form')
                ->with('property.contract.contractor')
                ->with('property.measures.job_lookup:id,title')
                ->first();
            // dd($data);
            $template = 'dashboard.property.reports.prem-safty-report';
        } else if ($type == 56 || $type == 58 || $type == 59 || $type == 60) {
            $data = [];
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('rams_core_ventilation')
                ->with('property.contract.contractor')
                ->with('property.measures.job_lookup:id,title')
                ->first();
            // dd($data->rams_core_ventilation);
            $template = 'dashboard.property.reports.rams-core-vent-report';
        } else if ($type == 11) {
            $data = [];
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                ->with('contract_forms')
                ->with('property.contract.contractor')
                ->with('property.measures.job_lookup:id,title')
                ->first();
            $template = 'dashboard.property.reports.contact-report1';
        } else if ($type == 61) {
            $data = [];
            $data = Inspection::where('id', $inspection_id)
                ->with('property.client')
                // ->with('toolbox_save')
                ->with('toolbox_person')
                // ->with('toolbox_save.toolbox_talkdata')
                // ->with('toolbox_save.toolbox_talkitems')
                ->first();
            $tblx = DB::table('toolbox_talk_save')->select('toolbox_talk_save.*','toolbox_talk.talk_title','toolbox_talk_items.toolbox_item')
            ->join('inspections','inspections.id','toolbox_talk_save.fk_inspection_id')
            ->join('toolbox_talk','toolbox_talk.id','toolbox_talk_save.fk_toolbox_id')
            ->join('toolbox_talk_items','toolbox_talk_items.id','toolbox_talk_save.fk_toolbox_item_id')
            ->where('toolbox_talk_save.fk_inspection_id',$inspection_id)->get();
            $tblx = $tblx->groupBy('talk_title');
            // dd($tblx);
            $data->toolbox_saved_data = $tblx;
                // dd($data);
            $template = 'dashboard.property.reports.toolbox-report';
        } else {
            abort(404);
        }
        // dd($data);
        $backs = 8;
        if (isset($data->fk_property_id)) {
            $backs = Crypt::encrypt($data->fk_property_id);
        } else {
            $backs = Crypt::encrypt($data['fk_property_id']);
        }

        $back = $request->query('back');

        $report_name = Form::where('forms_id', $type)->select(['name'])->first();

        $quotWorkDesc = DB::table('quot_work_desc')->get();
        $data['quot_desc'] = $quotWorkDesc;

        $data['report_name'] = $report_name['name'] ?? 'Unknown Report';
        $config = ReportConfig::first();
        $data['report_config'] = $config;
        return view($template . ($mode == 'print' ? '-print' : ''), compact('data', 'backs', 'back'));
    }
    public function reportDelete(Request $request, $inspection_id, $mode = 'delete')
    {
        // dd($request, $inspection_id, $type, $mode);
        $template = '';
        $data = [];
        $type = DB::table('inspections')->where('id',$inspection_id)->first()->fk_forms_id;
        if ($type == 13) { //Progress Report

            $progR = DB::table('progress_report')->where('fk_inspection_id', $inspection_id)->delete();
            $deleteInsp = DB::table('inspections')->where('id', $inspection_id)->delete();
            if ($progR && $deleteInsp) {
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } else {
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 12) { //Pre Works Inspection
            DB::beginTransaction();
            try {
                DB::table('pi_building_details')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_wall_insulation')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_external_installation')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_external_installation2')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_attic_insulation')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_heating_upgrade')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_grand_total')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_grants_credits')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_additional_photos_notes')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_drawings_and_photographs')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_additional_property_detail')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('pi_iternal_insulation')->where('fk_inspection_id', $inspection_id)->delete();

                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 22) { //OSS Quotation
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('oss_template')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('oss_cost')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 24) { //Fuel Quotation
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('fuel_template')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('fuel_cost')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 23) { //Hosuing Quotation
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('housing_template')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('housing_cost')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 25) { //Better Energy Homes QA
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('bre_photo_inspection_items')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 21) { // Installer Progress Report
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('photo_inspection_items')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 7) { // CWI Survey
            DB::beginTransaction();
            try {
                DB::table('ws_additional_property_detail')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_building_details')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_building_type')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_condition_of_inner_leaf')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_condition_of_outer_leaf')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_insulation_present_in_cavity')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_new_build_cavity')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_services_in_the_cavity')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('ws_ventilation_through_the_cavity')->where('fk_inspection_id', $inspection_id)->delete();

                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 14) { // EWI Installer Progress Report
            DB::beginTransaction();
            try {
                DB::table('sir_base_coat_complete')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('sir_boarding_complete')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('sir_drawings_photographs')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('sir_finish_coat_complete')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('sir_job_complete')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('sir_preparation_complete')->where('fk_inspection_id', $inspection_id)->delete();

                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }

        } else if ($type == 26) { // Contractors QA
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('cqa_photo_inspection_items')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 6) { // Roof Survey
            DB::beginTransaction();
            try {
                DB::table('rs_additional_property_detail')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_building_details')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_coomments_photographs')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_roof_conditions')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_roof_services')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_roof_types')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_roof_ventilation')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('rs_spray_plan_for_roof')->where('fk_inspection_id', $inspection_id)->delete();

                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }

        } else if ($type == 55) {
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('risk_safety_form')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 56 || $type == 58 || $type == 59 || $type == 60) {
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('rams_core_ventilation')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 57) {
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('pre_risk_safety_form')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else if ($type == 11) {
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('contract_forms')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return redirect()->back()->with('success', "Inspection & Report Deleted Successfully.");
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            }
        } else {
            return redirect()->back()->with('error', "Failed to delete Inspection & Report.");
            abort(404);
        }

    }

    public function updateVariation(Request $request)
    {
        Variaton::where('id', $request['variation_id'])->update([
            'status' => $request['variation_status'],
        ]);

        return redirect()->back();
    }
    public function safetyHealthUpdate(Request $request)
    {
        $resultArray = array();
        $specific_risk = $request->specific_risk;
        $specific_control = $request->specific_control;
        foreach ($specific_risk as $key => $risk) {
            $resultArray[] = array(
                'risk' => $risk,
                'control' => isset($specific_control[$key]) ? $specific_control[$key] : null,
            );
        }
        $formId = 55;
        $riskCont = json_encode($resultArray, true);
        $saveRiskSafety = RiskSafetyForm::where('id', $request->id)->first();
        $saveRiskSafety->fk_inspection_id = $saveRiskSafety->fk_inspection_id;
        $saveRiskSafety->fk_user_id = $saveRiskSafety->fk_user_id;
        $saveRiskSafety->fk_property_id = $saveRiskSafety->fk_property_id;
        $saveRiskSafety->fk_property_surveyors_id = $saveRiskSafety->fk_property_surveyors_id;
        $saveRiskSafety->p_date = $request->p_date;
        $saveRiskSafety->p_name = $saveRiskSafety->p_name;
        $saveRiskSafety->p_address = $saveRiskSafety->p_address;
        $saveRiskSafety->desc_site = $request->desc_site;
        $saveRiskSafety->desc_site_other = $request->desc_site_other;
        $saveRiskSafety->work_desc = $request->work_desc;
        $saveRiskSafety->prop_start = $request->prop_start;
        $saveRiskSafety->prop_end = $request->prop_end;
        $saveRiskSafety->measure_activity = $request->measure_activity;
        $saveRiskSafety->contractors_avail = $request->contractors_avail;
        $saveRiskSafety->rams = $request->rams;
        $saveRiskSafety->dwell_occu = $request->dwell_occu;
        $saveRiskSafety->further_activity = $request->further_activity;
        $saveRiskSafety->list_activity = $request->list_activity;
        $saveRiskSafety->having_taken = $request->having_taken;
        $saveRiskSafety->prog_time = $request->prog_time;
        $saveRiskSafety->after_inquiry = $request->after_inquiry;
        $saveRiskSafety->princy_prevent = $request->princy_prevent;
        $saveRiskSafety->emmer_name = $request->emmer_name;
        $saveRiskSafety->emmer_contact = $request->emmer_contact;
        $saveRiskSafety->risk_control = $riskCont;
        $saveRiskSafety->update();

        $response = test_method($saveRiskSafety->fk_inspection_id);

        return redirect('/dashboard/property/report/' . $saveRiskSafety->fk_inspection_id . '/' . $formId . '/view');
    }
    public function getOldPdf(Request $request)
    {
        $url = asset('futurefitapi/assets/uploads/inspection_pdf');
        $response = getOldPdfData($request->id);
        $newPDF = $url.$response;
        $pdf = file_get_contents($newPDF);
        Storage::disk('local')->put($request->id.'.pdf', $pdf);
        return response()->download(storage_path().'/app/'.$request->id.'.pdf')->deleteFileAfterSend(true);
    }
    // public function checkReminder(Request $request)
    // {
    //     $timezone = thisismyip();
    //     date_default_timezone_set($timezone);
    //     $date = date('Y-m-d');
    //     $time = date('H:i');
    //     $currentTime = date('Y-m-d H:i');
    //     if(isset($request->id) && ($request->id != null || $request->id != "")){
    //         $reminders = Reminder::select('reminders.*')
    //     ->selectRaw("CONCAT_WS(', ',
    //     COALESCE(properties.house_num, ''),
    //     NULLIF(properties.address1, 'null'),
    //     NULLIF(properties.address2, 'null'),
    //     NULLIF(properties.address3, 'null'),
    //     COALESCE(properties.county, ''),
    //     COALESCE(properties.eircode, '')
    //     ) AS address")
    //     ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
    //     ->whereDate('reminders.due_date', '>=', $date)
    //     ->where('reminders.property_id', $request->id)
    //     ->get();
    //     }else{
    //         $reminders = Reminder::select('reminders.*')
    //     ->selectRaw("CONCAT_WS(', ',
    //     COALESCE(properties.house_num, ''),
    //     NULLIF(properties.address1, 'null'),
    //     NULLIF(properties.address2, 'null'),
    //     NULLIF(properties.address3, 'null'),
    //     COALESCE(properties.county, ''),
    //     COALESCE(properties.eircode, '')
    //     ) AS address")
    //     ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
    //     ->whereDate('reminders.due_date', '>=', $date)
    //     ->get();
    //     }
    //     $filteredReminders = [];
    //     $filteredReminders = $reminders->filter(function ($reminder) use ($currentTime) {
    //         $dueDateTime = calculateDueDateTime($reminder->due_date, $reminder->due_time, $reminder->when_time);
    //         return strtotime($currentTime) >= strtotime($dueDateTime) && $reminder->when_time != null;
    //     });
    //     $filteredReminders = $filteredReminders->values();
    //     return response()->json(['success'=>true,'data'=>$filteredReminders,'message'=>'records fetched.']);

    // }
    public function checkReminder(Request $request)
    {
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d');
        $time = date('H:i');
        $currentTime = date('Y-m-d H:i');

        $start = date('1970-01-01');
        $end = date('3000-12-31');

        $auth = Auth::user();
        $newIds = [];
        if($auth->role == 'contractor'){
            $nId = null;
            $getUS = DB::table('tbl_user')->where('contractor_id',$auth->id)->first();
            if($getUS){
                $getuID = Surveyor::where('user_id', $getUS->user_id)->with('properties.batch')->first();
                if($getuID){
                    $nIds = $getuID->properties;
                }
            }
            foreach($nIds as $nid){
                $newIds[] = $nid->id;
            }
        }
        // dd($newIds);
        if(isset($request->id) && ($request->id != null || $request->id != "")){
            $reminders = Reminder::select('reminders.*')
            ->selectRaw("CONCAT_WS(', ',
            COALESCE(properties.house_num, ''),
            NULLIF(properties.address1, 'null'),
            NULLIF(properties.address2, 'null'),
            NULLIF(properties.address3, 'null'),
            COALESCE(properties.county, ''),
            COALESCE(properties.eircode, '')
            ) AS address")
            ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
            ->whereNotNull('reminders.when_time')
            ->where('reminders.status','Pending')
            ->whereNotNull('reminders.due_time')
            ->whereNotNull('reminders.due_date')
            ->whereBetween('reminders.due_date',[$start,$end])
            ->where('reminders.property_id', $request->id)
            ->orderBy('reminders.is_read', 'DESC')
            ->orderBy('reminders.id', 'DESC');
            // ->get();
            if (!empty($newIds)) {
                $reminders->whereIn('reminders.property_id', $newIds);
            }
            $reminders = $reminders->get();
        }else {
            $reminders = Reminder::select('reminders.*')
        ->selectRaw("CONCAT_WS(', ',
        COALESCE(properties.house_num, ''),
        NULLIF(properties.address1, 'null'),
        NULLIF(properties.address2, 'null'),
        NULLIF(properties.address3, 'null'),
        COALESCE(properties.county, ''),
        COALESCE(properties.eircode, '')
        ) AS address")
        ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
        ->whereNotNull('reminders.when_time')
        ->where('reminders.status','Pending')
        ->whereNotNull('reminders.due_time')
        ->whereNotNull('reminders.due_date')
        ->whereBetween('reminders.due_date',[$start,$end])
        ->orderBy('reminders.is_read', 'DESC')
        ->orderBy('reminders.id', 'DESC');
        // ->get();
        if (!empty($newIds)) {
            $reminders->whereIn('reminders.property_id', $newIds);
        }
        $reminders = $reminders->get();
        }
        // $filteredReminders = [];
        // $filteredReminders = $reminders->filter(function ($reminder) use ($currentTime) {
        //     $dueDateTime = calculateDueDateTime($reminder->due_date, $reminder->due_time, $reminder->when_time);
        //     return strtotime($currentTime) >= strtotime($dueDateTime) && $reminder->when_time != null;
        // });
        $filteredReminders = $reminders;
        return response()->json(['success'=>true,'data'=>$filteredReminders,'message'=>'records fetched.']);

    }
    public function filterReminder(Request $request)
    {
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d');
        $time = date('H:i');
        $currentTime = date('Y-m-d H:i');

        $start = $request->sdate;
        $end = $request->edate;
        if($request->range === "All Reminders"){
            $start = date('1970-01-01');
            $end = date('3000-12-31');
        }

        $auth = Auth::user();
        $newIds = [];
        if($auth->role == 'contractor'){
            $nId = null;
            $getUS = DB::table('tbl_user')->where('contractor_id',$auth->id)->first();
            if($getUS){
                $getuID = Surveyor::where('user_id', $getUS->user_id)->with('properties.batch')->first();
                if($getuID){
                    $nIds = $getuID->properties;
                }
            }
            foreach($nIds as $nid){
                $newIds[] = $nid->id;
            }
        }

        $reminders = Reminder::select('reminders.*')
        ->selectRaw("CONCAT_WS(', ',
        COALESCE(properties.house_num, ''),
        NULLIF(properties.address1, 'null'),
        NULLIF(properties.address2, 'null'),
        NULLIF(properties.address3, 'null'),
        COALESCE(properties.county, ''),
        COALESCE(properties.eircode, '')
        ) AS address")
        ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
        ->whereNotNull('reminders.when_time')
        ->where('reminders.status','Pending')
        ->whereNotNull('reminders.due_time')
        ->whereNotNull('reminders.due_date')
        ->whereBetween('reminders.due_date',[$start,$end])
        ->orderBy('reminders.is_read', 'DESC')
        ->orderBy('reminders.id', 'DESC');
        // ->get();
        if (!empty($newIds)) {
            $reminders->whereIn('reminders.property_id', $newIds);
        }
        $reminders = $reminders->get();
        if ($request->from == 'dash') {
            $reminders = Reminder::select('reminders.*')
            ->selectRaw("CONCAT_WS(', ',
            COALESCE(properties.house_num, ''),
            NULLIF(properties.address1, 'null'),
            NULLIF(properties.address2, 'null'),
            NULLIF(properties.address3, 'null'),
            COALESCE(properties.county, ''),
            COALESCE(properties.eircode, '')
            ) AS address")
            ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
            ->whereNotNull('reminders.when_time')
            ->where('reminders.status','Pending')
            ->whereNotNull('reminders.due_time')
            ->whereNotNull('reminders.due_date')
            ->whereBetween('reminders.due_date',[$start,$end])
            ->orderBy('reminders.id', 'DESC');
            // ->get();
            if (!empty($newIds)) {
                $reminders->whereIn('reminders.property_id', $newIds);
            }
            $reminders = $reminders->get();
        }
        // $reminders = $reminders->values();
        return response()->json(['success'=>true,'data'=>$reminders,'message'=>'records fetched.']);

    }
    // public function checkReminder2()
    // {
    //     $timezone = thisismyip();
    //     date_default_timezone_set($timezone);
    //     $date = date('Y-m-d');
    //     $time = date('H:i');
    //     $currentTime = date('Y-m-d H:i');
    //     $reminders = Reminder::select('reminders.*')
    //     ->selectRaw("CONCAT_WS(', ',
    //     COALESCE(properties.house_num, ''),
    //     NULLIF(properties.address1, 'null'),
    //     NULLIF(properties.address2, 'null'),
    //     NULLIF(properties.address3, 'null'),
    //     COALESCE(properties.county, ''),
    //     COALESCE(properties.eircode, '')
    //     ) AS address")
    //     ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
    //     ->whereDate('reminders.due_date', '>=', $date)
    //     ->get();
    //     $filteredReminders = [];
    //     $filteredReminders = $reminders->filter(function ($reminder) use ($currentTime) {
    //         $dueDateTime = calculateDueDateTime($reminder->due_date, $reminder->due_time, $reminder->when_time);
    //         return strtotime($currentTime) >= strtotime($dueDateTime) && $reminder->when_time != null;
    //     });
    //     $filteredReminders = $filteredReminders->values();
    //     return $filteredReminders;

    // }
    public function checkReminder2()
    {
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d');
        $time = date('H:i');
        $currentTime = date('Y-m-d H:i');

        $start = date('1970-01-01');
        $end = date('3000-12-31');

        $auth = Auth::user();
        $newIds = [];
        if($auth->role == 'contractor'){
            $nId = null;
            $getUS = DB::table('tbl_user')->where('contractor_id',$auth->id)->first();
            if($getUS){
                $getuID = Surveyor::where('user_id', $getUS->user_id)->with('properties.batch')->first();
                if($getuID){
                    $nIds = $getuID->properties;
                }
            }
            foreach($nIds as $nid){
                $newIds[] = $nid->id;
            }
        }

        $reminders = Reminder::select('reminders.*')
        ->selectRaw("CONCAT_WS(', ',
        COALESCE(properties.house_num, ''),
        NULLIF(properties.address1, 'null'),
        NULLIF(properties.address2, 'null'),
        NULLIF(properties.address3, 'null'),
        COALESCE(properties.county, ''),
        COALESCE(properties.eircode, '')
        ) AS address")
        ->leftJoin('properties', 'properties.id', '=', 'reminders.property_id')
        ->whereNotNull('reminders.when_time')
        ->where('reminders.status','Pending')
        ->whereNotNull('reminders.due_time')
        ->whereNotNull('reminders.due_date')
        ->whereBetween('reminders.due_date',[$start,$end])
        ->orderBy('reminders.is_read', 'DESC')
        ->orderBy('reminders.id', 'DESC');
        if (!empty($newIds)) {
            $reminders->whereIn('reminders.property_id', $newIds);
        }
        $reminders = $reminders->get();

        // $filteredReminders = [];
        // $filteredReminders = $reminders->filter(function ($reminder) use ($currentTime) {
        //     $dueDateTime = calculateDueDateTime($reminder->due_date, $reminder->due_time, $reminder->when_time);
        //     return strtotime($currentTime) >= strtotime($dueDateTime) && $reminder->when_time != null;
        // });
        $filteredReminders = $reminders;
        return $filteredReminders;

    }
    public function createReminder(Request $request)
    {
        $request->validate([
            'title' => ['nullable', 'string'],
            'notes' => ['nullable', 'string', 'max:900'],
            'status' => ['required', 'string', 'max:9'],
            'due_date' => ['nullable'],
            'property_id' => ['required', 'numeric']
        ]);
        $data = [];

        if($request->when_time == null){
            $request['when_time'] = 'atoe';
        }
        if($request->due_time == null){
            $request['due_time'] = date('H:i:00');
        }
        $data = Reminder::create([
            'title' => $request['title'],
            'notes' => $request['notes'],
            'due_date' => $request['due_date'],
            'property_id' => $request['property_id'],
            'status' => $request['status'],
            'when_time' => $request['when_time'],
            'due_time' => $request['due_time'],
        ]);

        return response()->json(['success' => true, 'data' => $data]);
        return redirect()->back();
    }

    public function deleteReminder($id)
    {
        Reminder::where('id', $id)->delete();
        return redirect()->back();
    }

    public function updateNotes(Request $request)
    {
        $request->validate([
            'property_id' => ['required', 'numeric'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        Property::where('id', $request['property_id'])->update([
            'notes' => $request['notes'],
        ]);

        return redirect()->back();
    }

    //    HEA BER Assessor Code
    public function assignAssessor($property_id, $contract_id = null)
    {
        $assessors = User::where('role', 'hea/ber-assessor')->get();
        $surveyors = Surveyor::get();

        $contract = null;

        if ($contract_id) {
            $contract = AssessorProperty::where('id', $contract_id)->with('assessor')->first();
        }

        $assessor_jobs = $this->hea_ber_assessor_jobs;
        $contract_status = $this->assessor_contact_status;

        return view(
            'dashboard.property.assign-assessor',
            compact(
                'assessors',
                'property_id',
                'assessor_jobs',
                'contract',
                'contract_status',
                'surveyors'
            )
        );
    }

    public function storeAssessor(StoreAssessorContractRequest $request)
    {

        $contract = AssessorProperty::create([
            'assessor_id' => $request->assessor_id,
            'property_id' => $request->property_id,
            'notes' => $request->notes,
            'job_id' => $request->job_id,
            'cost' => $request->cost ?? 0.0,
            'paid' => $request->paid ?? 0.0,
            'our_price' => $request->our_price ?? 0.0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'surveyor_id' => $request->surveyor_id,
        ]);

        //        Sending Email
        $assessor_property = AssessorProperty::where('id', $contract->id)->with('property')->with('assessor')->first();
        $address = format_address(
            $assessor_property->property->house_num,
            $assessor_property->property->address1,
            $assessor_property->property->address2,
            $assessor_property->property->address3,
            $assessor_property->property->county,
            $assessor_property->property->eircode
        );

        $email = $assessor_property->assessor->email;
        $job = $assessor_property->job;

        $config = Config::first();

        $details = [
            'name' => $assessor_property->assessor->firstname,
            'title' => 'Assessor Job Assignment',
            'assigned_job' => $job,
            'property_address' => $address,
            'email' => $assessor_property->assessor->email,
            'password' => $assessor_property->assessor->password,
            'template' => 'mail.job-assignment',
            'config' => $config,
        ];

        \Mail::to($email)->send(new \App\Mail\Mailer($details));

        $asseName = $assessor_property->assessor->firstname;
        if ($contract->wasRecentlyCreated === true) {
            $property = Property::where('id', $request->property_id)->first();
            if($property->batch->scheme->scheme == "Leads"){
                $details = [
                    "body" => "Assessor " ."($asseName)". " has been assigned to a Lead: ".$address,
                    "section" => "Lead",
                    "sub_section" => "her",
                    "property_id" => $request->property_id,
                    "route" => "lead.show"
                ];
            }else{
                $details = [
                    "body" => "Assessor " ."($asseName)". " has been assigned to a Property: ".$address,
                    "section" => "Property",
                    "sub_section" => "her",
                    "property_id" => $request->property_id,
                    "route" => "property.show"
                ];
            }
            newNotification($details);
        }

        $back_url = $request->query('back_url');
        return redirect()->route($back_url, Crypt::encrypt($request->property_id));
    }

    public function updateAssessor(StoreAssessorContractRequest $request)
    {
        $asseProOld = AssessorProperty::where('id', $request->contract_id)->first();
        $assePro = AssessorProperty::where('id', $request->contract_id)->update([
            'assessor_id' => $request->assessor_id,
            'property_id' => $request->property_id,
            'notes' => $request->notes,
            'job_id' => $request->job_id,
            'cost' => $request->cost ?? 0.0,
            'paid' => $request->paid ?? 0.0,
            'our_price' => $request->our_price ?? 0.0,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'surveyor_id' => $request->surveyor_id,
        ]);

        if ($assePro > 0) {
            if($request->status == 'Complete'){
                $getPropertyDetails = Property::where('id', $request->property_id)->first();
                $address = format_address(
                    $getPropertyDetails->house_num,
                    $getPropertyDetails->address1,
                    $getPropertyDetails->address2,
                    $getPropertyDetails->address3,
                    $getPropertyDetails->county,
                    $getPropertyDetails->eircode
                );
                if($getPropertyDetails->batch->scheme->scheme == "Leads"){
                    $details = [
                        "body" => "Status of the measure has been changed from ".$asseProOld->status." to ".$request->status ." in ". $address,
                        "section" => "Lead",
                        "sub_section" => "her",
                        "property_id" => $request->property_id,
                        "route" => "lead.show"
                    ];
                }else{
                    $details = [
                        "body" => "Status of the measure has been changed from ".$asseProOld->status." to ".$request->status ." in ". $address,
                        "section" => "Property",
                        "sub_section" => "her",
                        "property_id" => $request->property_id,
                        "route" => "property.show"
                    ];
                }
                newNotification($details);
            }
        }

        $back_url = $request->query('back_url');

        return redirect()->route($back_url, Crypt::encrypt($request->property_id));
    }

    public function deleteAssessor($id)
    {
        $id = Crypt::decrypt($id);
        AssessorProperty::where('id', $id)->delete();
        return redirect()->back();
    }

    public function changePropertyStatus($id, Request $request)
    {

        if ($request->type === 'hea_status') {
            Property::where('id', Crypt::decrypt($id))->update([
                'hea_status' => $request->status,
            ]);
        } else if ($request->type === 'contractor_status') {
            Property::where('id', Crypt::decrypt($id))->update([
                'contractor_status' => $request->status,
            ]);
        } else if ($request->type === 'batch_status') {
            Batch::where('id', Crypt::decrypt($id))->update([
                'status' => $request->status,
            ]);
        } else if ($request->type === 'property_status') {
            Property::where('id', Crypt::decrypt($id))->update([
                'status' => $request->status,
            ]);
        }

        return redirect()->back();
    }

    public function addPostWorkLog(Request $request)
    {
        // $id: ContractorProperty Id

        $request->validate([
            'notes' => ['required', 'string'],
            'id' => ['required'],
            'status' => ['required', 'string'],
        ]);

        PostWorkLog::create([
            'notes' => $request->notes,
            'date_added' => NOW(),
            'fk_contractor_property_id' => $request->id,
            'status' => $request->status,
        ]);

        return redirect()->back();
    }

    public function updatePostWorkLog(Request $request)
    {
        // $id: ContractorProperty Id

        $request->validate([
            'status' => ['required', 'string'],
            'id' => ['required'],
            'notes' => ['required', 'string'],
        ]);

        PostWorkLog::where('id', $request->id)->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->back();
    }

    public function deletePostWorkLog($id)
    {
        $id = Crypt::decrypt($id);
        PostWorkLog::where('id', $id)->delete();
        return redirect()->back();
    }

    public function updateFinancials(StoreFinancialRequest $request)
    {
        Property::where('id', $request['property_id'])->update([
            'deposit_amount' => $request['deposit_amount'],
            'interim_amount' => $request['interim_amount'],
            'final_amount' => $request['final_amount'],
            'deposit_date' => $request['deposit_date'],
            'interim_date' => $request['interim_date'],
            'final_date' => $request['final_date'],
            'deposit_status' => $request['deposit_status'],
            'interim_status' => $request['interim_status'],
            'final_status' => $request['final_status'],
            'overall_total' => $request['overall_total'],
        ]);

        return redirect()->back();
    }

    // public function addMeasure(StoreMeasureRequest $request)
    // {
    //     Measure::create([
    //         'property_id' => $request['property_id'],
    //         'job_id' => $request['job_id'],
    //     ]);
    //     return redirect()->back();
    // }
    function addMeasure(Request $request)
    {
        $is_measure_alreadt_exist = Measure::where(
            'property_id',
            $request['property_id']
            )
        ->where(
            'job_id',
            $request['job_id']
        )
        ->first();

        if ($is_measure_alreadt_exist) {
            return redirect()->back();
        }

        $default_contractor = User::where('role', 'contractor')
            ->where('is_default_contractor', 1)
            ->latest()->first();

        if ($default_contractor) {
            $contract = ContractorProperty::create([
                'contractor_id' => $default_contractor->id,
                'property_id' => $request['property_id'],
                'job_id' => $request['job_id'],
                'surveyor_id' => 0,
                'units' => $request['quantity'],
                'survey_qty_inc_variation' => $request['quantity'],
                'start_date' => $request['start_date'],
                'status' => "Pending",
                'end_date' => $request['end_date'],
                'contractor_notes' => $request['qua_details'],
                'our_price' => $request['our_price'],
            ]);
        }
        $measure = Measure::create([
            'property_id' => $request['property_id'],
            'job_id' => $request['job_id']
        ]);
        $jName = $measure->job_lookup->title;
        if ($measure->wasRecentlyCreated === true) {
            $property = Property::where('id', $request['property_id'])->first();
            $address = format_address(
                $property->house_num,
                $property->address1,
                $property->address2,
                $property->address3,
                $property->county
            );

            if($property->batch->scheme->scheme == "Leads"){
                $details = [
                    "body" => "Measure " ."($jName)". " has been assigned to Lead: ".$address,
                    "section" => "Lead",
                    "sub_section" => "mea",
                    "property_id" => $request['property_id'],
                    "route" => "lead.show"
                ];
            } else{
                $details = [
                    "body" => "Measure " ."($jName)". " has been assigned to Property: ".$address,
                    "section" => "Property",
                    "sub_section" => "mea",
                    "property_id" => $request['property_id'],
                    "route" => "property.show"
                ];
            }
            newNotification($details);
        }
        return redirect()->back();
    }
    public function deleteMeasure($id)
    {
        Measure::where('id', $id)->delete();
        return redirect()->back();
    }
    public function deleteMeasures($id)
    {
        $get = ContractorProperty::where('id',$id)->first();
        $getM = Measure::where('property_id',$get->property_id)->where('job_id',$get->job_id)->first();
        // dd($get,$getM);
        if($getM){
            Measure::where('id', $getM->id)->delete();
        }
        ContractorProperty::where('id',$id)->delete();

        return redirect()->back();
    }
    public function deleteDocument($id)
    {
        File::where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteVariationDocument($id)
    {
        VariatonDoc::where('id', $id)->delete();
        return redirect()->back();
    }
    public function getNote($note_id)
    {
        $notes = PropertyNote::where('id', $note_id)->first();
        return response()->json(['success' => true, 'data' => $notes]);
    }
    public function getNotes($property_id)
    {
        $notes = PropertyNote::where('property_id', $property_id)->select([
            'id',
            'text',
            'created_at',
            'updated_at',
        ]);

        return datatables()->of($notes)
            ->addColumn('action', function ($note) {
                $actions = '<a data-nid='. $note->id .' data-bs-toggle="modal" data-bs-target="#viewNoteModal" class="btn btn-outline-sm _btn-primary px-2 action-icon rounded vnotebtn" title="Show Note"> <i class="text-white mdi mdi-eye"></i></a>';

                $actions .= '<a data-nid='. $note->id .' data-bs-toggle="modal" data-bs-target="#editNoteModal" class="btn btn-outline-sm _btn-primary px-2 action-icon rounded enotebtn" title="Edit Note"><i class="text-white mdi mdi-circle-edit-outline"></i></a>';

                $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/property/delete-note/' . Crypt::encrypt($note->id) . '" class="btn btn-outline-sm btn-danger  px-2 action-icon rounded" title="Delete Note"> <i class="text-white mdi mdi-delete"></i></a>';

                return $actions;
            })
            ->editColumn('created_at', function ($note) {
                return date('d/m/Y', strtotime($note->created_at));;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function updateNote(Request $request)
    {
        PropertyNote::where('id',$request->note_id)->update(['text' => $request->text]);
        return redirect()->back()->with('success', "Note Updated Successfully");
    }
    public function storeNote(StoreNoteRequest $request)
    {
        PropertyNote::create($request->all());
        return redirect()->back();
    }

    public function deleteNote($id)
    {
        PropertyNote::where('id', Crypt::decrypt($id))->delete();
        return redirect()->back();
    }
    public function deleteSheet($id){
        $id =  Crypt::decrypt($id);
        $get = UserPropSigninOut::where('id',$id)->first();
        $baseURL2 = env('CHILD_URL').'/assets/uploads/user_signinout/';
        for ($i = 1; $i <= 10; $i++) {
            $ind = 'signin_image'.$i;
            $myURL = $baseURL2.$get->$ind;
            if ($get->$ind != null && $get->$ind != "" && file_exists(public_path($myURL))) {
                unlink(public_path($myURL));
            }
        }
        $get->delete();
        return redirect()->back()->with('success','Timesheet Deleted Successfully!');
    }
    public function photoFolder()
    {
        $photoFolders = PhotoFolderName::orderBy('id','asc')->get();
        return view('dashboard.photo-folder.index',get_defined_vars());
    }
    public function saveNewFolder(Request $request)
    {
        if($request->id == null){
            $save = new PhotoFolderName();
            $save->name = $request->name;
            $save->save();
            $photoDetails = PhotoFolderName::where('id',$save->id)->first();
        }else{
            $save = PhotoFolderName::find($request->id);
            $save->name = $request->name;
            $save->update();
            $photoDetails = PhotoFolderName::where('id',$request->id)->first();
        }
        if($save){
            if($request->id == null){
                $text = "Saved";
                $details = [
                    "body" => "Folder " ."($photoDetails->name)". " has been added",
                    "section" => "Folder",
                    "route" => "photoFolder"
                ];
                newNotification($details);
            }else{
                $text = "Updated";
                $details = [
                    "body" => "Folder " ."($photoDetails->name)". " has been updated",
                    "section" => "Folder",
                    "route" => "photoFolder"
                ];
                newNotification($details);
            }
            return redirect()->back()->with('success','Photo Folder '.$text.' successfully!');
        }else{
            return redirect()->back()->with('error','Photo Folder Failed to save.');
        }
    }
    public function deletePhotoFolder(Request $request)
    {
        $photoDetails = PhotoFolderName::where('id',$request->id)->first();
        $save = PhotoFolderName::where('id',$request->id)->delete();
        if($save) {
            $details = [
                "body" => "Folder " ."($photoDetails->name)". " has been deleted",
                "section" => "Folder",
                "route" => "photoFolder"
            ];
            newNotification($details);
        }
        return redirect()->back()->with('success','Photo Folder deleted successfully!');
    }
    public function deletePhotoComment(Request $request) {
        $photo = PhotoUploads::where('id',$request->id)->update([
            "comment" => ""
        ]);
        if($photo > 0){
            return response()->json(['success'=>true,'message' => "Comment Deleted Successfully"]);
        }else{
            return response()->json(['success'=>false,'message' => "Comment deletion failed"]);
        }
    }
    public function surveyorLogs($property_id)
    {
        if (request()->ajax()) {
            $user_prop_signin_out = UserPropSigninOut::where('property_id', $property_id)->with('surveyor')->orderBy('id', 'desc');
        // dd($property_id);

            return datatables()->of($user_prop_signin_out)
                ->editColumn('time', function ($entry) {
                    return $entry->type == 'signin' ? $entry->sign_time : $entry->sign_e_time;
                })
                ->editColumn('date', function ($entry) {
                    return $entry->type == 'signin' ? date('d/m/Y', strtotime($entry->sign_date)) : date('d/m/Y', strtotime($entry->sign_e_date));
                })
                ->editColumn('type', function ($entry) {
                    return strtoupper($entry->type);
                })
                ->addColumn('surveyor', function ($entry) {
                    return $entry->surveyor->full_name ?? '';
                })
                ->addColumn('showDetails', function ($entry) {
                    // return '<a onClick="showSurveyorLogDetails(' . $entry->id . ')" class="btn-outline-sm btn-info pointer px-2 action-icon rounded ml-1" title="Show Details"> <i class="text-white mdi mdi-eye"></i></a>';
                    return '<a onClick="showSurveyorLogDetails(' . $entry->id . ')" class="btn btn-sm _btn-primary pointer px-2 action-icon rounded ml-1" title="Show Details"> <i class="text-white mdi mdi-eye"></i></a>';
                })
                ->rawColumns(['showDetails'])
                ->make(true);

        }

    }

    public function surveyorLogDetails($id)
    {
        $details = UserPropSigninOut::where('id', $id)->first();
        echo json_encode($details);
    }
    public function updateContractorPropertyUnits(UpdateContractorPropertyUnits $request) {
        $contractor_property_units = $request->input('data');

        foreach($contractor_property_units as $unit) {
            ContractorProperty::where('id', $unit['contractor_property_id'])->update([
                'units' => $unit['units'],
                'survey_qty_inc_variation' => $unit['survey_qty_inc_variation'],
                'contractor_notes' => $unit['contractor_notes']
            ]);
        }

        return redirect()->back();
    }
    public function exportInspectionReport($id)
    {
        try{
            $destinationPath = public_path('zipfiles');
            !is_dir($destinationPath) && mkdir($destinationPath, 0777, true);
            $id = Crypt::decrypt($id);
            $property = Property::where('id', $id)->first();
            $inspections = Inspection::where('fk_property_id', $id)->get()->sortByDesc("id");

            $address = format_address(
                $property->house_num,
                $property->address1,
                $property->address2,
                $property->address3,
                $property->county
            );

            $fileslug = Str::slug($address);
            $zip = new ZipArchive;
            $fileName = $fileslug.'-'.time() .'.zip';

            $zipfilepath =  $destinationPath.'/'.$fileName;

            if ($zip->open($zipfilepath, ZipArchive::CREATE) === TRUE)
            {
                foreach ($inspections as $key => $inspection) {
                    $file = public_path(env('APP_BASE_IMAGE_PATH').'/public/assets/uploads/inspection_pdf'.$inspection->pdf_filename);
                    if(file_exists($file) && is_file($file)){
                    $filebase = basename($file);
                    $zip->addFile($file, $filebase);
                    }
                }

                $zip->close();
            }else{
                dd('File Not Created');
            }
            return response()->download($zipfilepath);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function importProperty(Request $request)
    {
        $clients = Client::select(['id', 'name', 'email'])->get();
        $batches = Batch::select(['id', 'our_ref', 'scheme_id'])->get();
        $back = $request->query('back');
        return view('dashboard.property.import-property',get_defined_vars());
    }

    public function storeImportProperty(Request $request) {


        try{
            if ($request->hasFile('file')) {
                $uploadedFile = $request->file('file');
                if (in_array($uploadedFile->getClientOriginalExtension(), ['csv'])) {
                    $filename = explode('.',$uploadedFile->getClientOriginalName())[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                    if($uploadedFile->move(public_path('files'), $filename)){
                        $csv_data = $this->getCSVTOArray($filename);

                        foreach($csv_data as $csv){
                            DB::beginTransaction();
                            try{
                                $client_name_arr = explode(',',@$csv['applicant-name']);
                                $wh_fname = trim(@$client_name_arr[2].''.@$client_name_arr[1]);
                                $wh_lname = trim(@$client_name_arr[0]);
                                $phone = isset($csv['primary-phone-number']) ? @$csv['primary-phone-number'] : @$csv['secondary-phone-number'];
                                $phone = preg_replace('/\s+/', '', $phone);

                                Property::create([
                                    'client_id' => $request->client_id,
                                    'batch_id' => $request->batch_id,
                                    'address1' => @$csv['address'].' '.$csv['address-1'] ?? null,
                                    'address2' => @$csv['address-2'] ?? null,
                                    'address3' => @$csv['address-3'].' '.@$csv['address-4'] ?? null,
                                    'county' =>  @$csv['county'] ?? null,
                                    'eircode' => @$csv['eircode'] ?? null,
                                    'wh_fname' => $wh_fname,
                                    'wh_lname' => $wh_lname,
                                    'phone1' => preg_replace('/\s+/', '', @$csv['primary-phone-number']) ?? null,
                                    'phone2' => preg_replace('/\s+/', '', @$csv['secondary-phone-number']) ?? null,
                                    'wh_mprn' => @$csv['m-p-r-n'] ?? null,
                                    'archived' =>  0,
                                    'start_date' => date('Y-m-d'),
                                    'end_date' => date('Y-m-d'),
                                    'status' => 'pending',
                                    'wh_ref' => @$csv['application-id'] ?? null
                                ]);

                                DB::commit();
                            } catch (Exception $e) {
                                DB::rollback();
                            }
                        }


                    }

                }

                return redirect()->route('property',0);
            }
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    function getCSVTOArray($filename){
        $delimiter = ',';
        $header = null;
        $data = array();
        $filepath = public_path('files').'/'.$filename;
        if(file_exists($filepath)){
            if (($handle = fopen($filepath, 'r')) !== false){
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                    if (!$header){
                        foreach($row as $r){
                            $header[] = Str::slug($r);
                        }
                    }else{
                        $data[] = array_combine($header, $row);
                    }
                }
                fclose($handle);
            }
            return $data;
        }else{
            return false;
        }

    }

    public function export_documents($property_id, $contract_id){
        try{
            $id = Crypt::decrypt($property_id);
            $contract_id = Crypt::decrypt($contract_id);
            $property = Property::where('id', $id)->first();
            $contract = ContractorProperty::where('property_id', $id)->where('id', $contract_id)->with('document')->first();

            $destinationPath = public_path('zipfiles');
            !is_dir($destinationPath) && mkdir($destinationPath, 0777, true);

            $address = format_address(
                $property->house_num,
                $property->address1,
                $property->address2,
                $property->address3,
                $property->county
            );

            $fileslug = Str::slug($address);
            $zip = new ZipArchive;
            $fileName = $fileslug.'-'.time() .'.zip';

            $zipfilepath =  $destinationPath.'/'.$fileName;

            if ($zip->open($zipfilepath, ZipArchive::CREATE) === TRUE)
            {
                foreach ($contract['document'] as $key => $document) {
                    $file = public_path('files/'.$document->file);
                    if(file_exists($file) && is_file($file)){
                        $filebase = basename($file);
                        $zip->addFile($file, $filebase);
                    }
                }

                $zip->close();
            }else{
                dd('File Not Created');
            }
            return response()->download($zipfilepath);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function export_documents2($property_id, $assessor_id){
        try{
            $id = Crypt::decrypt($property_id);
            $assessor_id = Crypt::decrypt($assessor_id);

            $property = Property::where('id', $id)->first();
            $contract = AssessorProperty::where('property_id',$id)->where('assessor_id', $assessor_id)->with('document')->first();
            $destinationPath = public_path('zipfiles');
            !is_dir($destinationPath) && mkdir($destinationPath, 0777, true);

            $address = format_address(
                $property->house_num,
                $property->address1,
                $property->address2,
                $property->address3,
                $property->county
            );

            $fileslug = Str::slug($address);
            $zip = new ZipArchive;
            $fileName = $fileslug.'-'.time() .'.zip';

            $zipfilepath =  $destinationPath.'/'.$fileName;

            if ($zip->open($zipfilepath, ZipArchive::CREATE) === TRUE)
            {
                foreach ($contract['document'] as $key => $document) {
                    $file = public_path('files/'.$document->file);
                    if(file_exists($file) && is_file($file)){
                        $filebase = basename($file);
                        $zip->addFile($file, $filebase);
                    }
                }

                $zip->close();
            }else{
                dd('File Not Created');
            }
            return response()->download($zipfilepath);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function export_all_documents2($property_id){
        try{
            $id = Crypt::decrypt($property_id);
            $property = Property::where('id', $id)->first();
            $contracts = AssessorProperty::where('property_id', $id)->with('document')->get();

            $destinationPath = public_path('zipfiles');
            !is_dir($destinationPath) && mkdir($destinationPath, 0777, true);

            $address = format_address(
                $property->house_num,
                $property->address1,
                $property->address2,
                $property->address3,
                $property->county
            );

            $fileslug = Str::slug($address);
            $zip = new ZipArchive;
            $fileName = $fileslug.'-'.time() .'.zip';

            $zipfilepath =  $destinationPath.'/'.$fileName;

            if ($zip->open($zipfilepath, ZipArchive::CREATE) === TRUE)
            {
                foreach($contracts as $contract){
                    if(!empty($contract['document'])){
                        foreach($contract['document'] as $document){
                            $file = public_path('files/'.$document->file);
                            if(file_exists($file) && is_file($file)){
                                $filebase = basename($file);
                                $zip->addFile($file, $filebase);
                            }
                        }
                    }
                }

                $zip->close();
            }else{
                dd('File Not Created');
            }
            return response()->download($zipfilepath);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function export_all_documents($property_id){
        try{
            $id = Crypt::decrypt($property_id);
            $property = Property::where('id', $id)->first();
            $contracts = ContractorProperty::where('property_id', $id)->with('document')->get();

            $destinationPath = public_path('zipfiles');
            !is_dir($destinationPath) && mkdir($destinationPath, 0777, true);

            $address = format_address(
                $property->house_num,
                $property->address1,
                $property->address2,
                $property->address3,
                $property->county
            );

            $fileslug = Str::slug($address);
            $zip = new ZipArchive;
            $fileName = $fileslug.'-'.time() .'.zip';

            $zipfilepath =  $destinationPath.'/'.$fileName;

            if ($zip->open($zipfilepath, ZipArchive::CREATE) === TRUE)
            {
                foreach($contracts as $contract){
                    if(!empty($contract['document'])){
                        foreach($contract['document'] as $document){
                            $file = public_path('files/'.$document->file);
                            if(file_exists($file) && is_file($file)){
                                $filebase = basename($file);
                                $zip->addFile($file, $filebase);
                            }
                        }
                    }
                }

                $zip->close();
            }else{
                dd('File Not Created');
            }
            return response()->download($zipfilepath);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function snag_report($id, $mode)
    {
        if ($mode == 'delete') {
            // DB::beginTransaction();
            try {
                // Delete records from related tables
                $check = DB::table('snag_records')->where('id', $id)->update(['del_status' => '1']);

                return redirect()->back()->with('success', "Snag Report Deleted Successfully.");
            } catch (\Exception $e) {
                // DB::rollback();
                return redirect()->back()->with('error', "Failed to delete Snag Report.");
            }
        } else {

            $snag = SnagRecord::where('id', $id)
                ->with('property.client')
                ->with('comments.comment_reply')->first();

            if($mode == 'pdf'){
                $snagID = $id;
                $url = asset('futurefitapi/assets/uploads/snag_pdf');
                $response = snagReportPDF($snagID,$snag);
                $newPDF = $url.$response;
                $pdf = file_get_contents($newPDF);
                Storage::disk('local')->put($snagID.'.pdf', $pdf);
                return response()->download(storage_path().'/app/'.$snagID.'.pdf')->deleteFileAfterSend(true);
            }
            // dd($snag);
            $backs = Crypt::encrypt($snag->fk_property_id);
            return view(
                'dashboard.property.reports.snag-report' . ($mode == 'print' ? '-print' : ''),
                compact('snag', 'backs')
            );
        }

    }

    public function photoUploads(Request $request){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');

        $validated = $request->validate(
            [
                'folder_id' => 'required',
                'photo_img' => 'required'
            ],
            [
                'folder_id.required' => 'The Folder Is Required',
                'photo_img.required' => 'The Images Is Required'
            ]
        );
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        $cdate = date('d-m-Y | h:i A');
        if($request->folder_id === "edit"){
            $getOld = PhotoUploads::find($request->id);
            $baseURL = env('CHILD_URL').'/public/assets/uploads/photo_uploads'.$getOld->image_path;
            if (file_exists($baseURL)) {
                unlink($baseURL);
            }
            $getSection = DB::table("photo_folder_names")->where('id',$getOld->fk_section_id)->first();
            $section = $getSection->name;
            if ($request->photo_img) {
                $propertyId = $getOld->fk_property_id;
                $section = $getOld->fk_section_id;
                if (!is_dir('futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId)) {
                    mkdir('./futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId . '/' . $section, 0777, true);
                } else if (is_dir('futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId)) {
                    if (!is_dir('futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId . '/' . $section)) {
                        mkdir('./futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId . '/' . $section, 0777, true);
                    }
                }
                $image_path = "./assets/uploads/photo_uploads/" . $propertyId . "/" . $section . "/";
                $photo = $request->photo_img;
                $imageName = str_replace(' ','_',$section).'-' . time() .'_'.rand(11111,99999).'.' . $request->photo_img->getClientOriginalExtension();
                $photo->move(public_path('futurefitapi/public/'.$image_path), $imageName);
                $imagePath = "/" . $propertyId . "/" . $section . "/" . $imageName;
            }
            $save = PhotoUploads::find($request->id);
            $save->image_path = $imagePath;
            $save->date_added = $cdate;
            $save->date_created = $cdate;
            $save->update();
            if($save){
                return response()->json(['success'=>true,'message'=>"Image Edited Successfully"]);
            }else{
                return response()->json(['success'=>false,'message'=>"Image Editation Failed"]);
            }
        }
        $imgCount = sizeOf($request->photo_img);

        $comment = isset($request->photo_comment) && $request->photo_comment != "" ?  $request->photo_comment : "";
        $getSection = DB::table("photo_folder_names")->where('id',$request->folder_id)->first();
        $section = $getSection->name;
        $imagePath = "";
        $m = 0;
        for($i = 0; $i < $imgCount; $i++){
            $save = new PhotoUploads();
            $save->date_added = $cdate;
            $save->date_created = $cdate;
            $save->fk_section_id = $request->folder_id;
            $save->fk_property_id = $request->fk_property_id;
            $save->fk_surveyor_id = 0;
            if ($request->photo_img[$i]) {
                $propertyId = $request->fk_property_id;
                if (!is_dir('futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId)) {
                    mkdir('./futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId . '/' . $section, 0777, true);
                } else if (is_dir('futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId)) {
                    if (!is_dir('futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId . '/' . $section)) {
                        mkdir('./futurefitapi/public/assets/uploads/photo_uploads/' . $propertyId . '/' . $section, 0777, true);
                    }
                }
                $image_path = "./assets/uploads/photo_uploads/" . $propertyId . "/" . $section . "/";
                $photo = $request->photo_img[$i];
                $imageName = str_replace(' ','_',$section).'-' . time() .'_'.rand(11111,99999).'.' . $request->photo_img[$i]->getClientOriginalExtension();
                $photo->move(public_path('futurefitapi/public/'.$image_path), $imageName);
                $imagePath = "/" . $propertyId . "/" . $section . "/" . $imageName;
            }
            $save->image_path = $imagePath;
            $save->comment = $comment;
            $save->save();
            if($save){
                $m++;
            }
        }
        if ($m > 0) {
            if($imgCount > 1){
                $body = "Photo/Video Batch has been uploaded to Folder: ".$section;
            }else {
                $body = "Photo/Video has been uploaded to Folder: ".$section;
            }
            $getPropertyDetails = Property::where('id', $request->fk_property_id)->first();
            if($getPropertyDetails->batch->scheme->scheme == "Leads"){
                $details = [
                    "body" => $body,
                    "section" => "Lead",
                    "sub_section" => "pho",
                    "property_id" => $request->fk_property_id,
                    "route" => "lead.show"
                ];
            }else{
                $details = [
                    "body" => $body,
                    "section" => "Property",
                    "sub_section" => "pho",
                    "property_id" => $request->fk_property_id,
                    "route" => "property.show"
                ];
            }
            newNotification($details);
            return redirect()->back()->with('success', "Images Uploaded Successfully");
        } else {
            return redirect()->back()->with('error', "Images Upload failes");
        }
    }

    public function getUploadsPhotoBySection(Request $request)
    {
        $baseURL = 'https://futurefit.bcrcomply.com/futurefitapi/public/assets/uploads/photo_uploads';
        $getData = PhotoUploads::select('photo_uploads.*','photo_folder_names.name as fk_section_name',
        DB::raw("IF(image_path != '', CONCAT('" . $baseURL . "', REPLACE(image_path, ' ', '%20')), null) AS image_path"),DB::raw("IF(tbl_user.full_name IS NULL, 'Admin', tbl_user.full_name) AS full_name"))
        ->join('photo_folder_names','photo_folder_names.id','photo_uploads.fk_section_id')
        ->leftjoin('property_surveyors','property_surveyors.id','photo_uploads.fk_surveyor_id')
        ->leftjoin('tbl_user','tbl_user.user_id','property_surveyors.surveyor_id')
        ->where('photo_uploads.fk_property_id',$request->fk_perperty_id)
        ->where('photo_uploads.fk_section_id',$request->fk_section_id)
        ->get()
        ->map(function ($item) {
            // If date_created is null, set it to date_added
            if ($item->date_created === null) {
                $item->date_created = $item->date_added;
            }
            return $item;
        });

        if (count($getData) > 0) {
            return response()->json(['success' => "1", 'data'=>$getData,'message' =>'Images Fetched Successfully.', 'code' => 200]);
        } else {
            return response()->json(['success' => "0",'data'=>[], 'message' => 'Images not found.', 'code' => 400]);
        }
    }
    public function deletephotofile(Request $request) {
        $delete = PhotoUploads::find($request->id);
        $imagePath = public_path('futurefitapi/public/assets/uploads/photo_uploads'.$delete->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
                $delete->delete();
                return response()->json(['success'=>true,'message' => "Images Deleted Successfully"]);
        }else{
            $delete->delete();
            return response()->json(['success'=>true,'message' => "Images Deleted Successfully"]);
        }
    }
    public function downloadimgs(Request $request) {
        // Initialize archive object
        $zip = new ZipArchive();
        if($request->fk_section_id) {
           $folder = DB::table('photo_folder_names')->where('id',$request->fk_section_id)->first();
        }
        // dd($folder->name);
        $zipFilename = $request->fk_section_id ?  $folder->name . '.zip' : 'Photo_Uploads.zip';

        $zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $rootPath = $request->fk_section_id ? public_path('futurefitapi/public/assets/uploads/photo_uploads/'.$request->property_id .'/'.$folder->name) : public_path('futurefitapi/public/assets/uploads/photo_uploads/'.$request->property_id);
        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($rootPath), \RecursiveIteratorIterator::LEAVES_ONLY);

        foreach ($files as $name => $file)
        {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            if (!$file->isDir())
            {
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }else {
                if($relativePath !== false)
                    $zip->addEmptyDir($relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();
        return response()->download(public_path($zipFilename))->deleteFileAfterSend(true);
    }
    public function createpropertyEmail(Request $request)
    {
        $id = $request->id;
        $prev = url()->previous();
        // dd($request->all());
        $id = Crypt::decrypt($id);

        $property = Property::where('id', $id)->with('batch.scheme')->with('measures.job_lookup:id,title')->with('user_signin_out')->with('user_signin_out.users')->with('snags')->first();
        return view('dashboard.property.leadMail.create-email',get_defined_vars());
    }
    public function propertyViewEmail(Request $request)
    {
        // dd('in');
        $id = $request->id;
        $id = Crypt::decrypt($id);
        $data = LeadEmail::where('id',$id)->first();
        $property = Property::where('id', $data->fk_property_id)->with('batch.scheme')->with('measures.job_lookup:id,title')->with('user_signin_out')->with('user_signin_out.users')->with('snags')->first();
        return view('dashboard.property.leadMail.view-email',get_defined_vars());
    }
    public function sendEmailCustom(Request $request)
    {
        // dd($request->all());
        foreach($request->files as $fls){
            $files = $fls;
        }
        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {

                    $filename = explode('.',$uploadedFile->getClientOriginalName())[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                    $uploadedFile->move(public_path('assets/mail_attachments'), $filename);
                   $uploadeds['url'] = env("APP_URL")."/public/assets/mail_attachments/".$filename;
                   $uploadeds['name'] = $filename;
                   $uploadedFiles[] = $uploadeds;
            }
        }
        $details = [
            'senderemail' => env("MAIL_USERNAME"),
            'sendername' => env("APP_NAME"),
            'to_email' => $request->to_email,
            'to_name' => $request->to_name,
            'to_bcc' => $request->to_bcc,
            'to_greeting' => $request->to_greeting,
            'to_regards_by' => $request->to_regards_by,
            'to_regards' => $request->to_regards,
            'to_cc' => $request->to_cc,
            'to_body' => $request->to_body,
            'logo' => env("APP_URL")."/public/assets/images/logo.png",
            'subject' => $request->to_subject,
            'title' => $request->to_subject,
            'files' => $uploadedFiles,
            'template' => 'sendEmailCustom'
        ];
        $save = new LeadEmail();
        $save->fk_property_id = $request->fk_property_id;
        $save->to_email = $request->to_email;
        $save->to_subject = $request->to_subject;
        $save->to_greeting = $request->to_greeting;
        $save->to_regards_by = $request->to_regards_by;
        $save->to_regards = $request->to_regards;
        $save->to_cc = isset($request->to_cc) && $request->to_cc != "" ? $request->to_cc : null;
        $save->to_body = $request->to_body;
        $save->attechments = json_encode($uploadedFiles);
        $save->send_date = date('Y-m-d');
        $save->save();
        $message = \Mail::to($request->to_email);
            if (!empty($request->to_cc) && filter_var($request->to_cc, FILTER_VALIDATE_EMAIL)) { // Check if CC is provided
                $message->cc($request->to_cc);
            }
            if (!empty($request->to_bcc) && filter_var($request->to_bcc, FILTER_VALIDATE_EMAIL)) { // Check if BCC is provided
                $message->bcc($request->to_bcc);
            }
            $test = $message->send(new \App\Mail\Mailer($details));
           return redirect($request->prev)->with('success','Email Sent Successfully.');
    }
    public function createAppointment(Request $request)
    {
        // dd($request->all());
        $crAx = [];
        $contrAR = isset($request['appointment_contractors']) ? $request['appointment_contractors'] : [];
        if(sizeOf($contrAR)){
            foreach($contrAR as $cr){
                $getS = Surveyor::where('user_id',$cr)->first();
                $mx['id'] = $cr;
                $mx['full_name'] = $getS->full_name;
                $crAx[] = $mx;
            }
        }
        $request->validate([
            'subject' => ['nullable', 'string'],
            'appointment_desc' => ['nullable', 'string', 'max:900'],
            'appointment_status' => ['required', 'string', 'max:9'],
            'due_date' => ['nullable'],
            'property_id' => ['required', 'numeric']
        ]);
        $data = [];
        // dd($request->all());
        // if($request->when_time == null){
        //     $request['when_time'] = 'atoe';
        // }
        if($request->due_time == null){
            $request['due_time'] = date('H:i:00');
        }
        $data = Appointment::create([
            'subject' => $request['subject'],
            'appointment_desc' => $request['appointment_desc'],
            'property_id' => $request['property_id'],
            'appointment_status' => $request['appointment_status'],
            'status' => $request['appointment_status1'],
            'reason' => $request['appointment_status1_reason'],
            'appointment_other' => $request['appointment_other'],
            'appointment_contractors' => json_encode($crAx),
            'location' => $request['location'],
            'due_date' => $request['due_date'],
            'due_time' => $request['due_time']
        ]);
        // dd($data);
        // return redirect()->back()->with('success','Appointment Created Succcessfully.');
        return response()->json(['success' => true, 'data' => $data]);
    }
    public function deleteAppointment($id)
    {
        Appointment::where('id', $id)->delete();
        return redirect()->back();
    }
}

