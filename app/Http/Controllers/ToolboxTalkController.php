<?php

namespace App\Http\Controllers;
use App\Models\ToolboxTalk;
use App\Models\ToolboxTalkItem;
use App\Models\PhotoFolderName;
use App\Http\Requests\StoreToolboxTalkItemRequest;
use App\Http\Requests\StoreToolboxTalkRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class ToolboxTalkController extends Controller
{
    private $types = [
        'opened' => 'Opened',
        'closed' => 'Closed'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if (request()->ajax()) {

            $toolbaxtalks = ToolboxTalk::select(['id', 'talk_title', 'status']);

            return datatables()->of($toolbaxtalks)
                ->editColumn('is_archived', function ($talk) {
                    return $talk->is_archived ? 'Archived' : 'Active';
                })
                ->addColumn('actions', function ($talk) {
                    $actions = '<a href="/dashboard/toolbox-talk/' . Crypt::encrypt($talk->id) . '" class="btn-outline-sm _btn-primary px-2  action-icon rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/toolbox-talk/delete/'. Crypt::encrypt($talk->id) .'" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    // $actions .= '<a onClick="return confirm(`Are you sure you want to '.(
                    //     $talk->is_archived ? 'Active' : 'Archive'
                    //     ).' this?`)" href="/dashboard/toolbox-talk/archive/' . Crypt::encrypt($talk->id) . '/' . (
                    //     $talk->is_archived ? 'active ' : 'archive'
                    //     ) . '" class="btn-outline-sm btn-'.(
                    //         $talk->is_archived ? 'success' : 'danger'
                    //         ).'  px-2 action-icon rounded ml-1" title="'. (
                    //         $talk->is_archived ? 'Active' : 'Archive'
                    //         ) .'"> <i class="text-white mdi mdi-'.(
                    //             $talk->is_archived ? 'check-circle' : 'minus-circle'
                    //             ).'"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('dashboard.toolbox-talk.index');
    }

    public function create()
    {
        $types = $this->types;
        return view('dashboard.toolbox-talk.create', compact('types'));
    }

    public function store(StoreToolboxTalkRequest $request)
    {
        $toolbox = ToolboxTalk::create([
            'talk_title' => $request['talk_title'],
            'status' => $request['type'],
        ]);

        if ($toolbox->wasRecentlyCreated === true) {
            $details = [
                "body" => "Toolbox Talk " ."($toolbox->talk_title)". " has been added",
                "section" => "Toolbox Talk",
                "route" => "toolboxTalk"
            ];
            newNotification($details);
        }

        return redirect()->action([ToolboxTalkController::class, 'index']);
    }

    public function edit($id)
    {
        $types = $this->types;
        $toolbox_talk = ToolboxTalk::where('id', Crypt::decrypt($id))->first();
        return view('dashboard.toolbox-talk.create', compact('toolbox_talk','types'));
    }

    public function update(StoreToolboxTalkRequest $request, $id)
    {
        $toolbox = ToolboxTalk::where('id', $id)->update([
            'talk_title' => $request['talk_title'],
            'status' => $request['type'],
        ]);
        $toolboxDetails = ToolboxTalk::where('id', $id)->first();

        if ($toolbox > 0) {
            $details = [
                "body" => "Toolbox Talk " ."($toolboxDetails->talk_title)". " has been updated",
                "section" => "Toolbox Talk",
                "route" => "toolboxTalk"
            ];
            newNotification($details);

            if($toolboxDetails->status == 'closed') {
                $details = [
                    "body" => "Toolbox Talk " ."($toolboxDetails->talk_title)". " has been Closed",
                    "section" => "Toolbox Talk",
                    "route" => "toolboxTalk"
                ];
                newNotification($details);
            }
        }
        return redirect()->action([ToolboxTalkController::class, 'index']);
    }

    public function archiveToggle($id, $status)
    {
        ToolboxTalk::where('id', Crypt::decrypt($id))->update([
            'is_archived' => $status == 'archive' ? 1 : 0
        ]);
        return redirect()->back();
    }
    public function itemUpdate(Request $request)
    {
        $get = ToolboxTalkItem::where('id',$request->hidId)->first();
        if($get){
            $get->toolbox_item = $request->item_name;
            if($get->update()){
                return redirect()->back()->with('success','Edited successfully.');
            }else{
                return redirect()->back()->with('error','Editation failed.');
            }
        }else{
            return redirect()->back()->with('error','Item not found.');
        }
        // dd($request->all(),$get);
    }
    public function storeToolboxTalkItems(StoreToolboxTalkItemRequest $request, $id)
    {
        $data_to_save = array_map(function ($toolbox_item) use ($id) {
            return [
                'toolbox_item' => $toolbox_item,
                'fk_toolbox_talk_id' => $id
            ];
        }, $request['toolbox_talk_items']);

        ToolboxTalkItem::insert($data_to_save);

        return redirect()->back();
    }

    function getToolboxTalkItems(Request $request, $id)
    {
        if (request()->ajax()) {

            $items = ToolboxTalkItem::where('fk_toolbox_talk_id', $id)->select(['id', 'toolbox_item']);

            return datatables()->of($items)
                ->addColumn('actions', function ($item) {
                    $actions = '<a href="javascript:void(0)" data-id="'.$item->id.'"class="btn-outline-sm _btn-primary px-2  action-icon edit-items rounded" title="edit"> <i class="text-white mdi mdi-circle-edit-outline"></i></a>';
                    $actions .= '<a onClick="return confirm(`Are you sure you want to delete?`)" href="/dashboard/toolbox-talk/item/delete/' . Crypt::encrypt($item->id) . '" class="btn-outline-sm btn-danger  px-2 action-icon rounded ml-1" title="delete"> <i class="text-white mdi mdi-delete"></i></a>';
                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return '';
    }

    public function delete(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $toolDetails = ToolboxTalk::where('id',$id)->first();
        $save = ToolboxTalk::where('id',$id)->delete();
        if($save) {
            $details = [
                "body" => "Toolbox Talk " ."($toolDetails->talk_title)". " has been deleted",
                "section" => "Toolbox Talk",
                "route" => "toolboxTalk"
            ];
            newNotification($details);
        }
        return redirect()->back()->with('success','Toolbox Talk deleted successfully!');
    }

    public function deleteToolboxTalkItem($id)
    {
        ToolboxTalkItem::where('id', Crypt::decrypt($id))->delete();
        return redirect()->back();
    }
}
