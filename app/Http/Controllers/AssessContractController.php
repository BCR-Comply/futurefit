<?php

namespace App\Http\Controllers;

use App\Models\AssessorProperty;
use App\Models\ContractorProperty;
use App\Models\File;
use App\Models\JobLookup;
use App\Models\Log;
use App\Models\Property;
use App\Models\Variaton;
use App\Models\VariatonDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Node\Block\Document;
use App\Models\PhotoUploads;
use Illuminate\Support\Facades\DB;

class AssessContractController extends Controller
{

    private $assessoor_jobs = [];

    private $jobs = [];

    protected $contact_status = [
        'Pending',
        'Accepted',
        'Rejected',
        'Complete',
        'Variation',
        'In-Progress'
    ];

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
        $this->middleware('hea/ber-assessor');

        $contractor_jobs = JobLookup::where('type', 'contractor_job')->with('documents')->get();

        foreach ($contractor_jobs->toArray() as $value) {
            $this->jobs[$value['id']]['title'] = $value['title'];
            $this->jobs[$value['id']]['documents'] = array_map(function ($document) {
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
            $contracts = Property::with('assessor_contract')->with('batch')->whereHas('assessor_contract', function ($q) use ($authUser) {
                $q->where('assessor_id', $authUser->id);
            })->get();

            return datatables()->of($contracts)
                ->addColumn('action', function ($property) {
                    return '<a href="/dashboard/assessor-contract/show-contract/' . Crypt::encrypt($property->id) . '" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="View"> <i class="text-white mdi mdi-eye"></i></a>';

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
        return view('dashboard.assessor-contract.view-contract');
    }

    public function showContract($id)
    {

        $property_id = Crypt::decrypt($id);

        $authUser = Auth::user();
        $contacts = ContractorProperty::where('property_id', $property_id)->with('property')->with('document')->with('job_lookup:id,title')->with('word_orders')->with('variation.documents')->get();

        $assessor_contacts = AssessorProperty::where('property_id', Crypt::decrypt($id))->where('assessor_id', $authUser->id)->with('property')->with('job_lookup:id,title')->with('document')->with('work_orders')->get();

        $jobs = $this->jobs;
        $contact_status = $this->contact_status;

        $processed_contracts = [];

        foreach ($contacts as $contract) {

            $documents = [];
            $remaining_documents = [];

            foreach ($contract['document'] as $document) {
                $documents[] = $document['document'];
            }

            if(isset($jobs[$contract['job_id']]['documents'])){
                foreach ($jobs[$contract['job_id']]['documents'] as $document) {
                    if (!in_array($document, $documents)) {
                        $remaining_documents[] = $document;
                    }
                }
            }

            $contract['remaining_documents'] = $remaining_documents;

            $processed_contracts[] = $contract;
        }

        $contacts = $processed_contracts;


        $processed_assessor_contracts = [];

        foreach ($assessor_contacts as $contract) {

            $documents = [];
            $remaining_documents = [];

            foreach ($contract['document'] as $document) {
                $documents[] = $document['document'];
            }

            if(isset($this->assessoor_jobs[$contract['job_id']]['documents'])){
                foreach ($this->assessoor_jobs[$contract['job_id']]['documents'] as $document) {
                    if (!in_array($document, $documents)) {
                        $remaining_documents[] = $document;
                    }
                }
            }

            $contract['remaining_documents'] = $remaining_documents;

            $processed_assessor_contracts[] = $contract;
        }

        $assessor_contacts = $processed_assessor_contracts;

        $assessor_jobs = $this->assessoor_jobs;

        $property = Property::where('id', $property_id)->with('client')->first();

        $folderList = [];
        $folderLists = DB::table('photo_folder_names')->select('*')->orderBy('id', 'asc')->get();
        $getfolders = PhotoUploads::select('photo_uploads.fk_section_id','photo_folder_names.name as fk_section_name')
            ->join('photo_folder_names','photo_folder_names.id','photo_uploads.fk_section_id')
            ->where('photo_uploads.fk_property_id',$property_id)
            // ->whereIn('photo_folder_names.name', ["Post-Works BER Photos", "Pre-Works BER Photos"])
            ->where(function($query) {
                $query->whereRaw("
                    LOWER(
                        REGEXP_REPLACE(photo_folder_names.name, '[^a-zA-Z0-9]', '')
                    ) LIKE ?", ['%postwork%']
                )
                ->orWhereRaw("
                    LOWER(
                        REGEXP_REPLACE(photo_folder_names.name, '[^a-zA-Z0-9]', '')
                    ) LIKE ?", ['%prework%']
                );
            })
            ->groupBy('fk_section_id', 'fk_section_name')
            ->get();


        return view('dashboard.assessor-contract.show-contract', compact(
                'contacts',
                'jobs',
                'contact_status',
                'assessor_contacts',
                'assessor_jobs',
                'property',
                'folderLists',
                'getfolders'
            )
        );
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
                        'assessor_contract_id' => $request['id'],
                        'author' => trim($first_name . ' ' . $last_name). "($role)"
                    ];
                }

            }

            if (sizeof($uploadedFiles) > 0) {

                File::insert($uploadedFiles);

                $contract = AssessorProperty::where('id', $request['id'])->with('property')->with('assessor')->first();

                Log::create([
                    'type' => 'Assessor: ' . '[' . $request['document'] . '] Upload',
                    'property_id' => $contract['property_id'],
                    'author' => $contract['assessor']['firstname'] . ' ' . $contract['assessor']['lastname'],
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
            'assessor_notes' => ['nullable', 'string'],
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

        AssessorProperty::where('id', $request['id'])->update([
            'status' => $request['status'],
            'assessor_notes' => $request['assessor_notes']
        ]);

        $contract = ContractorProperty::where('id', $request['id'])->with('property')->with('assessor')->with('job_lookup')->first();

        Log::create([
            'type' => 'Assessor: ' . ($contract['job_lookup']['title'] ?? '') . ' [changed status ' . $request['status'] . ']',
            'property_id' => $contract['property_id'],
            'author' => $contract['assessor']['firstname'] . ' ' . $contract['assessor']['lastname'],
            'address' => $contract['property']['address1'] . ', ' . $contract['property']['address2'] . ', ' . $contract['property']['address3'],
            'first_name' => $contract['property']['wh_fname'],
            'last_name' => $contract['property']['wh_lname']
        ]);

        return redirect()->back();
    }

    function deleteDocument($id)
    {
        File::where('id', $id)->delete();
        return redirect()->back();
    }
}
