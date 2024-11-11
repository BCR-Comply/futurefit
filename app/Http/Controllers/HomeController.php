<?php

namespace App\Http\Controllers;


use App\Models\Log;
use App\Models\User;
use App\Models\Batch;
use App\Models\Scheme;
use App\Models\Survey;
use App\Models\Property;
use App\Models\Reminder;
use App\Models\JobLookup;
use App\Models\PostWorkLog;
use Illuminate\Http\Request;
use App\Models\PropertyOrder;
use App\Models\Appointment;
use App\Models\ContractorProperty;
use Illuminate\Support\Facades\DB;
use App\Notifications\ContractorJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ContractorJobAcceptReject;



class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function adminProfile()
    {
        $user = Auth::user();
        $id = $user->id;
        $user = User::find($id);

        return view('dashboard.admin.main-admin', compact('user'));
    }
    public function changeStatusNofication(Request $request)
    {
        // dd($request->all());
        if($request->type == 'reminder'){
            $update = Reminder::where('id',$request->id)->first();
                $update->is_read = $request->value;
                $update->update();
            $data = ['id'=>Crypt::encrypt($update->property_id),'type'=>'rem'];
            return response()->json(['success'=>true,'data'=>$data,'message' => 'Reminder updated successfully']);
        }
        if($request->type == "appointmentstatus"){
            $data = Appointment::where('id',$request->id)->update([
                'appointment_status' => $request->value,
                'appointment_other' => $request->value2,
            ]);
            return response()->json(['success'=>true,'message' => 'Appointment updated successfully']);

        }
        if($request->type == "appointmentPstatus"){
            $data = Appointment::where('id',$request->id)->update([
                'status' => $request->value,
                'reason' => isset($request->reason) && $request->reason != "" ?$request->reason : null,
            ]);
            return response()->json(['success'=>true,'message' => 'Appointment status updated successfully']);

        }
        if($request->type == "reminderstatus"){
            // if($request->value == "Pending"){
            //     $data = "Complete";
            // }else{
            //     $data = "Pending";
            // }
            $data = Reminder::where('id',$request->id)->update([
                'status' => $request->value,
            ]);
            // $updateReminder = DB::table('reminders')->where('id',$request->id)->update(['status'=>$data]);
            // $updateReminder = Reminder::find($request->id);
            // $updateReminder->status = $data;
            // $updateReminder->update();

            return response()->json(['success'=>true,'message' => 'Reminder updated successfully']);
        }
    }
    public function adminUpdate(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $id = $user->id;
        $find = User::where('id',$id)->first();
        if ($request->file('profile_img')) {
            $image_path = "/assets/images/admin/";
            $photo = $request->file('profile_img');
            $imageName = 'admin-' . time() . '.' . request()->profile_img->getClientOriginalExtension();
            $photo->move(public_path($image_path), $imageName);
            $find->profile_img = $imageName;
        }else{
            if($request->profile_img_filename == null){
                $find->profile_img = null;
            }
        }
        if(($request->password != "" || $request->password != null) && $request->change_pass == '1'){
        $find->password = bcrypt($request->password);
        }
        $find->firstname = $request->firstname;
        $find->lastname = $request->lastname;
        if($find->update()){
            return redirect()->back()->with('success','Profile Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Profile Updatation Failed.');
        }
    }

    public function index()
    {
        if (request()->ajax()) {
            $logs = Log::select('logs.*','properties.house_num','properties.address1','properties.address2','properties.address3','properties.county','properties.eircode')
            ->join('properties','properties.id','logs.property_id')->get();
            return datatables()->of($logs)
                ->addColumn('action', function ($log) {
                    return '<a href="/dashboard/property/show/' . Crypt::encrypt($log->property_id) . '?back=0" class="btn btn-sm _btn-primary px-2 mr-1 view-actionlog-btn">View Property</a>';
                })
                ->addColumn('created_at', function ($log) {
                    return date("Y-m-d H:i A", strtotime($log->created_at));
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }



        if (request()->ajax()) {

            $post_work_logs = PostWorkLog::where('status', '!=', 'Complete')->with('contractor_property')->orderBy('id', 'desc');

            return datatables()->of($post_work_logs)
                ->addColumn('action', function ($log) {
                    return '<a href="/dashboard/property/show/' . Crypt::encrypt($log->contractor_property->property_id) . '?back=0" class="btn btn-sm _btn-primary px-2 mr-1" title="View Property">View Property</a>';
                })
                ->rawColumns(['action']);
        }

        $jobs = JobLookup::where('type', 'contractor_job')->get();

        // $batches = Batch::select(['id', 'scheme_id', 'our_ref'])->withCount('properties')->get();
        $batches = Batch::select(['id', 'scheme_id', 'our_ref'])
        ->withCount(['properties' => function ($query) {
                        $query->where('archived', '!=', 1);
                    }])
        ->get();
        $batch_schemes = Scheme::select(['id', 'scheme','color','logo'])->where('is_active', 1)->get()->pluck([], 'id')->toArray();

        foreach ($batch_schemes as $key => $value) {
            $batch_schemes[$key]['property_count'] = 0;
            $batch_schemes[$key]['batch_count'] = 0;
        }

        foreach ($batches as $key => $value) {
            if (isset($batch_schemes[$value->scheme_id])) {
                $batch_schemes[$value->scheme_id]['batch_count'] += 1;
                $batch_schemes[$value->scheme_id]['property_count'] += $value['properties_count'];
            }
        }

        $start = date('1970-01-01');
        $end = date('3000-12-31');
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
        // ->orderBy('reminders.is_read', 'DESC')
        ->orderBy('reminders.id', 'DESC')
        ->get();

        $authUser = Auth::user();
        $contractCost = DB::table('contractor_property')->where('contractor_id', $authUser->id)->sum('cost');

        return view(
            'dashboard.dashboard',
            compact(
                'contractCost',
                'jobs',
                'batch_schemes',
                'batches',
                'reminders'
            )
        );
    }

    function propertyContracts(Request $request)
    {
        if (request()->ajax()) {

            $status_color = [
                'Pending' => 'badge-warning',
                'Accepted' => 'badge-success-light',
                'Rejected' => 'badge-danger',
                'Complete' => 'badge-success',
                'Variation' => 'badge-info',
                'In-Progress' => 'badge-warning-light'
            ];

            $batch_id = $request->batch_id ?? '';
            $contractor_id =  $request->contractor_id ?? '';

            $property_contracts = null;

            $property_contracts = Property::leftjoin('clients','clients.id','properties.client_id')
            ->select('properties.*','clients.name as clients_name')
            ->whereIn('status', ['in-progress', 'pending', 'survey-complete'])
            ->orderBy('properties.id', 'DESC');

            if (!empty($request->selected_jobs)) {
                $property_contracts =  $property_contracts->with('contract.job_lookup')->whereHas('contract.job_lookup', function ($q) use ($request) {
                    $q->whereIn('title', $request->selected_jobs);
                });
            }

            if (!empty($request->scheme)) {
                $property_contracts =  $property_contracts->with('batch.scheme')->whereHas('batch.scheme', function ($q) use ($request) {
                    $q->where('schemes.id', $request->scheme);
                });
            }

            if (trim($batch_id) != "") {
                $property_contracts = $property_contracts->where('batch_id', $batch_id);
            }

            if (trim($contractor_id != "")) {

                $property_contracts = $property_contracts->with('contract.job_lookup')->whereHas('contract.job_lookup', function ($query) use ($contractor_id) {
                    return $query->where('contractor_property.contractor_id', $contractor_id);
                });

                $property_contracts = $property_contracts->orderByRaw('(SELECT priority FROM properties_order WHERE properties_order.property_id = properties.id AND properties_order.contractor_id = ' . $contractor_id . ')');
            } else {
                $property_contracts = $property_contracts->with('contract.job_lookup');
            }


            $jobs = JobLookup::where('type', 'contractor_job');

            $jobs = $jobs->get()->toArray();

            $properties_with_contracts = [];

            $data_table = datatables()->of($property_contracts);

            $headers = array_map(function ($measure) {
                return 'c_' . $measure['id'];
            }, $jobs);


            foreach ($headers as $header) {
                $data_table->addColumn($header, function ($property) use ($header, $status_color, $request) {

                    $column = '';

                    foreach ($property['contract'] as $contract) {

                        if ('c_' . $contract['job_id'] == $header) {

                            if (!empty($request->selected_jobs)) {
                                if (!in_array($contract['job_lookup']['title'], $request->selected_jobs)) {
                                    continue;
                                }
                            }

                            $title = isset($contract['contractor']['firstname']) ? $contract['contractor']['firstname'] :  '' . ' ' . (isset($contract['contractor']['lastname']) ? $contract['contractor']['lastname'] : '');
                            $title .= " - " . ($contract['job_lookup']['title'] ?? '') . " " . date('d/m/Y', strtotime($contract['start_date'])) . ' - ' . date('d/m/Y', strtotime($contract['end_date']));
                            $badge = <<<EOT
                                    <span
                                        class="pointer badge {$status_color[$contract['status']]} badge-secondary my-1 p-1 d-block text-uppercase"
                                        title="{$title}"
                                        data-toggle="tooltip"
                                        data-placement="bottom"
                                    >
                                    {$contract['status']}
                                    </span>
                                EOT;
                            $column .= $badge;
                        }
                    }

                    return $column;
                });
            }

            $headers[] = 'address';

            $data_table->addColumn('address', function ($property) {
                $client_name = trim($property->wh_fname . ' ' . $property->wh_lname);
                $client_name = $client_name ? $client_name . ', ' : '';

                $address = format_address(
                    $property->house_num,
                    $property->address1,
                    $property->address2,
                    $property->address3,
                    $property->county
                );

                return '<a title="' . $client_name . $address . '" class="mt-2 text-secondary" href="/dashboard/property/show/' . Crypt::encrypt($property ? $property->id : 0) . '?back=0" red>' . $client_name . format_address(
                    $property->house_num,
                    $property->address1
                ) . "</a>";
            })
                ->filterColumn('address', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT(COALESCE(wh_fname, ''), ' ', COALESCE(wh_lname, ''), ', ', COALESCE(house_num, ''),', ', COALESCE(house_num, ''),', ',COALESCE(properties.address1, ''),', ',COALESCE(properties.address2, ''),', ',COALESCE(properties.address3,''), ', ', COALESCE(properties.county, '')) like ?", ["%{$keywords}%"]);
                })
                ->rawColumns($headers)
                ->setRowAttr([
                    'data-id' => function ($property) {
                        return $property->id;
                    }
                ]); 

                $data_table->addColumn('clients_name', function ($property) {
                    $clients_name = trim($property->clients_name);
                    return $clients_name;
                })->filterColumn('clients_name', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT(COALESCE(clients.name, '')) like ?", ["%{$keywords}%"]);
                });

            return $data_table->make(true);
        }
    }


    public function propertyContractsOrder(Request $request)
    {

        $response = [];

        foreach ($request->order as  $order) {
            if (PropertyOrder::where('property_id', $order['id'])->where('contractor_id', $order['contractor_id'])->exists()) {
                $propertyOrder = PropertyOrder::where('property_id', $order['id'])->where('contractor_id', $order['contractor_id'])->first();
                $propertyOrder->priority = $order['position'];
                $propertyOrder->save();
                $response['msg'][] = 'UPDATE';
            } else {
                PropertyOrder::create([
                    'property_id' => $order['id'],
                    'contractor_id' => $order['contractor_id'],
                    'priority' => $order['position']
                ]);
                $response['msg'][] = 'INSERT';
            }
        }

        return response($response, 200);
    }

    function postWorkLog()
    {
        if (request()->ajax()) {

            // $post_work_logs = PostWorkLog::where('status', '!=', 'Complete')->with('contractor_property');
            $post_work_logs = PostWorkLog::select('post_works_logs.*','properties.house_num','properties.address1','properties.address2','properties.address3','properties.county','properties.eircode')
            ->leftjoin('contractor_property','contractor_property.id','post_works_logs.fk_contractor_property_id')
            ->join('properties','properties.id','contractor_property.property_id')
            ->where('post_works_logs.status', '=', 'Opened')->with('contractor_property')->orderBy('post_works_logs.id', 'desc');
            return datatables()->of($post_work_logs)
                ->addColumn('action', function ($log) {
                    return '<a href="/dashboard/property/show/' . Crypt::encrypt(isset($log->contractor_property) ? $log->contractor_property->property_id : 0) . '?back=0#post_work_log_' . $log['id'] . '" class="btn btn-sm _btn-primary px-2 text-white view-post-property" title="View Property">View Property</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    function getContractorJobs()
    {
        if (request()->ajax()) {

            $contractor_jobs = ContractorProperty::leftJoin('properties', 'contractor_property.property_id', '=', 'properties.id')
                ->select('contractor_property.*')
                ->with('property.batch.scheme')
                ->with('surveyor')
                ->with('job_lookup')
                ->whereHas('surveyor')
                ->whereHas('property.batch.scheme', function ($q) {
                    $q->where('properties.id', '!=', null);
                    $q->where('batches.id', '!=', null);
                    $q->where('schemes.id', '!=', null);
                });

            return datatables()->of($contractor_jobs)
                ->addColumn('action', function ($job) {
                    return '<a href="/dashboard/property/show/' . Crypt::encrypt($job->property_id) . '?back=0" class="btn btn-sm _btn-primary px-2 mr-1">View Property</a>';
                })
                ->editColumn('property.created_at', function ($job) {
                    return isset($job->property->created_at) ? date('d/m/Y', strtotime($job->property->created_at)) : '';
                })
                ->editColumn('wh_fname', function ($job) {
                    return isset($job->property) ? $job->property->wh_fname . ' ' . $job->property->wh_lname : '';
                })
                ->editColumn('job', function ($job) {
                    return $job->job_lookup->title ?? '';
                })
                ->editColumn('status', function ($job) {
                    return $job->status ?? '';
                })
                ->editColumn('eircode', function ($job) {
                    return $job->property->eircode ?? '';
                })
                ->editColumn('phone', function ($job) {
                    return $job->property->phone1 ? $job->property->phone1 : $job->property->phone2;
                })
                ->editColumn('scheme', function ($job) {
                    return $job->property->batch->scheme->scheme ?? '';
                })
                ->editColumn('address', function ($job) {
                    return isset($job->property) ? format_address(
                        $job->property->house_num,
                        $job->property->address1,
                        $job->property->address2,
                        $job->property->address3,
                        $job->property->county
                    ) : '';
                })
                ->filterColumn('address', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT( COALESCE(house_num, ''),', ',COALESCE(address1, ''),', ',COALESCE(address2, ''),', ',COALESCE(address3,''), ', ', COALESCE(county, '')) like ?", ["%{$keywords}%"]);
                })
                ->filterColumn('phone', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("phone1 like ? OR phone2 like ?", ["%{$keywords}%", "%{$keywords}%"]);
                })
                ->filterColumn('wh_fname', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT(wh_fname,' ', wh_lname) like ?", ["%{$keywords}%"]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getCalendarJobs(Request $request)
    {

        $jobs = ContractorProperty::orderBy('id', "DESC");
        if (!empty($request->jobs)) {
            $jobs =  $jobs->whereHas('job_lookup', function ($q) use ($request) {
                $q->whereIn('title', $request->jobs);
            });
        }
        if (!empty($request->start_date)) {
            $jobs = $jobs->where('start_date', '>=', $request->start_date);
        }
        if (!empty($request->end_date)) {
            $jobs = $jobs->where('end_date', '<=', $request->end_date);
        }
        $data = $jobs->get();
        $events = [];
        foreach ($data as $key => $d) {
            $status_color = [
                'Pending' => 'badge-warning',
                'Accepted' => 'badge-success-light',
                'Rejected' => 'badge-danger',
                'Complete' => 'badge-success',
                'Variation' => 'badge-info',
                'In-Progress' => 'badge-warning-light'
            ];

            $address = NULL;

            $url = NULL;
            if (!empty($d->property)) {
                $address = $d->property->wh_fname . ' ' . $d->property->wh_lname . ', ' . $d->property->house_num . ', ' . $d->property->address1;
                $url = Crypt::encrypt($d->property->id);
            }

            $event = [
                'title' => $d->job_lookup->title ?? 'N/A',
                'start' => $d->start_date,
                'end' => $d->end_date,
                'contractor_name' => $d->contractor->firstname . ' ' . $d->contractor->lastname,
                'contractor_email' => $d->contractor->email,
                'contractor_phone' => $d->contractor->phone,
                'surveyor_name' => $d->surveyor->full_name ?? 'N/A',
                'surveyor_phone' => $d->surveyor->phone_number ?? 'N/A',
                'address' => $address,
                'color' => random_color_generate($d->job_id % 55),
                "status" => $d->status,
                "status_class" => $status_color[$d->status],
                "action_url" => $url
            ];
            array_push($events, $event);
        }
        return response()->json($events);
    }


    public function propertiesJobs(Request $request)
    {
        $events['data'] = [];
        $property_contracts = Property::with('contract.job_lookup')->with('contract.contractor')->get();
        $i = 0;
        foreach ($property_contracts as $property_contract) {
            $rand = rand(0000,9999);
            $modifiedID = $property_contract->id.'_'.$rand;
            $url = Crypt::encrypt($property_contract->id);
            $address = ($property_contract->wh_fname ?? '') . ' ' . ($property_contract->wh_lname ?? '') . ', ' . ($property_contract->house_num ?? '') . ', ' . ($property_contract->address1 ?? '');
            $event = [
                'id' => $modifiedID,
                'text' => $address,
                'start_date' => null,
                'duration' => null,
                'parent' => 0,
                'open' => true,
                'eventColor' => 'bg-4d6e96',
                'property_start_date' => $property_contract->start_date,
                'property_end_date' => $property_contract->end_date,
                'url' => url('/dashboard/property/show/' . $url)
            ];
            array_push($events['data'], $event);
            $i++;
            foreach ($property_contract->contract as $contract) {
                $i++;
                $to = \Carbon\Carbon::parse($contract->start_date);
                $from = \Carbon\Carbon::parse($contract->end_date);
                $days = $to->diffInDays($from);
                $status_color = [
                    'Pending' => 'badge-warning',
                    'Accepted' => 'badge-success-light',
                    'Rejected' => 'badge-danger',
                    'Complete' => 'badge-success',
                    'Variation' => 'badge-info',
                    'In-Progress' => 'badge-warning-light'
                ];

                if($contract->id == $property_contract->id) {
                    $cids = $contract->id."@@@";
                }else {
                    $cids = $contract->id;
                }
                $event = [
                    'id' => $cids ?? '',
                    'text' => $contract->job_lookup->title ?? '',
                    'start_date' =>  $contract->start_date ?? '',
                    'duration' => $days,
                    'parent' => $modifiedID,
                    'status' => '<span class="pointer badge ' . $status_color[$contract->status] . ' text-uppercase">' . $contract->status . '</span>',
                    'contractor' => $contract->contractor->firstname ?? '',
                    'address' => $address,
                    'url' => url('/dashboard/property/show/' . $url)
                ];
                array_push($events['data'], $event);
            }
        }
        // dd($events);
        return response()->json($events);
    }

    function contractorPropertiesGantt(Request $request)
    {
        $start = $end = "";
        $start = $request->start;
        $end = $request->end;
        return view('dashboard.gantt',get_defined_vars());
    }
    function scheduler(Request $request)
    {
        $start = $end = "";
        $start = $request->start;
        $end = $request->end;
        return view('dashboard.scheduler',get_defined_vars());
    }
    public function markAsRead(Request $request)
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }

    public function acceptPropertyContract(ContractorProperty $contract)
    {
        $contract->status = 'Accepted';
        if($contract->update()){
            $contractor_property = ContractorProperty::where('id', $contract->id)->with('property')->with('contractor')->with('job_lookup:id,title')->first();
            $address = format_address(
                $contractor_property->property->house_num,
                $contractor_property->property->address1,
                $contractor_property->property->address2,
                $contractor_property->property->address3,
                $contractor_property->property->county,
                $contractor_property->property->eircode
            );

            $contractor = $contractor_property->contractor->firstname.' '.$contractor_property->contractor->lastname;
            $job = $contractor_property['job_lookup']['title'] ?? '';

            $notification_details = ['decision' => "Accepted", 'contractor' => $contractor, 'assigned_job' => $job, 'property_address' => $address];


            $users = User::where('role','admin')->get();
            Notification::send($users, new ContractorJobAcceptReject($notification_details));

        }
        return redirect()->route('show.contract', Crypt::encrypt($contract->property_id));
    }

    public function rejectPropertyContract(ContractorProperty $contract)
    {
        $contract->status = 'Rejected';
        if($contract->update()){
            $contractor_property = ContractorProperty::where('id', $contract->id)->with('property')->with('contractor')->with('job_lookup:id,title')->first();
            $address = format_address(
                $contractor_property->property->house_num,
                $contractor_property->property->address1,
                $contractor_property->property->address2,
                $contractor_property->property->address3,
                $contractor_property->property->county,
                $contractor_property->property->eircode
            );

            $contractor = $contractor_property->contractor->firstname.' '.$contractor_property->contractor->lastname;
            $job = $contractor_property['job_lookup']['title'] ?? '';

            $notification_details = ['decision' => "Rejected", 'contractor' => $contractor, 'assigned_job' => $job, 'property_address' => $address];


            $users = User::where('role','admin')->get();
            Notification::send($users, new ContractorJobAcceptReject($notification_details));

        }
        return redirect()->route('show.contract', Crypt::encrypt($contract->property_id));
    }


    public function contractorsAndAdmins(Request $request)
    {
        $contractors = User::where('role', 'contractor')->get();
        $accessors = User::where('role', 'hea/ber-assessor')->get();
        $admins = User::where('role', 'admin')->get();
        $html = view('dashboard.chat.dropdown', get_defined_vars())->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }
    public function calendar_appointments(Request $request)
    {
        return view('dashboard.calendar.calendar-appointments',get_defined_vars());
    }
}