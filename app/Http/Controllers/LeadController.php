<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\LeadEmail;
use App\Models\TableUser;
use Exception;
use ZipArchive;
use Illuminate\Support\Str;
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
class LeadController extends Controller
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
        'lead' => 'New Lead',
        'quoted' => 'Quoted',
        'appointment_booked' => 'Appointment Booked',
        'surveyed' => 'Surveyed',
        'confirmed' => 'Confirmed',
        'will-follow-up' => 'Will Follow Up',
        'lost' => 'Lost',
        'not_interested' => 'Not Interested'
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
                $properties = Property::where('archived', $archived)->where('client_id', Crypt::decrypt($client_id))->where('batch_id', Crypt::decrypt($batch_id))->with('client')->with('batch.scheme')->with("inspection_data.quotation");
            } else if (!$client_id && $batch_id) {
                $properties = Property::where('archived', $archived)->where('batch_id', Crypt::decrypt($batch_id))->with('client')->with('batch.scheme')->with("inspection_data.quotation");
            } else if ($client_id && !$batch_id) {
                $properties = Property::where('archived', $archived)->where('client_id', Crypt::decrypt($client_id))->with('client')->with('batch.scheme')->with("inspection_data.quotation");
            } else {
                $properties = Property::where('archived', $archived)->with('client')->with('batch.scheme')->with("inspection_data.quotation");
            }
            if (!empty($request->get('property_start_date_filter'))) {
                $properties->where('properties.start_date', '>=', $request->get('property_start_date_filter'));
            }

            if (!empty($request->get('property_end_date_filter'))) {
                $properties->where('properties.end_date', '>=', $request->get('property_end_date_filter'));
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
                    $actions = '<a href="/dashboard/lead/show/' . Crypt::encrypt($property->id) . '?back=' . $scheme_id . '" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="show"> <i class="text-white mdi mdi-eye"></i></a>';
                    $actions .= '<a href="/dashboard/lead/edit/' . Crypt::encrypt($property->id) . '?back=' . $scheme_id . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/lead/delete/' . Crypt::encrypt($property->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
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
                ->addColumn('quotation', function ($property) {
                    $name = '';
                    if(($property->inspection_data != null && $property->inspection_data->fk_forms_id == 22) && ($property->inspection_data->quotation != null && $property->inspection_data->id == $property->inspection_data->quotation->fk_inspection_id)){
                        $name =  asset('/futurefitapi/public/assets/uploads/inspection_pdf'.$property->inspection_data->pdf_filename);
                    }
                    // dd($name);
                    return $name;
                })
                ->addColumn('quotation_title', function ($property) {
                    $name2 = '';
                    if(($property->inspection_data != null && $property->inspection_data->fk_forms_id == 22) && ($property->inspection_data->quotation != null && $property->inspection_data->id == $property->inspection_data->quotation->fk_inspection_id)){
                        $name2 = "Quotation - ".date('d/m/Y',strtotime($property->inspection_data->date_inspected));
                    }
                    return ucfirst($name2);
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
                ->addColumn('created_at', function ($property) {
                    return date('d/m/Y', strtotime($property->created_at));
                })
                ->addColumn('occupier_name', function ($property) {
                    return $property->wh_fname . ' ' . $property->wh_lname;
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
            'dashboard.property.lead.view-lead',
            compact(
                'title',
                'scheme_id',
                'batches',
                'property_status'
            )
        );
    }

    public function createLead(Request $request)
    {

        $clients = Client::select(['id', 'name', 'email'])->get();
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
            'dashboard.property.lead.create-lead',
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

    public function storeLead(StorePropertyRequest $request)
    {
        $client_id = $request->client_id;

        if ($request->client_select_type == 'select_from_clients' && $request->status != "lead") {

            $request->validate([
                'client_id' => ['required', 'numeric'],
            ]);

            $client_id = $request->client_id;
        } else if ($request->client_select_type == 'use_above_client' || $request->status == "lead") {

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
        } else if ($request->client_select_type == 'create_new_client' && $request->status != "lead") {

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
            'lead_type' => $request->lead_type,
            'lead_value' => $request->lead_value,
            'lead_source' => $request->lead_source,
        ]);
        $address = format_address(
            $created_property->house_num,
            $created_property->address1,
            $created_property->address2,
            $created_property->address3,
            $created_property->county,
            $created_property->eircode
        );

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

        if ($created_property->wasRecentlyCreated === true && $created_property->client_id != null) {
            $details = [
                "body" => "New Lead has been created: ".$address,
                "section" => "Lead",
                "route" => "lead"
            ];
            newNotification($details);

            $cname = $created_property->client->name;
            $details = [
                "body" => "Client " ."($cname)". " has been added to a Lead: ".$address,
                "section" => "Client",
                "route" => "client"
            ];
            newNotification($details);

            $details = [
                "body" => "Lead " ."($address)". " has been added to Batch: ".$created_property->batch->our_ref,
                "section" => "Lead",
                "route" => "lead"
            ];
            newNotification($details);
        }

        return redirect(route('lead.show', Crypt::encrypt($created_property->id)));
    }

    public function editLead(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $property = Property::where('id', $id)->with('batch.scheme')->first();

        $clients = Client::select(['id', 'name', 'email'])->get();
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
            'dashboard.property.lead.create-lead',
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
                "body" => "Lead has been deleted: ".$address,
                "section" => "Lead",
                "route" => "lead"
            ];
            newNotification($details);
        }
        return redirect()->back();
    }
    public function updateLead(StorePropertyRequest $request)
    {
        $oldValue = Property::where('id', $request->id)->first();
        $property = Property::where('id', $request->id)->update(
            [
                'batch_id' => isset($request->is_property) && $request->is_property == "property" ? $request->prop_batch_id : $request->batch_id,
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
                'status' => isset($request->is_property) && $request->is_property == "property" ? "pending" : $request->status,
                'email' => $request->email,
                'pre_ber' => $request->pre_ber,
                'post_ber' => $request->post_ber,
                'wh_ref' => $request->wh_ref,
                'lead_type' => $request->lead_type,
                'lead_value' => $request->lead_value,
                'lead_source' => $request->lead_source,
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
                "body" => "Lead has been updated: ".$address,
                "section" => "Lead",
                "route" => "lead"
            ];
            newNotification($details);

            if(isset($getPropertyDetails->batch->our_ref) && $oldValue->batch_id != $getPropertyDetails->batch_id){
                $details = [
                "body" => "Lead " ."($address)". " has been added to Batch: ".$getPropertyDetails->batch->our_ref,
                "section" => "Batch",
                "route" => "batch"
            ];
            newNotification($details);
            }

            if($getPropertyDetails->status == "completed") {
                $details = [
                "body" => "Lead has has been completed: ".$address,
                "section" => "Lead",
                "route" => "lead"
            ];
            newNotification($details);
            }
        }

        $back = $request->query('back');

        if(isset($request->is_property) && $request->is_property == "property"){
            $getPropDts = Property::where('id', $request->id)->first();
            $txt = "";
            $txt .= "Lead Type: ".$getPropDts->lead_type.",\n";
            $txt .= "Lead Value: ".$getPropDts->lead_value.",\n";
            $txt .= "Lead Source: ".$getPropDts->lead_source;
            PropertyNote::create([
                "property_id" => $request->id,
                "text" => $txt
            ]);
            return redirect()->route('property.show', Crypt::encrypt($request->id));
        }else{
            return redirect()->route('lead.show', Crypt::encrypt($request->id));
        }
    }

    public function showLead(Request $request, $id)
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
        $surveyors = Surveyor::select(['full_name','appname', 'user_id'])->get();

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

        $batches = Batch::select(['id', 'our_ref', 'scheme_id'])->get();
        return view(
            'dashboard.property.lead.show-lead',
            compact(
                'property',
                'counties',
                'contractors',
                'surveyors',
                'inspections',
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
                'post_work_logs',
                'appointments',
                'emailDatas',
                'batches'
            )
        );
    }
    public function deleteLead($id)
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
                "body" => "Lead has been deleted: ".$address,
                "section" => "Lead",
                "route" => "lead"
            ];
            newNotification($details);
        }
        return redirect()->back();
    }
    public function deleteLeadEmail(Request $request)
    {
        // dd($request->all());
        $get = LeadEmail::where('id', $request->id)->first();
        $getFiles = json_decode($get->attechments);
        if(sizeOf($getFiles)){
            foreach($getFiles as $fil){
                $filePAth = env('ABSO_PATH').'/assets/mail_attachments/'.$fil->name;
                if(file_exists($filePAth)){
                    unlink($filePAth);
                }
            }
        }
        $deleted = LeadEmail::where('id', $request->id)->delete();
        return redirect()->back()->with('success','Email data deleted Successfully.');
    }
    public function createLeadEmail(Request $request)
    {
        $id = $request->id;
        $prev = url()->previous();
        // dd($request->all());
        $id = Crypt::decrypt($id);

        $property = Property::where('id', $id)->with('batch.scheme')->with('measures.job_lookup:id,title')->with('user_signin_out')->with('user_signin_out.users')->with('snags')->first();
        return view('dashboard.property.leadMail.create-email',get_defined_vars());
    }
    public function leadViewEmail(Request $request)
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
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
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
        $save->send_date = date('Y-m-d H:i:s');
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
    public function convertLeadToProperty(Request $request)
    {
        $propId = $request->fk_property_id;

        Property::where('id', $propId)->update([
            'status' => 'pending',
            'batch_id' => $request->batch_id,
        ]);
        $getPropDts = Property::where('id', $propId)->first();
        $txt = "";
        $txt .= "Lead Type: ".$getPropDts->lead_type.",\n";
        $txt .= "Lead Value: ".$getPropDts->lead_value.",\n";
        $txt .= "Lead Source: ".$getPropDts->lead_source;
        PropertyNote::create([
            "property_id" => $propId,
            "text" => $txt
        ]);

        return redirect()->route('property.show',[Crypt::encrypt($propId)]);
    }
    public function leadStatus(Request $request){
        $prop = Property::where('id',$request->id)->update([
            'status' => $request->property_status,
        ]);
        return response()->json(["success" => true,"data" => $prop]);
    }
    public function leadReason(Request $request){
        $note = PropertyNote::create([
            "property_id" => $request->property_id,
            "text" => $request->text
        ]);
        return response()->json(["success" => true,"data" => $note]);
    }
}
