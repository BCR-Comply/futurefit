<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Log;
use App\Models\File;
use App\Models\JobLookup;
use App\Models\JobDocument;
use Illuminate\Http\Request;
use App\Models\DocumentLibrary;
use App\Models\ContractorProperty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class DocumentController extends Controller
{
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $documents = DocumentLibrary::with(['job_look','job_document_type']);

            return DataTables::eloquent($documents)
                ->addColumn('action', function ($document) {
                    $action = '';
                    $action.= '<a href="/files/' . $document->file . '" target="_blank" class="btn-outline-sm _btn-primary px-2 mr-1 action-icon rounded" title="Show"> <i class="text-white mdi mdi-eye"></i></a>';
                    $action.= '<a href="/dashboard/document/archive/' . Crypt::encrypt($document->id) . '" class="btn-outline-sm btn-danger px-2 mr-1 action-icon rounded" title="Archive"> <i class="text-white fa fa-archive"></i></a>';
                    return $action;
                })
                ->editColumn('status', function ($document) {
                    return ucfirst($document->status);
                })
                ->make(true);
        }

        return view('dashboard.document.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lookups = JobLookup::where('type', 'contractor_job')->get();
        $job_documents = JobDocument::all();
        return view('dashboard.document.create',get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            if ($request->hasFile('document')) {
                $uploadedFile = $request->file('document');
                if (in_array($uploadedFile->getClientOriginalExtension(), $this->allowed_files_extensions)) {
                    $filename = explode('.',$uploadedFile->getClientOriginalName())[0] . '-' . time() . '.' . $uploadedFile->getClientOriginalExtension();
                    $uploadedFile->move(public_path('files'), $filename);
                    $doc = DocumentLibrary::create([
                        'job_lookup' => $request->job_lookup,
                        'job_document' => $request->job_document,
                        'document' =>  explode('.',$uploadedFile->getClientOriginalName())[0],
                        'file' => $filename
                    ]);
                }
                if ($doc->wasRecentlyCreated === true) {
                    $details = [
                        "body" => "Document has been added to a Document Library: ".$doc->job_look->title,
                        "section" => "Document",
                        "route" => "document.index"
                    ];
                    newNotification($details);
                }
                return redirect()->route('document.index');
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function archive($id)
    {
        try{
            $id = Crypt::decrypt($id);
            DocumentLibrary::where('id', $id)->update(['status' => 'archive']);
            return redirect()->route('document.index');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function upload_contract_document(Request $request){

        try{
            $auth_user = Auth::user();

            $first_name = $auth_user->firstname;
            $last_name = $auth_user->lastname;
            $role = $auth_user->role;
            $document = DocumentLibrary::find($request->document_lib);

            $new_file_name = time() .'-'.$document->file;

            $file = public_path('files').'/'.$document->file;
            $newfile = public_path('files'). '/' . time() .'-'.$document->file;

            copy($file, $newfile);

            File::create([
                'document' => $request->job_document,
                'file' => $new_file_name,
                'contract_id' => $request->id,
                'author' => trim($first_name . ' ' . $last_name). "($role)"
            ]);

            $contract = ContractorProperty::where('id', $request->id)->with('property')->with('contractor')->first();

            Log::create([
                'type' => $request['document'],
                'property_id' => $contract['property_id'],
                'author' => trim($first_name . ' ' . $last_name). "($role)",
                'address' => $contract['property']['address1'] . ', ' . $contract['property']['address2'] . ', ' . $contract['property']['address3'],
                'first_name' => $contract['property']['wh_fname'],
                'last_name' => $contract['property']['wh_lname']
            ]);

            return redirect()->back();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function filter_document(Request $request){
        $html = '';
        if(!empty($request->document) && isset($request->document)){
            $jobDocument = JobDocument::where('title',$request->document)->where('job_look_id', $request->job)->first();
            $documents = DocumentLibrary::where('job_document', $jobDocument->id)->where('status','active')->get();
            if(!empty($documents)){
                foreach($documents as $doc){
                    $html.="<option value='".$doc->id."'>".$doc->document."</option>";
                }
            }
        }

        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }
}
