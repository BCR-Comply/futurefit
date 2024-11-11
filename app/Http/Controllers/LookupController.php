<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobDocumentLookupRequest;
use App\Http\Requests\StoreJobLookupRequest;
use App\Models\JobDocument;
use App\Models\JobLookup;
use App\Models\PropertyNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LookupController extends Controller
{
    private $types = [
        'contractor_job' => 'Contractor Job',
        'assessor_job' => 'Assessor Job'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {

            $lookups = JobLookup::select(['id', 'type', 'title']);

            return datatables()->of($lookups)
                ->addColumn('actions', function ($lookup) {
                    $actions = '<a href="/dashboard/lookup/job/' . Crypt::encrypt($lookup->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/lookup/job/delete/' . Crypt::encrypt($lookup->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->editColumn('type', function ($lookup) {
                    return ucfirst(str_replace('_', ' ', $lookup->type));
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.job-lookup.view-job-lookup');
    }

    public function createJob()
    {
        $types = $this->types;
        return view('dashboard.job-lookup.create-job-lookup', compact('types'));
    }

    public function storeJob(StoreJobLookupRequest $request)
    {
        $job = JobLookup::create([
            'type' => $request['type'],
            'title' => $request['title']
        ]);

        if ($job->wasRecentlyCreated === true) {
            $details = [
                "body" => " Job (Measure) " ."($job->title)". " has been added",
                "section" => "Job (Measure)",
                "route" => "lookup.job"
            ];
            newNotification($details);
        }

        return redirect()->action([LookupController::class, 'index']);
    }

    public function editJob($id)
    {
        $lookup = JobLookup::where('id', Crypt::decrypt($id))->first();
        $types = $this->types;
        return view('dashboard.job-lookup.create-job-lookup', compact('types', 'lookup'));
    }

    public function updateJob(StoreJobLookupRequest $request, $id)
    {
        $job = JobLookup::where('id', $id)->update([
            'type' => $request['type'],
            'title' => $request['title']
        ]);
        if ($job > 0) {
            $title = $request['title'];
            $details = [
                "body" => "Job (Measure) " ."($title)". " has been updated",
                "section" => "Job (Measure)",
                "route" => "lookup.job"
            ];
            newNotification($details);
        }
        return redirect()->action([LookupController::class, 'index']);
    }

    public function deleteJob($id)
    {
        JobLookup::where('id', Crypt::decrypt($id))->delete();
        return redirect()->back();
    }

    public function storeJobDocument(StoreJobDocumentLookupRequest $request, $job_id)
    {

        $data_to_save = array_map(function ($document) use ($job_id) {
            return [
                'title' => $document,
                'job_look_id' => $job_id
            ];
        }, $request['documents']);

        $jobdoc = JobDocument::insert($data_to_save);
        $job = JobLookup::where('id', $job_id)->first();
        if ($jobdoc) {
            $doc = $request['documents'];
            foreach ($doc as $d){
                $details = [
                    "body" => "Verification Documents " ."($d)". " have been added to a Job (Measure): ".$job->title,
                    "section" => "Job (Measure)",
                    "route" => "lookup.job"
                ];
                newNotification($details);
            }
        }
        return redirect()->back();
    }

    function getJobDocuments(Request $request, $job_id)
    {
        if (request()->ajax()) {

            $documents = JobDocument::where('job_look_id', $job_id)->select(['id', 'title']);

            return datatables()->of($documents)
                ->addColumn('actions', function ($document) {
                    $actions = '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/lookup/job/document/delete-document/' . Crypt::encrypt($document->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return '';
    }

    public function deleteJobDocument($id)
    {
        JobDocument::where('id', Crypt::decrypt($id))->delete();
        return redirect()->back();
    }
}
