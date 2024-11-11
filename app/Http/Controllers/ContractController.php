<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\File;
use App\Models\Property;
use App\Models\Variaton;
use App\Models\JobLookup;
use App\Models\VariatonDoc;
use Illuminate\Http\Request;
use App\Models\AssessorProperty;
use App\Models\ContractorProperty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\ContractorPropertyNotes;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Node\Block\Document;

class ContractController extends Controller
{

    private $contractor_jobs = [];

    protected $contact_status = [
        'Pending',
        'Accepted',
        'Rejected',
        'Complete',
        'Variation',
        'In-Progress'
    ];

    protected $hea_ber_assessor_jobs = [];

    private $allowed_files_extensions = [
        'txt',
        'pdf',
        'jpg',
        'jpeg',
        'png',
        'pdf',
        'xlsx',
        'xlsm',
        'xls',
        'pptx',
        'doc',
        'rtf',
        'gif'
    ];


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('contractor');

        $contractor_jobs = JobLookup::where('type', 'contractor_job')->with('documents')->get();

        foreach ($contractor_jobs->toArray() as $value) {
            $this->contractor_jobs[$value['id']]['title'] = $value['title'];
            $this->contractor_jobs[$value['id']]['documents'] = array_map(function ($document) {
                return $document['title'];
            }, $value['documents']);
        }

        $assessoor_jobs = JobLookup::where('type', 'assessor_job')->with('documents')->get();

