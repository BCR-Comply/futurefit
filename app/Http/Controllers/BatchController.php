<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BatchController extends Controller
{
    protected $invoice_types = [
        'no' => 'No',
        'yes' => 'Yes',
        'sent' => 'Sent',
        'balance_paid' => 'Balance Paid',
    ];

    protected $quote_types = [
        'HO details sent to Surveyor',
        'Quote sent HO',
        'Proforma Invoice sent to HO',
        'N/A',
        'No'
    ];

    protected $status = [
        'completed' => 'Completed',
        'pending' => 'Pending'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {

            $batches = null;

            $client_id = $request->query('client_id');

            if ($client_id) {
                $batches = Batch::with(['properties', 'scheme'])->whereHas('properties', function ($q) use ($client_id) {
                    $q->where('properties.client_id', Crypt::decrypt($client_id));
                });
            } else {
                $batches = Batch::with('scheme');
            }

            return datatables()->of($batches)
                ->addColumn('action', function ($batch) {
                    $actions = '<a href="/dashboard/batch/' . Crypt::encrypt($batch->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/batch/delete/' . Crypt::encrypt($batch->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';

                    return $actions;
                })
                ->addColumn('properties', function ($batch) {
                    return '<a title="Properties" href="/dashboard/property/0?batch_id=' . Crypt::encrypt($batch->id) . '" class="ml-1">View</a>';
                })
                ->rawColumns(['action', 'properties'])
                ->addColumn('scheme', function ($batch) {
                    return isset($batch->scheme) ? $batch->scheme->scheme : '';
                })
                ->addColumn('invoice', function ($batch) {
                    return $this->invoice_types[$batch->invoice];
                })
                ->addColumn('status', function ($batch) {
                    return $this->status[$batch->status];
                })
                ->addColumn('start_date', function ($batch) {
                    return date('d/m/Y', strtotime($batch->start_date));
                })
                ->addColumn('end_date', function ($batch) {
                    return date('d/m/Y', strtotime($batch->end_date));
                })
                ->make(true);
        }
        return view('dashboard.batch.view-batch');
    }

    public function createBatch()
    {
        $invoice_types = $this->invoice_types;
        $quote_types = $this->quote_types;
        $schemes = Scheme::where('is_active', 1)->get();
        $leadBatchExists = Batch::leftjoin('schemes','schemes.id','batches.scheme_id')->where('schemes.scheme','leads')->exists();

        return view(
            'dashboard.batch.create-batch',
            compact(
                'invoice_types',
                'quote_types',
                'schemes',
                'leadBatchExists'
            )
        );
    }

    public function storeBatch(Request $request)
    {
        $request->validate([
            'our_ref' => ['nullable', 'string', 'max:50'],
            'quote' => ['required', 'string', 'max:50'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'invoice' => ['required', 'string', 'max:12'],
            'scheme_id' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:completed,pending']
        ]);

        $batch = Batch::create([
            'our_ref' => $request->our_ref,
            'quote' => $request->quote,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'invoice' => $request->invoice,
            'scheme_id' => $request->scheme_id,
            'notes' => $request->notes,
            'status' => $request->status,
        ]);

        if ($batch->wasRecentlyCreated === true) {
            $details = [
                "body" => "New Batch " ."($batch->our_ref)". " has been created",
                "section" => "Batch",
                "route" => "batch"
            ];
            newNotification($details);
        }

        return redirect()->route('batch');
    }

    public function editBatch($id)
    {
        $id = Crypt::decrypt($id);
        $batch = Batch::find($id);

        $invoice_types = $this->invoice_types;
        $quote_types = $this->quote_types;

        $schemes = Scheme::where('is_active', 1)->get();
        $leadBatchExists = Batch::leftjoin('schemes','schemes.id','batches.scheme_id')->where('schemes.scheme','leads')->exists();
        return view(
            'dashboard.batch.create-batch',
            compact(
                'batch',
                'invoice_types',
                'quote_types',
                'schemes',
                'leadBatchExists'
            )
        );
    }

    public function deleteBatch($id)
    {
        $id = Crypt::decrypt($id);
        $batchDetails = Batch::where('id', $id)->first();
        $batch = Batch::where('id', $id)->delete();
        if($batch) {
            $details = [
                "body" => "Batch " ."($batchDetails->our_ref)". " has been deleted",
                "section" => "Batch",
                "route" => "batch"
            ];
            newNotification($details);
        }
        return redirect()->route('batch');
    }

    public function updateBatch(Request $request)
    {
        $request->validate([
            'our_ref' => ['nullable', 'string', 'max:50'],
            'quote' => ['required', 'string', 'max:50'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'invoice' => ['required', 'string', 'max:12'],
            'scheme_id' => ['required', 'numeric'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:completed,pending'],
        ]);

        $batch = Batch::where('id', $request->id)->update(
            [
                'our_ref' => $request->our_ref,
                'quote' => $request->quote,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'invoice' => $request->invoice,
                'scheme_id' => $request->scheme_id,
                'notes' => $request->notes,
                'status' => $request->status,
            ]
        );

        $batchDetails = Batch::where('id', $request->id)->first();

        if ($batch > 0) {
            $details = [
                "body" => "Batch " ."($batchDetails->our_ref)". " has been updated",
                "section" => "Batch",
                "route" => "batch"
            ];
            newNotification($details);
        }

        return redirect()->route('batch');
    }

}
