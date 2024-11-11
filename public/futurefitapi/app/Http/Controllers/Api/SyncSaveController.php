<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AsAccessProject;
use App\Models\AsComment;
use App\Models\AsMaterialNeed;
use App\Models\AsWorkTool;
use App\Models\BasfEnveronCondition;
use App\Models\BasfEquipment;
use App\Models\BasfGeneralInfo;
use App\Models\BasfMaterialInfo;
use App\Models\BasfProjectInfo;
use App\Models\BasfTestResult;
use App\Models\BasfWallCondition;
use App\Models\BrePhotoInspectionItem;
use App\Models\ContractForm;
use App\Models\CqaPhotoInspectionItem;
use App\Models\File;
use App\Models\FuelAdditional;
use App\Models\FuelSave;
use App\Models\FuelTemplate;
use App\Models\HbAdditional;
use App\Models\HbBuilDetail;
use App\Models\HbHollowBlock;
use App\Models\HousingAdditional;
use App\Models\HousingSave;
use App\Models\HousingTemplate;
use App\Models\Inspections;
use App\Models\MsBonded;
use App\Models\MsEathwool;
use App\Models\MsSprayFoam;
use App\Models\MsTapes;
use App\Models\NotifiationMobile;
use App\Models\OssAdditional;
use App\Models\OssSave;
use App\Models\OssTemplate;
use App\Models\PhotoInspectionItem;
use App\Models\PhotoUploads;
use App\Models\PiAdditionalNote;
use App\Models\PiAdditionalproperty;
use App\Models\PiAtticInsulation;
use App\Models\PiBuildingDetail;
use App\Models\PiDrawAndPhoto;
use App\Models\PiExternalOne;
use App\Models\PiExternalTwo;
use App\Models\PiGrantCredit;
use App\Models\PiGrantTotal;
use App\Models\PiHeatingUpgrade;
use App\Models\PIIternalInsulation;
use App\Models\PiWallInsulation;
use App\Models\PremRiskSafetyForm;
use App\Models\ProgressForm;
use App\Models\PropertySurveyor;
use App\Models\RAMSCoresVentilation;
use App\Models\RiskSafetyForm;
use App\Models\RsAdditionalProperty;
use App\Models\RsBuildingDetail;
use App\Models\RsCommentPhoto;
use App\Models\RsRoofCondition;
use App\Models\RsRoofService;
use App\Models\RsRoofType;
use App\Models\RsRoofVentilation;
use App\Models\RsSpreyPlan;
use App\Models\SirBasecoat;
use App\Models\SirBoarding;
use App\Models\SirDrawingPhoto;
use App\Models\SirFinishcoat;
use App\Models\SirJob;
use App\Models\SirPreparation;
use App\Models\SnagRecord;
use App\Models\SnagRecordComment;
use App\Models\SnagRecordReplyComment;
use App\Models\TerrecoForm;
use App\Models\ThirdPartyForm;
use App\Models\ToolBoxTalkPerson;
use App\Models\ToolBoxTalkSave;
use App\Models\TsAdditional;
use App\Models\TsBuilDetail;
use App\Models\TsWallSurvey;
use App\Models\WsAdditionalProperty;
use App\Models\WsBuildCavity;
use App\Models\WsBuildingDetail;
use App\Models\WsBuildingType;
use App\Models\WsInnerLeafCondition;
use App\Models\WsOuterLeafCondition;
use App\Models\WsPresentCavity;
use App\Models\WsServiceCavity;
use App\Models\WsVentilationCavity;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SyncSaveController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
    }
    public function toolBoxTalkSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            // dd();
            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));
            $array = json_decode($request->form_array);
            $array2 = json_decode($request->person_array);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            foreach ($array as $arr) {
                $toolboxSave = new ToolBoxTalkSave();
                $toolboxSave->fk_inspection_id = $inspectionId;
                $toolboxSave->fk_user_id = $user->user_id;
                $toolboxSave->fk_property_id = $property_id;
                $toolboxSave->fk_property_surveyors_id = $property_surveyors_id;
                $toolboxSave->fk_toolbox_id = $arr->fk_toolbox_id;
                $toolboxSave->fk_toolbox_item_id = $arr->fk_toolbox_item_id;
                $toolboxSave->option_value = $arr->option_value;
                $toolboxSave->comments = $arr->comments;
                for ($i = 1; $i <= 10; $i++) {
                    $photos_key = 'image' . $i;
                    $photos_key1 = 'toolbox_' . $arr->fk_toolbox_id . '_question_' . $arr->fk_toolbox_item_id . '_' . $i;
                    // dd($photos_key1,$request->all());
                    if ($request->hasFile($photos_key1)) {
                        $imageName = $this->imgFunctionGlobal($request->file($photos_key1));
                        $toolboxSave->$photos_key = $imageName;
                    } else {
                        $toolboxSave->$photos_key = "";
                    }
                }
                $toolboxSave->save();
            }
            $m = 0;
            foreach ($array2 as $arr2) {
                $m++;
                $toolboxPSave = new ToolBoxTalkPerson();
                $toolboxPSave->fk_inspection_id = $inspectionId;
                $toolboxPSave->person_name = $arr2->person_name;
                // $photosS_key = 'sign' . $m;
                if ($arr2->sign != "null" && sizeOf(json_decode($arr2->sign))) {
                    $imageName1 = $this->imageWork($arr2->sign);
                    $toolboxPSave->signature = $imageName1;
                } else {
                    $toolboxPSave->signature = "";
                }
                $toolboxPSave->save();
            }

            // if ($toolboxSave) {
            $updateInsp = Inspections::find($inspectionId);
            if ($request->file('signature')) {
                $year = date('Y');
                $month = date('m');
                if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                    mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                    if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    }
                }
                $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                $photo = $request->file('signature');
                $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                $photo->move(public_path($image_path), $imageName);
                $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
            }
            $updateInsp->update();
            // }

            if ($toolboxSave) {
                // $save = PropertySurveyor::find($property_surveyors_id);
                // $save->today_date_status = 1;
                // $save->update();

                $response = test_method($inspectionId);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function getFolderList()
    {
        $user = auth()->user();
        if ($user) {
            $folderList = [];
            $folderList = DB::table('photo_folder_names')->select('*')->orderBy('id', 'asc')->get();
            if (count($folderList) > 0) {
                return response()->json(['success' => "1", 'data' => $folderList, 'message' => 'Folders List Fetched Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'data' => [], 'message' => 'Folders Not found.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }

    public function deleteFileFolder(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            if ($request->type == 'file') {
                $delete = PhotoUploads::find($request->id);
                $imagePath = public_path('/assets/uploads/photo_uploads' . $delete->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    $delete->delete();
                    return response()->json(['success' => "1", 'message' => 'Image and Record Deleted Successfully.', 'code' => 200]);
                } else {
                    $delete->delete();
                    return response()->json(['success' => "1", 'message' => 'Image Record Deleted Successfully.', 'code' => 200]);
                }

            }
            if ($request->type == 'folder') {
                $deleteAll = PhotoUploads::where('fk_property_id', $request->fk_property_id)->where('fk_section_id', $request->fk_section_id)->get();
                foreach ($deleteAll as $delete) {
                    $imagePath = public_path('/assets/uploads/photo_uploads' . $delete->image_path);
                    if (file_exists($imagePath)) {
                        if (unlink($imagePath)) {
                            $delete->delete();
                        } else {
                            return response()->json(['success' => "0", 'message' => 'Failed to delete image file.', 'code' => 500]);
                        }
                    } else {
                        $delete->delete();
                    }
                }
                return response()->json(['success' => "1", 'message' => 'Image and Record Deleted Successfully.', 'code' => 200]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function getUploadsPhoto(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $getData = PhotoUploads::select('photo_uploads.fk_section_id', 'photo_folder_names.name as fk_section_name')
                ->join('photo_folder_names', 'photo_folder_names.id', 'photo_uploads.fk_section_id')
            // ->where('photo_uploads.fk_surveyor_id', $request->fk_surveyor_id)
                ->where('photo_uploads.fk_property_id', $request->fk_perperty_id)
                ->groupBy('fk_section_id')
                ->get();
            if (count($getData) > 0) {
                return response()->json(['success' => "1", 'data' => $getData, 'message' => 'Images Fetched Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'data' => [], 'message' => 'Images not found.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function getUploadsPhotoBySection(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $baseURL = 'https://futurefit.bcrcomply.com/futurefitapi/public/assets/uploads/photo_uploads';
            // $baseURL = 'https://24d4-2405-201-2001-683b-dca0-461c-e14f-da71.ngrok-free.app/futurefitapi/public/assets/uploads/photo_uploads';
            $getData = PhotoUploads::select(
                'photo_uploads.*',
                'photo_folder_names.name as fk_section_name',
                DB::raw("IF(image_path != '', CONCAT('" . $baseURL . "', REPLACE(image_path, ' ', '%20')), null) AS image_path"),
                DB::raw("IF(tbl_user.full_name IS NULL, 'Admin', tbl_user.full_name) AS full_name")
            )
                ->join('photo_folder_names', 'photo_folder_names.id', 'photo_uploads.fk_section_id')
                ->leftjoin('property_surveyors', 'property_surveyors.id', 'photo_uploads.fk_surveyor_id')
                ->leftjoin('tbl_user', 'tbl_user.user_id', 'property_surveyors.surveyor_id')
                ->where('photo_uploads.fk_property_id', $request->fk_perperty_id)
                ->where('photo_uploads.fk_section_id', $request->fk_section_id)
                ->get()
                ->map(function ($item) {
                    // If date_created is null, set it to date_added
                    if ($item->date_created === null) {
                        $item->date_created = $item->date_added;
                    }
                    return $item;
                });
            if (count($getData) > 0) {
                return response()->json(['success' => "1", 'data' => $getData, 'message' => 'Images Fetched Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'data' => [], 'message' => 'Images not found.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function photoUploads(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $imgCount = sizeOf($request->images);
            $comment = isset($request->comment) && $request->comment != "" ? $request->comment : "";
            $getSection = DB::table("photo_folder_names")->where('id', $request->fk_section_id)->first();
            $section = $getSection->name;

            $imagePath = "";
            $m = 0;
            // Cache::put('upload_progress', ['uploaded' => 0, 'total' => $imgCount], 3600);
            for ($i = 0; $i < $imgCount; $i++) {
                if ($request->{'date_created_' . $i} != null && $request->{'date_created_' . $i} != "null" && $request->{'date_created_' . $i} != "" && $request->{'date_created_' . $i} != "|") {
                    $ccdate = $request->{'date_created_' . $i};
                } else {
                    $ccdate = $request->date_added;
                }
                $save = new PhotoUploads();
                $save->date_added = $request->date_added;
                $save->date_created = $ccdate;
                $save->fk_section_id = $request->fk_section_id;
                $save->fk_property_id = $request->fk_property_id;
                $save->fk_surveyor_id = $request->fk_surveyor_id;
                if ($request->images[$i]) {
                    $propertyId = $request->fk_property_id;
                    $image_path = "assets/uploads/photo_uploads/{$propertyId}/{$section}/";
                    if (!is_dir(public_path($image_path))) {
                        mkdir(public_path($image_path), 0777, true);
                    }
                    $photo = $request->file('images')[$i];
                    $imageName = str_replace(' ', '_', $section) . '-' . time() . '_' . mt_rand(11111, 99999) . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $imagePath = "/{$propertyId}/{$section}/{$imageName}";
                }
                $save->image_path = $imagePath;
                $save->comment = $comment;
                $save->save();
                if ($save) {
                    $m++;
                    // Cache::put('upload_progress', ['uploaded' => $m, 'total' => $imgCount], 3600);
                }
            }
            if ($m > 0) {
                if ($m > 1) {
                    $fileText = "Files";
                    $body = "Photo/Video Batch has been uploaded to Folder: " . $section;
                } else {
                    $fileText = "File";
                    $body = "Photo/Video (" . $imageName . ") has been uploaded to Folder: " . $section;
                }
                $AuthId = $user->user_id;
                $pptype = propertyType($request->fk_property_id);
                $nsec = $nroute = null;
                if($pptype == "Property"){
                    $nsec = "Property";
                    $nroute = "property.show";
                }
                if($pptype == "Lead"){
                    $nsec = "Leads";
                    $nroute = "lead.show";
                }
                $details = [
                    "body" => $body,
                    'authid' => $AuthId,
                    "section" => $nsec,
                    "sub_section" => "pho",
                    "property_id" => $request->fk_property_id,
                    "route" => $nroute
                ];
                newNotification($details);
                return response()->json(['success' => "1", 'message' => $m . ' ' . $fileText . ' Uploaded Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'File upload failes.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function editPhoto(Request $request)
    {
        // dd($request->all());
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $imagePath = "";
            $oldData = PhotoUploads::where('id', $request->id)->first();
            $update = PhotoUploads::where('id', $request->id)->first();
            if ($request->image) {
                $propertyId = $oldData->fk_property_id;
                $getSection = DB::table('photo_folder_names')->where('id', $oldData->fk_section_id)->first();
                $section = $getSection->name;
                $oldImagePath = public_path('assets/uploads/photo_uploads' . $oldData->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $image_path = "assets/uploads/photo_uploads/{$propertyId}/{$section}/";
                if (!is_dir(public_path($image_path))) {
                    mkdir(public_path($image_path), 0777, true);
                }
                $photo = $request->file('image');
                $imageName = str_replace(' ', '_', $section) . '-' . time() . '_' . mt_rand(11111, 99999) . '.' . $photo->getClientOriginalExtension();
                $photo->move(public_path($image_path), $imageName);
                $imagePath = "/{$propertyId}/{$section}/{$imageName}";
            }
            $update->image_path = $imagePath;
            $update->update();
            if ($update) {
                return response()->json(['success' => "1", 'message' => ' Images Uploaded Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'Images upload failes.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    // public function streamingData()
    // {
    //     header('Content-Type: text/event-stream');
    //     header('Cache-Control: no-cache');
    //     header('Connection: keep-alive');

    //     while (true) {
    //         // Get the upload progress from the cache
    //         $progress = Cache::get('upload_progress', ['uploaded' => 0, 'total' => 0]);

    //         // Send progress to the client
    //         echo "data: " . json_encode($progress) . "\n\n";
    //         ob_flush();
    //         flush();

    //         // Sleep for a while before sending the next update
    //         sleep(1);
    //     }
    // }
    public function ramsCoresVentSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $getProp = DB::table('properties')->select('properties.*', 'projects.our_ref')->leftjoin('projects', 'projects.id', 'properties.project_id')
                ->where('properties.id', $request->property_id)->first();

            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));
            $parray = json_decode($request->form_array);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = "";
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            foreach ($parray as $arr) {
                $comm_signoff = json_decode($arr->communi_signoff);
                foreach ($comm_signoff as &$comoff) {
                    // dd(sizeOf(json_decode($comoff->signature)));
                    if ($comoff->signature != "null" && sizeOf(json_decode($comoff->signature))) {
                        $imageName = $this->imageWork2($comoff->signature);
                        $comoff->signature = $imageName;
                    } else {
                        $comoff->signature = "null";
                    }
                    // dd($comoff);
                }
                $ramscvSave = new RAMSCoresVentilation();
                $ramscvSave->fk_inspection_id = $inspectionId;
                $ramscvSave->fk_user_id = $user->user_id;
                $ramscvSave->fk_property_id = $property_id;
                $ramscvSave->fk_property_surveyors_id = $property_surveyors_id;
                $ramscvSave->p_name = $arr->p_name;
                $ramscvSave->project_id = $arr->project_id;
                $ramscvSave->desc_activity = $arr->desc_activity;
                $ramscvSave->site_location = $arr->site_location;
                $ramscvSave->work_duration = $arr->work_duration;
                $ramscvSave->proj_manager = $arr->proj_manager;
                $ramscvSave->proj_contact = $arr->proj_contact;
                $ramscvSave->site_supervisor = $arr->site_supervisor;
                $ramscvSave->site_contact = $arr->site_contact;
                $ramscvSave->rams_ref_no = $arr->rams_ref_no;
                $ramscvSave->person_involve = $arr->person_involve;
                $ramscvSave->subcontractor_data = $arr->subcontractor_data;
                $ramscvSave->training_require = $arr->training_require;
                $ramscvSave->other_spec_require = $arr->other_spec_require;
                $ramscvSave->key_plant = $arr->key_plant;
                $ramscvSave->key_material = $arr->key_material;
                $ramscvSave->pp_equipment = $arr->pp_equipment;
                $ramscvSave->other_pp_require = $arr->other_pp_require;
                $ramscvSave->emergency_procedure = $arr->emergency_procedure;
                $ramscvSave->assembly_location = $arr->assembly_location;
                $ramscvSave->first_aider = $arr->first_aider;
                $ramscvSave->first_aid_box = $arr->first_aid_box;
                $ramscvSave->hospital_location = $arr->hospital_location;
                $ramscvSave->fire_exsting_location = $arr->fire_exsting_location;
                $ramscvSave->emergency_contact = $arr->emergency_contact;
                $ramscvSave->hazard_substance = $arr->hazard_substance;
                $ramscvSave->sds_deail = $arr->sds_deail;
                $ramscvSave->chemical_storage = $arr->chemical_storage;
                $ramscvSave->site_access = $arr->site_access;
                $ramscvSave->welfare_arrange = $arr->welfare_arrange;
                $ramscvSave->parking_arrange = $arr->parking_arrange;
                $ramscvSave->storage_arrange = $arr->storage_arrange;
                $ramscvSave->site_times = $arr->site_times;
                $ramscvSave->waste_arrange = $arr->waste_arrange;
                $ramscvSave->appr_prep_by = $arr->appr_prep_by;
                $ramscvSave->appr_prep_position = $arr->appr_prep_position;
                $ramscvSave->appr_prep_date = $arr->appr_prep_date;
                $ramscvSave->appr_aprove_by = $arr->appr_aprove_by;
                $ramscvSave->appr_aprove_position = $arr->appr_aprove_position;
                $ramscvSave->appr_aprove_date = $arr->appr_aprove_date;
                $ramscvSave->communi_signoff = json_encode($comm_signoff);
                $ramscvSave->appn_sketch = $arr->appn_sketch;
                $ramscvSave->appn_plant_equip = $arr->appn_plant_equip;
                $ramscvSave->appn_prog_work = $arr->appn_prog_work;
                $ramscvSave->appn_training = $arr->appn_training;
                $ramscvSave->appn_permit = $arr->appn_permit;
                $ramscvSave->appn_sds = $arr->appn_sds;
                $ramscvSave->appn_specific_risk = $arr->appn_specific_risk;
                $ramscvSave->appn_other = $arr->appn_other;
                $ramscvSave->appn_other_text = $arr->appn_other_text;
                $ramscvSave->measure_hazard = $arr->measure_hazard;
                $ramscvSave->save();
            }

            if ($ramscvSave) {
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('signature');
                    $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
            }

            if ($ramscvSave) {
                $save = PropertySurveyor::find($property_surveyors_id);
                $save->today_date_status = 1;
                $save->update();

                $response = test_method($inspectionId);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function safetyHealthSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $array = json_decode($request->form_array);
            $getProp = DB::table('properties')->select('properties.*', 'projects.our_ref')->leftjoin('projects', 'projects.id', 'properties.project_id')
                ->where('properties.id', $request->property_id)->first();

            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));
            if (isset($getProp->our_ref) && $getProp->our_ref != '' && $getProp->our_ref != null) {
                $projectName = $getProp->our_ref;
            } else {
                $projectName = $getProp->wh_fname . ' ' . $getProp->wh_lname;
            }

            $addressParts = [$getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode];
            $filteredAddressParts = array_filter($addressParts, function ($part) {
                return $part !== null && $part !== '';
            });
            $finalAddress = implode(', ', $filteredAddressParts);
            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            foreach ($array as $arr) {
                $riskCont = json_encode($arr->risk_control, true);
                $saveRiskSafety = new RiskSafetyForm();
                $saveRiskSafety->fk_inspection_id = $inspectionId;
                $saveRiskSafety->fk_user_id = $user->user_id;
                $saveRiskSafety->fk_property_id = $property_id;
                $saveRiskSafety->fk_property_surveyors_id = $property_surveyors_id;
                $saveRiskSafety->p_date = $arr->p_date;
                $saveRiskSafety->p_name = $projectName;
                $saveRiskSafety->p_address = $finalAddress;
                $saveRiskSafety->desc_site = $arr->desc_site;
                $saveRiskSafety->desc_site_other = $arr->desc_site_other;
                $saveRiskSafety->work_desc = $arr->work_desc;
                $saveRiskSafety->prop_start = $arr->prop_start;
                $saveRiskSafety->prop_end = $arr->prop_end;
                $saveRiskSafety->measure_activity = $arr->measure_activity;
                $saveRiskSafety->contractors_avail = $arr->contractors_avail;
                $saveRiskSafety->rams = $arr->rams;
                $saveRiskSafety->dwell_occu = $arr->dwell_occu;
                $saveRiskSafety->further_activity = $arr->further_activity;
                $saveRiskSafety->list_activity = $arr->list_activity;
                $saveRiskSafety->having_taken = $arr->having_taken;
                $saveRiskSafety->prog_time = $arr->prog_time;
                $saveRiskSafety->after_inquiry = $arr->after_inquiry;
                $saveRiskSafety->princy_prevent = $arr->princy_prevent;
                $saveRiskSafety->emmer_name = $arr->emmer_name;
                $saveRiskSafety->emmer_contact = $arr->emmer_contact;
                $saveRiskSafety->risk_control = $riskCont;
                $saveRiskSafety->save();
            }

            if ($saveRiskSafety) {
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('signature');
                    $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
            }

            if ($saveRiskSafety) {
                $save = PropertySurveyor::find($property_surveyors_id);
                $save->today_date_status = 1;
                $save->update();

                $response = test_method($updateInsp->id);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function premSafetyHealthSave(Request $request)
    {
        // dd($request->all(),json_decode($request->form_array));
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $array = json_decode($request->form_array);
            $getProp = DB::table('properties')->select('properties.*', 'projects.our_ref')->leftjoin('projects', 'projects.id', 'properties.project_id')
                ->where('properties.id', $request->property_id)->first();

            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));
            if (isset($getProp->our_ref) && $getProp->our_ref != '' && $getProp->our_ref != null) {
                $projectName = $getProp->our_ref;
            } else {
                $projectName = $getProp->wh_fname . ' ' . $getProp->wh_lname;
            }
            $addressParts = [$getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode];
            $filteredAddressParts = array_filter($addressParts, function ($part) {
                return $part !== null && $part !== '';
            });
            $finalAddress = implode(', ', $filteredAddressParts);
            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            foreach ($array as $arr) {

                $savePreRiskSafety = new PremRiskSafetyForm();
                $savePreRiskSafety->fk_inspection_id = $inspectionId;
                $savePreRiskSafety->fk_user_id = $user->user_id;
                $savePreRiskSafety->fk_property_id = $property_id;
                $savePreRiskSafety->fk_property_surveyors_id = $property_surveyors_id;
                $savePreRiskSafety->p_name = isset($arr->p_name) && $arr->p_name != "" ? $arr->p_name : $projectName;
                $savePreRiskSafety->p_address = isset($arr->p_address) && $arr->p_address != "" ? $arr->p_address : $finalAddress;
                $savePreRiskSafety->pshp_ref = $arr->pshp_ref;
                $savePreRiskSafety->rev_no = $arr->rev_no;
                $savePreRiskSafety->pdsp = $arr->pdsp;
                $savePreRiskSafety->p_date = $arr->p_date;
                $savePreRiskSafety->desc_site = $arr->desc_site;
                $savePreRiskSafety->desc_site_other = $arr->desc_site_other;
                $savePreRiskSafety->gen_desc = $arr->gen_desc;
                $savePreRiskSafety->prop_start = $arr->prop_start;
                $savePreRiskSafety->prop_end = $arr->prop_end;
                $savePreRiskSafety->dwell_remain = $arr->dwell_remain;
                $savePreRiskSafety->work_on_hand = $arr->work_on_hand;
                $savePreRiskSafety->work_on_hand_other = $arr->work_on_hand_other;
                $savePreRiskSafety->work_prev_princy = $arr->work_prev_princy;
                $savePreRiskSafety->proj_prog = $arr->proj_prog;
                $savePreRiskSafety->after_inquiry = $arr->after_inquiry;
                $savePreRiskSafety->conc_prev_princy = $arr->conc_prev_princy;
                $savePreRiskSafety->elec_loc = $arr->elec_loc;
                $savePreRiskSafety->water_loc = $arr->water_loc;
                $savePreRiskSafety->sewage_loc = $arr->sewage_loc;
                $savePreRiskSafety->save();
            }

            if ($savePreRiskSafety) {
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('signature');
                    $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
            }

            if ($savePreRiskSafety) {
                $save = PropertySurveyor::find($property_surveyors_id);
                $save->today_date_status = 1;
                $save->update();

                $response = test_method($updateInsp->id);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function compSaveDoc(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $document = $request->document;
            $fk_contract_id = $request->fk_contract_id;
            $fk_assessor_contract_id = $request->fk_assessor_contract_id;
            $author = $user->first_name . ' (' . $user->user_type . ')';
            $attachment = null;
            if ($request->hasFile('file')) {

                $file_frontimage = $request->file('file');
                $actual_filename_frontimage = $file_frontimage->getClientOriginalName();
                $filename_frontimage = 'file_' . time() . '_' . $actual_filename_frontimage;
                $file_frontimage->storeAs('files', $filename_frontimage, 'parent_disk');
                $attachment = $filename_frontimage;
            }

            $save = new File();
            $save->document = $document;
            $save->file = $attachment;
            $save->contract_id = $fk_contract_id;
            $save->assessor_contract_id = $fk_assessor_contract_id;
            $save->author = $author;
            $save->save();

            return response()->json(['success' => "1", 'message' => 'Changed Successfully.', 'code' => 200]);

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function snageStatusChange(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $snag_id = $request->snag_id;
            $status = $request->status;
            $update = SnagRecord::where('id', $snag_id)->first();
            $update->status = $status;
            $update->update();
            return response()->json(['success' => "1", 'message' => 'Changed Successfully.', 'code' => 200]);

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function updateSnag(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {

            $snagArr = json_decode($request->snag_array);

            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $item_name = $request->item_name;
            $priority = $request->priority;
            $is_measure = $request->is_measure;
            $status = $request->status;
            $general_comment = $request->general_comment;
            $mainSnagId = $request->snag_id;
            $contractor_id = $request->contractor_id;
            $contractor_name = $request->contractor_name;
            if ($status == "Closed") {
                $getSnag = DB::table('snag_records')->where('id', $mainSnagId)->first();
                $itemGroupAll = DB::table('snag_records')->where('fk_type', $getSnag->fk_type)
                    ->where('fk_inspection_id', $getSnag->fk_inspection_id)->where('del_status', 0)->count();
                $itemGroupClosed = DB::table('snag_records')->where('fk_type', $getSnag->fk_type)
                    ->where('fk_inspection_id', $getSnag->fk_inspection_id)->where('status', 'Closed')->where('del_status', 0)->count();
                // dd($getSnag,$itemGroupAll,$itemGroupClosed);
                $itemGroupClosedPlus = $itemGroupClosed + 1;
                if ($itemGroupAll === $itemGroupClosedPlus) {
                    $getInsp = Inspections::where('id', $getSnag->fk_inspection_id)->first();
                    $clonedInsp = $getInsp->replicate();
                    $clonedInsp->created_date = date('Y-m-d H:i:s');
                    $clonedInsp->save();
                    $getPhInsp = BrePhotoInspectionItem::where('fk_inspection_id', $getSnag->fk_inspection_id)->get();

                    $clonedPhInspIds = [];
                    foreach ($getPhInsp as $kx => $phInsp) {
                        $clonedphInsp = $phInsp->replicate();
                        $clonedphInsp->fk_inspection_id = $clonedInsp->id;
                        $clonedphInsp->save();
                        $clonedPhInspIds[$phInsp->id] = $clonedphInsp->id;
                    }
                    $getsngPxx = SnagRecord::where('fk_inspection_id', $getSnag->fk_inspection_id)->get();
                    foreach ($getsngPxx as $getsngPsx) {
                        $mvc = SnagRecord::where('id', $getsngPsx->id)->first();
                        $mvc->del_status = 1;
                        $mvc->update();
                    }
                    $getsngP = SnagRecord::where('fk_inspection_id', $getSnag->fk_inspection_id)->get();
                    foreach ($getsngP as $getsngPs) {

                        if ($getsngPs->id == $mainSnagId) {
                            $clonedgetsngPs = $getsngPs->replicate();
                            $clonedgetsngPs->fk_property_id = $property_id;
                            $clonedgetsngPs->fk_surveyor_id = $property_surveyors_id;
                            $clonedgetsngPs->item_name = $item_name;
                            $clonedgetsngPs->priority = $priority;
                            $clonedgetsngPs->is_measure = $is_measure;
                            $clonedgetsngPs->status = $status;
                            $clonedgetsngPs->general_comment = $general_comment;
                            $clonedgetsngPs->contractor_id = $contractor_id;
                            $clonedgetsngPs->contractor_name = $contractor_name;
                            $clonedgetsngPs->fk_inspection_id = $clonedInsp->id;
                            $clonedgetsngPs->del_status = 0;
                            $clonedgetsngPs->is_letest = 1;
                            if (array_key_exists($getsngPs->fk_photo_inspection_id, $clonedPhInspIds)) {
                                $clonedgetsngPs->fk_photo_inspection_id = $clonedPhInspIds[$getsngPs->fk_photo_inspection_id];
                                DB::table('bre_photo_inspection_items')->where('id', $clonedPhInspIds[$getsngPs->fk_photo_inspection_id])->update(['option_value' => 'Yes']);
                            }
                            $clonedgetsngPs->save();
                            $snagId = $clonedgetsngPs->id;

                            $getSnagComment = SnagRecordComment::where('fk_snag_record_id', $getsngPs->id)->get();
                            foreach ($getSnagComment as $kbs => $gscv) {
                                $clonedgscv = $gscv->replicate();
                                $clonedgscv->fk_snag_record_id = $clonedgetsngPs->id;
                                foreach ($snagArr as $kbs => $arr) {
                                    for ($i = 1; $i <= 5; $i++) {
                                        $photos_keyD = 'snag_' . $kbs . '_' . $i;
                                        $photos_keyS = 'image' . $i;

                                        if ($request->hasFile($photos_keyD)) {
                                            $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                                            $clonedgscv->$photos_keyS = $imageName;
                                        } else {
                                            if ($arr->$photos_keyS == "unchange") {
                                            } else {
                                                $clonedgscv->$photos_keyS = "";
                                            }
                                        }
                                    }
                                }
                                $clonedgscv->save();

                                $snagreplyCmnts = SnagRecordReplyComment::where('fk_snag_comment_id', $gscv->id)->get();
                                foreach ($snagreplyCmnts as $snagreplyCmnt) {
                                    $clonedsnagreplyCmnt = $snagreplyCmnt->replicate();
                                    $clonedsnagreplyCmnt->fk_snag_comment_id = $clonedgscv->id;
                                    $clonedsnagreplyCmnt->save();
                                }

                            }
                            $getProp = DB::table('properties')->select('*')->where('id', $clonedInsp->fk_property_id)->first();
                            $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                            if ($clonedInsp->id != "" && $clonedInsp->id != null) {
                                $msgBodyText = $this->getSnagText($clonedInsp->fk_forms_id, $clonedInsp->id, $address,$item_name);
                            } else {
                                $txt = "Snag - ". $item_name ." Resolved in " . $address;
                                $txt1 = "Snag Resolved";
                                $msgBodyText = $txt . "@@@" . $txt1;
                            }
                            if ($msgBodyText != null) {
                                $explode = explode('@@@', $msgBodyText);
                                $getUser = DB::table('property_surveyors')->where('id', $property_surveyors_id)->first();
                                $getProp = DB::table('properties')->select('*')->where('id', $clonedInsp->fk_property_id)->first();
                                $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                                $meta = DB::table('tbl_user_meta')->where('fk_user_id', $getUser->surveyor_id)->orderBy('created_date', 'desc')->first();
                                $body = $explode[0];
                                $title = $explode[1];
                                if ($meta) {
                                    $session_other_status = 1;
                                    $token = $meta->device_token;
                                    $addnoti = new NotifiationMobile();
                                    $addnoti->fk_user_id = $getUser->surveyor_id;
                                    $addnoti->note = $body;
                                    $addnoti->sub_section = "snags";
                                    $addnoti->property_id = $property_id;
                                    $pptype = propertyType($property_id);
                                    if($pptype == "Property"){
                                        $addnoti->section = "Property";
                                        $addnoti->route = "property.show";
                                    }
                                    if($pptype == "Lead"){
                                        $addnoti->section = "Leads";
                                        $addnoti->route = "lead.show";
                                    }
                                    $addnoti->save();
                                    $this->send_notifications($token, $title, $body, $session_other_status);
                                }
                                if ($contractor_id) {
                                    $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id', 'tbl_user.appname')->where('contractor_id', $contractor_id)->first();
                                    if ($inspDatax) {
                                        $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $inspDatax->user_id)->first();
                                        if ($inspData) {
                                            $config = DB::table('config')->first();
                                            $details = [
                                                'name' => $inspData->full_name,
                                                'title' => 'Snag Resolved',
                                                'body' => $body,
                                                'email' => $inspData->email,
                                                'config' => $config,
                                                'template' => 'mail-sent',
                                            ];
                                            $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                                        }
                                    }
                                }
                                // $meta2 = DB::table('tbl_user_meta')->where('fk_user_id',$contractor_id)->orderBy('created_date','desc')->first();
                                //     if($meta2){
                                //         $session_other_status = 1;
                                //         $token = $meta2->device_token;
                                //         $body = "You have been allocated ".$explode[0];
                                //         $title = $explode[1];
                                //         $addnoti = new NotifiationMobile();
                                //         $addnoti->fk_user_id = $getUser->surveyor_id;
                                //         $addnoti->note = $body;
                                //         $addnoti->save();
                                //         $this->send_notifications($token, $title,$body,$session_other_status);
                                //     }
                            }
                        } else {
                            $clonedgetsngPs = $getsngPs->replicate();
                            $clonedgetsngPs->fk_inspection_id = $clonedInsp->id;
                            $clonedgetsngPs->del_status = 0;
                            $clonedgetsngPs->is_letest = 0;
                            if (array_key_exists($getsngPs->fk_photo_inspection_id, $clonedPhInspIds)) {
                                $clonedgetsngPs->fk_photo_inspection_id = $clonedPhInspIds[$getsngPs->fk_photo_inspection_id];
                                DB::table('bre_photo_inspection_items')->where('id', $clonedPhInspIds[$getsngPs->fk_photo_inspection_id])->update(['option_value' => 'Yes']);
                            }
                            $clonedgetsngPs->save();

                            $getSnagComment = SnagRecordComment::where('fk_snag_record_id', $getsngPs->id)->get();
                            foreach ($getSnagComment as $gscv) {
                                $clonedgscv = $gscv->replicate();
                                $clonedgscv->fk_snag_record_id = $clonedgetsngPs->id;
                                $clonedgscv->save();
                                $snagreplyCmnts = SnagRecordReplyComment::where('fk_snag_comment_id', $gscv->id)->get();
                                foreach ($snagreplyCmnts as $snagreplyCmnt) {
                                    $clonedsnagreplyCmnt = $snagreplyCmnt->replicate();
                                    $clonedsnagreplyCmnt->fk_snag_comment_id = $clonedgscv->id;
                                    $clonedsnagreplyCmnt->save();
                                }
                            }

                        }

                    }
                    $snagId = "yes";
                    test_method($clonedInsp->id);

                } else {
                    $saveSnag = SnagRecord::where('id', $mainSnagId)->first();
                    $saveSnag->fk_property_id = $property_id;
                    $saveSnag->fk_surveyor_id = $property_surveyors_id;
                    $saveSnag->item_name = $item_name;
                    $saveSnag->priority = $priority;
                    $saveSnag->is_measure = $is_measure;
                    $saveSnag->status = $status;
                    $saveSnag->general_comment = $general_comment;
                    $saveSnag->contractor_id = $contractor_id;
                    $saveSnag->contractor_name = $contractor_name;
                    $saveSnag->update();

                    $snagId = $mainSnagId;

                    foreach ($snagArr as $key => $arr) {

                        if (isset($arr->sub_snag_id) && $arr->sub_snag_id != "null") {
                            $saveSnagComment = SnagRecordComment::where('id', $arr->sub_snag_id)->first();
                        } else {
                            $saveSnagComment = new SnagRecordComment();
                        }
                        $saveSnagComment->fk_snag_record_id = $snagId;
                        $saveSnagComment->comment = $arr->comment;

                        for ($i = 1; $i <= 5; $i++) {
                            $photos_keyD = 'snag_' . $key . '_' . $i;
                            $photos_keyS = 'image' . $i;
                            // if ($request->hasFile($photos_keyD)) {
                            //     $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                            //     $saveSnagComment->$photos_keyS = $imageName;
                            // } else {
                            //     $saveSnagComment->$photos_keyS = "";
                            // }
                            if ($request->hasFile($photos_keyD)) {
                                $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                                $saveSnagComment->$photos_keyS = $imageName;
                            } else {
                                if ($arr->$photos_keyS == "unchange") {
                                } else {
                                    $saveSnagComment->$photos_keyS = "";
                                }
                            }
                        }
                        if (isset($arr->sub_snag_id) && $arr->sub_snag_id != "null") {
                            $saveSnagComment->update();
                        } else {
                            $saveSnagComment->save();
                        }
                    }
                    $getProp = DB::table('properties')->select('*')->where('id', $property_id)->first();
                    $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);

                    if ($saveSnag->fk_inspection_id != "" && $saveSnag->fk_inspection_id != null) {
                        $msgBodyText = $this->getSnagText(25, $saveSnag->fk_inspection_id, $address,$item_name);
                    } else {
                        $txt = "Snag - ". $item_name ." Resolved in ". $address;
                        $txt1 = "Snag Resolved";
                        $msgBodyText = $txt . "@@@" . $txt1;
                    }
                    if ($msgBodyText != null) {
                        $explode = explode('@@@', $msgBodyText);
                        $getUser = DB::table('property_surveyors')->where('id', $property_surveyors_id)->first();
                        $getProp = DB::table('properties')->select('*')->where('id', $property_id)->first();
                        $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                        $meta = DB::table('tbl_user_meta')->where('fk_user_id', $getUser->surveyor_id)->orderBy('created_date', 'desc')->first();
                        $body = $explode[0];
                        $title = $explode[1];
                        if ($meta) {
                            $session_other_status = 1;
                            $token = $meta->device_token;
                            $addnoti = new NotifiationMobile();
                            $addnoti->fk_user_id = $getUser->surveyor_id;
                            $addnoti->note = $body;
                            $addnoti->sub_section = "snags";
                            $addnoti->property_id = $property_id;
                            $pptype = propertyType($property_id);
                            if($pptype == "Property"){
                                $addnoti->section = "Property";
                                $addnoti->route = "property.show";
                            }
                            if($pptype == "Lead"){
                                $addnoti->section = "Leads";
                                $addnoti->route = "lead.show";
                            }
                            $addnoti->save();
                            $this->send_notifications($token, $title, $body, $session_other_status);
                        }
                        if ($contractor_id) {
                            $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id', 'tbl_user.appname')->where('contractor_id', $contractor_id)->first();
                            if ($inspDatax && $inspDatax->appname == 'Lite') {
                                $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $inspDatax->user_id)->first();
                                if ($inspData) {
                                    $config = DB::table('config')->first();
                                    $details = [
                                        'name' => $inspData->full_name,
                                        'title' => 'Snag Resolved',
                                        'body' => $body,
                                        'email' => $inspData->email,
                                        'config' => $config,
                                        'template' => 'mail-sent',
                                    ];
                                    $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                                }
                            }
                        }
                        // $meta2 = DB::table('tbl_user_meta')->where('fk_user_id',$contractor_id)->orderBy('created_date','desc')->first();
                        // if($meta2){
                        //     $session_other_status = 1;
                        //     $token = $meta2->device_token;
                        //     $body = "You have been allocated ".$explode[0];
                        //     $title = $explode[1];
                        //     $addnoti = new NotifiationMobile();
                        //     $addnoti->fk_user_id = $getUser->surveyor_id;
                        //     $addnoti->note = $body;
                        //     $addnoti->save();
                        //     $this->send_notifications($token, $title,$body,$session_other_status);
                        // }
                    }
                }
            } else {
                $saveSnagold = SnagRecord::where('id', $mainSnagId)->first();
                $saveSnag = SnagRecord::where('id', $mainSnagId)->first();
                $saveSnag->fk_property_id = $property_id;
                $saveSnag->fk_surveyor_id = $property_surveyors_id;
                $saveSnag->item_name = $item_name;
                $saveSnag->priority = $priority;
                $saveSnag->is_measure = $is_measure;
                $saveSnag->status = $status;
                $saveSnag->general_comment = $general_comment;
                $saveSnag->contractor_id = $contractor_id;
                $saveSnag->contractor_name = $contractor_name;
                $saveSnag->update();
                // $isUpdate = $saveSnag->update();

                $snagId = $mainSnagId;

                foreach ($snagArr as $key => $arr) {

                    if (isset($arr->sub_snag_id) && $arr->sub_snag_id != "null") {
                        $saveSnagComment = SnagRecordComment::where('id', $arr->sub_snag_id)->first();
                    } else {
                        $saveSnagComment = new SnagRecordComment();
                    }
                    $saveSnagComment->fk_snag_record_id = $snagId;
                    $saveSnagComment->comment = $arr->comment;
                    for ($i = 1; $i <= 5; $i++) {
                        $photos_keyD = 'snag_' . $key . '_' . $i;
                        $photos_keyS = 'image' . $i;

                        if ($request->hasFile($photos_keyD)) {
                            $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                            $saveSnagComment->$photos_keyS = $imageName;
                        } else {
                            if ($arr->$photos_keyS == "unchange") {
                            } else {
                                $saveSnagComment->$photos_keyS = "";
                            }
                        }
                    }
                    if (isset($arr->sub_snag_id) && $arr->sub_snag_id != "null") {
                        $saveSnagComment->update();
                    } else {
                        $saveSnagComment->save();
                    }
                }
                $getProp = DB::table('properties')->select('*')->where('id', $property_id)->first();
                $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                $txt = "Snag - ". $item_name ." Edited in ". $address;
                $txt1 = "Snag Edited";
                $msgBodyText = $txt . "@@@" . $txt1;
                if ($msgBodyText != null) {
                    $explode = explode('@@@', $msgBodyText);
                    $getUser = DB::table('property_surveyors')->where('id', $property_surveyors_id)->first();
                    $meta = DB::table('tbl_user_meta')->where('fk_user_id', $getUser->surveyor_id)->orderBy('created_date', 'desc')->first();
                    if ($meta) {
                        $session_other_status = 1;
                        $token = $meta->device_token;
                        $body = $explode[0];
                        $title = $explode[1];
                        $addnoti = new NotifiationMobile();
                        $addnoti->fk_user_id = $getUser->surveyor_id;
                        $addnoti->note = $body;
                        $addnoti->sub_section = "snags";
                        $addnoti->property_id = $property_id;
                        $pptype = propertyType($property_id);
                        if($pptype == "Property"){
                            $addnoti->section = "Property";
                            $addnoti->route = "property.show";
                        }
                        if($pptype == "Lead"){
                            $addnoti->section = "Leads";
                            $addnoti->route = "lead.show";
                        }
                        $addnoti->save();
                        $this->send_notifications($token, $title, $body, $session_other_status);
                    }
                    // $meta2 = DB::table('tbl_user_meta')->where('fk_user_id', $contractor_id)->orderBy('created_date', 'desc')->first();
                    if ($contractor_id && $saveSnagold->contractor_id != $contractor_id) {
                        $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id', 'tbl_user.appname')->where('contractor_id', $contractor_id)->first();
                        if ($inspDatax && $inspDatax->appname) {
                            $meta2 = DB::table('tbl_user_meta')->where('fk_user_id', $inspDatax->user_id)->orderBy('created_date', 'desc')->first();
                            $body = "You have been allocated";
                            $title = $explode[1];
                            if ($meta2) {
                                $session_other_status = 1;
                                $token = $meta2->device_token;
                                $addnoti = new NotifiationMobile();
                                $addnoti->fk_user_id = $inspDatax->user_id;
                                $addnoti->note = $body;
                                $addnoti->sub_section = "snags";
                                $addnoti->property_id = $property_id;
                                $pptype = propertyType($property_id);
                                if($pptype == "Property"){
                                    $addnoti->section = "Property";
                                    $addnoti->route = "property.show";
                                }
                                if($pptype == "Lead"){
                                    $addnoti->section = "Leads";
                                    $addnoti->route = "lead.show";
                                }
                                $addnoti->save();
                                $this->send_notifications($token, $title, $body, $session_other_status);
                            }
                            $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $inspDatax->user_id)->first();
                            if ($inspData) {
                                $config = DB::table('config')->first();
                                $details = [
                                    'name' => $inspData->full_name,
                                    'title' => $title,
                                    'body' => $body,
                                    'email' => $inspData->email,
                                    'config' => $config,
                                    'template' => 'mail-sent',
                                ];
                                $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                            }
                        }
                    } else {
                        $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id', 'tbl_user.appname')->where('contractor_id', $contractor_id)->first();
                        if ($inspDatax && $inspDatax->appname) {
                            $meta2 = DB::table('tbl_user_meta')->where('fk_user_id', $inspDatax->user_id)->orderBy('created_date', 'desc')->first();
                            $body = $explode[0];
                            $title = $explode[1];
                            if ($meta2) {
                                $session_other_status = 1;
                                $token = $meta2->device_token;
                                $addnoti = new NotifiationMobile();
                                $addnoti->fk_user_id = $inspDatax->user_id;
                                $addnoti->note = $body;
                                $addnoti->sub_section = "snags";
                                $addnoti->property_id = $property_id;
                                $pptype = propertyType($property_id);
                                if($pptype == "Property"){
                                    $addnoti->section = "Property";
                                    $addnoti->route = "property.show";
                                }
                                if($pptype == "Lead"){
                                    $addnoti->section = "Leads";
                                    $addnoti->route = "lead.show";
                                }
                                $addnoti->save();
                                $this->send_notifications($token, $title, $body, $session_other_status);
                            }
                            $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $inspDatax->user_id)->first();
                            if ($inspData) {
                                $config = DB::table('config')->first();
                                $details = [
                                    'name' => $inspData->full_name,
                                    'title' => $title,
                                    'body' => $body,
                                    'email' => $inspData->email,
                                    'config' => $config,
                                    'template' => 'mail-sent',
                                ];
                                $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                            }
                        }
                    }

                }
            }
            if ($snagId) {

                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function replySnag(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $snagArr = json_decode($request->snag_array);

            foreach ($snagArr as $key => $arr) {
                if (isset($arr->sub_reply_id) && $arr->sub_reply_id != "null") {
                    $saveSnagComment = SnagRecordReplyComment::where('id', $arr->sub_reply_id)->first();
                } else {
                    $saveSnagComment = new SnagRecordReplyComment();
                }
                $saveSnagComment->fk_snag_comment_id = $arr->fk_snag_record_id;
                $saveSnagComment->comment = $arr->comment;

                // if ($arr->image1 != "unchange" && $arr->image1 != "null" && sizeOf(json_decode($arr->image1))) {
                //     $imageName1 = $this->imageWorkSnag($arr->image1);
                //     $saveSnagComment->image1 = $imageName1;
                // } else {
                //     if ($arr->image1 == "unchange") {
                //     } else {
                //         $saveSnagComment->image1 = "";
                //     }
                // }
                // if ($arr->image2 != "unchange" && $arr->image2 != "null" && sizeOf(json_decode($arr->image2))) {
                //     $imageName2 = $this->imageWorkSnag($arr->image2);
                //     $saveSnagComment->image2 = $imageName2;
                // } else {
                //     if ($arr->image2 == "unchange") {

                //     } else {
                //         $saveSnagComment->image2 = "";
                //     }

                // }
                // if ($arr->image3 != "unchange" && $arr->image3 != "null" && sizeOf(json_decode($arr->image3))) {
                //     $imageName3 = $this->imageWorkSnag($arr->image3);
                //     $saveSnagComment->image3 = $imageName3;
                // } else {
                //     if ($arr->image3 == "unchange") {

                //     } else {
                //         $saveSnagComment->image3 = "";
                //     }

                // }
                // if ($arr->image4 != "unchange" && $arr->image4 != "null" && sizeOf(json_decode($arr->image4))) {
                //     $imageName4 = $this->imageWorkSnag($arr->image4);
                //     $saveSnagComment->image4 = $imageName4;
                // } else {
                //     if ($arr->image4 == "unchange") {

                //     } else {
                //         $saveSnagComment->image4 = "";
                //     }

                // }
                // if ($arr->image5 != "unchange" && $arr->image5 != "null" && sizeOf(json_decode($arr->image5))) {
                //     $imageName5 = $this->imageWorkSnag($arr->image5);
                //     $saveSnagComment->image5 = $imageName5;
                // } else {
                //     if ($arr->image5 == "unchange") {

                //     } else {
                //         $saveSnagComment->image5 = "";
                //     }

                // }
                for ($i = 1; $i <= 5; $i++) {
                    $photos_keyD = 'snag_' . $key . '_' . $i;
                    $photos_keyS = 'image' . $i;
                    // if ($request->hasFile($photos_keyD)) {
                    //     $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                    //     $saveSnagComment->$photos_keyS = $imageName;
                    // } else {
                    //     $saveSnagComment->$photos_keyS = "";
                    // }
                    if ($request->hasFile($photos_keyD)) {
                        $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                        $saveSnagComment->$photos_keyS = $imageName;
                    } else {
                        if ($arr->$photos_keyS == "unchange") {
                        } else {
                            $saveSnagComment->$photos_keyS = "";
                        }
                    }
                }
                if (isset($arr->sub_snag_id) && $arr->sub_snag_id != "null") {
                    $saveSnagComment->update();
                } else {
                    $saveSnagComment->save();
                }
            }
            // $snagRecRepCom = SnagRecordReplyComment::where('id',$saveSnagComment->id)->first();
            if ($saveSnagComment && $saveSnagComment->fk_snag_comment_id) {
                $snagRecCom = SnagRecordComment::where('id', $saveSnagComment->fk_snag_comment_id)->first();
                if ($snagRecCom && $snagRecCom->fk_snag_record_id) {
                    $snagRec = SnagRecord::where('id', $snagRecCom->fk_snag_record_id)->first();
                    if ($snagRec && $snagRec->fk_surveyor_id && $snagRec->fk_property_id) {
                        $getProp = DB::table('properties')->select('*')->where('id', $snagRec->fk_property_id)->first();
                        $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                        $txt = "Snag - ". $snagRec->item_name ." Edited in ". $address;
                        $txt1 = "Snag Edited";
                        $msgBodyText = $txt . "@@@" . $txt1;
                        if ($msgBodyText != null) {
                            $explode = explode('@@@', $msgBodyText);
                            $getUser = DB::table('property_surveyors')->where('id', $snagRec->fk_surveyor_id)->first();
                            $meta = DB::table('tbl_user_meta')->where('fk_user_id', $getUser->surveyor_id)->orderBy('created_date', 'desc')->first();
                            if ($meta) {
                                $session_other_status = 1;
                                $token = $meta->device_token;
                                $body = $explode[0];
                                $title = $explode[1];
                                $addnoti = new NotifiationMobile();
                                $addnoti->fk_user_id = $getUser->surveyor_id;
                                $addnoti->note = $body;
                                $addnoti->sub_section = "snags";
                                $addnoti->property_id = $snagRec->fk_property_id;
                                $pptype = propertyType($snagRec->fk_property_id);
                                if($pptype == "Property"){
                                    $addnoti->section = "Property";
                                    $addnoti->route = "property.show";
                                }
                                if($pptype == "Lead"){
                                    $addnoti->section = "Leads";
                                    $addnoti->route = "lead.show";
                                }
                                $addnoti->save();
                                $this->send_notifications($token, $title, $body, $session_other_status);

                                $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $getUser->surveyor_id)->first();
                                if ($inspData) {
                                    $config = DB::table('config')->first();
                                    $details = [
                                        'name' => $inspData->full_name,
                                        'title' => $title,
                                        'body' => $body,
                                        'email' => $inspData->email,
                                        'config' => $config,
                                        'template' => 'mail-sent',
                                    ];
                                    $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                                }
                            }
                        }
                    }
                }
            }
            if ($saveSnagComment) {

                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function saveSnag(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $snagArr = json_decode($request->snag_array);

            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $item_name = $request->item_name;
            $priority = $request->priority;
            $is_measure = $request->is_measure;
            $status = $request->status;
            $general_comment = $request->general_comment;
            $contractor_id = $request->contractor_id;
            $contractor_name = $request->contractor_name;

            $saveSnag = new SnagRecord();
            $saveSnag->fk_property_id = $property_id;
            $saveSnag->fk_surveyor_id = $property_surveyors_id;
            $saveSnag->item_name = $item_name;
            $saveSnag->priority = $priority;
            $saveSnag->is_measure = $is_measure;
            $saveSnag->status = $status;
            $saveSnag->general_comment = $general_comment;
            $saveSnag->contractor_id = $contractor_id;
            $saveSnag->contractor_name = $contractor_name;
            $saveSnag->save();

            $snagId = $saveSnag->id;

            foreach ($snagArr as $key => $arr) {
                $saveSnagComment = new SnagRecordComment();
                $saveSnagComment->fk_snag_record_id = $snagId;
                $saveSnagComment->comment = $arr->comment;
                if ($arr->image1 != "null" && sizeOf(json_decode($arr->image1))) {
                    $imageName1 = $this->imageWorkSnag($arr->image1);
                    $saveSnagComment->image1 = $imageName1;
                } else {
                    $saveSnagComment->image1 = "";
                }
                if ($arr->image2 != "null" && sizeOf(json_decode($arr->image2))) {
                    $imageName2 = $this->imageWorkSnag($arr->image2);
                    $saveSnagComment->image2 = $imageName2;
                } else {
                    $saveSnagComment->image2 = "";
                }
                if ($arr->image3 != "null" && sizeOf(json_decode($arr->image3))) {
                    $imageName3 = $this->imageWorkSnag($arr->image3);
                    $saveSnagComment->image3 = $imageName3;
                } else {
                    $saveSnagComment->image3 = "";
                }
                if ($arr->image4 != "null" && sizeOf(json_decode($arr->image4))) {
                    $imageName4 = $this->imageWorkSnag($arr->image4);
                    $saveSnagComment->image4 = $imageName4;
                } else {
                    $saveSnagComment->image4 = "";
                }
                if ($arr->image5 != "null" && sizeOf(json_decode($arr->image5))) {
                    $imageName5 = $this->imageWorkSnag($arr->image5);
                    $saveSnagComment->image5 = $imageName5;
                } else {
                    $saveSnagComment->image5 = "";
                }
                for ($i = 1; $i <= 5; $i++) {
                    $photos_keyD = 'snag_' . $key . '_' . $i;
                    $photos_keyS = 'image' . $i;
                    if ($request->hasFile($photos_keyD)) {
                        $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                        $saveSnagComment->$photos_keyS = $imageName;
                    } else {
                        $saveSnagComment->$photos_keyS = "";
                    }
                }

                $saveSnagComment->save();
            }
            if ($snagId) {
                // $msgBodyText =  $this->getSnagText(25,$saveSnag->fk_inspection_id,$address);
                // if($msgBodyText != null){
                //     $explode = explode('@@@',$msgBodyText);
                $getUser = DB::table('property_surveyors')->where('id', $property_surveyors_id)->first();
                $getProp = DB::table('properties')->select('*')->where('id', $property_id)->first();
                $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                $meta = DB::table('tbl_user_meta')->where('fk_user_id', $getUser->surveyor_id)->orderBy('created_date', 'desc')->first();
    
                if ($meta) {
                    $session_other_status = 1;
                    $token = $meta->device_token;
                    $body = "Snag - ". $item_name ." Recoreded in ". $address;
                    $title = 'Snag Recoreded';
                    $addnoti = new NotifiationMobile();
                    $addnoti->fk_user_id = $getUser->surveyor_id;
                    $addnoti->note = $body;
                    $addnoti->sub_section = "snags";
                    $addnoti->property_id = $property_id;
                    $pptype = propertyType($property_id);
                    if($pptype == "Property"){
                        $addnoti->section = "Property";
                        $addnoti->route = "property.show";
                    }
                    if($pptype == "Lead"){
                        $addnoti->section = "Leads";
                        $addnoti->route = "lead.show";
                    }
                    $addnoti->save();
                    $this->send_notifications($token, $title, $body, $session_other_status);
                }
                if ($contractor_id) {
                    $body = "You have been allocated Snag - ".$item_name." in " . $address;
                    $title = "Snag Recoreded";
                    $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id', 'tbl_user.appname')->where('contractor_id', $contractor_id)->first();
                    if ($inspDatax) {
                        $meta2 = DB::table('tbl_user_meta')->where('fk_user_id', $inspDatax->user_id)->orderBy('created_date', 'desc')->first();
                        if ($meta2) {
                            $session_other_status = 1;
                            $token = $meta2->device_token;
                            $addnoti = new NotifiationMobile();
                            $addnoti->fk_user_id = $inspDatax->user_id;
                            $addnoti->note = $body;
                            $addnoti->sub_section = "snags";
                            $addnoti->property_id = $property_id;
                            $pptype = propertyType($property_id);
                            if($pptype == "Property"){
                                $addnoti->section = "Property";
                                $addnoti->route = "property.show";
                            }
                            if($pptype == "Lead"){
                                $addnoti->section = "Leads";
                                $addnoti->route = "lead.show";
                            }
                            $addnoti->save();
                            $this->send_notifications($token, $title, $body, $session_other_status);
                        }
                        $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $inspDatax->user_id)->first();
                        if ($inspData && $inspDatax->appname == 'Lite') {
                            $config = DB::table('config')->first();
                            $details = [
                                'name' => $inspData->full_name,
                                'title' => 'Snag Recoreded',
                                'body' => $body,
                                'email' => $inspData->email,
                                'config' => $config,
                                'template' => 'mail-sent',
                            ];
                            $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                        }
                    }
                }
                // }
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    // public function breSyncSave(Request $request)
    // {
    //     ini_set('max_execution_time', 0);
    //     ini_set('memory_limit', '-1');
    //     $user = auth()->user();
    //     if ($user) {
    //         $array = json_decode($request->bre_array);

    //         $property_id = $request->property_id;
    //         $property_surveyors_id = $request->property_surveyors_id;
    //         $form_id = $request->form_id;
    //         $name = $request->name;
    //         $date_inspected = date('Y-m-d', strtotime($request->date_inspected));

    //         $saveInsp = new Inspections();
    //         $saveInsp->fk_user_id = $user->user_id;
    //         $saveInsp->fk_forms_id = $form_id;
    //         $saveInsp->fk_property_id = $property_id;
    //         $saveInsp->property_surveyors_id = $property_surveyors_id;
    //         $saveInsp->name = $name;
    //         $saveInsp->contractor_name = "";
    //         $saveInsp->contractor_signature = "";
    //         $saveInsp->date_inspected = $date_inspected;
    //         $saveInsp->pdf_filename = 'n/a';
    //         $saveInsp->created_date = date('Y-m-d H:i:s');
    //         $saveInsp->save();

    //         $inspectionId = $saveInsp->id;
    //         $countSnags = array_filter($array, function($items){
    //             return $items->item_name != null && $items->item_name != "" && $items->item_name;
    //         });
    //         foreach ($array as $arr) {
    //             // dd($arr->snag_data->contractor_id);
    //             // dd($arr);
    //             $saveBreQue = new BrePhotoInspectionItem();
    //             $saveBreQue->fk_inspection_id = $inspectionId;
    //             $saveBreQue->fk_question_id = $arr->question_id;
    //             $saveBreQue->fk_item_id = $arr->fk_item_id;
    //             $saveBreQue->fk_user_id = $user->user_id;
    //             $saveBreQue->type = $arr->fk_area;
    //             $saveBreQue->fk_property_id = $arr->property_id;
    //             $saveBreQue->fk_property_surveyors_id = $arr->property_surveyors_id;
    //             $saveBreQue->comments = $arr->comment;
    //             $saveBreQue->option_value = $arr->options;
    //             $saveBreQue->status = 0;
    //             $saveBreQue->save_status = 1;

    //             for ($i = 1; $i <= 5; $i++) {
    //                 $photos_key = 'image_' . $arr->question_id . '_' . $i;
    //                 $photos_key2 = 'image' . $i;
    //                 if ($request->hasFile($photos_key)) {
    //                     $imageName = $this->imgFunctionGlobal2($request->file($photos_key));
    //                     $saveBreQue->$photos_key2 = $imageName;
    //                 } else {
    //                     $saveBreQue->$photos_key2 = "";
    //                 }
    //             }
    //             $saveBreQue->save();
    //             if ($arr->item_name != null && $arr->item_name != "" && $arr->item_name != "null") {
    //                 $saveSang = new SnagRecord();
    //                 $saveSang->fk_property_id = $arr->property_id;
    //                 $saveSang->fk_surveyor_id = $property_surveyors_id;
    //                 $saveSang->fk_main_inspection_id = $inspectionId;
    //                 $saveSang->fk_inspection_id = $inspectionId;
    //                 $saveSang->fk_question_id = $arr->question_id;
    //                 $saveSang->fk_photo_inspection_id = $saveBreQue->id;
    //                 $saveSang->fk_item_id = $arr->fk_item_id;
    //                 $saveSang->fk_type = $arr->fk_area;
    //                 $saveSang->contractor_id = $arr->contractor_id;
    //                 $saveSang->contractor_name = $arr->contractor_name;
    //                 $saveSang->item_name = $arr->item_name;
    //                 $saveSang->priority = $arr->priority;
    //                 $saveSang->is_measure = $arr->is_measure;
    //                 $saveSang->status = $arr->status;
    //                 $saveSang->general_comment = $arr->general_comment;
    //                 $saveSang->save();

    //                 $saveSnagComment = new SnagRecordComment();
    //                 $saveSnagComment->fk_snag_record_id = $saveSang->id;
    //                 $saveSnagComment->comment = $arr->general_comment;
    //                 for ($i = 1; $i <= 5; $i++) {
    //                     $photos_keyD = 'snag_' . $arr->question_id . '_' . $i;
    //                     $photos_keyS = 'image' . $i;
    //                     if ($request->hasFile($photos_keyD)) {
    //                         $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
    //                         $saveSnagComment->$photos_keyS = $imageName;
    //                     } else {
    //                         $saveSnagComment->$photos_keyS = "";
    //                     }
    //                 }
    //                 $saveSnagComment->save();
    //                 if($arr->contractor_id != null && $arr->contractor_id != '') {
    //                     $getUser = DB::table('property_surveyors')->where('id',$property_surveyors_id)->first();
    //                     $getProp = DB::table('properties')->select('*')->where('id',$arr->property_id)->first();
    //                     $address = format_address($getProp->house_num,$getProp->address1,$getProp->address2,$getProp->address3,$getProp->county,$getProp->eircode);
    //                     // $meta2 = DB::table('tbl_user_meta')->where('fk_user_id',$arr->contractor_id)->orderBy('created_date','desc')->first();
    //                     $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id')->where('contractor_id',$arr->contractor_id)->first();
    //                 $meta2 = DB::table('tbl_user_meta')->where('fk_user_id',$inspDatax->user_id)->orderBy('created_date','desc')->first();
    //                     if($meta2){
    //                         $session_other_status = 1;
    //                         $token = $meta2->device_token;
    //                         $body = "You have allocated ".$explode[0];
    //                         $title = $explode[1];
    //                         $addnoti = new NotifiationMobile();
    //                         $addnoti->fk_user_id = $getUser->surveyor_id;
    //                         $addnoti->note = $body;
    //                         $addnoti->save();
    //                         $this->send_notifications($token, $title,$body,$session_other_status);
    //                         $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id')->where('contractor_id',$arr->contractor_id)->first();
    //                         $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id',$inspDatax->user_id)->first();
    //                     if($inspData){
    //                         $config = DB::table('config')->first();
    //                         $details = [
    //                             'name' => $inspData->full_name,
    //                             'title' => $title,
    //                             'body' => $body,
    //                             'email' => $inspData->email,
    //                             'config' => $config,
    //                             'template' => 'mail-sent',
    //                         ];
    //                        $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
    //                     }
    //                     }
    //                 }
    //             }
    //         }
    //         if(sizeOf($countSnags)){
    //                 $getUser = DB::table('property_surveyors')->where('id',$property_surveyors_id)->first();
    //                 $getProp = DB::table('properties')->select('*')->where('id',$property_id)->first();
    //                 $address = format_address($getProp->house_num,$getProp->address1,$getProp->address2,$getProp->address3,$getProp->county,$getProp->eircode);
    //                 $meta = DB::table('tbl_user_meta')->where('fk_user_id',$getUser->surveyor_id)->orderBy('created_date','desc')->first();
    //                 if($meta){
    //                     $session_other_status = 1;
    //                     $token = $meta->device_token;
    //                     $body = "Snag recorded (".$inspectionId.") in ".$address;
    //                     $title = "Snag recorded";
    //                     $addnoti = new NotifiationMobile();
    //                     $addnoti->fk_user_id = $getUser->surveyor_id;
    //                     $addnoti->note = $body;
    //                     $addnoti->save();
    //                     $this->send_notifications($token, $title,$body,$session_other_status);
    //                 }
    //         }
    //         if ($saveBreQue) {
    //             $updateInsp = Inspections::find($inspectionId);
    //             if ($request->file('signature')) {
    //                 $year = date('Y');
    //                 $month = date('m');
    //                 if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
    //                     mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
    //                 } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
    //                     if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
    //                         mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
    //                     }
    //                 }
    //                 $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
    //                 $photo = $request->file('signature');
    //                 $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
    //                 $photo->move(public_path($image_path), $imageName);
    //                 $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
    //             }
    //             $updateInsp->update();
    //         }

    //         if ($updateInsp) {
    //             $save = PropertySurveyor::find($property_surveyors_id);
    //             $save->today_date_status = 1;
    //             $save->update();

    //             $response = test_method($updateInsp->id);
    //             return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
    //         } else {
    //             return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
    //         }
    //     } else {
    //         return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
    //     }
    // }

    public function breSyncSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $array = json_decode($request->bre_array);

            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            $countSnags = array_filter($array, function ($items) {
                return $items->item_name != null && $items->item_name != "" && $items->item_name;
            });
            foreach ($array as $arr) {
                // dd($arr->snag_data->contractor_id);
                // dd($arr);
                $saveBreQue = new BrePhotoInspectionItem();
                $saveBreQue->fk_inspection_id = $inspectionId;
                $saveBreQue->fk_question_id = $arr->question_id;
                $saveBreQue->fk_item_id = $arr->fk_item_id;
                $saveBreQue->fk_user_id = $user->user_id;
                $saveBreQue->type = $arr->fk_area;
                $saveBreQue->fk_property_id = $arr->property_id;
                $saveBreQue->fk_property_surveyors_id = $arr->property_surveyors_id;
                $saveBreQue->comments = $arr->comment;
                $saveBreQue->option_value = $arr->options;
                $saveBreQue->status = 0;
                $saveBreQue->save_status = 1;

                for ($i = 1; $i <= 5; $i++) {
                    $photos_key = 'image_' . $arr->question_id . '_' . $i;
                    $photos_key2 = 'image' . $i;
                    if ($request->hasFile($photos_key)) {
                        $imageName = $this->imgFunctionGlobal2($request->file($photos_key));
                        $saveBreQue->$photos_key2 = $imageName;
                    } else {
                        $saveBreQue->$photos_key2 = "";
                    }
                }
                $saveBreQue->save();
                if ($arr->item_name != null && $arr->item_name != "" && $arr->item_name != "null") {
                    $saveSang = new SnagRecord();
                    $saveSang->fk_property_id = $arr->property_id;
                    $saveSang->fk_surveyor_id = $property_surveyors_id;
                    $saveSang->fk_main_inspection_id = $inspectionId;
                    $saveSang->fk_inspection_id = $inspectionId;
                    $saveSang->fk_question_id = $arr->question_id;
                    $saveSang->fk_photo_inspection_id = $saveBreQue->id;
                    $saveSang->fk_item_id = $arr->fk_item_id;
                    $saveSang->fk_type = $arr->fk_area;
                    $saveSang->contractor_id = $arr->contractor_id;
                    $saveSang->contractor_name = $arr->contractor_name;
                    $saveSang->item_name = $arr->item_name;
                    $saveSang->priority = $arr->priority;
                    $saveSang->is_measure = $arr->is_measure;
                    $saveSang->status = $arr->status;
                    $saveSang->general_comment = $arr->general_comment;
                    $saveSang->save();

                    $saveSnagComment = new SnagRecordComment();
                    $saveSnagComment->fk_snag_record_id = $saveSang->id;
                    $saveSnagComment->comment = $arr->general_comment;
                    for ($i = 1; $i <= 5; $i++) {
                        $photos_keyD = 'snag_' . $arr->question_id . '_' . $i;
                        $photos_keyS = 'image' . $i;
                        if ($request->hasFile($photos_keyD)) {
                            $imageName = $this->imgFunctionGlobalSnag($request->file($photos_keyD));
                            $saveSnagComment->$photos_keyS = $imageName;
                        } else {
                            $saveSnagComment->$photos_keyS = "";
                        }
                    }
                    $saveSnagComment->save();
                    if ($arr->contractor_id != null && $arr->contractor_id != '' && $arr->contractor_id != 'None') {
                        $getUser = DB::table('property_surveyors')->where('id', $property_surveyors_id)->first();
                        $getProp = DB::table('properties')->select('*')->where('id', $arr->property_id)->first();
                        $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                        $txt = "Snag - ". $arr->item_name ." Recorded in ". $address;
                        $txt1 = "Snag Recorded";
                        $msgBodyText = $txt . "@@@" . $txt1;
                        $body = "You have been allocated " . $txt;
                        $title = $txt1;
                        if ($msgBodyText != null) {
                            $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id')->where('contractor_id', $arr->contractor_id)->first();
                            $meta2 = DB::table('tbl_user_meta')->where('fk_user_id', $inspDatax->user_id)->orderBy('created_date', 'desc')->first();
                            if ($meta2) {
                                $session_other_status = 1;
                                $token = $meta2->device_token;
                                $addnoti = new NotifiationMobile();
                                $addnoti->fk_user_id = $inspDatax->user_id;
                                $addnoti->note = $body;
                                $addnoti->sub_section = "snags";
                                $addnoti->property_id = $property_id;
                                $pptype = propertyType($property_id);
                                if($pptype == "Property"){
                                    $addnoti->section = "Property";
                                    $addnoti->route = "property.show";
                                }
                                if($pptype == "Lead"){
                                    $addnoti->section = "Leads";
                                    $addnoti->route = "lead.show";
                                }
                                $addnoti->save();
                                $this->send_notifications($token, $title, $body, $session_other_status);
                            }
                            // $inspDatax = DB::table('tbl_user')->select('tbl_user.user_id')->where('contractor_id', $arr->contractor_id)->first();
                            $inspData = DB::table('tbl_user')->select('tbl_user.*')->where('user_id', $inspDatax->user_id)->first();
                            if ($inspData) {
                                $config = DB::table('config')->first();
                                $details = [
                                    'name' => $inspData->full_name,
                                    'title' => $title,
                                    'body' => $body,
                                    'email' => $inspData->email,
                                    'config' => $config,
                                    'template' => 'mail-sent',
                                ];
                                $svg = Mail::to($details['email'])->send(new \App\Mail\Mailer($details));
                            }
                        }
                    }
                    if (sizeOf($countSnags)) {
                        $getUser = DB::table('property_surveyors')->where('id', $property_surveyors_id)->first();
                        if ($getUser) {
                            $getProp = DB::table('properties')->select('*')->where('id', $property_id)->first();
                            $address = format_address($getProp->house_num, $getProp->address1, $getProp->address2, $getProp->address3, $getProp->county, $getProp->eircode);
                            $meta = DB::table('tbl_user_meta')->where('fk_user_id', $getUser->surveyor_id)->orderBy('created_date', 'desc')->first();
                            if ($meta) {
                                $session_other_status = 1;
                                $token = $meta->device_token;
                                $body = "Snag - ". $arr->item_name ." Recorded in ". $address;
                                $title = "Snag Recorded";
                                $addnoti = new NotifiationMobile();
                                $addnoti->fk_user_id = $getUser->surveyor_id;
                                $addnoti->note = $body;
                                $addnoti->sub_section = "snags";
                                $addnoti->property_id = $property_id;
                                $pptype = propertyType($property_id);
                                if($pptype == "Property"){
                                    $addnoti->section = "Property";
                                    $addnoti->route = "property.show";
                                }
                                if($pptype == "Lead"){
                                    $addnoti->section = "Leads";
                                    $addnoti->route = "lead.show";
                                }
                                $addnoti->save();
                                $this->send_notifications($token, $title, $body, $session_other_status);
                            }
                        }
                    }
                }
            }
            if ($saveBreQue) {
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('signature');
                    $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
            }

            if ($updateInsp) {
                $save = PropertySurveyor::find($property_surveyors_id);
                $save->today_date_status = 1;
                $save->update();

                $response = test_method($updateInsp->id);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function cqaSyncSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $array = json_decode($request->cqa_array);
            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            foreach ($array as $arr) {
                $saveCqaQue = new CqaPhotoInspectionItem();
                $saveCqaQue->fk_inspection_id = $inspectionId;
                $saveCqaQue->fk_question_id = $arr->question_id;
                $saveCqaQue->fk_item_id = $arr->fk_item_id;
                $saveCqaQue->fk_user_id = $user->user_id;
                $saveCqaQue->type = $arr->fk_area;
                $saveCqaQue->fk_property_id = $arr->property_id;
                $saveCqaQue->fk_property_surveyors_id = $arr->property_surveyors_id;
                $saveCqaQue->comments = $arr->comment;
                $saveCqaQue->option_value = $arr->options;
                $saveCqaQue->status = 0;
                $saveCqaQue->save_status = 1;
                if ($arr->image1 != "" && sizeOf(json_decode($arr->image1))) {
                    $imageName1 = $this->imageWork($arr->image1);
                    $saveCqaQue->image1 = $imageName1;
                } else {
                    $saveCqaQue->image1 = "";
                }
                if ($arr->image2 != "" && sizeOf(json_decode($arr->image2))) {
                    $imageName2 = $this->imageWork($arr->image2);
                    $saveCqaQue->image2 = $imageName2;
                } else {
                    $saveCqaQue->image2 = "";
                }
                if ($arr->image3 != "" && sizeOf(json_decode($arr->image3))) {
                    $imageName3 = $this->imageWork($arr->image3);
                    $saveCqaQue->image3 = $imageName3;
                } else {
                    $saveCqaQue->image3 = "";
                }
                if ($arr->image4 != "" && sizeOf(json_decode($arr->image4))) {
                    $imageName4 = $this->imageWork($arr->image4);
                    $saveCqaQue->image4 = $imageName4;
                } else {
                    $saveCqaQue->image4 = "";
                }
                if ($arr->image5 != "" && sizeOf(json_decode($arr->image5))) {
                    $imageName5 = $this->imageWork($arr->image5);
                    $saveCqaQue->image5 = $imageName5;
                } else {
                    $saveCqaQue->image5 = "";
                }
                $saveCqaQue->save();
            }

            if ($saveCqaQue) {
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('signature');
                    $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
            }

            if ($updateInsp) {
                $save = PropertySurveyor::find($property_surveyors_id);
                $save->today_date_status = 1;
                $save->update();

                $response = test_method($updateInsp->id);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    //Ecospec API Start
    public function basfFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $basfEC = $basfEquip = $basfGI = $basfPI = $basfMI = $basfTR = $basfWC = [];
                $basfEC = json_decode($request->basf_environmental_conditions);
                $basfEquip = json_decode($request->basf_equipment);
                $basfGI = json_decode($request->basf_general_information);
                $basfPI = json_decode($request->basf_project_information);
                $basfMI = json_decode($request->basf_material_information);
                $basfTR = json_decode($request->basf_test_result);
                $basfWC = json_decode($request->basf_wall_conditions);

                foreach ($basfEC as $arr) {
                    $basfECSave = new BasfEnveronCondition();
                    $basfECSave->fk_user_id = $user->user_id;
                    $basfECSave->fk_forms_id = $form_id;
                    $basfECSave->fk_property_id = $property_id;
                    $basfECSave->property_surveyors_id = $property_surveyors_id;
                    $basfECSave->fk_inspection_id = $inspectionId;
                    $basfECSave->conditions_time = $arr->conditions_time;
                    $basfECSave->ambient_temprature = $arr->ambient_temprature;
                    $basfECSave->substrate_temprature = $arr->substrate_temprature;
                    $basfECSave->other_comments = $arr->other_comments;
                    $basfECSave->save();

                }
                foreach ($basfEquip as $arr2) {
                    $basfEquipSave = new BasfEquipment();
                    $basfEquipSave->fk_user_id = $user->user_id;
                    $basfEquipSave->fk_forms_id = $form_id;
                    $basfEquipSave->fk_property_id = $property_id;
                    $basfEquipSave->property_surveyors_id = $property_surveyors_id;
                    $basfEquipSave->fk_inspection_id = $inspectionId;
                    $basfEquipSave->mixing_chamber_module_size = $arr2->mixing_chamber_module_size;
                    $basfEquipSave->pressure = $arr2->pressure;
                    $basfEquipSave->heater_temperature = $arr2->heater_temperature;
                    $basfEquipSave->hose_length = $arr2->hose_length;
                    $basfEquipSave->b_psi = $arr2->b_psi;
                    $basfEquipSave->hose = $arr2->hose;
                    $basfEquipSave->machiene_model = $arr2->machiene_model;
                    $basfEquipSave->save();

                }
                foreach ($basfGI as $arr3) {
                    $basfGISave = new BasfGeneralInfo();
                    $basfGISave->fk_user_id = $user->user_id;
                    $basfGISave->fk_forms_id = $form_id;
                    $basfGISave->fk_property_id = $property_id;
                    $basfGISave->property_surveyors_id = $property_surveyors_id;
                    $basfGISave->fk_inspection_id = $inspectionId;
                    $basfGISave->contractor = $arr3->contractor;
                    $basfGISave->installer = $arr3->installer;
                    $basfGISave->apprentice = $arr3->apprentice;
                    $basfGISave->information_date = $arr3->information_date;
                    $basfGISave->basf_card = $arr3->basf_card;
                    $basfGISave->apprentice_card = $arr3->apprentice_card;
                    $basfGISave->save();

                }
                foreach ($basfPI as $arr4) {
                    $basfPISave = new BasfProjectInfo();
                    $basfPISave->fk_user_id = $user->user_id;
                    $basfPISave->fk_forms_id = $form_id;
                    $basfPISave->fk_property_id = $property_id;
                    $basfPISave->property_surveyors_id = $property_surveyors_id;
                    $basfPISave->fk_inspection_id = $inspectionId;
                    $basfPISave->project_name = $arr4->project_name;
                    $basfPISave->project_address = $arr4->project_address;
                    $basfPISave->customer_name = $arr4->customer_name;
                    $basfPISave->new_construction = $arr4->new_construction;
                    $basfPISave->refurbishment = $arr4->refurbishment;
                    $basfPISave->area_in_m2 = $arr4->area_in_m2;
                    $basfPISave->save();

                }
                foreach ($basfMI as $arr5) {
                    $basfMISave = new BasfMaterialInfo();
                    $basfMISave->fk_user_id = $user->user_id;
                    $basfMISave->fk_forms_id = $form_id;
                    $basfMISave->fk_property_id = $property_id;
                    $basfMISave->property_surveyors_id = $property_surveyors_id;
                    $basfMISave->fk_inspection_id = $inspectionId;
                    $basfMISave->product = $arr5->product;
                    $basfMISave->batch_number = $arr5->batch_number;
                    $basfMISave->quantity = $arr5->quantity;
                    $basfMISave->colour = $arr5->colour;
                    $basfMISave->save();

                }
                foreach ($basfTR as $arr6) {
                    $basfTRSave = new BasfTestResult();
                    $basfTRSave->fk_user_id = $user->user_id;
                    $basfTRSave->fk_forms_id = $form_id;
                    $basfTRSave->fk_property_id = $property_id;
                    $basfTRSave->property_surveyors_id = $property_surveyors_id;
                    $basfTRSave->fk_inspection_id = $inspectionId;
                    $basfTRSave->mass = $arr6->mass;
                    $basfTRSave->density = $arr6->density;
                    $basfTRSave->basf_min_density = $arr6->basf_min_density;
                    $basfTRSave->volume = $arr6->volume;
                    $basfTRSave->acceptable = $arr6->acceptable;
                    $basfTRSave->interlaminar_adhesion = $arr6->interlaminar_adhesion;
                    $basfTRSave->colour_consistency = $arr6->colour_consistency;
                    $basfTRSave->cell_strcture = $arr6->cell_strcture;
                    $basfTRSave->save();

                }
                foreach ($basfWC as $arr7) {
                    $basfWCSave = new BasfWallCondition();
                    $basfWCSave->fk_user_id = $user->user_id;
                    $basfWCSave->fk_forms_id = $form_id;
                    $basfWCSave->fk_property_id = $property_id;
                    $basfWCSave->property_surveyors_id = $property_surveyors_id;
                    $basfWCSave->fk_inspection_id = $inspectionId;
                    $basfWCSave->wall_conditions_type = $arr7->wall_conditions_type;
                    $basfWCSave->wall_conditions_clean = $arr7->wall_conditions_clean;
                    $basfWCSave->dry = $arr7->dry;
                    $basfWCSave->moisture_content = $arr7->moisture_content;
                    $basfWCSave->bowing_or_distortion = $arr7->bowing_or_distortion;
                    $basfWCSave->cracks = $arr7->cracks;
                    $basfWCSave->cables_in_cavity = $arr7->cables_in_cavity;
                    $basfWCSave->anchors_fited = $arr7->anchors_fited;
                    $basfWCSave->conditions_type = $arr7->conditions_type;
                    $basfWCSave->tie_isolation = $arr7->tie_isolation;
                    $basfWCSave->re_pointing = $arr7->re_pointing;
                    $basfWCSave->comments = $arr7->comments;
                    $basfWCSave->walls_cleaned = $arr7->walls_cleaned;
                    $basfWCSave->electrical_cables_clear = $arr7->electrical_cables_clear;
                    $basfWCSave->flues_checked = $arr7->flues_checked;
                    $basfWCSave->ventilation_maintained = $arr7->ventilation_maintained;
                    $basfWCSave->drill_holes_filled = $arr7->drill_holes_filled;
                    $basfWCSave->site_left_tidy = $arr7->site_left_tidy;
                    $basfWCSave->comments1 = $arr7->comments1;
                    $basfWCSave->save();
                }

                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function asFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $asAP = $asC = $asMN = $asWR = [];
                $asAP = json_decode($request->as_access_to_project);
                $asC = json_decode($request->as_comments);
                $asMN = json_decode($request->as_materials_needed);
                $asWR = json_decode($request->as_work_tools_required);

                foreach ($asAP as $arr) {
                    $asAPSave = new AsAccessProject();
                    $asAPSave->fk_user_id = $user->user_id;
                    $asAPSave->fk_forms_id = $form_id;
                    $asAPSave->fk_property_id = $property_id;
                    $asAPSave->property_surveyors_id = $property_surveyors_id;
                    $asAPSave->fk_inspection_id = $inspectionId;
                    $asAPSave->vehicles_fit_onsite = $arr->vehicles_fit_onsite;
                    $asAPSave->comment = $arr->comment;
                    $asAPSave->suitable_for_ladders = $arr->suitable_for_ladders;
                    $asAPSave->hoist_needed = $arr->hoist_needed;
                    $asAPSave->comment_type_required = $arr->comment_type_required;
                    $asAPSave->scaffold_required = $arr->scaffold_required;
                    $asAPSave->comment_whats_required = $arr->comment_whats_required;
                    $asAPSave->flooring_down = $arr->flooring_down;
                    $asAPSave->flooring_comment = $arr->flooring_comment;
                    $asAPSave->save();

                }
                foreach ($asC as $arr2) {
                    $asCSave = new AsComment();
                    $asCSave->fk_user_id = $user->user_id;
                    $asCSave->fk_forms_id = $form_id;
                    $asCSave->fk_property_id = $property_id;
                    $asCSave->property_surveyors_id = $property_surveyors_id;
                    $asCSave->fk_inspection_id = $inspectionId;
                    $asCSave->comments = $arr2->comments;
                    $asCSave->save();

                }
                foreach ($asMN as $arr3) {
                    $asMNSave = new AsMaterialNeed();
                    $asMNSave->fk_user_id = $user->user_id;
                    $asMNSave->fk_forms_id = $form_id;
                    $asMNSave->fk_property_id = $property_id;
                    $asMNSave->property_surveyors_id = $property_surveyors_id;
                    $asMNSave->fk_inspection_id = $inspectionId;
                    $asMNSave->ventcard_250 = $arr3->ventcard_250;
                    $asMNSave->ventcard_450 = $arr3->ventcard_450;
                    $asMNSave->ventcard_650 = $arr3->ventcard_650;
                    $asMNSave->opencell = $arr3->opencell;
                    $asMNSave->closed_cell = $arr3->closed_cell;
                    $asMNSave->injection = $arr3->injection;
                    $asMNSave->injection_opencell = $arr3->injection_opencell;
                    $asMNSave->injection_closed_cell = $arr3->injection_closed_cell;
                    $asMNSave->plastic = $arr3->plastic;
                    $asMNSave->airtight_window_tape_80 = $arr3->airtight_window_tape_80;
                    $asMNSave->airtight_window_tape_100 = $arr3->airtight_window_tape_100;
                    $asMNSave->airtight_window_tape_150 = $arr3->airtight_window_tape_150;
                    $asMNSave->airtight_window_tape_200 = $arr3->airtight_window_tape_200;
                    $asMNSave->airtight_window_tape_timberframe = $arr3->airtight_window_tape_timberframe;
                    $asMNSave->membrane_required_100 = $arr3->membrane_required_100;
                    $asMNSave->membrane_required_150 = $arr3->membrane_required_150;
                    $asMNSave->membrane_required_200 = $arr3->membrane_required_200;
                    $asMNSave->insulation_required_100 = $arr3->insulation_required_100;
                    $asMNSave->insulation_required_150 = $arr3->insulation_required_150;
                    $asMNSave->insulation_required_200 = $arr3->insulation_required_200;
                    $asMNSave->comments = $arr3->comments;
                    $asMNSave->save();

                }
                foreach ($asWR as $arr4) {
                    $asWRSave = new AsWorkTool();
                    $asWRSave->fk_user_id = $user->user_id;
                    $asWRSave->fk_forms_id = $form_id;
                    $asWRSave->fk_property_id = $property_id;
                    $asWRSave->property_surveyors_id = $property_surveyors_id;
                    $asWRSave->fk_inspection_id = $inspectionId;
                    $asWRSave->shaver = $arr4->shaver;
                    $asWRSave->ladders = $arr4->ladders;
                    $asWRSave->scaffold = $arr4->scaffold;
                    $asWRSave->slabbing_knife = $arr4->slabbing_knife;
                    $asWRSave->drills = $arr4->drills;
                    $asWRSave->other = $arr4->other;
                    $asWRSave->save();

                }

                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function msFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $msBB = $msEW = $msSF = $msTM = [];
                $msBB = json_decode($request->ms_bonded_bead);
                $msEW = json_decode($request->ms_eathwool);
                $msSF = json_decode($request->ms_sprayfoam);
                $msTM = json_decode($request->ms_tapes_and_membranes);

                foreach ($msBB as $arr) {
                    $msBBSave = new MsBonded();
                    $msBBSave->fk_user_id = $user->user_id;
                    $msBBSave->fk_forms_id = $form_id;
                    $msBBSave->fk_property_id = $property_id;
                    $msBBSave->property_surveyors_id = $property_surveyors_id;
                    $msBBSave->fk_inspection_id = $inspectionId;
                    $msBBSave->bead = $arr->bead;
                    $msBBSave->save();

                }
                foreach ($msEW as $arr2) {
                    $msEWSave = new MsEathwool();
                    $msEWSave->fk_user_id = $user->user_id;
                    $msEWSave->fk_forms_id = $form_id;
                    $msEWSave->fk_property_id = $property_id;
                    $msEWSave->property_surveyors_id = $property_surveyors_id;
                    $msEWSave->fk_inspection_id = $inspectionId;
                    $msEWSave->rolls_of_100mm = $arr2->rolls_of_100mm;
                    $msEWSave->rolls_of_150mm = $arr2->rolls_of_150mm;
                    $msEWSave->rolls_of_200mm = $arr2->rolls_of_200mm;
                    $msEWSave->acoustic_wool_100mm = $arr2->acoustic_wool_100mm;
                    $msEWSave->acoustic_wool_150mm = $arr2->acoustic_wool_150mm;
                    $msEWSave->acoustic_wool_200mm = $arr2->acoustic_wool_200mm;
                    $msEWSave->metac_100mm = $arr2->metac_100mm;
                    $msEWSave->metac_150mm = $arr2->metac_150mm;
                    $msEWSave->metac_175mm = $arr2->metac_175mm;
                    $msEWSave->save();

                }
                foreach ($msSF as $arr3) {
                    $msSFSave = new MsSprayFoam();
                    $msSFSave->fk_user_id = $user->user_id;
                    $msSFSave->fk_forms_id = $form_id;
                    $msSFSave->fk_property_id = $property_id;
                    $msSFSave->property_surveyors_id = $property_surveyors_id;
                    $msSFSave->fk_inspection_id = $inspectionId;
                    $msSFSave->walltite_cv100 = $arr3->walltite_cv100;
                    $msSFSave->closed_cell = $arr3->closed_cell;
                    $msSFSave->open_cell = $arr3->open_cell;
                    $msSFSave->save();

                }
                foreach ($msTM as $arr4) {
                    $msTMSave = new MsTapes();
                    $msTMSave->fk_user_id = $user->user_id;
                    $msTMSave->fk_forms_id = $form_id;
                    $msTMSave->fk_property_id = $property_id;
                    $msTMSave->property_surveyors_id = $property_surveyors_id;
                    $msTMSave->fk_inspection_id = $inspectionId;
                    $msTMSave->rolls_of_80mm = $arr4->rolls_of_80mm;
                    $msTMSave->rolls_of_100mm = $arr4->rolls_of_100mm;
                    $msTMSave->rolls_of_50mm = $arr4->rolls_of_50mm;
                    $msTMSave->rolls_of_60mm = $arr4->rolls_of_60mm;
                    $msTMSave->rolls_of_membrane = $arr4->rolls_of_membrane;
                    $msTMSave->tubes_of_primer = $arr4->tubes_of_primer;
                    $msTMSave->lengths_of_timbers_4_2 = $arr4->lengths_of_timbers_4_2;
                    $msTMSave->sheets_of_osb = $arr4->sheets_of_osb;
                    $msTMSave->piping_lagging_0_5_inch = $arr4->piping_lagging_0_5_inch;
                    $msTMSave->pipe_lagging_0_75_inch = $arr4->pipe_lagging_0_75_inch;
                    $msTMSave->pipe_lagging_1_inch = $arr4->pipe_lagging_1_inch;
                    $msTMSave->external_vent_covers = $arr4->external_vent_covers;
                    $msTMSave->internal_vent_covers = $arr4->internal_vent_covers;
                    $msTMSave->soffit_vents = $arr4->soffit_vents;
                    $msTMSave->roof_vents = $arr4->roof_vents;
                    $msTMSave->passive_vents = $arr4->passive_vents;
                    $msTMSave->sleeves = $arr4->sleeves;
                    $msTMSave->save();

                }

                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function tsFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $tsAD = $tsBD = $tsWS = [];
                $tsAD = json_decode($request->ts_additional_property_detail);
                $tsBD = json_decode($request->ts_building_details);
                $tsWS = json_decode($request->ts_wall_survey);

                foreach ($tsAD as $arr) {
                    $tsADSave = new TsAdditional();
                    $tsADSave->fk_user_id = $user->user_id;
                    $tsADSave->fk_forms_id = $form_id;
                    $tsADSave->fk_property_id = $property_id;
                    $tsADSave->property_surveyors_id = $property_surveyors_id;
                    $tsADSave->fk_inspection_id = $inspectionId;
                    $tsADSave->additional_note = $arr->additional_note;
                    $tsADSave->save();

                }
                foreach ($tsBD as $arr2) {
                    $tsBDSave = new TsBuilDetail();
                    $tsBDSave->fk_user_id = $user->user_id;
                    $tsBDSave->fk_forms_id = $form_id;
                    $tsBDSave->fk_property_id = $property_id;
                    $tsBDSave->property_surveyors_id = $property_surveyors_id;
                    $tsBDSave->fk_inspection_id = $inspectionId;
                    $tsBDSave->appropriate_tick_box = $arr2->appropriate_tick_box;
                    $tsBDSave->others_data = $arr2->others_data;
                    $tsBDSave->save();

                }
                foreach ($tsWS as $arr3) {
                    $tsWSSave = new TsWallSurvey();
                    $tsWSSave->fk_user_id = $user->user_id;
                    $tsWSSave->fk_forms_id = $form_id;
                    $tsWSSave->fk_property_id = $property_id;
                    $tsWSSave->property_surveyors_id = $property_surveyors_id;
                    $tsWSSave->fk_inspection_id = $inspectionId;
                    $tsWSSave->plumbing_complete = $arr3->plumbing_complete;
                    $tsWSSave->electrical_complete = $arr3->electrical_complete;
                    $tsWSSave->vapour_barrier = $arr3->vapour_barrier;
                    $tsWSSave->taping_of_double = $arr3->taping_of_double;
                    $tsWSSave->sealing_of_double = $arr3->sealing_of_double;
                    $tsWSSave->shave_off = $arr3->shave_off;
                    $tsWSSave->required_depth = $arr3->required_depth;
                    $tsWSSave->timberframe = $arr3->timberframe;
                    $tsWSSave->notes = $arr3->notes;
                    if ($arr3->photos1 != "" && sizeOf(json_decode($arr3->photos1))) {
                        $imageName1 = $this->imageWork($arr3->photos1);
                        $tsWSSave->photos1 = $imageName1;
                    } else {
                        $tsWSSave->photos1 = "";
                    }
                    if ($arr3->photos2 != "" && sizeOf(json_decode($arr3->photos2))) {
                        $imageName2 = $this->imageWork($arr3->photos2);
                        $tsWSSave->photos2 = $imageName2;
                    } else {
                        $tsWSSave->photos2 = "";
                    }
                    if ($arr3->photos3 != "" && sizeOf(json_decode($arr3->photos3))) {
                        $imageName3 = $this->imageWork($arr3->photos3);
                        $tsWSSave->photos3 = $imageName3;
                    } else {
                        $tsWSSave->photos3 = "";
                    }
                    if ($arr3->photos4 != "" && sizeOf(json_decode($arr3->photos4))) {
                        $imageName4 = $this->imageWork($arr3->photos4);
                        $tsWSSave->photos4 = $imageName4;
                    } else {
                        $tsWSSave->photos4 = "";
                    }
                    if ($arr3->photos5 != "" && sizeOf(json_decode($arr3->photos5))) {
                        $imageName5 = $this->imageWork($arr3->photos5);
                        $tsWSSave->photos5 = $imageName5;
                    } else {
                        $tsWSSave->photos5 = "";
                    }
                    $tsWSSave->save();

                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function hbFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $hbAD = $hbBD = $hbWS = [];
                $hbAD = json_decode($request->hb_additional_property_detail);
                $hbBD = json_decode($request->hb_building_details);
                $hbWS = json_decode($request->hb_hollow_block_or_solid);

                foreach ($hbAD as $arr) {
                    $hbADSave = new HbAdditional();
                    $hbADSave->fk_user_id = $user->user_id;
                    $hbADSave->fk_forms_id = $form_id;
                    $hbADSave->fk_property_id = $property_id;
                    $hbADSave->property_surveyors_id = $property_surveyors_id;
                    $hbADSave->fk_inspection_id = $inspectionId;
                    $hbADSave->additional_note = $arr->additional_note;
                    $hbADSave->save();

                }
                foreach ($hbBD as $arr2) {
                    $hbBDSave = new HbBuilDetail();
                    $hbBDSave->fk_user_id = $user->user_id;
                    $hbBDSave->fk_forms_id = $form_id;
                    $hbBDSave->fk_property_id = $property_id;
                    $hbBDSave->property_surveyors_id = $property_surveyors_id;
                    $hbBDSave->fk_inspection_id = $inspectionId;
                    $hbBDSave->appropriate_tick_box = $arr2->appropriate_tick_box;
                    $hbBDSave->others_data = $arr2->others_data;
                    $hbBDSave->save();

                }
                foreach ($hbWS as $arr3) {

                    $hbWSSave = new HbHollowBlock();
                    $hbWSSave->fk_user_id = $user->user_id;
                    $hbWSSave->fk_forms_id = $form_id;
                    $hbWSSave->fk_property_id = $property_id;
                    $hbWSSave->property_surveyors_id = $property_surveyors_id;
                    $hbWSSave->fk_inspection_id = $inspectionId;
                    $hbWSSave->stud_erected = $arr3->stud_erected;
                    $hbWSSave->stud_type = $arr3->stud_type;
                    $hbWSSave->distance = $arr3->distance;
                    $hbWSSave->reveals = $arr3->reveals;
                    $hbWSSave->plumbing_complete = $arr3->plumbing_complete;
                    $hbWSSave->electrical_complete = $arr3->electrical_complete;
                    $hbWSSave->wires_in_conjutes = $arr3->wires_in_conjutes;
                    $hbWSSave->patches_on_wall = $arr3->patches_on_wall;
                    $hbWSSave->vents_sleeved = $arr3->vents_sleeved;
                    $hbWSSave->depth_of_insulation = $arr3->depth_of_insulation;
                    $hbWSSave->type_of_insulation = $arr3->type_of_insulation;
                    $hbWSSave->notes = $arr3->notes;
                    if ($arr3->photos1 != "" && sizeOf(json_decode($arr3->photos1))) {
                        $imageName1 = $this->imageWork($arr3->photos1);
                        $hbWSSave->photos1 = $imageName1;
                    } else {
                        $hbWSSave->photos1 = "";
                    }
                    if ($arr3->photos2 != "" && sizeOf(json_decode($arr3->photos2))) {
                        $imageName2 = $this->imageWork($arr3->photos2);
                        $hbWSSave->photos2 = $imageName2;
                    } else {
                        $hbWSSave->photos2 = "";
                    }
                    if ($arr3->photos3 != "" && sizeOf(json_decode($arr3->photos3))) {
                        $imageName3 = $this->imageWork($arr3->photos3);
                        $hbWSSave->photos3 = $imageName3;
                    } else {
                        $hbWSSave->photos3 = "";
                    }
                    if ($arr3->photos4 != "" && sizeOf(json_decode($arr3->photos4))) {
                        $imageName4 = $this->imageWork($arr3->photos4);
                        $hbWSSave->photos4 = $imageName4;
                    } else {
                        $hbWSSave->photos4 = "";
                    }
                    if ($arr3->photos5 != "" && sizeOf(json_decode($arr3->photos5))) {
                        $imageName5 = $this->imageWork($arr3->photos5);
                        $hbWSSave->photos5 = $imageName5;
                    } else {
                        $hbWSSave->photos5 = "";
                    }
                    $hbWSSave->save();

                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }

    public function thirdPartyFormSave(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = $request->contractor_name;
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();
            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $savePdfFrom = new ThirdPartyForm();
                $savePdfFrom->fk_user_id = $user->user_id;
                $savePdfFrom->fk_forms_id = $form_id;
                $savePdfFrom->fk_property_id = $property_id;
                $savePdfFrom->property_surveyors_id = $property_surveyors_id;
                $savePdfFrom->fk_rdparty_forms_id = $request->rdparty_forms_id;
                $savePdfFrom->fk_inspection_id = $inspectionId;
                if ($request->photos1 != "" && sizeOf(json_decode($request->photos1))) {
                    $imageName1 = $this->imageWork($request->photos1);
                    $savePdfFrom->third_party_image1 = $imageName1;
                } else {
                    $savePdfFrom->third_party_image1 = "";
                }
                if ($request->photos2 != "" && sizeOf(json_decode($request->photos2))) {
                    $imageName2 = $this->imageWork($request->photos2);
                    $savePdfFrom->third_party_image2 = $imageName2;
                } else {
                    $savePdfFrom->third_party_image2 = "";
                }
                if ($request->photos3 != "" && sizeOf(json_decode($request->photos3))) {
                    $imageName3 = $this->imageWork($request->photos3);
                    $savePdfFrom->third_party_image3 = $imageName3;
                } else {
                    $savePdfFrom->third_party_image3 = "";
                }
                if ($request->photos4 != "" && sizeOf(json_decode($request->photos4))) {
                    $imageName4 = $this->imageWork($request->photos4);
                    $savePdfFrom->third_party_image4 = $imageName4;
                } else {
                    $savePdfFrom->third_party_image4 = "";
                }
                if ($request->photos5 != "" && sizeOf(json_decode($request->photos5))) {
                    $imageName5 = $this->imageWork($request->photos5);
                    $savePdfFrom->third_party_image5 = $imageName5;
                } else {
                    $savePdfFrom->third_party_image5 = "";
                }
                $savePdfFrom->save();
                if ($savePdfFrom) {
                    $updateInsp = Inspections::find($inspectionId);

                    if ($request->images_signature != null && $request->file('images_signature')) {
                        $year = date('Y');
                        $month = date('m');
                        if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                            if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                                mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                            }
                        }
                        $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                        $photo = $request->file('images_signature');
                        $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                        $photo->move(public_path($image_path), $imageName);
                        $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                    } else {
                        $updateInsp->signature = "";
                    }

                    $updateInsp->update();
                    if ($updateInsp) {
                        $save = PropertySurveyor::find($property_surveyors_id);
                        $save->today_date_status = 1;
                        $save->update();

                        $response = test_method($updateInsp->id);
                        return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                    } else {
                        return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 400]);
                    }
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection created but form not saved.', 'code' => 400]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    //Ecospec API End
    public function imgFunctionGlobal($image)
    {
        $year = date('Y');
        $month = date('m');
        $image_path = "assets/uploads/inspection_photo/{$year}/{$month}/";
        if (!is_dir(public_path($image_path))) {
            mkdir(public_path($image_path), 0777, true);
        }
        $photo = $image;
        $imageName = 'img-' . time() . '_' . mt_rand(11111, 99999) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path($image_path), $imageName);
        $imagePath = "/{$year}/{$month}/{$imageName}";

        return $imagePath;
    }
    public function imgFunctionGlobalSnag($image)
    {
        $year = date('Y');
        $month = date('m');
        $image_path = "assets/uploads/snag_photo/{$year}/{$month}/";
        if (!is_dir(public_path($image_path))) {
            mkdir(public_path($image_path), 0777, true);
        }
        $photo = $image;
        $imageName = 'img-' . time() . '_' . mt_rand(11111, 99999) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path($image_path), $imageName);
        $imagePath = "{$year}/{$month}/{$imageName}";

        return $imagePath;
    }
    public function imgFunctionGlobal2($image)
    {
        $year = date('Y');
        $month = date('m');
        $image_path = "assets/uploads/inspection_photo/{$year}/{$month}/";
        if (!is_dir(public_path($image_path))) {
            mkdir(public_path($image_path), 0777, true);
        }
        $photo = $image;
        $imageName = 'img-' . time() . '_' . mt_rand(11111, 99999) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path($image_path), $imageName);
        $imagePath = "{$year}/{$month}/{$imageName}";

        return $imagePath;
    }
    public function imageWork($image)
    {
        $year = date('Y');
        $month = date('m');
        $uploadPath = "./assets/uploads/inspection_photo/{$year}/{$month}/";

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Use a more meaningful variable name than $fp for file handling
        $outputFile = $uploadPath . "sampleJPG.jpg";

        $image = json_decode($image);

        // Use file_put_contents to write the image data in one go
        file_put_contents($outputFile, implode(array_map("chr", $image)));

        $imageName = 'img-' . rand(10, 10000) . '.jpg';
        $newImagePath = $uploadPath . $imageName;

        // Use rename instead of copy and unlink for better performance
        rename($outputFile, $newImagePath);

        // Return the relative path to the saved image
        return "{$year}/{$month}/{$imageName}";
    }
    public function imageWork2($image)
    {
        $year = date('Y');
        $month = date('m');
        if (!is_dir('assets/uploads/inspection_photo/' . $year)) {
            mkdir('./assets/uploads/inspection_photo/' . $year . '/' . $month, 0777, true);
        } else if (is_dir('assets/uploads/inspection_photo/' . $year)) {
            if (!is_dir('assets/uploads/inspection_photo/' . $year . '/' . $month)) {
                mkdir('./assets/uploads/inspection_photo/' . $year . '/' . $month, 0777, true);
            }
        }
        $uploadPath = "./assets/uploads/inspection_photo/" . $year . "/" . $month . "/";
        $fp = fopen("./sampleJPG.jpg", "wb");
        $image = json_decode($image);
        $len = count($image);
        for ($i = 0; $i < $len; $i++) {
            $data = pack("C*", $image[$i]);
            fwrite($fp, $data);
        }
        fclose($fp);
        $fp = "./sampleJPG.jpg";
        copy($fp, $uploadPath . "/sampleJPG.jpg");
        $imageName = 'img-' . rand(10, 10000) . '.jpg';
        rename($uploadPath . "/sampleJPG.jpg", $uploadPath . $imageName);

        return $year . "/" . $month . "/" . $imageName;
    }
    public function imageWorkSnag($image)
    {
        $year = date('Y');
        $month = date('m');
        if (!is_dir('assets/uploads/snag_photo/' . $year)) {
            mkdir('./assets/uploads/snag_photo/' . $year . '/' . $month, 0777, true);
        } else if (is_dir('assets/uploads/snag_photo/' . $year)) {
            if (!is_dir('assets/uploads/snag_photo/' . $year . '/' . $month)) {
                mkdir('./assets/uploads/snag_photo/' . $year . '/' . $month, 0777, true);
            }
        }
        $uploadPath = "./assets/uploads/snag_photo/" . $year . "/" . $month . "/";
        $fp = fopen("./sampleJPG.jpg", "wb");
        $image = json_decode($image);
        $len = count($image);
        for ($i = 0; $i < $len; $i++) {
            $data = pack("C*", $image[$i]);
            fwrite($fp, $data);
        }
        fclose($fp);
        $fp = "./sampleJPG.jpg";
        copy($fp, $uploadPath . "/sampleJPG.jpg");
        $imageName = 'img-' . rand(10, 10000) . '.jpg';
        rename($uploadPath . "/sampleJPG.jpg", $uploadPath . $imageName);
        // $mP = "http://localhost/LiveProjects/bcrRetro/public/bcrapi/public/assets/uploads/inspection_photo/";
        return $year . "/" . $month . "/" . $imageName;
    }
    public function retroSyncSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $array = json_decode($request->retrofit_array);
            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = 21;
            $name = $request->name;
            $date_inspected = isset($request->date_inspected) ? $request->date_inspected : date('Y-m-d');
            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            foreach ($array as $arr) {
                $saveRetroQue = new PhotoInspectionItem();
                $saveRetroQue->fk_inspection_id = $inspectionId;
                $saveRetroQue->fk_quesion_id = $arr->question_id;
                $saveRetroQue->fk_item_id = $arr->fk_item_id;
                $saveRetroQue->fk_user_id = $user->user_id;
                $saveRetroQue->type = $arr->fk_area;
                $saveRetroQue->fk_property_id = $arr->property_id;
                $saveRetroQue->fk_property_surveyors_id = $arr->property_surveyors_id;
                $saveRetroQue->comments = $arr->comment;
                // $saveRetroQue->option_value = $arr->options;
                $saveRetroQue->status = 0;
                $saveRetroQue->save_status = 1;
                for ($i = 1; $i <= 5; $i++) {
                    $photos_key = 'image_' . $arr->question_id . '_' . $i;
                    $photos_key2 = 'image' . $i;
                    if ($request->hasFile($photos_key)) {
                        $imageName = $this->imgFunctionGlobal2($request->file($photos_key));
                        $saveRetroQue->$photos_key2 = $imageName;
                    } else {
                        $saveRetroQue->$photos_key2 = "";
                    }
                }
                $saveRetroQue->save();
            }

            if ($saveRetroQue) {
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('signature');
                    $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
            }
            if ($updateInsp) {
                $save = PropertySurveyor::find($property_surveyors_id);
                $save->today_date_status = 1;
                $save->update();

                $response = test_method($updateInsp->id);
                return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function ossSyncSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $inspecId = "";
            $dataArr = json_decode($request->data_array);
            $messureArray = $additionalArray = [];
            $messureArray = array_filter($dataArr, function ($msrArr) {
                return $msrArr->type == 'measure';

            });
            $additionalArray = array_filter($dataArr, function ($msrArr) {
                return $msrArr->type == 'additional';

            });

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $request->form_id;
            $saveInsp->fk_property_id = $request->property_id;
            $saveInsp->property_surveyors_id = $request->property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();
            $inspecId = $saveInsp->id;
            if ($saveInsp) {
                if ($request->form_id == 22) {
                    $ossCostSave = new OssSave();
                    $ossCostSave->fk_forms_id = 22;
                }
                if ($request->form_id == 23) {
                    $ossCostSave = new HousingSave();
                    $ossCostSave->fk_forms_id = 23;
                }
                if ($request->form_id == 24) {
                    $ossCostSave = new FuelSave();
                    $ossCostSave->fk_forms_id = 24;
                }

                $ossCostSave->fk_user_id = $user->user_id;
                $ossCostSave->fk_property_id = $request->property_id;
                $ossCostSave->fk_property_surveyors_id = $request->property_surveyors_id;
                $ossCostSave->fk_inspection_id = $inspecId;
                $ossCostSave->toatl_unit = $request->toatl_unit;
                $ossCostSave->total_cost_works = $request->total_cost_works;
                $ossCostSave->total_grant = $request->total_grant;
                $ossCostSave->profit_per = $request->profit_per;
                $ossCostSave->per_cost_works = $request->per_cost_works;
                $ossCostSave->final_total_client_contripution = $request->final_total_client_contripution;
                $ossCostSave->cost_work_contribution = $request->cost_work_contribution;
                $ossCostSave->vatcost = $request->vatcost;
                $ossCostSave->total_client_cost_work_contribution = $request->total_client_cost_work_contribution;
                $ossCostSave->total_estimate_cost_for_customer = $request->total_estimate_cost_for_customer;
                $ossCostSave->total_project_management = 0;
                $ossCostSave->status = 1;
                $ossCostSave->vat_per = '13.5';
                $ossCostSave->per_grant = 0;
                $ossCostSave->total_net_client_controbution = 0.00;
                $ossCostSave->total_vat_per = 0.00;
                $ossCostSave->total_net_grant = 0.00;
                $ossCostSave->total_net_cost_works = 0.00;
                $ossCostSave->per_net_cost_works = 0.00;
                if ($request->form_id == 22) {
                    if ($request->hasFile('coverImg')) {
                        $imageName = $this->imgFunctionGlobal($request->file('coverImg'));
                        $ossCostSave->coverImg = $imageName;
                    } else {
                        $ossCostSave->coverImg = "";
                    }
                }
                $ossCostSave->save();
                if ($ossCostSave) {
                    if (sizeOf($messureArray)) {
                        foreach ($messureArray as $mKey => $mesArr) {
                            if ($request->form_id == 22) {
                                $saveTemp = new OssTemplate();
                                $saveTemp->fk_forms_id = 22;
                            }
                            if ($request->form_id == 23) {
                                $saveTemp = new HousingTemplate();
                                $saveTemp->fk_forms_id = 23;
                            }
                            if ($request->form_id == 24) {
                                $saveTemp = new FuelTemplate();
                                $saveTemp->fk_forms_id = 24;
                            }
                            $saveTemp->fk_user_id = $user->user_id;
                            $saveTemp->fk_property_id = $mesArr->property_id;
                            $saveTemp->fk_property_surveyors_id = $mesArr->property_surveyors_id;
                            $saveTemp->oss_cost_id = $ossCostSave->id;
                            $saveTemp->fk_inspection_id = $inspecId;
                            if ($request->form_id == 22) {
                                $saveTemp->house_type_name = $request->house_type;
                                $saveTemp->fk_house_type_id = $request->house_type_id;
                            } else {
                                $saveTemp->house_type_name = $mesArr->house_type;
                                $saveTemp->fk_house_type_id = $mesArr->house_type_id;
                            }
                            $saveTemp->fk_measure_id = $mesArr->measure_type_id;
                            $saveTemp->measure_name = $mesArr->measure_type;
                            $saveTemp->unit = $mesArr->unit;
                            $saveTemp->cost_works = $mesArr->cost_works;
                            $saveTemp->comments = $mesArr->comment;
                            $saveTemp->grant_cost = $mesArr->grant;
                            $saveTemp->net_grant = 0.00;
                            $saveTemp->net_cost_works = 0.00;
                            $saveTemp->status = 1;
                            if ($request->form_id == 22) {
                                for ($i = 1; $i <= 5; $i++) {
                                    $photos_key = 'image_oss_' . $mKey . '_' . $i;
                                    $photos_key2 = 'image' . $i;
                                    if ($request->hasFile($photos_key)) {
                                        $imageName = $this->imgFunctionGlobal($request->file($photos_key));
                                        $saveTemp->$photos_key2 = $imageName;
                                    } else {
                                        $saveTemp->$photos_key2 = "";
                                    }
                                }
                            }
                            $saveTemp->save();
                        }

                    }
                    if (sizeOf($additionalArray)) {
                        foreach ($additionalArray as $aKey => $addArr) {
                            if ($request->form_id == 22) {
                                $saveAdditional = new OssAdditional();
                            }
                            if ($request->form_id == 23) {
                                $saveAdditional = new HousingAdditional();
                            }
                            if ($request->form_id == 24) {
                                $saveAdditional = new FuelAdditional();
                            }
                            $saveAdditional->fk_user_id = $user->user_id;
                            $saveAdditional->fk_property_id = $addArr->property_id;
                            $saveAdditional->fk_property_surveyors_id = $addArr->property_surveyors_id;
                            $saveAdditional->fk_inspection_id = $inspecId;
                            $saveAdditional->fk_oss_id = $ossCostSave->id;
                            $saveAdditional->additional_unit = $addArr->unit;
                            $saveAdditional->additional_cost_works = $addArr->cost_works;
                            $saveAdditional->additional_comments = $addArr->comment;
                            $saveAdditional->status = 1;
                            $saveAdditional->additional_grant_cost = $addArr->grant;
                            $saveAdditional->additional_net_grant = 0.00;
                            $saveAdditional->additional_net_cost_works = 0.00;
                            $saveAdditional->save();
                        }
                    }
                    // if ($saveBreQue) {
                    $updateInsp = Inspections::find($inspecId);
                    if ($request->file('signature')) {
                        $year = date('Y');
                        $month = date('m');
                        if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                            if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                                mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                            }
                        }
                        $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                        $photo = $request->file('signature');
                        $imageName = 'signature-' . time() . '.' . request()->signature->getClientOriginalExtension();
                        $photo->move(public_path($image_path), $imageName);
                        $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                        // }
                        $updateInsp->update();
                    }
                    if ($updateInsp) {
                        $save = PropertySurveyor::find($request->property_surveyors_id);
                        $save->today_date_status = 1;
                        $save->update();

                        $response = test_method($updateInsp->id);
                        return response()->json(['success' => true, 'message' => 'Inspection Submitted Successfully.', 'code' => 200]);
                    } else {
                        return response()->json(['success' => true, 'message' => 'Inspection Submitted Successfully but signature not saved.', 'code' => 200]);
                    }

                } else {
                    return response()->json(['success' => true, 'message' => 'Inspection created but cost data Failed.', 'code' => 400]);
                }
            } else {
                return response()->json(['success' => true, 'message' => 'Inspection creation Failed.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function ContactFormSave(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));
            $cfid = $request->fk_contract_forms_pdf_id;
            if ($cfid == "") {
                $cfid = 0;
            }
            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = isset($request->contractor_name) && $request->contractor_name != null ? $request->contractor_name : "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();
            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $saveCForm = new ContractForm();
                $saveCForm->fk_user_id = $user->user_id;
                $saveCForm->fk_forms_id = $request->form_id;
                $saveCForm->fk_property_id = $property_id;
                $saveCForm->property_surveyors_id = $property_surveyors_id;
                $saveCForm->fk_contract_forms_pdf_id = $cfid;
                if ($request->milestone1 == null) {
                    $milestone1 = "";
                } else {
                    $milestone1 = $request->milestone1;
                }
                $saveCForm->milestone1 = $milestone1;
                if ($request->milestone2 == null) {
                    $milestone2 = "";
                } else {
                    $milestone2 = $request->milestone2;
                }
                $saveCForm->milestone2 = $milestone2;
                if ($request->milestone3 == null) {
                    $milestone3 = "";
                } else {
                    $milestone3 = $request->milestone3;
                }
                $saveCForm->milestone3 = $milestone3;
                if ($request->milestone1_date == null) {
                    $milestone1_date = "";
                } else {
                    $milestone1_date = $request->milestone1_date;
                }
                if ($request->milestone2_date == null) {
                    $milestone2_date = "";
                } else {
                    $milestone2_date = $request->milestone2_date;
                }
                if ($request->milestone3_date == null) {
                    $milestone3_date = "";
                } else {
                    $milestone3_date = $request->milestone3_date;
                }
                $saveCForm->milestone1_date = $milestone1_date;
                $saveCForm->milestone2_date = $milestone2_date;
                $saveCForm->milestone3_date = $milestone3_date;
                $saveCForm->milestone1_description = $request->milestone1_description;
                $saveCForm->milestone2_description = $request->milestone2_description;
                $saveCForm->milestone3_description = $request->milestone3_description;
                if ($request->insert_date == null) {
                    $insert_date = "";
                } else {
                    $insert_date = $request->insert_date;
                }
                $saveCForm->insert_date = $insert_date;
                if ($request->contract_relates_tick_mark == null) {
                    $contract_relates_tick_mark = "";
                } else {
                    $contract_relates_tick_mark = $request->contract_relates_tick_mark;
                }
                $saveCForm->contract_relates_tick_mark = $contract_relates_tick_mark;
                $saveCForm->contract_relates_tick_mark_other = $request->contract_relates_tick_mark_other;
                $saveCForm->contract_relates_schema = $request->contract_relates_schema;
                $saveCForm->fk_inspection_id = $inspectionId;
                $saveCForm->save();
                if ($saveCForm) {
                    $updateInsp = Inspections::find($inspectionId);

                    if ($request->images_signature != null && $request->file('images_signature')) {
                        $year = date('Y');
                        $month = date('m');
                        if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                            if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                                mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                            }
                        }
                        $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                        $photo = $request->file('images_signature');
                        $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                        $photo->move(public_path($image_path), $imageName);
                        $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                    } else {
                        $updateInsp->signature = "";
                    }
                    if ($request->contractor_signature != null && $request->file('contractor_signature')) {
                        $year = date('Y');
                        $month = date('m');
                        if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                            if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                                mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                            }
                        }
                        $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                        $photo = $request->file('contractor_signature');
                        $imageName = 'contactsignature-' . time() . '.' . request()->contractor_signature->getClientOriginalExtension();
                        $photo->move(public_path($image_path), $imageName);
                        $updateInsp->contractor_signature = "/" . $year . "/" . $month . "/" . $imageName;
                    } else {
                        $updateInsp->contractor_signature = "";
                    }
                    $updateInsp->update();
                    if ($updateInsp) {
                        $save = PropertySurveyor::find($property_surveyors_id);
                        $save->today_date_status = 1;
                        $save->update();

                        $response = test_method($updateInsp->id);
                        return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                    } else {
                        return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 400]);
                    }
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection created but form not saved.', 'code' => 400]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }

    public function TerrecoFormSave(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $property_id = $request->property_id;
            $property_surveyors_id = $request->property_surveyors_id;
            $form_id = $request->form_id;
            $name = $request->name;
            $date_inspected = date('Y-m-d', strtotime($request->date_inspected));
            $cfid = $request->fk_terraco_forms_pdf_id;
            if ($cfid == "") {
                $cfid = 0;
            }
            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();
            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $saveTForm = new TerrecoForm();
                $saveTForm->fk_user_id = $user->user_id;
                $saveTForm->fk_forms_id = $request->form_id;
                $saveTForm->fk_property_id = $property_id;
                $saveTForm->property_surveyors_id = $property_surveyors_id;
                $saveTForm->fk_terraco_forms_pdf_id = $cfid;
                $saveTForm->commencement_date = $request->commencement_date;
                $saveTForm->signature_date = $request->signature_date;
                $saveTForm->guarantor_name = $name;
                $saveTForm->fk_inspection_id = $inspectionId;
                $saveTForm->save();
                if ($saveTForm) {
                    $updateInsp = Inspections::find($inspectionId);
                    if ($request->file('images_signature')) {
                        $year = date('Y');
                        $month = date('m');
                        if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                            if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                                mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                            }
                        }
                        $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                        $photo = $request->file('images_signature');
                        $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                        $photo->move(public_path($image_path), $imageName);
                        $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                    }
                    $updateInsp->update();
                    if ($updateInsp) {
                        $save = PropertySurveyor::find($property_surveyors_id);
                        $save->today_date_status = 1;
                        $save->update();

                        $response = test_method($updateInsp->id);
                        return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                    } else {
                        return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 400]);
                    }
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection created but form not saved.', 'code' => 400]);
                }

            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function ProggressFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if (!$user) {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }

        $property_id = $request->property_id;
        $property_surveyors_id = $request->property_surveyors_id;
        $form_id = $request->form_id;
        $name = $request->name;
        $date_inspected = date('Y-m-d', strtotime($request->date_inspected));

        $saveInsp = new Inspections();
        $saveInsp->fk_user_id = $user->user_id;
        $saveInsp->fk_forms_id = $form_id;
        $saveInsp->fk_property_id = $property_id;
        $saveInsp->property_surveyors_id = $property_surveyors_id;
        $saveInsp->name = $name;
        $saveInsp->contractor_name = "";
        $saveInsp->contractor_signature = "";
        $saveInsp->date_inspected = $date_inspected;
        $saveInsp->pdf_filename = 'n/a';
        $saveInsp->created_date = date('Y-m-d H:i:s');
        $saveInsp->save();
        $inspectionId = $saveInsp->id;

        if (!$saveInsp) {
            return response()->json(['success' => "0", 'message' => 'Data not saved.', 'code' => 400]);
        }

        $saveTForm = new ProgressForm();
        $saveTForm->fk_user_id = $user->user_id;
        $saveTForm->fk_forms_id = $form_id;
        $saveTForm->fk_property_id = $property_id;
        $saveTForm->property_surveyors_id = $property_surveyors_id;
        $saveTForm->note = $request->note;

        for ($i = 1; $i <= 10; $i++) {
            $photos_key = 'photos' . $i;
            if ($request->hasFile($photos_key)) {
                $imageName = $this->imgFunctionGlobal($request->file($photos_key));
                $saveTForm->$photos_key = $imageName;
            } else {
                $saveTForm->$photos_key = "";
            }
        }

        $saveTForm->fk_inspection_id = $inspectionId;
        $saveTForm->type = $request->type;
        $saveTForm->save();

        if (!$saveTForm) {
            return response()->json(['success' => "0", 'message' => 'Inspection created but form not saved.', 'code' => 400]);
        }

        $updateInsp = Inspections::find($inspectionId);
        if ($request->file('images_signature')) {
            $year = date('Y');
            $month = date('m');
            if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
            } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                    mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                }
            }
            $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
            $photo = $request->file('images_signature');
            $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
            $photo->move(public_path($image_path), $imageName);
            $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
        }
        $updateInsp->update();

        $save = PropertySurveyor::find($property_surveyors_id);
        $save->today_date_status = 1;
        $save->update();

        $response = test_method($updateInsp->id);

        return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
    }
    // public function ProggressFormSave(Request $request)
    // {
    //     ini_set('max_execution_time', 0);
    //     ini_set('memory_limit', '-1');
    //     $user = auth()->user();
    //     if($user){
    //         $property_id = $request->property_id;
    //         $property_surveyors_id = $request->property_surveyors_id;
    //         $form_id = $request->form_id;
    //         $name = $request->name;
    //         $date_inspected = date('Y-m-d',strtotime($request->date_inspected));

    //         $saveInsp = new Inspections();
    //         $saveInsp->fk_user_id = $user->user_id;
    //         $saveInsp->fk_forms_id = $form_id;
    //         $saveInsp->fk_property_id = $property_id;
    //         $saveInsp->property_surveyors_id = $property_surveyors_id;
    //         $saveInsp->name = $name;
    //         $saveInsp->contractor_name = "";
    //         $saveInsp->contractor_signature = "";
    //         $saveInsp->date_inspected = $date_inspected;
    //         $saveInsp->pdf_filename = 'n/a';
    //       $saveInsp->created_date = date('Y-m-d H:i:s');
    //         $saveInsp->save();
    //         $inspectionId = $saveInsp->id;
    //         if($saveInsp){
    //             $saveTForm = new ProgressForm();
    //             $saveTForm->fk_user_id = $user->user_id;
    //             $saveTForm->fk_forms_id = $request->form_id;
    //             $saveTForm->fk_property_id = $property_id;
    //             $saveTForm->property_surveyors_id = $property_surveyors_id;
    //             $saveTForm->note = $request->note;
    //             if ($request->photos1 != "" && sizeOf(json_decode($request->photos1))) {
    //                 $imageName1 = $this->imageWork($request->photos1);
    //                 $saveTForm->photos1 = $imageName1;
    //             } else {
    //                 $saveTForm->photos1 = "";
    //             }
    //             if ($request->photos2 != "" && sizeOf(json_decode($request->photos2))) {
    //                 $imageName2 = $this->imageWork($request->photos2);
    //                 $saveTForm->photos2 = $imageName2;
    //             } else {
    //                 $saveTForm->photos2 = "";
    //             }
    //             if ($request->photos3 != "" && sizeOf(json_decode($request->photos3))) {
    //                 $imageName3 = $this->imageWork($request->photos3);
    //                 $saveTForm->photos3 = $imageName3;
    //             } else {
    //                 $saveTForm->photos3 = "";
    //             }
    //             if ($request->photos4 != "" && sizeOf(json_decode($request->photos4))) {
    //                 $imageName4 = $this->imageWork($request->photos4);
    //                 $saveTForm->photos4 = $imageName4;
    //             } else {
    //                 $saveTForm->photos4 = "";
    //             }
    //             if ($request->photos5 != "" && sizeOf(json_decode($request->photos5))) {
    //                 $imageName5 = $this->imageWork($request->photos5);
    //                 $saveTForm->photos5 = $imageName5;
    //             } else {
    //                 $saveTForm->photos5 = "";
    //             }
    //             if ($request->photos6 != "" && sizeOf(json_decode($request->photos6))) {
    //                 $imageName6 = $this->imageWork($request->photos6);
    //                 $saveTForm->photos6 = $imageName6;
    //             } else {
    //                 $saveTForm->photos6 = "";
    //             }
    //             if ($request->photos7 != "" && sizeOf(json_decode($request->photos7))) {
    //                 $imageName7 = $this->imageWork($request->photos7);
    //                 $saveTForm->photos7 = $imageName7;
    //             } else {
    //                 $saveTForm->photos7 = "";
    //             }
    //             if ($request->photos8 != "" && sizeOf(json_decode($request->photos8))) {
    //                 $imageName8 = $this->imageWork($request->photos8);
    //                 $saveTForm->photos8 = $imageName8;
    //             } else {
    //                 $saveTForm->photos8 = "";
    //             }
    //             if ($request->photos9 != "" && sizeOf(json_decode($request->photos9))) {
    //                 $imageName9 = $this->imageWork($request->photos9);
    //                 $saveTForm->photos9 = $imageName9;
    //             } else {
    //                 $saveTForm->photos9 = "";
    //             }
    //             if ($request->photos10 != "" && sizeOf(json_decode($request->photos10))) {
    //                 $imageName10 = $this->imageWork($request->photos10);
    //                 $saveTForm->photos10 = $imageName10;
    //             } else {
    //                 $saveTForm->photos10 = "";
    //             }
    //             $saveTForm->fk_inspection_id = $inspectionId;
    //             $saveTForm->type = $request->type;
    //             $saveTForm->save();
    //             if($saveTForm){
    //                 $updateInsp = Inspections::find($inspectionId);
    //                 if ($request->file('images_signature')) {
    //                     $year = date('Y');
    //                     $month = date('m');
    //                     if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
    //                         mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
    //                     } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
    //                         if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
    //                             mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
    //                         }
    //                     }
    //                     $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
    //                     $photo = $request->file('images_signature');
    //                     $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
    //                     $photo->move(public_path($image_path), $imageName);
    //                     $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
    //                 }
    //                 $updateInsp->update();
    //                 if ($updateInsp) {
    //                     $save = PropertySurveyor::find($property_surveyors_id);
    //                     $save->today_date_status = 1;
    //                     $save->update();

    //                     $response = test_method($updateInsp->id);
    //                     return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
    //                 } else {
    //                     return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 400]);
    //                 }
    //             }else{
    //                 return response()->json(['success' => "1", 'message' => 'Inspection created but form not saved.', 'code' => 400]);
    //             }

    //         }else{
    //             return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
    //         }
    //     } else {
    //         return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
    //     }
    // }
    // public function piFormSave(Request $request)
    // {
    //     ini_set('max_execution_time', 0);
    //     ini_set('memory_limit', '-1');
    //     $user = auth()->user();
    //     if($user)
    //     {
    //         $property_surveyors_id = $request->property_surveyors_id;
    //         $property_id = $request->property_id;
    //         $form_id = $request->form_id;
    //         $form_status = $request->form_status;

    //         $saveInsp = new Inspections();
    //         $saveInsp->fk_user_id = $user->user_id;
    //         $saveInsp->fk_forms_id = $form_id;
    //         $saveInsp->fk_property_id = $property_id;
    //         $saveInsp->property_surveyors_id = $property_surveyors_id;
    //         $saveInsp->name = $request->name;
    //         $saveInsp->contractor_name = "";
    //         $saveInsp->contractor_signature = "";
    //         $saveInsp->date_inspected = $request->date_inspected;
    //         $saveInsp->pdf_filename = 'n/a';
    //       $saveInsp->created_date = date('Y-m-d H:i:s');
    //         $saveInsp->save();

    //         $inspectionId = $saveInsp->id;

    //         if($saveInsp){
    //             $addPhoNote = $addPropD = $addAtIn = $addBuDe = $addDrawPho = $addExtIn = $addExtIn2 = $addGrantT = $addGrantD = $addHeatUp = $addWallIn = $addIternalIns= [];
    //             $addPhoNote = json_decode($request->additional_photo_note);
    //             $addPropD   = json_decode($request->additional_prop_detail);
    //             $addAtIn    = json_decode($request->attic_insulation);
    //             $addBuDe    = json_decode($request->builiding_details);
    //             $addDrawPho = json_decode($request->draw_photo);
    //             $addExtIn   = json_decode($request->extr_install);
    //             $addExtIn2  = json_decode($request->extr_install2);
    //             $addGrantT  = json_decode($request->grant_total);
    //             $addGrantD  = json_decode($request->grant_details);
    //             $addHeatUp  = json_decode($request->heating_upgrade);
    //             $addWallIn  = json_decode($request->wall_insulation);
    //             $addIternalIns  = json_decode($request->iternal_insulation);

    //             foreach($addPhoNote as $arr){
    //                 $saveaddPhoNote = new PiAdditionalNote();
    //                 $saveaddPhoNote->fk_user_id = $user->user_id;
    //                 $saveaddPhoNote->fk_forms_id = $form_id;
    //                 $saveaddPhoNote->fk_property_id = $property_id;
    //                 $saveaddPhoNote->property_surveyors_id = $property_surveyors_id;
    //                 $saveaddPhoNote->fk_inspection_id = $inspectionId;
    //                 $saveaddPhoNote->notes = $arr->note;
    //                 if ($arr->image1 != "null" && sizeOf(json_decode($arr->image1))) {
    //                     $imageName1 = $this->imageWork($arr->image1);
    //                     $saveaddPhoNote->image1 = $imageName1;
    //                 } else {
    //                     $saveaddPhoNote->image1 = "";
    //                 }
    //                 if ($arr->image2 != "null" && sizeOf(json_decode($arr->image2))) {
    //                     $imageName2 = $this->imageWork($arr->image2);
    //                     $saveaddPhoNote->image2 = $imageName2;
    //                 } else {
    //                     $saveaddPhoNote->image2 = "";
    //                 }
    //                 if ($arr->image3 != "null" && sizeOf(json_decode($arr->image3))) {
    //                     $imageName3 = $this->imageWork($arr->image3);
    //                     $saveaddPhoNote->image3 = $imageName3;
    //                 } else {
    //                     $saveaddPhoNote->image3 = "";
    //                 }
    //                 if ($arr->image4 != "null" && sizeOf(json_decode($arr->image4))) {
    //                     $imageName4 = $this->imageWork($arr->image4);
    //                     $saveaddPhoNote->image4 = $imageName4;
    //                 } else {
    //                     $saveaddPhoNote->image4 = "";
    //                 }
    //                 if ($arr->image5 != "null" && sizeOf(json_decode($arr->image5))) {
    //                     $imageName5 = $this->imageWork($arr->image5);
    //                     $saveaddPhoNote->image5 = $imageName5;
    //                 } else {
    //                     $saveaddPhoNote->image5 = "";
    //                 }
    //                 $saveaddPhoNote->save();
    //             }

    //             foreach($addPropD as $arr2){
    //                 $saveAddPropD = new PiAdditionalproperty();
    //                 $saveAddPropD->fk_user_id = $user->user_id;
    //                 $saveAddPropD->fk_forms_id = $form_id;
    //                 $saveAddPropD->fk_property_id = $property_id;
    //                 $saveAddPropD->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddPropD->fk_inspection_id = $inspectionId;
    //                 $saveAddPropD->additional_note = $arr2->note;
    //                 if ($arr2->image1 != "null" && sizeOf(json_decode($arr2->image1))) {
    //                     $imageName1 = $this->imageWork($arr2->image1);
    //                     $saveAddPropD->image1 = $imageName1;
    //                 } else {
    //                     $saveAddPropD->image1 = "";
    //                 }
    //                 if ($arr2->image2 != "null" && sizeOf(json_decode($arr2->image2))) {
    //                     $imageName2 = $this->imageWork($arr2->image2);
    //                     $saveAddPropD->image2 = $imageName2;
    //                 } else {
    //                     $saveAddPropD->image2 = "";
    //                 }
    //                 if ($arr2->image3 != "null" && sizeOf(json_decode($arr2->image3))) {
    //                     $imageName3 = $this->imageWork($arr2->image3);
    //                     $saveAddPropD->image3 = $imageName3;
    //                 } else {
    //                     $saveAddPropD->image3 = "";
    //                 }
    //                 if ($arr2->image4 != "null" && sizeOf(json_decode($arr2->image4))) {
    //                     $imageName4 = $this->imageWork($arr2->image4);
    //                     $saveAddPropD->image4 = $imageName4;
    //                 } else {
    //                     $saveAddPropD->image4 = "";
    //                 }
    //                 if ($arr2->image5 != "null" && sizeOf(json_decode($arr2->image5))) {
    //                     $imageName5 = $this->imageWork($arr2->image5);
    //                     $saveAddPropD->image5 = $imageName5;
    //                 } else {
    //                     $saveAddPropD->image5 = "";
    //                 }
    //                 $saveAddPropD->save();
    //             }
    //             foreach($addBuDe as $arr3){
    //                 $saveAddBuDe = new PiBuildingDetail();
    //                 $saveAddBuDe->fk_user_id = $user->user_id;
    //                 $saveAddBuDe->fk_forms_id = $form_id;
    //                 $saveAddBuDe->fk_property_id = $property_id;
    //                 $saveAddBuDe->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddBuDe->fk_inspection_id = $inspectionId;
    //                 $saveAddBuDe->appropriate_tick_box = $arr3->checked_text;
    //                 $saveAddBuDe->others_data = $arr3->other;
    //                 if ($arr3->image1 != "null" && sizeOf(json_decode($arr3->image1))) {
    //                     $imageName1 = $this->imageWork($arr3->image1);
    //                     $saveAddBuDe->image1 = $imageName1;
    //                 } else {
    //                     $saveAddBuDe->image1 = "";
    //                 }
    //                 if ($arr3->image2 != "null" && sizeOf(json_decode($arr3->image2))) {
    //                     $imageName2 = $this->imageWork($arr3->image2);
    //                     $saveAddBuDe->image2 = $imageName2;
    //                 } else {
    //                     $saveAddBuDe->image2 = "";
    //                 }
    //                 if ($arr3->image3 != "null" && sizeOf(json_decode($arr3->image3))) {
    //                     $imageName3 = $this->imageWork($arr3->image3);
    //                     $saveAddBuDe->image3 = $imageName3;
    //                 } else {
    //                     $saveAddBuDe->image3 = "";
    //                 }
    //                 if ($arr3->image4 != "null" && sizeOf(json_decode($arr3->image4))) {
    //                     $imageName4 = $this->imageWork($arr3->image4);
    //                     $saveAddBuDe->image4 = $imageName4;
    //                 } else {
    //                     $saveAddBuDe->image4 = "";
    //                 }
    //                 if ($arr3->image5 != "null" && sizeOf(json_decode($arr3->image5))) {
    //                     $imageName5 = $this->imageWork($arr3->image5);
    //                     $saveAddBuDe->image5 = $imageName5;
    //                 } else {
    //                     $saveAddBuDe->image5 = "";
    //                 }
    //                 $saveAddBuDe->save();
    //             }
    //             foreach($addAtIn as $arr4){
    //                 $saveAddAtIn = new PiAtticInsulation();
    //                 $saveAddAtIn->fk_user_id = $user->user_id;
    //                 $saveAddAtIn->fk_forms_id = $form_id;
    //                 $saveAddAtIn->fk_property_id = $property_id;
    //                 $saveAddAtIn->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddAtIn->fk_inspection_id = $inspectionId;
    //                 $saveAddAtIn->attic_floor_4 = $arr4->attic_floor_4;
    //                 $saveAddAtIn->attic_floor_8 = $arr4->attic_floor_8;
    //                 $saveAddAtIn->attic_floor_12 = $arr4->attic_floor_12;
    //                 $saveAddAtIn->attic_floor_comment = $arr4->attic_floor_comment;
    //                 $saveAddAtIn->foamlok_5_6 = $arr4->foamlok_5_6;
    //                 $saveAddAtIn->foamlok_comment = $arr4->foamlok_comment;
    //                 $saveAddAtIn->basf_walltite_qty = $arr4->basf_walltite_qty;
    //                 $saveAddAtIn->basf_walltite_comment = $arr4->basf_walltite_comment;
    //                 $saveAddAtIn->retro_roof_sprayfoam_qty = $arr4->retro_roof_sprayfoam_qty;
    //                 $saveAddAtIn->retro_roof_sprayfoam_comment = $arr4->retro_roof_sprayfoam_comment;
    //                 $saveAddAtIn->soffit_vents_qty = $arr4->soffit_vents_qty;
    //                 $saveAddAtIn->soffit_vents_comment = $arr4->soffit_vents_comment;
    //                 $saveAddAtIn->roof_tile_vents_qty = $arr4->roof_tile_vents_qty;
    //                 $saveAddAtIn->roof_tile_vents_comment = $arr4->roof_tile_vents_comment;
    //                 $saveAddAtIn->wooden_attic_ladder_with_hood_qty = $arr4->wooden_attic_ladder_with_hood_qty;
    //                 $saveAddAtIn->wooden_attic_ladder_with_hood_comment = $arr4->wooden_attic_ladder_with_hood_comment;
    //                 $saveAddAtIn->remove_existing_floor_qty = $arr4->remove_existing_floor_qty;
    //                 $saveAddAtIn->remove_existing_floor_comment = $arr4->remove_existing_floor_comment;
    //                 $saveAddAtIn->raised_floor_space_qty = $arr4->raised_floor_space_qty;
    //                 $saveAddAtIn->raised_floor_space_comment = $arr4->raised_floor_space_comment;
    //                 $saveAddAtIn->attic_light_qty = $arr4->attic_light_qty;
    //                 $saveAddAtIn->attic_light_comment = $arr4->attic_light_comment;
    //                 if ($arr4->image1 != "null" && sizeOf(json_decode($arr4->image1))) {
    //                     $imageName1 = $this->imageWork($arr4->image1);
    //                     $saveAddAtIn->image1 = $imageName1;
    //                 } else {
    //                     $saveAddAtIn->image1 = "";
    //                 }
    //                 if ($arr4->image2 != "null" && sizeOf(json_decode($arr4->image2))) {
    //                     $imageName2 = $this->imageWork($arr4->image2);
    //                     $saveAddAtIn->image2 = $imageName2;
    //                 } else {
    //                     $saveAddAtIn->image2 = "";
    //                 }
    //                 if ($arr4->image3 != "null" && sizeOf(json_decode($arr4->image3))) {
    //                     $imageName3 = $this->imageWork($arr4->image3);
    //                     $saveAddAtIn->image3 = $imageName3;
    //                 } else {
    //                     $saveAddAtIn->image3 = "";
    //                 }
    //                 if ($arr4->image4 != "null" && sizeOf(json_decode($arr4->image4))) {
    //                     $imageName4 = $this->imageWork($arr4->image4);
    //                     $saveAddAtIn->image4 = $imageName4;
    //                 } else {
    //                     $saveAddAtIn->image4 = "";
    //                 }
    //                 if ($arr4->image5 != "null" && sizeOf(json_decode($arr4->image5))) {
    //                     $imageName5 = $this->imageWork($arr4->image5);
    //                     $saveAddAtIn->image5 = $imageName5;
    //                 } else {
    //                     $saveAddAtIn->image5 = "";
    //                 }
    //                 $saveAddAtIn->save();

    //                 // $saveAddAtIn->save();
    //             }
    //             foreach($addExtIn as $arr5){
    //                 $saveAddExtIn = new PiExternalOne();
    //                 $saveAddExtIn->fk_user_id = $user->user_id;
    //                 $saveAddExtIn->fk_forms_id = $form_id;
    //                 $saveAddExtIn->fk_property_id = $property_id;
    //                 $saveAddExtIn->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddExtIn->fk_inspection_id = $inspectionId;
    //                 $saveAddExtIn->house_type = $arr5->checked_text;
    //                 $saveAddExtIn->house_type_other = $arr5->other;
    //                 $saveAddExtIn->wall_type1 = $arr5->wallType1;
    //                 $saveAddExtIn->wall_width1 = $arr5->wallWidht1;
    //                 $saveAddExtIn->wall_type2 = $arr5->wallType2;
    //                 $saveAddExtIn->wall_width2 = $arr5->wallWidht2;
    //                 $saveAddExtIn->render_type1 = $arr5->renderType1;
    //                 $saveAddExtIn->condition1 = $arr5->renderTypeRadio1;
    //                 $saveAddExtIn->render_type2 = $arr5->renderType2;
    //                 $saveAddExtIn->condition2 = $arr5->renderTypeRadio2;
    //                 $saveAddExtIn->original_dwelling = $arr5->originalDwelling;
    //                 $saveAddExtIn->extension1 = $arr5->extension1;
    //                 $saveAddExtIn->extension2 = $arr5->extension2;
    //                 $saveAddExtIn->over_cill_required = $arr5->radio1;
    //                 $saveAddExtIn->eve_trims_required = $arr5->radio2;
    //                 $saveAddExtIn->eve_vents_no_maintain_installed = $arr5->radio3;
    //                 $saveAddExtIn->wall_vents_no_maintain_installed = $arr5->radio4;
    //                 $saveAddExtIn->plinth_vents_no_maintain_installed = $arr5->radio5;
    //                 $saveAddExtIn->esb_vents_no_re_clipped_in_conduit = $arr5->radio6;
    //                 $saveAddExtIn->flue_vents_no_maintain_installed = $arr5->radio7;
    //                 $saveAddExtIn->down_pipes_refitted_replace = $arr5->radio8;
    //                 $saveAddExtIn->fense_gates_refitted_replace = $arr5->radio9;
    //                 $saveAddExtIn->telecom_cables_re_clipped_in_conduit = $arr5->radio10;
    //                 $saveAddExtIn->alarm_box_reinstated_refitted = $arr5->radio11;
    //                 $saveAddExtIn->satelite_dish_maintain_installed = $arr5->radio12;
    //                 $saveAddExtIn->hanging_basket_reinstated_refitted = $arr5->radio13;
    //                 $saveAddExtIn->wall_trellis_reinstated_refitted = $arr5->radio14;
    //                 $saveAddExtIn->other_reinstated_refitted = $arr5->notes15;
    //                 $saveAddExtIn->other_reinstated_refitted_yes_no = $arr5->radio15;
    //                 $saveAddExtIn->other_reinstated_refitted2 = $arr5->notes16;
    //                 $saveAddExtIn->other_reinstated_refitted1_yes_no = $arr5->radio16;
    //                 $saveAddExtIn->notes1 = $arr5->notes1;
    //                 $saveAddExtIn->notes2 = $arr5->notes2;
    //                 $saveAddExtIn->notes3 = $arr5->notes3;
    //                 $saveAddExtIn->notes4 = $arr5->notes4;
    //                 $saveAddExtIn->notes5 = $arr5->notes5;
    //                 $saveAddExtIn->notes6 = $arr5->notes6;
    //                 $saveAddExtIn->notes7 = $arr5->notes7;
    //                 $saveAddExtIn->notes8 = $arr5->notes8;
    //                 $saveAddExtIn->notes9 = $arr5->notes9;
    //                 $saveAddExtIn->notes10 = $arr5->notes10;
    //                 $saveAddExtIn->notes11 = $arr5->notes11;
    //                 $saveAddExtIn->notes12 = $arr5->notes12;
    //                 $saveAddExtIn->notes13 = $arr5->notes13;
    //                 $saveAddExtIn->notes14 = $arr5->notes14;
    //                 if ($arr5->image1 != "null" && sizeOf(json_decode($arr5->image1))) {
    //                     $imageName1 = $this->imageWork($arr5->image1);
    //                     $saveAddExtIn->image1 = $imageName1;
    //                 } else {
    //                     $saveAddExtIn->image1 = "";
    //                 }
    //                 if ($arr5->image2 != "null" && sizeOf(json_decode($arr5->image2))) {
    //                     $imageName2 = $this->imageWork($arr5->image2);
    //                     $saveAddExtIn->image2 = $imageName2;
    //                 } else {
    //                     $saveAddExtIn->image2 = "";
    //                 }
    //                 if ($arr5->image3 != "null" && sizeOf(json_decode($arr5->image3))) {
    //                     $imageName3 = $this->imageWork($arr5->image3);
    //                     $saveAddExtIn->image3 = $imageName3;
    //                 } else {
    //                     $saveAddExtIn->image3 = "";
    //                 }
    //                 if ($arr5->image4 != "null" && sizeOf(json_decode($arr5->image4))) {
    //                     $imageName4 = $this->imageWork($arr5->image4);
    //                     $saveAddExtIn->image4 = $imageName4;
    //                 } else {
    //                     $saveAddExtIn->image4 = "";
    //                 }
    //                 if ($arr5->image5 != "null" && sizeOf(json_decode($arr5->image5))) {
    //                     $imageName5 = $this->imageWork($arr5->image5);
    //                     $saveAddExtIn->image5 = $imageName5;
    //                 } else {
    //                     $saveAddExtIn->image5 = "";
    //                 }
    //                 $saveAddExtIn->save();

    //                 // $saveAddAtIn->save();
    //             }

    //             foreach($addExtIn2 as $arr6){
    //                 $saveAddExtIn2 = new PiExternalTwo();
    //                 $saveAddExtIn2->fk_user_id = $user->user_id;
    //                 $saveAddExtIn2->fk_forms_id = $form_id;
    //                 $saveAddExtIn2->fk_property_id = $property_id;
    //                 $saveAddExtIn2->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddExtIn2->fk_inspection_id = $inspectionId;
    //                 $saveAddExtIn2->insulation_type_depth = $arr6->insulation_type_depth;
    //                 $saveAddExtIn2->finish_render_type_requested = $arr6->finish_render_type_requested;
    //                 $saveAddExtIn2->finish_reveal_type_requested = $arr6->finish_reveal_type_requested;
    //                 $saveAddExtIn2->wall_width2 = $arr6->wall_width2;
    //                 $saveAddExtIn2->health_safety_issues_access_issues = $arr6->health_safety_issues_access_issues;
    //                 $saveAddExtIn2->fire_barriers_vertical_horizontal = $arr6->fire_barriers_vertical_horizontal;
    //                 $saveAddExtIn2->fire_sepration_requirements_at_betoiic = $arr6->fire_sepration_requirements_at_betoiic;
    //                 $saveAddExtIn2->exposure_to_heat_barbeque_bonfire = $arr6->exposure_to_heat_barbeque_bonfire;
    //                 $saveAddExtIn2->abutments_boundary_wall_treatments = $arr6->abutments_boundary_wall_treatments;
    //                 $saveAddExtIn2->confirm_existing_wall_insulation = $arr6->confirm_existing_wall_insulation;
    //                 $saveAddExtIn2->confirm_finished_floor_dpc_level = $arr6->confirm_finished_floor_dpc_level;
    //                 $saveAddExtIn2->evidense_of_exception_dampness_in_or_on_walls = $arr6->evidense_of_exception_dampness_in_or_on_walls;
    //                 $saveAddExtIn2->plant_growth_or_fungi_on_wall_surfaces = $arr6->plant_growth_or_fungi_on_wall_surfaces;
    //                 $saveAddExtIn2->adequency_of_root_overhangs = $arr6->adequency_of_root_overhangs;
    //                 $saveAddExtIn2->decorative_features_on_wall_surface = $arr6->decorative_features_on_wall_surface;
    //                 $saveAddExtIn2->cill_reveal_threshold_condition = $arr6->cill_reveal_threshold_condition;
    //                 $saveAddExtIn2->surface_render_paint_condition = $arr6->surface_render_paint_condition;
    //                 $saveAddExtIn2->details_of_abutting_roofs = $arr6->details_of_abutting_roofs;
    //                 $saveAddExtIn2->esb_gas_telecoms_cables_if_applicable = $arr6->esb_gas_telecoms_cables_if_applicable;
    //                 $saveAddExtIn2->treatments_to_cavity_hollow_block_wall_cavity_closer = $arr6->treatments_to_cavity_hollow_block_wall_cavity_closer;
    //                 $saveAddExtIn2->existing_cracks = $arr6->existing_cracks;
    //                 $saveAddExtIn2->existing_render_defects = $arr6->existing_render_defects;
    //                 $saveAddExtIn2->other_exceptional_items = $arr6->other_exceptional_items;
    //                 $saveAddExtIn2->walls = $arr6->walls;
    //                 $saveAddExtIn2->floor = $arr6->floor;
    //                 $saveAddExtIn2->attics = $arr6->attics;
    //                 $saveAddExtIn2->planning_permission_if_applicable_consult_pw_thermal_building_so = $arr6->planning_permission_if_applicable_consult_pw_thermal_building_so;
    //                 $saveAddExtIn2->chimneys_and_flues = $arr6->chimneys_and_flues;
    //                 $saveAddExtIn2->structure_fixing_awnings_clothes_lines = $arr6->structure_fixing_awnings_clothes_lines;
    //                 $saveAddExtIn2->earth_rod_boxes = $arr6->earth_rod_boxes;
    //                 $saveAddExtIn2->other_items_of_concern = $arr6->other_items_of_concern;
    //                 if ($arr6->front_elevations != "null" && sizeOf(json_decode($arr6->front_elevations))) {
    //                     $front_elevations1 = $this->imageWork($arr6->front_elevations);
    //                     $saveAddExtIn2->front_elevations = $front_elevations1;
    //                 } else {
    //                     $saveAddExtIn2->front_elevations = "";
    //                 }
    //                 if ($arr6->image1 != "null" && sizeOf(json_decode($arr6->image1))) {
    //                     $imageName1 = $this->imageWork($arr6->image1);
    //                     $saveAddExtIn2->image1 = $imageName1;
    //                 } else {
    //                     $saveAddExtIn2->image1 = "";
    //                 }
    //                 if ($arr6->image2 != "null" && sizeOf(json_decode($arr6->image2))) {
    //                     $imageName2 = $this->imageWork($arr6->image2);
    //                     $saveAddExtIn2->image2 = $imageName2;
    //                 } else {
    //                     $saveAddExtIn2->image2 = "";
    //                 }
    //                 if ($arr6->image3 != "null" && sizeOf(json_decode($arr6->image3))) {
    //                     $imageName3 = $this->imageWork($arr6->image3);
    //                     $saveAddExtIn2->image3 = $imageName3;
    //                 } else {
    //                     $saveAddExtIn2->image3 = "";
    //                 }
    //                 if ($arr6->image4 != "null" && sizeOf(json_decode($arr6->image4))) {
    //                     $imageName4 = $this->imageWork($arr6->image4);
    //                     $saveAddExtIn2->image4 = $imageName4;
    //                 } else {
    //                     $saveAddExtIn2->image4 = "";
    //                 }
    //                 if ($arr6->image5 != "null" && sizeOf(json_decode($arr6->image5))) {
    //                     $imageName5 = $this->imageWork($arr6->image5);
    //                     $saveAddExtIn2->image5 = $imageName5;
    //                 } else {
    //                     $saveAddExtIn2->image5 = "";
    //                 }
    //                 $saveAddExtIn2->save();

    //                 // $saveAddAtIn->save();
    //             }
    //             foreach($addDrawPho as $arr7){
    //                 $saveAddDrawPho = new PiDrawAndPhoto();
    //                 $saveAddDrawPho->fk_user_id = $user->user_id;
    //                 $saveAddDrawPho->fk_forms_id = $form_id;
    //                 $saveAddDrawPho->fk_property_id = $property_id;
    //                 $saveAddDrawPho->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddDrawPho->fk_inspection_id = $inspectionId;
    //                 $saveAddDrawPho->completed_attached = $arr7->radio1;
    //                 $saveAddDrawPho->photographs_been_taken = $arr7->radio2;
    //                 $saveAddDrawPho->additional_risks_notes = $arr7->note;
    //                 if ($arr7->image1 != "null" && sizeOf(json_decode($arr7->image1))) {
    //                     $imageName1 = $this->imageWork($arr7->image1);
    //                     $saveAddDrawPho->plan_view = $imageName1;
    //                 } else {
    //                     $saveAddDrawPho->plan_view = "";
    //                 }
    //                 if ($arr7->image2 != "null" && sizeOf(json_decode($arr7->image2))) {
    //                     $imageName2 = $this->imageWork($arr7->image2);
    //                     $saveAddDrawPho->front_elevations = $imageName2;
    //                 } else {
    //                     $saveAddDrawPho->front_elevations = "";
    //                 }
    //                 if ($arr7->image3 != "null" && sizeOf(json_decode($arr7->image3))) {
    //                     $imageName3 = $this->imageWork($arr7->image3);
    //                     $saveAddDrawPho->rear_elevations = $imageName3;
    //                 } else {
    //                     $saveAddDrawPho->rear_elevations = "";
    //                 }
    //                 if ($arr7->image4 != "null" && sizeOf(json_decode($arr7->image4))) {
    //                     $imageName4 = $this->imageWork($arr7->image4);
    //                     $saveAddDrawPho->gable_elevations1 = $imageName4;
    //                 } else {
    //                     $saveAddDrawPho->gable_elevations1 = "";
    //                 }
    //                 if ($arr7->image5 != "null" && sizeOf(json_decode($arr7->image5))) {
    //                     $imageName5 = $this->imageWork($arr7->image5);
    //                     $saveAddDrawPho->gable_elevations2 = $imageName5;
    //                 } else {
    //                     $saveAddDrawPho->gable_elevations2 = "";
    //                 }
    //                 if ($arr7->image6 != "null" && sizeOf(json_decode($arr7->image6))) {
    //                     $imageName6 = $this->imageWork($arr7->image6);
    //                     $saveAddDrawPho->gable_elevations3 = $imageName6;
    //                 } else {
    //                     $saveAddDrawPho->gable_elevations3 = "";
    //                 }
    //                 $saveAddDrawPho->save();
    //             }

    //             foreach($addGrantT as $arr8){
    //                 $saveAddGrantT = new PiGrantTotal();
    //                 $saveAddGrantT->fk_user_id = $user->user_id;
    //                 $saveAddGrantT->fk_forms_id = $form_id;
    //                 $saveAddGrantT->fk_property_id = $property_id;
    //                 $saveAddGrantT->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddGrantT->fk_inspection_id = $inspectionId;
    //                 $saveAddGrantT->subtotal = $arr8->subtotal;
    //                 $saveAddGrantT->vat = $arr8->vat;
    //                 $saveAddGrantT->price = $arr8->price;
    //                 $saveAddGrantT->grand_total = $arr8->grand_total;
    //                 if ($arr8->image1 != "null" && sizeOf(json_decode($arr8->image1))) {
    //                     $imageName1 = $this->imageWork($arr8->image1);
    //                     $saveAddGrantT->image1 = $imageName1;
    //                 } else {
    //                     $saveAddGrantT->image1 = "";
    //                 }
    //                 if ($arr8->image2 != "null" && sizeOf(json_decode($arr8->image2))) {
    //                     $imageName2 = $this->imageWork($arr8->image2);
    //                     $saveAddGrantT->image2 = $imageName2;
    //                 } else {
    //                     $saveAddGrantT->image2 = "";
    //                 }
    //                 if ($arr8->image3 != "null" && sizeOf(json_decode($arr8->image3))) {
    //                     $imageName3 = $this->imageWork($arr8->image3);
    //                     $saveAddGrantT->image3 = $imageName3;
    //                 } else {
    //                     $saveAddGrantT->image3 = "";
    //                 }
    //                 if ($arr8->image4 != "null" && sizeOf(json_decode($arr8->image4))) {
    //                     $imageName4 = $this->imageWork($arr8->image4);
    //                     $saveAddGrantT->image4 = $imageName4;
    //                 } else {
    //                     $saveAddGrantT->image4 = "";
    //                 }
    //                 if ($arr8->image5 != "null" && sizeOf(json_decode($arr8->image5))) {
    //                     $imageName5 = $this->imageWork($arr8->image5);
    //                     $saveAddGrantT->image5 = $imageName5;
    //                 } else {
    //                     $saveAddGrantT->image5 = "";
    //                 }
    //                 $saveAddGrantT->save();
    //             }

    //             foreach($addGrantD as $arr9){
    //                 $saveAddGrantD = new PiGrantCredit();
    //                 $saveAddGrantD->fk_user_id = $user->user_id;
    //                 $saveAddGrantD->fk_forms_id = $form_id;
    //                 $saveAddGrantD->fk_property_id = $property_id;
    //                 $saveAddGrantD->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddGrantD->fk_inspection_id = $inspectionId;
    //                 $saveAddGrantD->grant_tick = $arr9->grant_tick;
    //                 $saveAddGrantD->energy_credits_tick = $arr9->energy_credits_tick;
    //                 if ($arr9->image1 != "null" && sizeOf(json_decode($arr9->image1))) {
    //                     $imageName1 = $this->imageWork($arr9->image1);
    //                     $saveAddGrantD->image1 = $imageName1;
    //                 } else {
    //                     $saveAddGrantD->image1 = "";
    //                 }
    //                 if ($arr9->image2 != "null" && sizeOf(json_decode($arr9->image2))) {
    //                     $imageName2 = $this->imageWork($arr9->image2);
    //                     $saveAddGrantD->image2 = $imageName2;
    //                 } else {
    //                     $saveAddGrantD->image2 = "";
    //                 }
    //                 if ($arr9->image3 != "null" && sizeOf(json_decode($arr9->image3))) {
    //                     $imageName3 = $this->imageWork($arr9->image3);
    //                     $saveAddGrantD->image3 = $imageName3;
    //                 } else {
    //                     $saveAddGrantD->image3 = "";
    //                 }
    //                 if ($arr9->image4 != "null" && sizeOf(json_decode($arr9->image4))) {
    //                     $imageName4 = $this->imageWork($arr9->image4);
    //                     $saveAddGrantD->image4 = $imageName4;
    //                 } else {
    //                     $saveAddGrantD->image4 = "";
    //                 }
    //                 if ($arr9->image5 != "null" && sizeOf(json_decode($arr9->image5))) {
    //                     $imageName5 = $this->imageWork($arr9->image5);
    //                     $saveAddGrantD->image5 = $imageName5;
    //                 } else {
    //                     $saveAddGrantD->image5 = "";
    //                 }
    //                 $saveAddGrantD->save();
    //             }

    //             foreach($addHeatUp as $arr10){
    //                 $saveAddHeatUp = new PiHeatingUpgrade();
    //                 $saveAddHeatUp->fk_user_id = $user->user_id;
    //                 $saveAddHeatUp->fk_forms_id = $form_id;
    //                 $saveAddHeatUp->fk_property_id = $property_id;
    //                 $saveAddHeatUp->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddHeatUp->fk_inspection_id = $inspectionId;
    //                 $saveAddHeatUp->existing_system = $arr10->existing_system;
    //                 $saveAddHeatUp->remarks = $arr10->remarks;
    //                 $saveAddHeatUp->subtotal = $arr10->subtotal;
    //                 $saveAddHeatUp->vat = $arr10->vat;
    //                 $saveAddHeatUp->price = $arr10->price;
    //                 $saveAddHeatUp->additional_notes = $arr10->additional_notes;
    //                 if ($arr10->image1 != "null" && sizeOf(json_decode($arr10->image1))) {
    //                     $imageName1 = $this->imageWork($arr10->image1);
    //                     $saveAddHeatUp->image1 = $imageName1;
    //                 } else {
    //                     $saveAddHeatUp->image1 = "";
    //                 }
    //                 if ($arr10->image2 != "null" && sizeOf(json_decode($arr10->image2))) {
    //                     $imageName2 = $this->imageWork($arr10->image2);
    //                     $saveAddHeatUp->image2 = $imageName2;
    //                 } else {
    //                     $saveAddHeatUp->image2 = "";
    //                 }
    //                 if ($arr10->image3 != "null" && sizeOf(json_decode($arr10->image3))) {
    //                     $imageName3 = $this->imageWork($arr10->image3);
    //                     $saveAddHeatUp->image3 = $imageName3;
    //                 } else {
    //                     $saveAddHeatUp->image3 = "";
    //                 }
    //                 if ($arr10->image4 != "null" && sizeOf(json_decode($arr10->image4))) {
    //                     $imageName4 = $this->imageWork($arr10->image4);
    //                     $saveAddHeatUp->image4 = $imageName4;
    //                 } else {
    //                     $saveAddHeatUp->image4 = "";
    //                 }
    //                 if ($arr10->image5 != "null" && sizeOf(json_decode($arr10->image5))) {
    //                     $imageName5 = $this->imageWork($arr10->image5);
    //                     $saveAddHeatUp->image5 = $imageName5;
    //                 } else {
    //                     $saveAddHeatUp->image5 = "";
    //                 }
    //                 $saveAddHeatUp->save();
    //             }

    //             foreach($addWallIn as $arr11){
    //                 $saveAddWallIn = new PiWallInsulation();
    //                 $saveAddWallIn->fk_user_id = $user->user_id;
    //                 $saveAddWallIn->fk_forms_id = $form_id;
    //                 $saveAddWallIn->fk_property_id = $property_id;
    //                 $saveAddWallIn->property_surveyors_id = $property_surveyors_id;
    //                 $saveAddWallIn->fk_inspection_id = $inspectionId;
    //                 $saveAddWallIn->wall_insulation_tick = $arr11->checked_text;
    //                 $saveAddWallIn->wall_insulation_other = $arr11->other;
    //                 $saveAddWallIn->no_of_storeys = $arr11->noOfStoreys;
    //                 $saveAddWallIn->measure_of_outer_walls = $arr11->mouterWall;
    //                 $saveAddWallIn->age_of_house = $arr11->ageOfHouse;
    //                 $saveAddWallIn->construction_of_walls = $arr11->constructionOfWalls;
    //                 $saveAddWallIn->rendered_or_protected_areas = $arr11->checked_ren_text;
    //                 $saveAddWallIn->areas_other = $arr11->commentRen;
    //                 $saveAddWallIn->colour = $arr11->colour;
    //                 $saveAddWallIn->building_features = $arr11->radio;
    //                 $saveAddWallIn->building_features_details = $arr11->ifYes;
    //                 $saveAddWallIn->cavity_bead_quantity = $arr11->quality1;
    //                 $saveAddWallIn->cavity_bead_remarks = $arr11->remarks1;
    //                 $saveAddWallIn->cavity_bead_amount = $arr11->currentAmount1;
    //                 $saveAddWallIn->cavity_bead_comments = $arr11->comments1;
    //                 $saveAddWallIn->cavity_block_quantity = $arr11->quality2;
    //                 $saveAddWallIn->cavity_block_remarks = $arr11->remarks2;
    //                 $saveAddWallIn->cavity_block_amount = $arr11->currentAmount2;
    //                 $saveAddWallIn->cavity_block_comments = $arr11->comments2;
    //                 $saveAddWallIn->drylining_quantity = $arr11->quality3;
    //                 $saveAddWallIn->drylining_remarks = $arr11->remarks3;
    //                 $saveAddWallIn->drylining_amount = $arr11->currentAmount3;
    //                 $saveAddWallIn->drylining_comments = $arr11->comments3;
    //                 $saveAddWallIn->external_wrap_quantity = $arr11->quality4;
    //                 $saveAddWallIn->external_wrap_remarks = $arr11->remarks4;
    //                 $saveAddWallIn->external_wrap_amount = $arr11->currentAmount4;
    //                 $saveAddWallIn->external_wrap_comments = $arr11->comments4;
    //                 $saveAddWallIn->core_vents_quantity = $arr11->quality5;
    //                 $saveAddWallIn->core_vents_remarks = $arr11->remarks5;
    //                 $saveAddWallIn->core_vents_amount = $arr11->currentAmount5;
    //                 $saveAddWallIn->core_vents_comments = $arr11->comments5;
    //                 $saveAddWallIn->window_vents_quantity = $arr11->quality6;
    //                 $saveAddWallIn->window_vents_remarks = $arr11->remarks6;
    //                 $saveAddWallIn->window_vents_amount = $arr11->currentAmount6;
    //                 $saveAddWallIn->window_vents_comments = $arr11->comments6;
    //                 if ($arr11->image1 != "null" && sizeOf(json_decode($arr11->image1))) {
    //                     $imageName1 = $this->imageWork($arr11->image1);
    //                     $saveAddWallIn->image1 = $imageName1;
    //                 } else {
    //                     $saveAddWallIn->image1 = "";
    //                 }
    //                 if ($arr11->image2 != "null" && sizeOf(json_decode($arr11->image2))) {
    //                     $imageName2 = $this->imageWork($arr11->image2);
    //                     $saveAddWallIn->image2 = $imageName2;
    //                 } else {
    //                     $saveAddWallIn->image2 = "";
    //                 }
    //                 if ($arr11->image3 != "null" && sizeOf(json_decode($arr11->image3))) {
    //                     $imageName3 = $this->imageWork($arr11->image3);
    //                     $saveAddWallIn->image3 = $imageName3;
    //                 } else {
    //                     $saveAddWallIn->image3 = "";
    //                 }
    //                 if ($arr11->image4 != "null" && sizeOf(json_decode($arr11->image4))) {
    //                     $imageName4 = $this->imageWork($arr11->image4);
    //                     $saveAddWallIn->image4 = $imageName4;
    //                 } else {
    //                     $saveAddWallIn->image4 = "";
    //                 }
    //                 if ($arr11->image5 != "null" && sizeOf(json_decode($arr11->image5))) {
    //                     $imageName5 = $this->imageWork($arr11->image5);
    //                     $saveAddWallIn->image5 = $imageName5;
    //                 } else {
    //                     $saveAddWallIn->image5 = "";
    //                 }
    //                 $saveAddWallIn->save();
    //             }
    //             foreach($addIternalIns as $arr12){
    //                 $saveIIns = new PIIternalInsulation();
    //                 $saveIIns->fk_user_id = $user->user_id;
    //                 $saveIIns->fk_forms_id = $form_id;
    //                 $saveIIns->fk_property_id = $property_id;
    //                 $saveIIns->property_surveyors_id = $property_surveyors_id;
    //                 $saveIIns->fk_inspection_id = $inspectionId;
    //                 $saveIIns->room = $arr12->room;
    //                 $saveIIns->section = $arr12->section;
    //                 $saveIIns->comment = $arr12->comment;
    //                 $saveIIns->imagecomment1 = $arr12->imageComment1;
    //                 $saveIIns->imagecomment2 = $arr12->imageComment2;
    //                 $saveIIns->imagecomment3 = $arr12->imageComment3;
    //                 $saveIIns->imagecomment4 = $arr12->imageComment4;
    //                 $saveIIns->imagecomment5 = $arr12->imageComment5;
    //                 $saveIIns->imagecomment6 = $arr12->imageComment6;
    //                 $saveIIns->imagecomment7 = $arr12->imageComment7;
    //                 $saveIIns->imagecomment8 = $arr12->imageComment8;
    //                 $saveIIns->imagecomment9 = $arr12->imageComment9;
    //                 $saveIIns->imagecomment10 = $arr12->imageComment10;

    //                 if ($arr12->image1 != "" && sizeOf(json_decode($arr12->image1))) {
    //                     $imageName1 = $this->imageWork($arr12->image1);
    //                     $saveIIns->image1 = $imageName1;
    //                 } else {
    //                     $saveIIns->image1 = "";
    //                 }
    //                 if ($arr12->image2 != "" && sizeOf(json_decode($arr12->image2))) {
    //                     $imageName2 = $this->imageWork($arr12->image2);
    //                     $saveIIns->image2 = $imageName2;
    //                 } else {
    //                     $saveIIns->image2 = "";
    //                 }
    //                 if ($arr12->image3 != "" && sizeOf(json_decode($arr12->image3))) {
    //                     $imageName3 = $this->imageWork($arr12->image3);
    //                     $saveIIns->image3 = $imageName3;
    //                 } else {
    //                     $saveIIns->image3 = "";
    //                 }
    //                 if ($arr12->image4 != "" && sizeOf(json_decode($arr12->image4))) {
    //                     $imageName4 = $this->imageWork($arr12->image4);
    //                     $saveIIns->image4 = $imageName4;
    //                 } else {
    //                     $saveIIns->image4 = "";
    //                 }
    //                 if ($arr12->image5 != "" && sizeOf(json_decode($arr12->image5))) {
    //                     $imageName5 = $this->imageWork($arr12->image5);
    //                     $saveIIns->image5 = $imageName5;
    //                 } else {
    //                     $saveIIns->image5 = "";
    //                 }
    //                 if ($arr12->image6 != "" && sizeOf(json_decode($arr12->image6))) {
    //                     $imageName6 = $this->imageWork($arr12->image6);
    //                     $saveIIns->image6 = $imageName6;
    //                 } else {
    //                     $saveIIns->image6 = "";
    //                 }
    //                 if ($arr12->image7 != "" && sizeOf(json_decode($arr12->image7))) {
    //                     $imageName7 = $this->imageWork($arr12->image7);
    //                     $saveIIns->image7 = $imageName7;
    //                 } else {
    //                     $saveIIns->image7 = "";
    //                 }
    //                 if ($arr12->image8 != "" && sizeOf(json_decode($arr12->image8))) {
    //                     $imageName8 = $this->imageWork($arr12->image8);
    //                     $saveIIns->image8 = $imageName8;
    //                 } else {
    //                     $saveIIns->image8 = "";
    //                 }
    //                 if ($arr12->image9 != "" && sizeOf(json_decode($arr12->image9))) {
    //                     $imageName9 = $this->imageWork($arr12->image9);
    //                     $saveIIns->image9 = $imageName9;
    //                 } else {
    //                     $saveIIns->image9 = "";
    //                 }
    //                 if ($arr12->image10 != "" && sizeOf(json_decode($arr12->image10))) {
    //                     $imageName10 = $this->imageWork($arr12->image10);
    //                     $saveIIns->image10 = $imageName10;
    //                 } else {
    //                     $saveIIns->image10 = "";
    //                 }
    //                 $saveIIns->created_date = Carbon::now();
    //                 $saveIIns->save();
    //             }

    //             $updateInsp = Inspections::find($inspectionId);
    //             if ($request->file('images_signature')) {
    //                 $year = date('Y');
    //                 $month = date('m');
    //                 if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
    //                     mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
    //                 } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
    //                     if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
    //                         mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
    //                     }
    //                 }
    //                 $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
    //                 $photo = $request->file('images_signature');
    //                 $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
    //                 $photo->move(public_path($image_path), $imageName);
    //                 $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
    //             }
    //             $updateInsp->update();
    //             if ($updateInsp) {
    //                 $save = PropertySurveyor::find($property_surveyors_id);
    //                 $save->today_date_status = 1;
    //                 $save->update();

    //                 $response = test_method($updateInsp->id);
    //                 return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
    //             } else {
    //                 return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
    //             }
    //         }else{
    //             return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
    //         }
    //     } else {
    //         return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
    //     }
    // }
    public function piFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                $addPhoNote = $addPropD = $addAtIn = $addBuDe = $addDrawPho = $addExtIn = $addExtIn2 = $addGrantT = $addGrantD = $addHeatUp = $addWallIn = $addIternalIns = [];

                $addPhoNote = json_decode($request->additional_photo_note);
                $addPropD = json_decode($request->additional_prop_detail);
                $addAtIn = json_decode($request->attic_insulation);
                $addBuDe = json_decode($request->builiding_details);
                $addDrawPho = json_decode($request->draw_photo);
                $addExtIn = json_decode($request->extr_install);
                $addExtIn2 = json_decode($request->extr_install2);
                $addGrantT = json_decode($request->grant_total);
                $addGrantD = json_decode($request->grant_details);
                $addHeatUp = json_decode($request->heating_upgrade);
                $addWallIn = json_decode($request->wall_insulation);
                $addIternalIns = json_decode($request->iternal_insulation);

                foreach ($addPhoNote as $arr) {
                    $saveaddPhoNote = new PiAdditionalNote();
                    $saveaddPhoNote->fk_user_id = $user->user_id;
                    $saveaddPhoNote->fk_forms_id = $form_id;
                    $saveaddPhoNote->fk_property_id = $property_id;
                    $saveaddPhoNote->property_surveyors_id = $property_surveyors_id;
                    $saveaddPhoNote->fk_inspection_id = $inspectionId;
                    $saveaddPhoNote->notes = $arr->note;
                    if ($request->hasFile('additional_photo_note_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('additional_photo_note_photos1'));
                        $saveaddPhoNote->image1 = $imageName1;
                    } else {
                        $saveaddPhoNote->image1 = "";
                    }
                    if ($request->hasFile('additional_photo_note_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('additional_photo_note_photos2'));
                        $saveaddPhoNote->image2 = $imageName2;
                    } else {
                        $saveaddPhoNote->image2 = "";
                    }
                    if ($request->hasFile('additional_photo_note_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('additional_photo_note_photos3'));
                        $saveaddPhoNote->image3 = $imageName3;
                    } else {
                        $saveaddPhoNote->image3 = "";
                    }
                    if ($request->hasFile('additional_photo_note_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('additional_photo_note_photos4'));
                        $saveaddPhoNote->image4 = $imageName4;
                    } else {
                        $saveaddPhoNote->image4 = "";
                    }
                    if ($request->hasFile('additional_photo_note_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('additional_photo_note_photos5'));
                        $saveaddPhoNote->image5 = $imageName5;
                    } else {
                        $saveaddPhoNote->image5 = "";
                    }
                    $saveaddPhoNote->save();
                }

                foreach ($addPropD as $arr2) {
                    $saveAddPropD = new PiAdditionalproperty();
                    $saveAddPropD->fk_user_id = $user->user_id;
                    $saveAddPropD->fk_forms_id = $form_id;
                    $saveAddPropD->fk_property_id = $property_id;
                    $saveAddPropD->property_surveyors_id = $property_surveyors_id;
                    $saveAddPropD->fk_inspection_id = $inspectionId;
                    $saveAddPropD->additional_note = $arr2->note;
                    if ($request->hasFile('additional_prop_detail_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('additional_prop_detail_photos1'));
                        $saveAddPropD->image1 = $imageName1;
                    } else {
                        $saveAddPropD->image1 = "";
                    }
                    if ($request->hasFile('additional_prop_detail_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('additional_prop_detail_photos2'));
                        $saveAddPropD->image2 = $imageName2;
                    } else {
                        $saveAddPropD->image2 = "";
                    }
                    if ($request->hasFile('additional_prop_detail_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('additional_prop_detail_photos3'));
                        $saveAddPropD->image3 = $imageName3;
                    } else {
                        $saveAddPropD->image3 = "";
                    }
                    if ($request->hasFile('additional_prop_detail_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('additional_prop_detail_photos4'));
                        $saveAddPropD->image4 = $imageName4;
                    } else {
                        $saveAddPropD->image4 = "";
                    }
                    if ($request->hasFile('additional_prop_detail_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('additional_prop_detail_photos5'));
                        $saveAddPropD->image5 = $imageName5;
                    } else {
                        $saveAddPropD->image5 = "";
                    }

                    $saveAddPropD->save();
                }
                foreach ($addBuDe as $arr3) {
                    $saveAddBuDe = new PiBuildingDetail();
                    $saveAddBuDe->fk_user_id = $user->user_id;
                    $saveAddBuDe->fk_forms_id = $form_id;
                    $saveAddBuDe->fk_property_id = $property_id;
                    $saveAddBuDe->property_surveyors_id = $property_surveyors_id;
                    $saveAddBuDe->fk_inspection_id = $inspectionId;
                    $saveAddBuDe->appropriate_tick_box = $arr3->checked_text;
                    $saveAddBuDe->others_data = $arr3->other;
                    if ($request->hasFile('builiding_details_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('builiding_details_photos1'));
                        $saveAddBuDe->image1 = $imageName1;
                    } else {
                        $saveAddBuDe->image1 = "";
                    }
                    if ($request->hasFile('builiding_details_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('builiding_details_photos2'));
                        $saveAddBuDe->image2 = $imageName2;
                    } else {
                        $saveAddBuDe->image2 = "";
                    }
                    if ($request->hasFile('builiding_details_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('builiding_details_photos3'));
                        $saveAddBuDe->image3 = $imageName3;
                    } else {
                        $saveAddBuDe->image3 = "";
                    }
                    if ($request->hasFile('builiding_details_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('builiding_details_photos4'));
                        $saveAddBuDe->image4 = $imageName4;
                    } else {
                        $saveAddBuDe->image4 = "";
                    }
                    if ($request->hasFile('builiding_details_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('builiding_details_photos5'));
                        $saveAddBuDe->image5 = $imageName5;
                    } else {
                        $saveAddBuDe->image5 = "";
                    }

                    $saveAddBuDe->save();
                }
                foreach ($addAtIn as $arr4) {
                    $saveAddAtIn = new PiAtticInsulation();
                    $saveAddAtIn->fk_user_id = $user->user_id;
                    $saveAddAtIn->fk_forms_id = $form_id;
                    $saveAddAtIn->fk_property_id = $property_id;
                    $saveAddAtIn->property_surveyors_id = $property_surveyors_id;
                    $saveAddAtIn->fk_inspection_id = $inspectionId;
                    $saveAddAtIn->attic_floor_4 = $arr4->attic_floor_4;
                    $saveAddAtIn->attic_floor_8 = $arr4->attic_floor_8;
                    $saveAddAtIn->attic_floor_12 = $arr4->attic_floor_12;
                    $saveAddAtIn->attic_floor_comment = $arr4->attic_floor_comment;
                    $saveAddAtIn->foamlok_5_6 = $arr4->foamlok_5_6;
                    $saveAddAtIn->foamlok_comment = $arr4->foamlok_comment;
                    $saveAddAtIn->basf_walltite_qty = $arr4->basf_walltite_qty;
                    $saveAddAtIn->basf_walltite_comment = $arr4->basf_walltite_comment;
                    $saveAddAtIn->retro_roof_sprayfoam_qty = $arr4->retro_roof_sprayfoam_qty;
                    $saveAddAtIn->retro_roof_sprayfoam_comment = $arr4->retro_roof_sprayfoam_comment;
                    $saveAddAtIn->soffit_vents_qty = $arr4->soffit_vents_qty;
                    $saveAddAtIn->soffit_vents_comment = $arr4->soffit_vents_comment;
                    $saveAddAtIn->roof_tile_vents_qty = $arr4->roof_tile_vents_qty;
                    $saveAddAtIn->roof_tile_vents_comment = $arr4->roof_tile_vents_comment;
                    $saveAddAtIn->wooden_attic_ladder_with_hood_qty = $arr4->wooden_attic_ladder_with_hood_qty;
                    $saveAddAtIn->wooden_attic_ladder_with_hood_comment = $arr4->wooden_attic_ladder_with_hood_comment;
                    $saveAddAtIn->remove_existing_floor_qty = $arr4->remove_existing_floor_qty;
                    $saveAddAtIn->remove_existing_floor_comment = $arr4->remove_existing_floor_comment;
                    $saveAddAtIn->raised_floor_space_qty = $arr4->raised_floor_space_qty;
                    $saveAddAtIn->raised_floor_space_comment = $arr4->raised_floor_space_comment;
                    $saveAddAtIn->attic_light_qty = $arr4->attic_light_qty;
                    $saveAddAtIn->attic_light_comment = $arr4->attic_light_comment;
                    if ($request->hasFile('attic_insulation_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('attic_insulation_photos1'));
                        $saveAddAtIn->image1 = $imageName1;
                    } else {
                        $saveAddAtIn->image1 = "";
                    }
                    if ($request->hasFile('attic_insulation_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('attic_insulation_photos2'));
                        $saveAddAtIn->image2 = $imageName2;
                    } else {
                        $saveAddAtIn->image2 = "";
                    }
                    if ($request->hasFile('attic_insulation_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('attic_insulation_photos3'));
                        $saveAddAtIn->image3 = $imageName3;
                    } else {
                        $saveAddAtIn->image3 = "";
                    }
                    if ($request->hasFile('attic_insulation_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('attic_insulation_photos4'));
                        $saveAddAtIn->image4 = $imageName4;
                    } else {
                        $saveAddAtIn->image4 = "";
                    }
                    if ($request->hasFile('attic_insulation_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('attic_insulation_photos5'));
                        $saveAddAtIn->image5 = $imageName5;
                    } else {
                        $saveAddAtIn->image5 = "";
                    }
                    $saveAddAtIn->save();

                    // $saveAddAtIn->save();
                }
                foreach ($addExtIn as $arr5) {
                    $saveAddExtIn = new PiExternalOne();
                    $saveAddExtIn->fk_user_id = $user->user_id;
                    $saveAddExtIn->fk_forms_id = $form_id;
                    $saveAddExtIn->fk_property_id = $property_id;
                    $saveAddExtIn->property_surveyors_id = $property_surveyors_id;
                    $saveAddExtIn->fk_inspection_id = $inspectionId;
                    $saveAddExtIn->house_type = $arr5->checked_text;
                    $saveAddExtIn->house_type_other = $arr5->other;
                    $saveAddExtIn->wall_type1 = $arr5->wallType1;
                    $saveAddExtIn->wall_width1 = $arr5->wallWidht1;
                    $saveAddExtIn->wall_type2 = $arr5->wallType2;
                    $saveAddExtIn->wall_width2 = $arr5->wallWidht2;
                    $saveAddExtIn->render_type1 = $arr5->renderType1;
                    $saveAddExtIn->condition1 = $arr5->renderTypeRadio1;
                    $saveAddExtIn->render_type2 = $arr5->renderType2;
                    $saveAddExtIn->condition2 = $arr5->renderTypeRadio2;
                    $saveAddExtIn->original_dwelling = $arr5->originalDwelling;
                    $saveAddExtIn->extension1 = $arr5->extension1;
                    $saveAddExtIn->extension2 = $arr5->extension2;
                    $saveAddExtIn->over_cill_required = $arr5->radio1;
                    $saveAddExtIn->eve_trims_required = $arr5->radio2;
                    $saveAddExtIn->eve_vents_no_maintain_installed = $arr5->radio3;
                    $saveAddExtIn->wall_vents_no_maintain_installed = $arr5->radio4;
                    $saveAddExtIn->plinth_vents_no_maintain_installed = $arr5->radio5;
                    $saveAddExtIn->esb_vents_no_re_clipped_in_conduit = $arr5->radio6;
                    $saveAddExtIn->flue_vents_no_maintain_installed = $arr5->radio7;
                    $saveAddExtIn->down_pipes_refitted_replace = $arr5->radio8;
                    $saveAddExtIn->fense_gates_refitted_replace = $arr5->radio9;
                    $saveAddExtIn->telecom_cables_re_clipped_in_conduit = $arr5->radio10;
                    $saveAddExtIn->alarm_box_reinstated_refitted = $arr5->radio11;
                    $saveAddExtIn->satelite_dish_maintain_installed = $arr5->radio12;
                    $saveAddExtIn->hanging_basket_reinstated_refitted = $arr5->radio13;
                    $saveAddExtIn->wall_trellis_reinstated_refitted = $arr5->radio14;
                    $saveAddExtIn->other_reinstated_refitted = $arr5->notes15;
                    $saveAddExtIn->other_reinstated_refitted_yes_no = $arr5->radio15;
                    $saveAddExtIn->other_reinstated_refitted2 = $arr5->notes16;
                    $saveAddExtIn->other_reinstated_refitted1_yes_no = $arr5->radio16;
                    $saveAddExtIn->notes1 = $arr5->notes1;
                    $saveAddExtIn->notes2 = $arr5->notes2;
                    $saveAddExtIn->notes3 = $arr5->notes3;
                    $saveAddExtIn->notes4 = $arr5->notes4;
                    $saveAddExtIn->notes5 = $arr5->notes5;
                    $saveAddExtIn->notes6 = $arr5->notes6;
                    $saveAddExtIn->notes7 = $arr5->notes7;
                    $saveAddExtIn->notes8 = $arr5->notes8;
                    $saveAddExtIn->notes9 = $arr5->notes9;
                    $saveAddExtIn->notes10 = $arr5->notes10;
                    $saveAddExtIn->notes11 = $arr5->notes11;
                    $saveAddExtIn->notes12 = $arr5->notes12;
                    $saveAddExtIn->notes13 = $arr5->notes13;
                    $saveAddExtIn->notes14 = $arr5->notes14;
                    if ($request->hasFile('extr_install_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('extr_install_photos1'));
                        $saveAddExtIn->image1 = $imageName1;
                    } else {
                        $saveAddExtIn->image1 = "";
                    }
                    if ($request->hasFile('extr_install_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('extr_install_photos2'));
                        $saveAddExtIn->image2 = $imageName2;
                    } else {
                        $saveAddExtIn->image2 = "";
                    }
                    if ($request->hasFile('extr_install_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('extr_install_photos3'));
                        $saveAddExtIn->image3 = $imageName3;
                    } else {
                        $saveAddExtIn->image3 = "";
                    }
                    if ($request->hasFile('extr_install_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('extr_install_photos4'));
                        $saveAddExtIn->image4 = $imageName4;
                    } else {
                        $saveAddExtIn->image4 = "";
                    }
                    if ($request->hasFile('extr_install_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('extr_install_photos5'));
                        $saveAddExtIn->image5 = $imageName5;
                    } else {
                        $saveAddExtIn->image5 = "";
                    }

                    $saveAddExtIn->save();

                    // $saveAddAtIn->save();
                }

                foreach ($addExtIn2 as $arr6) {
                    $saveAddExtIn2 = new PiExternalTwo();
                    $saveAddExtIn2->fk_user_id = $user->user_id;
                    $saveAddExtIn2->fk_forms_id = $form_id;
                    $saveAddExtIn2->fk_property_id = $property_id;
                    $saveAddExtIn2->property_surveyors_id = $property_surveyors_id;
                    $saveAddExtIn2->fk_inspection_id = $inspectionId;
                    $saveAddExtIn2->insulation_type_depth = $arr6->insulation_type_depth;
                    $saveAddExtIn2->finish_render_type_requested = $arr6->finish_render_type_requested;
                    $saveAddExtIn2->finish_reveal_type_requested = $arr6->finish_reveal_type_requested;
                    $saveAddExtIn2->wall_width2 = $arr6->wall_width2;
                    $saveAddExtIn2->health_safety_issues_access_issues = $arr6->health_safety_issues_access_issues;
                    $saveAddExtIn2->fire_barriers_vertical_horizontal = $arr6->fire_barriers_vertical_horizontal;
                    $saveAddExtIn2->fire_sepration_requirements_at_betoiic = $arr6->fire_sepration_requirements_at_betoiic;
                    $saveAddExtIn2->exposure_to_heat_barbeque_bonfire = $arr6->exposure_to_heat_barbeque_bonfire;
                    $saveAddExtIn2->abutments_boundary_wall_treatments = $arr6->abutments_boundary_wall_treatments;
                    $saveAddExtIn2->confirm_existing_wall_insulation = $arr6->confirm_existing_wall_insulation;
                    $saveAddExtIn2->confirm_finished_floor_dpc_level = $arr6->confirm_finished_floor_dpc_level;
                    $saveAddExtIn2->evidense_of_exception_dampness_in_or_on_walls = $arr6->evidense_of_exception_dampness_in_or_on_walls;
                    $saveAddExtIn2->plant_growth_or_fungi_on_wall_surfaces = $arr6->plant_growth_or_fungi_on_wall_surfaces;
                    $saveAddExtIn2->adequency_of_root_overhangs = $arr6->adequency_of_root_overhangs;
                    $saveAddExtIn2->decorative_features_on_wall_surface = $arr6->decorative_features_on_wall_surface;
                    $saveAddExtIn2->cill_reveal_threshold_condition = $arr6->cill_reveal_threshold_condition;
                    $saveAddExtIn2->surface_render_paint_condition = $arr6->surface_render_paint_condition;
                    $saveAddExtIn2->details_of_abutting_roofs = $arr6->details_of_abutting_roofs;
                    $saveAddExtIn2->esb_gas_telecoms_cables_if_applicable = $arr6->esb_gas_telecoms_cables_if_applicable;
                    $saveAddExtIn2->treatments_to_cavity_hollow_block_wall_cavity_closer = $arr6->treatments_to_cavity_hollow_block_wall_cavity_closer;
                    $saveAddExtIn2->existing_cracks = $arr6->existing_cracks;
                    $saveAddExtIn2->existing_render_defects = $arr6->existing_render_defects;
                    $saveAddExtIn2->other_exceptional_items = $arr6->other_exceptional_items;
                    $saveAddExtIn2->walls = $arr6->walls;
                    $saveAddExtIn2->floor = $arr6->floor;
                    $saveAddExtIn2->attics = $arr6->attics;
                    $saveAddExtIn2->planning_permission_if_applicable_consult_pw_thermal_building_so = $arr6->planning_permission_if_applicable_consult_pw_thermal_building_so;
                    $saveAddExtIn2->chimneys_and_flues = $arr6->chimneys_and_flues;
                    $saveAddExtIn2->structure_fixing_awnings_clothes_lines = $arr6->structure_fixing_awnings_clothes_lines;
                    $saveAddExtIn2->earth_rod_boxes = $arr6->earth_rod_boxes;
                    $saveAddExtIn2->other_items_of_concern = $arr6->other_items_of_concern;

                    if ($request->hasFile('extr_install2_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('extr_install2_photos1'));
                        $saveAddExtIn2->image1 = $imageName1;
                    } else {
                        $saveAddExtIn2->image1 = "";
                    }
                    if ($request->hasFile('extr_install2_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('extr_install2_photos2'));
                        $saveAddExtIn2->image2 = $imageName2;
                    } else {
                        $saveAddExtIn2->image2 = "";
                    }
                    if ($request->hasFile('extr_install2_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('extr_install2_photos3'));
                        $saveAddExtIn2->image3 = $imageName3;
                    } else {
                        $saveAddExtIn2->image3 = "";
                    }
                    if ($request->hasFile('extr_install2_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('extr_install2_photos4'));
                        $saveAddExtIn2->image4 = $imageName4;
                    } else {
                        $saveAddExtIn2->image4 = "";
                    }
                    if ($request->hasFile('extr_install2_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('extr_install2_photos5'));
                        $saveAddExtIn2->image5 = $imageName5;
                    } else {
                        $saveAddExtIn2->image5 = "";
                    }
                    if ($request->hasFile('extr_install2_photos6')) {
                        $imageName6 = $this->imgFunctionGlobal($request->file('extr_install2_photos6'));
                        $saveAddExtIn2->front_elevations = $imageName6;
                    } else {
                        $saveAddExtIn2->front_elevations = "";
                    }

                    $saveAddExtIn2->save();

                    // $saveAddAtIn->save();
                }
                foreach ($addDrawPho as $arr7) {
                    $saveAddDrawPho = new PiDrawAndPhoto();
                    $saveAddDrawPho->fk_user_id = $user->user_id;
                    $saveAddDrawPho->fk_forms_id = $form_id;
                    $saveAddDrawPho->fk_property_id = $property_id;
                    $saveAddDrawPho->property_surveyors_id = $property_surveyors_id;
                    $saveAddDrawPho->fk_inspection_id = $inspectionId;
                    $saveAddDrawPho->completed_attached = $arr7->radio1;
                    $saveAddDrawPho->photographs_been_taken = $arr7->radio2;
                    $saveAddDrawPho->additional_risks_notes = $arr7->note;
                    if ($request->hasFile('draw_photo_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('draw_photo_photos1'));
                        $saveAddDrawPho->plan_view = $imageName1;
                    } else {
                        $saveAddDrawPho->plan_view = "";
                    }
                    if ($request->hasFile('draw_photo_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('draw_photo_photos2'));
                        $saveAddDrawPho->front_elevations = $imageName2;
                    } else {
                        $saveAddDrawPho->front_elevations = "";
                    }
                    if ($request->hasFile('draw_photo_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('draw_photo_photos3'));
                        $saveAddDrawPho->rear_elevations = $imageName3;
                    } else {
                        $saveAddDrawPho->rear_elevations = "";
                    }
                    if ($request->hasFile('draw_photo_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('draw_photo_photos4'));
                        $saveAddDrawPho->gable_elevations1 = $imageName4;
                    } else {
                        $saveAddDrawPho->gable_elevations1 = "";
                    }
                    if ($request->hasFile('draw_photo_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('draw_photo_photos5'));
                        $saveAddDrawPho->gable_elevations2 = $imageName5;
                    } else {
                        $saveAddDrawPho->gable_elevations2 = "";
                    }
                    if ($request->hasFile('draw_photo_photos6')) {
                        $imageName6 = $this->imgFunctionGlobal($request->file('draw_photo_photos6'));
                        $saveAddDrawPho->gable_elevations3 = $imageName6;
                    } else {
                        $saveAddDrawPho->gable_elevations3 = "";
                    }

                    $saveAddDrawPho->save();
                }

                foreach ($addGrantT as $arr8) {
                    $saveAddGrantT = new PiGrantTotal();
                    $saveAddGrantT->fk_user_id = $user->user_id;
                    $saveAddGrantT->fk_forms_id = $form_id;
                    $saveAddGrantT->fk_property_id = $property_id;
                    $saveAddGrantT->property_surveyors_id = $property_surveyors_id;
                    $saveAddGrantT->fk_inspection_id = $inspectionId;
                    $saveAddGrantT->subtotal = $arr8->subtotal;
                    $saveAddGrantT->vat = $arr8->vat;
                    $saveAddGrantT->price = $arr8->price;
                    $saveAddGrantT->grand_total = $arr8->grand_total;
                    if ($request->hasFile('grant_total_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('grant_total_photos1'));
                        $saveAddGrantT->image1 = $imageName1;
                    } else {
                        $saveAddGrantT->image1 = "";
                    }
                    if ($request->hasFile('grant_total_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('grant_total_photos2'));
                        $saveAddGrantT->image2 = $imageName2;
                    } else {
                        $saveAddGrantT->image2 = "";
                    }
                    if ($request->hasFile('grant_total_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('grant_total_photos3'));
                        $saveAddGrantT->image3 = $imageName3;
                    } else {
                        $saveAddGrantT->image3 = "";
                    }
                    if ($request->hasFile('grant_total_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('grant_total_photos4'));
                        $saveAddGrantT->image4 = $imageName4;
                    } else {
                        $saveAddGrantT->image4 = "";
                    }
                    if ($request->hasFile('grant_total_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('grant_total_photos5'));
                        $saveAddGrantT->image5 = $imageName5;
                    } else {
                        $saveAddGrantT->image5 = "";
                    }

                    $saveAddGrantT->save();
                }

                foreach ($addGrantD as $arr9) {
                    $saveAddGrantD = new PiGrantCredit();
                    $saveAddGrantD->fk_user_id = $user->user_id;
                    $saveAddGrantD->fk_forms_id = $form_id;
                    $saveAddGrantD->fk_property_id = $property_id;
                    $saveAddGrantD->property_surveyors_id = $property_surveyors_id;
                    $saveAddGrantD->fk_inspection_id = $inspectionId;
                    $saveAddGrantD->grant_tick = $arr9->grant_tick;
                    $saveAddGrantD->energy_credits_tick = $arr9->energy_credits_tick;
                    if ($request->hasFile('grant_details_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('grant_details_photos1'));
                        $saveAddGrantD->image1 = $imageName1;
                    } else {
                        $saveAddGrantD->image1 = "";
                    }
                    if ($request->hasFile('grant_details_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('grant_details_photos2'));
                        $saveAddGrantD->image2 = $imageName2;
                    } else {
                        $saveAddGrantD->image2 = "";
                    }
                    if ($request->hasFile('grant_details_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('grant_details_photos3'));
                        $saveAddGrantD->image3 = $imageName3;
                    } else {
                        $saveAddGrantD->image3 = "";
                    }
                    if ($request->hasFile('grant_details_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('grant_details_photos4'));
                        $saveAddGrantD->image4 = $imageName4;
                    } else {
                        $saveAddGrantD->image4 = "";
                    }
                    if ($request->hasFile('grant_details_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('grant_details_photos5'));
                        $saveAddGrantD->image5 = $imageName5;
                    } else {
                        $saveAddGrantD->image5 = "";
                    }

                    $saveAddGrantD->save();
                }

                foreach ($addHeatUp as $arr10) {
                    $saveAddHeatUp = new PiHeatingUpgrade();
                    $saveAddHeatUp->fk_user_id = $user->user_id;
                    $saveAddHeatUp->fk_forms_id = $form_id;
                    $saveAddHeatUp->fk_property_id = $property_id;
                    $saveAddHeatUp->property_surveyors_id = $property_surveyors_id;
                    $saveAddHeatUp->fk_inspection_id = $inspectionId;
                    $saveAddHeatUp->existing_system = $arr10->existing_system;
                    $saveAddHeatUp->remarks = $arr10->remarks;
                    $saveAddHeatUp->subtotal = $arr10->subtotal;
                    $saveAddHeatUp->vat = $arr10->vat;
                    $saveAddHeatUp->price = $arr10->price;
                    $saveAddHeatUp->additional_notes = $arr10->additional_notes;
                    if ($request->hasFile('heating_upgrade_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('heating_upgrade_photos1'));
                        $saveAddHeatUp->image1 = $imageName1;
                    } else {
                        $saveAddHeatUp->image1 = "";
                    }
                    if ($request->hasFile('heating_upgrade_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('heating_upgrade_photos2'));
                        $saveAddHeatUp->image2 = $imageName2;
                    } else {
                        $saveAddHeatUp->image2 = "";
                    }
                    if ($request->hasFile('heating_upgrade_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('heating_upgrade_photos3'));
                        $saveAddHeatUp->image3 = $imageName3;
                    } else {
                        $saveAddHeatUp->image3 = "";
                    }
                    if ($request->hasFile('heating_upgrade_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('heating_upgrade_photos4'));
                        $saveAddHeatUp->image4 = $imageName4;
                    } else {
                        $saveAddHeatUp->image4 = "";
                    }
                    if ($request->hasFile('heating_upgrade_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('heating_upgrade_photos5'));
                        $saveAddHeatUp->image5 = $imageName5;
                    } else {
                        $saveAddHeatUp->image5 = "";
                    }

                    $saveAddHeatUp->save();
                }

                foreach ($addWallIn as $arr11) {
                    $saveAddWallIn = new PiWallInsulation();
                    $saveAddWallIn->fk_user_id = $user->user_id;
                    $saveAddWallIn->fk_forms_id = $form_id;
                    $saveAddWallIn->fk_property_id = $property_id;
                    $saveAddWallIn->property_surveyors_id = $property_surveyors_id;
                    $saveAddWallIn->fk_inspection_id = $inspectionId;
                    $saveAddWallIn->wall_insulation_tick = $arr11->checked_text;
                    $saveAddWallIn->wall_insulation_other = $arr11->other;
                    $saveAddWallIn->no_of_storeys = $arr11->noOfStoreys;
                    $saveAddWallIn->measure_of_outer_walls = $arr11->mouterWall;
                    $saveAddWallIn->age_of_house = $arr11->ageOfHouse;
                    $saveAddWallIn->construction_of_walls = $arr11->constructionOfWalls;
                    $saveAddWallIn->rendered_or_protected_areas = $arr11->checked_ren_text;
                    $saveAddWallIn->areas_other = $arr11->commentRen;
                    $saveAddWallIn->colour = $arr11->colour;
                    $saveAddWallIn->building_features = $arr11->radio;
                    $saveAddWallIn->building_features_details = $arr11->ifYes;
                    $saveAddWallIn->cavity_bead_quantity = $arr11->quality1;
                    $saveAddWallIn->cavity_bead_remarks = $arr11->remarks1;
                    $saveAddWallIn->cavity_bead_amount = $arr11->currentAmount1;
                    $saveAddWallIn->cavity_bead_comments = $arr11->comments1;
                    $saveAddWallIn->cavity_block_quantity = $arr11->quality2;
                    $saveAddWallIn->cavity_block_remarks = $arr11->remarks2;
                    $saveAddWallIn->cavity_block_amount = $arr11->currentAmount2;
                    $saveAddWallIn->cavity_block_comments = $arr11->comments2;
                    $saveAddWallIn->drylining_quantity = $arr11->quality3;
                    $saveAddWallIn->drylining_remarks = $arr11->remarks3;
                    $saveAddWallIn->drylining_amount = $arr11->currentAmount3;
                    $saveAddWallIn->drylining_comments = $arr11->comments3;
                    $saveAddWallIn->external_wrap_quantity = $arr11->quality4;
                    $saveAddWallIn->external_wrap_remarks = $arr11->remarks4;
                    $saveAddWallIn->external_wrap_amount = $arr11->currentAmount4;
                    $saveAddWallIn->external_wrap_comments = $arr11->comments4;
                    $saveAddWallIn->core_vents_quantity = $arr11->quality5;
                    $saveAddWallIn->core_vents_remarks = $arr11->remarks5;
                    $saveAddWallIn->core_vents_amount = $arr11->currentAmount5;
                    $saveAddWallIn->core_vents_comments = $arr11->comments5;
                    $saveAddWallIn->window_vents_quantity = $arr11->quality6;
                    $saveAddWallIn->window_vents_remarks = $arr11->remarks6;
                    $saveAddWallIn->window_vents_amount = $arr11->currentAmount6;
                    $saveAddWallIn->window_vents_comments = $arr11->comments6;
                    if ($request->hasFile('wall_insulation_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('wall_insulation_photos1'));
                        $saveAddWallIn->image1 = $imageName1;
                    } else {
                        $saveAddWallIn->image1 = "";
                    }
                    if ($request->hasFile('wall_insulation_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('wall_insulation_photos2'));
                        $saveAddWallIn->image2 = $imageName2;
                    } else {
                        $saveAddWallIn->image2 = "";
                    }
                    if ($request->hasFile('wall_insulation_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('wall_insulation_photos3'));
                        $saveAddWallIn->image3 = $imageName3;
                    } else {
                        $saveAddWallIn->image3 = "";
                    }
                    if ($request->hasFile('wall_insulation_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('wall_insulation_photos4'));
                        $saveAddWallIn->image4 = $imageName4;
                    } else {
                        $saveAddWallIn->image4 = "";
                    }
                    if ($request->hasFile('wall_insulation_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('wall_insulation_photos5'));
                        $saveAddWallIn->image5 = $imageName5;
                    } else {
                        $saveAddWallIn->image5 = "";
                    }

                    $saveAddWallIn->save();
                }
                foreach ($addIternalIns as $key => $arr12) {
                    $saveIIns = new PIIternalInsulation();
                    $saveIIns->fk_user_id = $user->user_id;
                    $saveIIns->fk_forms_id = $form_id;
                    $saveIIns->fk_property_id = $property_id;
                    $saveIIns->property_surveyors_id = $property_surveyors_id;
                    $saveIIns->fk_inspection_id = $inspectionId;
                    $saveIIns->room = $arr12->room;
                    $saveIIns->section = $arr12->section;
                    $saveIIns->comment = $arr12->comment;
                    $saveIIns->imagecomment1 = $arr12->imageComment1;
                    $saveIIns->imagecomment2 = $arr12->imageComment2;
                    $saveIIns->imagecomment3 = $arr12->imageComment3;
                    $saveIIns->imagecomment4 = $arr12->imageComment4;
                    $saveIIns->imagecomment5 = $arr12->imageComment5;
                    $saveIIns->imagecomment6 = $arr12->imageComment6;
                    $saveIIns->imagecomment7 = $arr12->imageComment7;
                    $saveIIns->imagecomment8 = $arr12->imageComment8;
                    $saveIIns->imagecomment9 = $arr12->imageComment9;
                    $saveIIns->imagecomment10 = $arr12->imageComment10;
                    for ($i = 1; $i <= 10; $i++) {
                        $photos_key = 'iternal_insulation_' . $key . '_photos' . $i;
                        $photos_key2 = 'image' . $i;
                        if ($request->hasFile($photos_key)) {
                            $imageName = $this->imgFunctionGlobal2($request->file($photos_key));
                            $saveIIns->$photos_key2 = $imageName;
                        } else {
                            $saveIIns->$photos_key2 = "";
                        }
                    }

                    $saveIIns->created_date = Carbon::now();
                    $saveIIns->save();
                }

                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function srFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                $addPropD = $addBuDe = $addDrawPho = $addExtIn = $addExtIn2 = $addGrantT = $addGrantD = $addHeatUp = [];
                $addPropD = json_decode($request->rs_additional_prop_detail);
                $addBuDe = json_decode($request->rs_builiding_details);
                $addDrawPho = json_decode($request->rs_comment_photo);
                $addExtIn = json_decode($request->rs_roof_condition);
                $addExtIn2 = json_decode($request->rs_roof_services);
                $addGrantT = json_decode($request->rs_roof_types);
                $addGrantD = json_decode($request->rs_roof_ventilation);
                $addHeatUp = json_decode($request->rs_spray_plan_for_roof);
                foreach ($addPropD as $arr) {
                    $saveAddPropD = new RsAdditionalProperty();
                    $saveAddPropD->fk_user_id = $user->user_id;
                    $saveAddPropD->fk_forms_id = $form_id;
                    $saveAddPropD->fk_property_id = $property_id;
                    $saveAddPropD->property_surveyors_id = $property_surveyors_id;
                    $saveAddPropD->fk_inspection_id = $inspectionId;
                    $saveAddPropD->additional_note = $arr->note;
                    $saveAddPropD->save();
                }
                foreach ($addBuDe as $arr2) {
                    $saveAddBuDe = new RsBuildingDetail();
                    $saveAddBuDe->fk_user_id = $user->user_id;
                    $saveAddBuDe->fk_forms_id = $form_id;
                    $saveAddBuDe->fk_property_id = $property_id;
                    $saveAddBuDe->property_surveyors_id = $property_surveyors_id;
                    $saveAddBuDe->fk_inspection_id = $inspectionId;
                    $saveAddBuDe->appropriate_tick_box = $arr2->checked_text;
                    $saveAddBuDe->others_data = $arr2->other;
                    $saveAddBuDe->save();
                }
                foreach ($addDrawPho as $arr3) {
                    $saveAddDrawPho = new RsCommentPhoto();
                    $saveAddDrawPho->fk_user_id = $user->user_id;
                    $saveAddDrawPho->fk_forms_id = $form_id;
                    $saveAddDrawPho->fk_property_id = $property_id;
                    $saveAddDrawPho->property_surveyors_id = $property_surveyors_id;
                    $saveAddDrawPho->fk_inspection_id = $inspectionId;
                    $saveAddDrawPho->comments = $arr3->note;

                    if ($request->hasFile('rs_comment_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('rs_comment_photos1'));
                        $saveAddDrawPho->photos1 = $imageName1;
                    } else {
                        $saveAddDrawPho->photos1 = "";
                    }
                    if ($request->hasFile('rs_comment_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('rs_comment_photos2'));
                        $saveAddDrawPho->photos2 = $imageName2;
                    } else {
                        $saveAddDrawPho->photos2 = "";
                    }
                    if ($request->hasFile('rs_comment_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('rs_comment_photos3'));
                        $saveAddDrawPho->photos3 = $imageName3;
                    } else {
                        $saveAddDrawPho->photos3 = "";
                    }
                    if ($request->hasFile('rs_comment_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('rs_comment_photos4'));
                        $saveAddDrawPho->photos4 = $imageName4;
                    } else {
                        $saveAddDrawPho->photos4 = "";
                    }
                    if ($request->hasFile('rs_comment_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('rs_comment_photos5'));
                        $saveAddDrawPho->photos5 = $imageName5;
                    } else {
                        $saveAddDrawPho->photos5 = "";
                    }

                    $saveAddDrawPho->save();
                }
                foreach ($addExtIn as $arr4) {
                    $saveAddExtIn = new RsRoofCondition();
                    $saveAddExtIn->fk_user_id = $user->user_id;
                    $saveAddExtIn->fk_forms_id = $form_id;
                    $saveAddExtIn->fk_property_id = $property_id;
                    $saveAddExtIn->property_surveyors_id = $property_surveyors_id;
                    $saveAddExtIn->fk_inspection_id = $inspectionId;
                    $saveAddExtIn->existing = $arr4->existing;
                    $saveAddExtIn->breathable = $arr4->breathable;
                    $saveAddExtIn->non_breathable = $arr4->non_breathable;
                    $saveAddExtIn->comments = $arr4->comments;
                    $saveAddExtIn->breather_membrane = $arr4->breather_membrane;
                    $saveAddExtIn->signs_of_rot = $arr4->signs_of_rot;
                    $saveAddExtIn->signs_of_mould = $arr4->signs_of_mould;
                    $saveAddExtIn->rafters = $arr4->rafters;
                    $saveAddExtIn->other = $arr4->other;

                    if ($request->hasFile('rs_mould_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('rs_mould_photos1'));
                        $saveAddExtIn->mould_pictures1 = $imageName1;
                    } else {
                        $saveAddExtIn->mould_pictures1 = "";
                    }
                    if ($request->hasFile('rs_mould_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('rs_mould_photos2'));
                        $saveAddExtIn->mould_pictures2 = $imageName2;
                    } else {
                        $saveAddExtIn->mould_pictures2 = "";
                    }
                    if ($request->hasFile('rs_mould_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('rs_mould_photos3'));
                        $saveAddExtIn->mould_pictures3 = $imageName3;
                    } else {
                        $saveAddExtIn->mould_pictures3 = "";
                    }
                    if ($request->hasFile('rs_mould_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('rs_mould_photos4'));
                        $saveAddExtIn->mould_pictures4 = $imageName4;
                    } else {
                        $saveAddExtIn->mould_pictures4 = "";
                    }
                    if ($request->hasFile('rs_mould_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('rs_mould_photos5'));
                        $saveAddExtIn->mould_pictures5 = $imageName5;
                    } else {
                        $saveAddExtIn->mould_pictures5 = "";
                    }
                    if ($request->hasFile('rs_roof_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('rs_roof_photos1'));
                        $saveAddExtIn->pictures1 = $imageName1;
                    } else {
                        $saveAddExtIn->pictures1 = "";
                    }
                    if ($request->hasFile('rs_roof_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('rs_roof_photos2'));
                        $saveAddExtIn->pictures2 = $imageName2;
                    } else {
                        $saveAddExtIn->pictures2 = "";
                    }
                    if ($request->hasFile('rs_roof_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('rs_roof_photos3'));
                        $saveAddExtIn->pictures3 = $imageName3;
                    } else {
                        $saveAddExtIn->pictures3 = "";
                    }
                    if ($request->hasFile('rs_roof_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('rs_roof_photos4'));
                        $saveAddExtIn->pictures4 = $imageName4;
                    } else {
                        $saveAddExtIn->pictures4 = "";
                    }
                    if ($request->hasFile('rs_roof_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('rs_roof_photos5'));
                        $saveAddExtIn->pictures5 = $imageName5;
                    } else {
                        $saveAddExtIn->pictures5 = "";
                    }

                    $saveAddExtIn->save();

                    // $saveAddAtIn->save();
                }

                foreach ($addExtIn2 as $arr5) {
                    $saveAddExtIn2 = new RsRoofService();
                    $saveAddExtIn2->fk_user_id = $user->user_id;
                    $saveAddExtIn2->fk_forms_id = $form_id;
                    $saveAddExtIn2->fk_property_id = $property_id;
                    $saveAddExtIn2->property_surveyors_id = $property_surveyors_id;
                    $saveAddExtIn2->fk_inspection_id = $inspectionId;
                    $saveAddExtIn2->vents_for_services = $arr5->vents_for_services;
                    $saveAddExtIn2->electical_cables = $arr5->electical_cables;
                    $saveAddExtIn2->ductwork = $arr5->ductwork;
                    $saveAddExtIn2->comments = $arr5->comments;

                    if ($request->hasFile('rs_roof_service_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos1'));
                        $saveAddExtIn2->pictures1 = $imageName1;
                    } else {
                        $saveAddExtIn2->pictures1 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos2'));
                        $saveAddExtIn2->pictures2 = $imageName2;
                    } else {
                        $saveAddExtIn2->pictures2 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos3'));
                        $saveAddExtIn2->pictures3 = $imageName3;
                    } else {
                        $saveAddExtIn2->pictures3 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos4'));
                        $saveAddExtIn2->pictures4 = $imageName4;
                    } else {
                        $saveAddExtIn2->pictures4 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos5'));
                        $saveAddExtIn2->pictures5 = $imageName5;
                    } else {
                        $saveAddExtIn2->pictures5 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos6')) {
                        $imageName6 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos6'));
                        $saveAddExtIn2->pictures6 = $imageName6;
                    } else {
                        $saveAddExtIn2->pictures6 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos7')) {
                        $imageName7 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos7'));
                        $saveAddExtIn2->pictures7 = $imageName7;
                    } else {
                        $saveAddExtIn2->pictures7 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos8')) {
                        $imageName8 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos8'));
                        $saveAddExtIn2->pictures8 = $imageName8;
                    } else {
                        $saveAddExtIn2->pictures8 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos9')) {
                        $imageName9 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos9'));
                        $saveAddExtIn2->pictures9 = $imageName9;
                    } else {
                        $saveAddExtIn2->pictures9 = "";
                    }
                    if ($request->hasFile('rs_roof_service_photos10')) {
                        $imageName10 = $this->imgFunctionGlobal($request->file('rs_roof_service_photos10'));
                        $saveAddExtIn2->pictures10 = $imageName10;
                    } else {
                        $saveAddExtIn2->pictures10 = "";
                    }

                    $saveAddExtIn2->save();

                    // $saveAddAtIn->save();
                }
                foreach ($addGrantT as $arr6) {
                    $saveAddGrantT = new RsRoofType();
                    $saveAddGrantT->fk_user_id = $user->user_id;
                    $saveAddGrantT->fk_forms_id = $form_id;
                    $saveAddGrantT->fk_property_id = $property_id;
                    $saveAddGrantT->property_surveyors_id = $property_surveyors_id;
                    $saveAddGrantT->fk_inspection_id = $inspectionId;
                    $saveAddGrantT->warm = $arr6->warm;
                    $saveAddGrantT->cold = $arr6->cold;
                    $saveAddGrantT->pitches = $arr6->pitches;
                    $saveAddGrantT->vaulted = $arr6->vaulted;
                    $saveAddGrantT->dormer = $arr6->dormer;
                    $saveAddGrantT->save();
                }
                foreach ($addGrantD as $arr7) {
                    $saveAddGrantD = new RsRoofVentilation();
                    $saveAddGrantD->fk_user_id = $user->user_id;
                    $saveAddGrantD->fk_forms_id = $form_id;
                    $saveAddGrantD->fk_property_id = $property_id;
                    $saveAddGrantD->property_surveyors_id = $property_surveyors_id;
                    $saveAddGrantD->fk_inspection_id = $inspectionId;
                    $saveAddGrantD->ventilated_ridges = $arr7->ventilated_ridges;
                    $saveAddGrantD->ridges_on_hips = $arr7->ridges_on_hips;
                    $saveAddGrantD->soffit = $arr7->soffit;
                    $saveAddGrantD->fitted = $arr7->fitted;
                    $saveAddGrantD->source_of_ventilation = $arr7->source_of_ventilation;
                    $saveAddGrantD->cross_ventilation = $arr7->cross_ventilation;
                    $saveAddGrantD->adequately_ventilated = $arr7->adequately_ventilated;
                    $saveAddGrantD->counter_battened = $arr7->counter_battened;
                    $saveAddGrantD->save();
                }
                foreach ($addHeatUp as $arr8) {
                    $saveAddHeatUp = new RsSpreyPlan();
                    $saveAddHeatUp->fk_user_id = $user->user_id;
                    $saveAddHeatUp->fk_forms_id = $form_id;
                    $saveAddHeatUp->fk_property_id = $property_id;
                    $saveAddHeatUp->property_surveyors_id = $property_surveyors_id;
                    $saveAddHeatUp->fk_inspection_id = $inspectionId;
                    $saveAddHeatUp->cold_deck = $arr8->cold_deck;
                    $saveAddHeatUp->warm_deck = $arr8->warm_deck;
                    $saveAddHeatUp->ceiling_ground_floor = $arr8->ceiling_ground_floor;
                    $saveAddHeatUp->top_of_stud = $arr8->top_of_stud;
                    $saveAddHeatUp->ventcard1 = $arr8->ventcard1;
                    $saveAddHeatUp->depth1 = $arr8->depth1;
                    $saveAddHeatUp->shaved = $arr8->shaved;
                    $saveAddHeatUp->stud_to_collar = $arr8->stud_to_collar;
                    $saveAddHeatUp->ventcard2 = $arr8->ventcard2;
                    $saveAddHeatUp->depth2 = $arr8->depth2;
                    $saveAddHeatUp->need_to_be_shaved = $arr8->need_to_be_shaved;
                    $saveAddHeatUp->collar_to_ridge = $arr8->collar_to_ridge;
                    $saveAddHeatUp->ventcard3 = $arr8->ventcard3;
                    $saveAddHeatUp->depth3 = $arr8->depth3;
                    $saveAddHeatUp->plate_across = $arr8->plate_across;
                    $saveAddHeatUp->ceiling_to_stud = $arr8->ceiling_to_stud;
                    $saveAddHeatUp->depth4 = $arr8->depth4;
                    $saveAddHeatUp->spraying = $arr8->spraying;
                    $saveAddHeatUp->depth5 = $arr8->depth5;
                    $saveAddHeatUp->comments = $arr8->comments;
                    if ($request->hasFile('rs_spray_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('rs_spray_photos1'));
                        $saveAddHeatUp->pictures1 = $imageName1;
                    } else {
                        $saveAddHeatUp->pictures1 = "";
                    }
                    if ($request->hasFile('rs_spray_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('rs_spray_photos2'));
                        $saveAddHeatUp->pictures2 = $imageName2;
                    } else {
                        $saveAddHeatUp->pictures2 = "";
                    }
                    if ($request->hasFile('rs_spray_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('rs_spray_photos3'));
                        $saveAddHeatUp->pictures3 = $imageName3;
                    } else {
                        $saveAddHeatUp->pictures3 = "";
                    }
                    if ($request->hasFile('rs_spray_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('rs_spray_photos4'));
                        $saveAddHeatUp->pictures4 = $imageName4;
                    } else {
                        $saveAddHeatUp->pictures4 = "";
                    }
                    if ($request->hasFile('rs_spray_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('rs_spray_photos5'));
                        $saveAddHeatUp->pictures5 = $imageName5;
                    } else {
                        $saveAddHeatUp->pictures5 = "";
                    }
                    $saveAddHeatUp->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function wsformSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {

            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;
            if ($saveInsp) {
                $wapd = $wbd = $wbt = $wcoil = $wcool = $wipic = $wnbc = $wsitc = $wvttc = [];
                $wapd = json_decode($request->ws_additional_prop_detail);
                $wbd = json_decode($request->ws_building_details);
                $wbt = json_decode($request->ws_building_type);
                $wcoil = json_decode($request->ws_condition_of_inner_leaf);
                $wcool = json_decode($request->ws_condition_of_outer_leaf);
                $wipic = json_decode($request->ws_insulation_present_in_cavity);
                $wnbc = json_decode($request->ws_new_build_cavity);
                $wsitc = json_decode($request->ws_services_in_the_cavity);
                $wvttc = json_decode($request->ws_ventilation_through_the_cavity);
                foreach ($wapd as $arr) {
                    $savewapd = new WsAdditionalProperty();
                    $savewapd->fk_user_id = $user->user_id;
                    $savewapd->fk_forms_id = $form_id;
                    $savewapd->fk_property_id = $property_id;
                    $savewapd->property_surveyors_id = $property_surveyors_id;
                    $savewapd->fk_inspection_id = $inspectionId;
                    $savewapd->additional_note = $arr->note;
                    $savewapd->save();
                }
                foreach ($wbd as $arr2) {
                    $savewbd = new WsBuildingDetail();
                    $savewbd->fk_user_id = $user->user_id;
                    $savewbd->fk_forms_id = $form_id;
                    $savewbd->fk_property_id = $property_id;
                    $savewbd->property_surveyors_id = $property_surveyors_id;
                    $savewbd->fk_inspection_id = $inspectionId;
                    $savewbd->appropriate_tick_box = $arr2->checked_text;
                    $savewbd->others_data = $arr2->other;
                    $savewbd->save();
                }
                foreach ($wbt as $arr3) {
                    $savewbt = new WsBuildingType();
                    $savewbt->fk_user_id = $user->user_id;
                    $savewbt->fk_forms_id = $form_id;
                    $savewbt->fk_property_id = $property_id;
                    $savewbt->property_surveyors_id = $property_surveyors_id;
                    $savewbt->fk_inspection_id = $inspectionId;
                    $savewbt->examined_with_borescope = $arr3->examined_with_borescope;
                    $savewbt->cavity_type = $arr3->cavity_type;
                    $savewbt->no_of_holes_drilled = $arr3->no_of_holes_drilled;
                    $savewbt->cavity_widths = $arr3->cavity_widths;
                    $savewbt->notes_on_cavity = $arr3->notes_on_cavity;
                    $savewbt->save();
                }
                foreach ($wcoil as $arr4) {
                    $savewcoil = new WsInnerLeafCondition();
                    $savewcoil->fk_user_id = $user->user_id;
                    $savewcoil->fk_forms_id = $form_id;
                    $savewcoil->fk_property_id = $property_id;
                    $savewcoil->property_surveyors_id = $property_surveyors_id;
                    $savewcoil->fk_inspection_id = $inspectionId;
                    $savewcoil->cracks = $arr4->cracks;
                    $savewcoil->services_sealed = $arr4->services_sealed;
                    $savewcoil->airtight = $arr4->airtight;
                    $savewcoil->dampness = $arr4->dampness;
                    $savewcoil->slabs_dobbed = $arr4->slabs_dobbed;
                    $savewcoil->conduits_sealed = $arr4->conduits_sealed;
                    $savewcoil->gables_to_be_fitted = $arr4->gables_to_be_fitted;
                    $savewcoil->save();

                    // $saveAddAtIn->save();
                }
                foreach ($wcool as $arr5) {
                    $savewcool = new WsOuterLeafCondition();
                    $savewcool->fk_user_id = $user->user_id;
                    $savewcool->fk_forms_id = $form_id;
                    $savewcool->fk_property_id = $property_id;
                    $savewcool->property_surveyors_id = $property_surveyors_id;
                    $savewcool->fk_inspection_id = $inspectionId;
                    $savewcool->good_condition = $arr5->good_condition;
                    $savewcool->cracks_gaps_holes = $arr5->cracks_gaps_holes;
                    $savewcool->jointing_good = $arr5->jointing_good;
                    $savewcool->running_vertically = $arr5->running_vertically;
                    $savewcool->running_horizontally = $arr5->running_horizontally;
                    $savewcool->joints_sealed = $arr5->joints_sealed;
                    $savewcool->weep_holes_to_linters = $arr5->weep_holes_to_linters;
                    $savewcool->have_sills_adequate_drip = $arr5->have_sills_adequate_drip;
                    $savewcool->notes = $arr5->notes;
                    $savewcool->save();

                    // $saveAddAtIn->save();
                }
                foreach ($wipic as $arr6) {
                    $savewipic = new WsPresentCavity();
                    $savewipic->fk_user_id = $user->user_id;
                    $savewipic->fk_forms_id = $form_id;
                    $savewipic->fk_property_id = $property_id;
                    $savewipic->property_surveyors_id = $property_surveyors_id;
                    $savewipic->fk_inspection_id = $inspectionId;
                    $savewipic->eps_white = $arr6->eps_white;
                    $savewipic->eps_silver = $arr6->eps_silver;
                    $savewipic->pir_board = $arr6->pir_board;
                    $savewipic->mineral_board = $arr6->mineral_board;
                    $savewipic->fsell_fill = $arr6->fsell_fill;
                    $savewipic->condition_of_insulation_present = $arr6->condition_of_insulation_present;
                    $savewipic->boards_overlapping = $arr6->boards_overlapping;
                    $savewipic->insulation_bridge_the_cavity = $arr6->insulation_bridge_the_cavity;
                    $savewipic->significant_mortar = $arr6->significant_mortar;
                    $savewipic->save();
                }
                foreach ($wnbc as $arr7) {
                    $savewnbc = new WsBuildCavity();
                    $savewnbc->fk_user_id = $user->user_id;
                    $savewnbc->fk_forms_id = $form_id;
                    $savewnbc->fk_property_id = $property_id;
                    $savewnbc->property_surveyors_id = $property_surveyors_id;
                    $savewnbc->fk_inspection_id = $inspectionId;
                    $savewnbc->wall_ties_free_from_mortar = $arr7->wall_ties_free_from_mortar;
                    $savewnbc->window_details_adequate = $arr7->window_details_adequate;
                    $savewnbc->plate_open = $arr7->plate_open;
                    $savewnbc->correct_position = $arr7->correct_position;
                    $savewnbc->comments = $arr7->comments;

                    if ($request->hasFile('ws_build_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('ws_build_photos1'));
                        $savewnbc->pictures1 = $imageName1;
                    } else {
                        $savewnbc->pictures1 = "";
                    }
                    if ($request->hasFile('ws_build_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('ws_build_photos2'));
                        $savewnbc->pictures2 = $imageName2;
                    } else {
                        $savewnbc->pictures2 = "";
                    }
                    if ($request->hasFile('ws_build_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('ws_build_photos3'));
                        $savewnbc->pictures3 = $imageName3;
                    } else {
                        $savewnbc->pictures3 = "";
                    }
                    if ($request->hasFile('ws_build_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('ws_build_photos4'));
                        $savewnbc->pictures4 = $imageName4;
                    } else {
                        $savewnbc->pictures4 = "";
                    }
                    if ($request->hasFile('ws_build_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('ws_build_photos5'));
                        $savewnbc->pictures5 = $imageName5;
                    } else {
                        $savewnbc->pictures5 = "";
                    }
                    $savewnbc->save();
                }
                foreach ($wsitc as $arr8) {
                    $savewsitc = new WsServiceCavity();
                    $savewsitc->fk_user_id = $user->user_id;
                    $savewsitc->fk_forms_id = $form_id;
                    $savewsitc->fk_property_id = $property_id;
                    $savewsitc->property_surveyors_id = $property_surveyors_id;
                    $savewsitc->fk_inspection_id = $inspectionId;
                    $savewsitc->pipes_in_the_cavity = $arr8->pipes_in_the_cavity;
                    $savewsitc->crossing_the_cavity = $arr8->crossing_the_cavity;
                    $savewsitc->windows_airtight = $arr8->windows_airtight;
                    $savewsitc->cables_in_the_cavity = $arr8->cables_in_the_cavity;
                    $savewsitc->isolated_from_the_cavity = $arr8->isolated_from_the_cavity;
                    $savewsitc->additional_comments = $arr8->additional_comments;

                    if ($request->hasFile('ws_service_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('ws_service_photos1'));
                        $savewsitc->pictures1 = $imageName1;
                    } else {
                        $savewsitc->pictures1 = "";
                    }
                    if ($request->hasFile('ws_service_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('ws_service_photos2'));
                        $savewsitc->pictures2 = $imageName2;
                    } else {
                        $savewsitc->pictures2 = "";
                    }
                    if ($request->hasFile('ws_service_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('ws_service_photos3'));
                        $savewsitc->pictures3 = $imageName3;
                    } else {
                        $savewsitc->pictures3 = "";
                    }
                    if ($request->hasFile('ws_service_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('ws_service_photos4'));
                        $savewsitc->pictures4 = $imageName4;
                    } else {
                        $savewsitc->pictures4 = "";
                    }
                    if ($request->hasFile('ws_service_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('ws_service_photos5'));
                        $savewsitc->pictures5 = $imageName5;
                    } else {
                        $savewsitc->pictures5 = "";
                    }
                    $savewsitc->save();
                }
                foreach ($wvttc as $arr9) {
                    $savewsitc = new WsVentilationCavity();
                    $savewsitc->fk_user_id = $user->user_id;
                    $savewsitc->fk_forms_id = $form_id;
                    $savewsitc->fk_property_id = $property_id;
                    $savewsitc->property_surveyors_id = $property_surveyors_id;
                    $savewsitc->fk_inspection_id = $inspectionId;
                    $savewsitc->suspended_floors = $arr9->suspended_floors;
                    $savewsitc->vents_sleeved = $arr9->vents_sleeved;
                    $savewsitc->comment = $arr9->comment;
                    $savewsitc->cores_need = $arr9->cores_need;
                    $savewsitc->how_many = $arr9->how_many;
                    $savewsitc->types_of_vents_need = $arr9->types_of_vents_need;
                    $savewsitc->burning_appliances = $arr9->burning_appliances;
                    $savewsitc->notes = $arr9->notes;

                    if ($request->hasFile('ws_ventilation_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('ws_ventilation_photos1'));
                        $savewsitc->pictures1 = $imageName1;
                    } else {
                        $savewsitc->pictures1 = "";
                    }
                    if ($request->hasFile('ws_ventilation_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('ws_ventilation_photos2'));
                        $savewsitc->pictures2 = $imageName2;
                    } else {
                        $savewsitc->pictures2 = "";
                    }
                    if ($request->hasFile('ws_ventilation_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('ws_ventilation_photos3'));
                        $savewsitc->pictures3 = $imageName3;
                    } else {
                        $savewsitc->pictures3 = "";
                    }
                    if ($request->hasFile('ws_ventilation_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('ws_ventilation_photos4'));
                        $savewsitc->pictures4 = $imageName4;
                    } else {
                        $savewsitc->pictures4 = "";
                    }
                    if ($request->hasFile('ws_ventilation_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('ws_ventilation_photos5'));
                        $savewsitc->pictures5 = $imageName5;
                    } else {
                        $savewsitc->pictures5 = "";
                    }
                    $savewsitc->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sirPrepFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            $form_status = $request->form_status;
            $subFormNos = $request->sub_form_number;
            $sir_preparation = json_decode($request->sir_preparation);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                foreach ($sir_preparation as $sPrep) {
                    $savePrep = new SirPreparation();
                    $savePrep->fk_user_id = $user->user_id;
                    $savePrep->fk_forms_id = $form_id;
                    $savePrep->fk_property_id = $sPrep->property_id;
                    $savePrep->property_surveyors_id = $sPrep->property_surveyors_id;
                    $savePrep->fk_inspection_id = $inspectionId;
                    $savePrep->weather_conditions = $sPrep->weather;
                    $savePrep->temperature = $sPrep->temperature;
                    if ($request->hasFile('sir_preparation_photos1')) {
                        $imageName = $this->imgFunctionGlobal($request->file('sir_preparation_photos1'));
                        $savePrep->temperature_image = $imageName;
                    } else {
                        $savePrep->temperature_image = "";
                    }
                    $savePrep->time_of_day = $sPrep->time;
                    $savePrep->health_safety = $sPrep->checked_text;
                    $savePrep->building_services = $sPrep->checked_text_one;
                    $savePrep->materials_check = $sPrep->checked_text_two;
                    $savePrep->contractor_performance_rating = $sPrep->checked_text_three;
                    $savePrep->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sirBoardFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            // $form_status = $request->form_status;
            // $subFormNos = $request->sub_form_number;
            $sir_boarding = json_decode($request->sir_boarding);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                foreach ($sir_boarding as $sBoard) {
                    $savePrep = new SirBoarding();
                    $savePrep->fk_user_id = $user->user_id;
                    $savePrep->fk_forms_id = $form_id;
                    $savePrep->fk_property_id = $sBoard->property_id;
                    $savePrep->property_surveyors_id = $sBoard->property_surveyors_id;
                    $savePrep->fk_inspection_id = $inspectionId;
                    $savePrep->weather_conditions = $sBoard->weather;
                    $savePrep->temperature = $sBoard->temperature;
                    if ($request->hasFile('sir_boarding_photos1')) {
                        $imageName = $this->imgFunctionGlobal($request->file('sir_boarding_photos1'));
                        $savePrep->temperature_image = $imageName;
                    } else {
                        $savePrep->temperature_image = "";
                    }
                    $savePrep->time_of_day = $sBoard->time;
                    $savePrep->health_safety = $sBoard->checked_text;
                    $savePrep->workmanship = $sBoard->checked_text_one;
                    $savePrep->ventilation = $sBoard->checked_text_two;
                    $savePrep->contractor_performance_rating = $sBoard->checked_text_three;
                    $savePrep->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sirbaseCFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            // $form_status = $request->form_status;
            // $subFormNos = $request->sub_form_number;
            $sir_basecoat = json_decode($request->sir_basecoat);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                foreach ($sir_basecoat as $sBaseC) {
                    $savePrep = new SirBasecoat();
                    $savePrep->fk_user_id = $user->user_id;
                    $savePrep->fk_forms_id = $form_id;
                    $savePrep->fk_property_id = $sBaseC->property_id;
                    $savePrep->property_surveyors_id = $sBaseC->property_surveyors_id;
                    $savePrep->fk_inspection_id = $inspectionId;
                    $savePrep->weather_conditions = $sBaseC->weather;
                    $savePrep->temperature = $sBaseC->temperature;
                    if ($request->hasFile('sir_basecoat_photos1')) {
                        $imageName = $this->imgFunctionGlobal($request->file('sir_basecoat_photos1'));
                        $savePrep->temperature_image = $imageName;
                    } else {
                        $savePrep->temperature_image = "";
                    }
                    $savePrep->time_of_day = $sBaseC->time;
                    $savePrep->health_safety = $sBaseC->checked_text;
                    $savePrep->workmanship = $sBaseC->checked_text_one;
                    $savePrep->ventilation = $sBaseC->checked_text_two;
                    $savePrep->contractor_performance_rating = $sBaseC->checked_text_three;
                    $savePrep->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sirFinshCFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            // $form_status = $request->form_status;
            // $subFormNos = $request->sub_form_number;
            $sir_finishcoat = json_decode($request->sir_finishcoat);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                foreach ($sir_finishcoat as $sFinisC) {
                    $savePrep = new SirFinishcoat();
                    $savePrep->fk_user_id = $user->user_id;
                    $savePrep->fk_forms_id = $form_id;
                    $savePrep->fk_property_id = $sFinisC->property_id;
                    $savePrep->property_surveyors_id = $sFinisC->property_surveyors_id;
                    $savePrep->fk_inspection_id = $inspectionId;
                    $savePrep->weather_conditions = $sFinisC->weather;
                    $savePrep->temperature = $sFinisC->temperature;

                    if ($request->hasFile('sir_finishcoat_photos1')) {
                        $imageName = $this->imgFunctionGlobal($request->file('sir_finishcoat_photos1'));
                        $savePrep->temperature_image = $imageName;
                    } else {
                        $savePrep->temperature_image = "";
                    }
                    $savePrep->time_of_day = $sFinisC->time;
                    $savePrep->health_safety = $sFinisC->checked_text;
                    $savePrep->workmanship = $sFinisC->checked_text_one;
                    $savePrep->ventilation = $sFinisC->checked_text_two;
                    $savePrep->contractor_performance_rating = $sFinisC->checked_text_three;
                    $savePrep->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sirJFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            // $form_status = $request->form_status;
            // $subFormNos = $request->sub_form_number;
            $sir_job = json_decode($request->sir_job);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                foreach ($sir_job as $sJob) {
                    $savePrep = new SirJob();
                    $savePrep->fk_user_id = $user->user_id;
                    $savePrep->fk_forms_id = $form_id;
                    $savePrep->fk_property_id = $sJob->property_id;
                    $savePrep->property_surveyors_id = $sJob->property_surveyors_id;
                    $savePrep->fk_inspection_id = $inspectionId;
                    $savePrep->material_records = $sJob->checked_text;
                    $savePrep->paperwork_records = $sJob->checked_text_one;
                    $savePrep->exceptional_items = $sJob->exceptional;
                    $savePrep->contractor_performance_rating = $sJob->checked_text_two;
                    $savePrep->notes_recommendations = $sJob->note;
                    $savePrep->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sirDrawFormSave(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $user = auth()->user();
        if ($user) {
            $property_surveyors_id = $request->property_surveyors_id;
            $property_id = $request->property_id;
            $form_id = $request->form_id;
            // $form_status = $request->form_status;
            // $subFormNos = $request->sub_form_number;
            $sir_drawphoto = json_decode($request->sir_drawphoto);

            $saveInsp = new Inspections();
            $saveInsp->fk_user_id = $user->user_id;
            $saveInsp->fk_forms_id = $form_id;
            $saveInsp->fk_property_id = $property_id;
            $saveInsp->property_surveyors_id = $property_surveyors_id;
            $saveInsp->name = $request->name;
            $saveInsp->contractor_name = "";
            $saveInsp->contractor_signature = "";
            $saveInsp->date_inspected = $request->date_inspected;
            $saveInsp->pdf_filename = 'n/a';
            $saveInsp->created_date = date('Y-m-d H:i:s');
            $saveInsp->save();

            $inspectionId = $saveInsp->id;

            if ($saveInsp) {
                foreach ($sir_drawphoto as $sDP) {
                    $savePrep = new SirDrawingPhoto();
                    $savePrep->fk_user_id = $user->user_id;
                    $savePrep->fk_forms_id = $form_id;
                    $savePrep->fk_property_id = $sDP->property_id;
                    $savePrep->property_surveyors_id = $sDP->property_surveyors_id;
                    $savePrep->fk_inspection_id = $inspectionId;
                    $savePrep->sketches_been_completed_and_attached = $sDP->radio1;
                    $savePrep->photographs_been_taken = $sDP->radio2;
                    $savePrep->addditional_risks_notes = $sDP->note;

                    if ($request->hasFile('sir_draw_photos1')) {
                        $imageName1 = $this->imgFunctionGlobal($request->file('sir_draw_photos1'));
                        $savePrep->front_elevations = $imageName1;
                    } else {
                        $savePrep->front_elevations = "";
                    }
                    if ($request->hasFile('sir_draw_photos2')) {
                        $imageName2 = $this->imgFunctionGlobal($request->file('sir_draw_photos2'));
                        $savePrep->rear_elevations = $imageName2;
                    } else {
                        $savePrep->rear_elevations = "";
                    }
                    if ($request->hasFile('sir_draw_photos3')) {
                        $imageName3 = $this->imgFunctionGlobal($request->file('sir_draw_photos3'));
                        $savePrep->gable_elevations1 = $imageName3;
                    } else {
                        $savePrep->gable_elevations1 = "";
                    }
                    if ($request->hasFile('sir_draw_photos4')) {
                        $imageName4 = $this->imgFunctionGlobal($request->file('sir_draw_photos4'));
                        $savePrep->gable_elevations2 = $imageName4;
                    } else {
                        $savePrep->gable_elevations2 = "";
                    }
                    if ($request->hasFile('sir_draw_photos5')) {
                        $imageName5 = $this->imgFunctionGlobal($request->file('sir_draw_photos5'));
                        $savePrep->gable_elevations3 = $imageName5;
                    } else {
                        $savePrep->gable_elevations3 = "";
                    }
                    $savePrep->save();
                }
                $updateInsp = Inspections::find($inspectionId);
                if ($request->file('images_signature')) {
                    $year = date('Y');
                    $month = date('m');
                    if (!is_dir('assets/uploads/inspection_signature/' . $year)) {
                        mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('assets/uploads/inspection_signature/' . $year)) {
                        if (!is_dir('assets/uploads/inspection_signature/' . $year . '/' . $month)) {
                            mkdir('./assets/uploads/inspection_signature/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $image_path = "./assets/uploads/inspection_signature/" . $year . "/" . $month . "/";
                    $photo = $request->file('images_signature');
                    $imageName = 'signature-' . time() . '.' . request()->images_signature->getClientOriginalExtension();
                    $photo->move(public_path($image_path), $imageName);
                    $updateInsp->signature = "/" . $year . "/" . $month . "/" . $imageName;
                }
                $updateInsp->update();
                if ($updateInsp) {
                    $save = PropertySurveyor::find($property_surveyors_id);
                    $save->today_date_status = 1;
                    $save->update();

                    $response = test_method($updateInsp->id);
                    return response()->json(['success' => "1", 'message' => 'Submitted Successfully.', 'code' => 200]);
                } else {
                    return response()->json(['success' => "1", 'message' => 'Inspection and Form created but form signature not saved.', 'code' => 200]);
                }
            } else {
                return response()->json(['success' => "0", 'message' => 'data not saved.', 'code' => 400]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function send_notifications($token, $title, $body, $session_other_status = null)
    {
        if ($session_other_status == 1) {
            $fcmUrl = 'https://fcm.googleapis.com/v1/projects/bcr-comply-2/messages:send';
            $notification = [
                'title' => $title,
                'body' => $body,
            ];
            $message = [
                'token' => $token,
                'notification' => $notification,
                'data' => ['type_name' => 'announcement', 'click_action' => 'FLUTTER_NOTIFICATION_CLICK'],
                'android' => [
                    'priority' => 'high',
                    'notification' => [
                        'sound' => 'default'
                    ],
                ],
                'apns' => [
                    'payload' => [
                        'aps' => [
                            'sound' => 'default'
                        ],
                    ],
                ],
            ];
            $fcmNotification = [
                'message' => $message,
            ];
            $headers = [
                'Authorization: Bearer ' . getGoogleAccessToken(),
                'Content-Type: application/json',
            ];
            if (!empty($token)) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
            }
            return false;
        } else {
            return false;
        }
    }
    public function getSnagText($formID, $propId, $address,$item_name)
    {
        if ($formID == 25) {
            if ($propId == null || $propId == "") {
                return null;
            }
            $dataChecked = Inspections::where('id', $propId)
                ->with('bre_snag')
                ->first();

            if (sizeOf($dataChecked['bre_snag'])) {
                $angArr = $dataChecked['bre_snag']->toArray();
                $totalsnag = sizeOf($angArr);
                // dd($angArr);
                $reported = array_filter($angArr, function ($item) {
                    return $item['status'] == "Open";
                });
                $closed = array_filter($angArr, function ($item) {
                    return $item['status'] == "Closed" && $item['is_letest'] == 1;
                });
                $mainInsp = array_unique(array_column($angArr, 'fk_main_inspection_id'));
                if (sizeOf($mainInsp)) {
                    $inspI = $mainInsp[0];
                } else {
                    $inspI = $propId;
                }
                // dd($closed,$totalsnag);
                if (sizeOf($closed) && sizeOf($closed) < $totalsnag) {
                    $closed2 = array_filter($angArr, function ($item) {
                        return $item['status'] == "Closed";
                    });
                    if (sizeOf($closed2) && sizeOf($closed2) == $totalsnag) {
                        // $txt = "(Snag Resolved) (# " . $inspI . ") In " . $address;
                        $txt = "Snag - ". $item_name ." Resolved in ". $address;
                        $txt1 = "Snag Resolved";
                    } else {
                        $grup = implode('/', array_unique(array_column($closed, 'fk_type')));
                        // $txt = "(Snag Resolved: " . $grup . ") (# " . $inspI . ") In " . $address;
                        $txt = "Snag - ". $item_name ." Resolved in ". $address;
                        $txt1 = "Snag Resolved";
                    }
                } else if (sizeOf($closed) && sizeOf($closed) == $totalsnag) {
                    // $txt = "(Snag Resolved) (# " . $inspI . ") In " . $address;
                    $txt = "Snag - ". $item_name ." Resolved in ". $address;
                    $txt1 = "Snag Resolved";
                } else {
                    // $txt = "(Snag Recorded) (# " . $inspI . ") In " . $address;
                    $txt = "Snag - ". $item_name ." Recorded in ". $address;
                    $txt1 = "Snag Recorded";
                }
            } else {
                // $txt = "(No Snag Recorded) (# " . $propId . ") In " . $address;
                $txt = "Snag - ". $item_name ." Not Recorded in ". $address;
                $txt1 = "No Snag Recorded";
            }
            $finalText = $txt . "@@@" . $txt1;
        } else {
            $finalText = null;
        }
        return $finalText;
    }
}