        foreach ($assessoor_jobs->toArray() as $value) {
            $this->assessoor_jobs[$value['id']]['title'] = $value['title'];
            $this->assessoor_jobs[$value['id']]['documents'] = array_map(function ($document) {
                return $document['title'];
            }, $value['documents']);
        }
    }


    public function index()
    {
        if (request()->ajax()) {

            $authUser = Auth::user();
            $contracts = Property::with('contract')->with('batch')->whereHas('contract', function ($q) use ($authUser) {
                $q->where('contractor_id', $authUser->id);
            });

            $contracts = $contracts->orderByRaw('(SELECT priority FROM properties_order WHERE properties_order.property_id = properties.id AND properties_order.contractor_id = '.$authUser->id.')')->get();

            return datatables()->of($contracts)
                ->addColumn('action', function ($property) {
                    return '<a href="/dashboard/contract/show-contract/' . Crypt::encrypt($property->id) . '" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="View"> <i class="text-white mdi mdi-eye"></i></a>';

                })
                ->addColumn('address1', function ($property) {
                    return format_address(
                        $property->house_num,
                        $property->address1,
                        $property->address2,
                        $property->address3,
                        $property->county
                    );
                })
                ->addColumn('batch', function ($property) {

                    return $property->batch->our_ref;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.contract.view-contract');
    }

    public function showContract($id)
    {
        $notify = isset($_GET['notify']) ? $_GET['notify'] : false;

        if($notify){
            auth()->user()->unreadNotifications->markAsRead();
        }
        $property_id = Crypt::decrypt($id);

        $authUser = Auth::user();
        $contacts = ContractorProperty::where('property_id', $property_id)->where('contractor_id', $authUser->id)->with('property')->with('job_lookup:id,title')->with('document')->with('word_orders')->with('variation.documents')->get();

        $processed_assessor_contracts = [];

        $assessors = AssessorProperty::where('property_id', $property_id)
            ->with('assessor')
            ->with('document')
            ->with('work_orders')
            ->with('job_lookup:id,title')
            ->with('surveyor')
            ->get();

        $contractor_jobs = $this->contractor_jobs;
        $contact_status = $this->contact_status;

        $processed_contracts = [];

        foreach ($contacts as $contract) {

            $documents = [];
            $remaining_documents = [];

            foreach ($contract['document'] as $document) {
                $documents[] = $document['document'];
            }

            if(isset($contractor_jobs[$contract['job_id']]['documents'])){
                foreach ($contractor_jobs[$contract['job_id']]['documents'] as $document) {
                    if (!in_array($document, $documents)) {
                        $remaining_documents[] = $document;
                    }
                }
            }

            $contract['remaining_documents'] = $remaining_documents;

            $processed_contracts[] = $contract;
        }

        foreach ($assessors as $assessor) {

            $documents = [];
            $remaining_documents = [];

            foreach ($assessor['document'] as $document) {
                $documents[] = $document['document'];
            }

            if(isset($this->hea_ber_assessor_jobs[$assessor['job_id']]['documents'])){
                foreach ($this->hea_ber_assessor_jobs[$assessor['job_id']]['documents'] as $document) {
                    if (!in_array($document, $documents)) {
                        $remaining_documents[] = $document;
                    }
                }
            }

            $assessor['remaining_documents'] = $remaining_documents;

            $processed_assessor_contracts[] = $assessor;
        }

        $assessors = $processed_assessor_contracts;

        $contacts = $processed_contracts;




        $property = Property::where('id', $property_id)->with('client')->first();


        return view('dashboard.contract.show-contract', compact(
                'contacts',
                'contractor_jobs',
                'contact_status',
                'property',
                'assessors',
                'notify'
            )
        );
    }

    function uploadFile(Request $request)
    {

        $auth_user = Auth::user();

        $first_name = $auth_user->firstname;
        $last_name = $auth_user->lastname;
        $role = $auth_user->role;

        if ($request->hasFile('files')) {

            $uploadedFiles = [];

            foreach ($request->file('files') as $uploadedFile) {

                if (in_array($uploadedFile->getClientOriginalExtension(), $this->allowed_files_extensions)) {

                    $filename = explode(
                            '.',
                            $uploadedFile->getClientOriginalName()
                        )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

                    $uploadedFile->move(public_path('files'), $filename);

                    $uploadedFiles[] = [
                        'document' => $request['document'],
                        'file' => $filename,
                        'contract_id' => $request['id'],
                        'author' => trim($first_name . ' ' . $last_name). "($role)"
                    ];

                }

            }

            if (sizeof($uploadedFiles) > 0) {

                File::insert($uploadedFiles);

                $contract = ContractorProperty::where('id', $request['id'])->with('property')->with('contractor')->first();

                Log::create([
                    'type' => $request['document'],
                    'property_id' => $contract['property_id'],
                    'author' => trim($first_name . ' ' . $last_name). "($role)",
                    'address' => $contract['property']['address1'] . ', ' . $contract['property']['address2'] . ', ' . $contract['property']['address3'],
                    'first_name' => $contract['property']['wh_fname'],
                    'last_name' => $contract['property']['wh_lname']
                ]);
            }
        }

        return redirect()->back();
    }

    function updateStatus(Request $request)
    {
        $request->validate([
            'current_status' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string', 'max:50'],
            'contractor_notes' => ['nullable', 'string'],
        ]);

        // if ($request['current_status'] != $request['status']) {
        //     $details = [
        //         'title' => 'Contract Status Changed',
        //         'email' => 'jon@bcrcomply.com',
        //         'job_url' => env(
        //             'APP_URL',
        //             'http://bcr-retrofit.bcrcomply.com/dashboard/property/assign-contractor/' . $request['property_id'] . '/' . $request['id']
        //         ),
        //         'old_status' => $request['current_status'],
        //         'new_status' => $request['status'],
        //         'template' => 'mail.contractor-status-change'
        //     ];

        //     \Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
        // }

        $old_data = ContractorProperty::where('id', $request['id'])->first();
        $updated_data = ContractorProperty::where('id', $request['id'])->update([
            'status' => $request['status'],
            'contractor_notes' => $request['contractor_notes']
        ]);
        $new_data = ContractorProperty::where('id', $request['id'])->first();

        $getPropertyDetails = Property::where('id', $new_data->property_id)->first();
        $address = format_address(
            $getPropertyDetails->house_num,
            $getPropertyDetails->address1,
            $getPropertyDetails->address2,
            $getPropertyDetails->address3,
            $getPropertyDetails->county,
            $getPropertyDetails->eircode
        );

        if($new_data->status != $old_data->status){
            $details = [
                "body" => "Status of the measure has been chaged from ". $old_data->status ." to ".$new_data->status ." in ". $address,
                "section" => "Contracts",
                "route" => "contract"
            ];
            newNotification($details);
        }

        $contract = ContractorProperty::where('id', $request['id'])->with('property')->with('contractor')->with('job_lookup')->first();

        Log::create([
            'type' => ($contract['job_lookup']['title'] ?? '') . ' [changed status ' . $request['status'] . ']',
            'property_id' => $contract['property_id'],
            'author' => $contract['contractor']['firstname'] . ' ' . $contract['contractor']['lastname'],
            'address' => $contract['property']['address1'] . ', ' . $contract['property']['address2'] . ', ' . $contract['property']['address3'],
            'first_name' => $contract['property']['wh_fname'],
            'last_name' => $contract['property']['wh_lname']
        ]);

        return redirect()->back();
    }

    function createVariation(Request $request)
    {
        $auth_user = Auth::user();

        Variaton::create([
            'fk_contractor_property_id' => $request['contractor_property_id'],
            'notes' => $request['notes'],
            'additional_cost' => $request['additional_cost'],
            'uploader_type' => $auth_user->role,
            'uploader_id' => $auth_user->id,
            'date' => NOW()
        ]);

        return redirect()->back();

    }

    function uploadVariationDocument(Request $request)
    {
        if ($request->hasFile('document')) {

            $uploadedFile = $request->file('document');

            $filename = explode(
                    '.',
                    $uploadedFile->getClientOriginalName()
                )[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();

            $file = Storage::disk('public')->putFileAs(
                '/',
                $uploadedFile,
                $filename
            );

            $filename = $file;

            $auth_user = Auth::user();

            VariatonDoc::create([
                'file_path' => $filename,
                'fk_variation_id' => $request['variation_id'],
                'uploader_type' => $auth_user->role,
                'uploader_id' => $auth_user->id
            ]);
        }

        return redirect()->back();
    }

    function deleteVariation($id)
    {
        Variaton::where('id', Crypt::decrypt($id))->delete();
        return redirect()->back();
    }

    function deleteDocument($id)
    {
        File::where('id', $id)->delete();
        return redirect()->back();
    }

    function deleteVariationDocument($id)
    {
        VariatonDoc::where('id', $id)->delete();
        return redirect()->back();
    }
    public function createNote(Request $request)
    {
        $auth_user = Auth::user();
        ContractorPropertyNotes::create([
            'property_id' => $request->property_id,
            'contractor_property_id' => $request->contractor_property_id,
            'contractor_id' => $request->contractor_id,
            'job_id' => $request->job_id,
            'notes' => $request->notes,
            'created_by' => $auth_user->id,
        ]);
        return redirect()->back();

    }

    public function deleteNote($id)
    {
        $auth_user = Auth::user();
        $contact = ContractorPropertyNotes::where('id', Crypt::decrypt($id))->first();
        if(!$contact) {
            abort(404);
        }
        if ($contact->created_by != $auth_user->id) {
            abort(401);
        }
        ContractorPropertyNotes::where('id', Crypt::decrypt($id))->delete();
        return redirect()->back();
    }
}
