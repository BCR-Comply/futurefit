<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BrePhotoInspectionItem;
use App\Models\CqaPhotoInspectionItem;
use App\Models\Inspections;
use App\Models\PhotoInspectionItem;
use App\Models\PropertySurveyor;
use App\Models\NotifiationMobile;
use App\Models\ContractorProperty;
use App\Models\SnagRecord;
use App\Models\SnagRecordComment;
use App\Models\SnagRecordReplyComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SqlController extends Controller
{
    public function contractPropUpdate(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $data = ContractorProperty::where('id', $request->id)->first();
            $data2 = ContractorProperty::where('id', $request->id)->first();
            $data2->status = isset($request->status) ? $request->status : "";
            $data2->units = isset($request->units) ? $request->units : "";
            if ($data2->update()) {
                // dd($data->status,$request->status);
                if($request->status != $data->status){
                    $getPropertyDetails = DB::table('properties')->where('id', $data2->property_id)->first();
                    $address = format_address(
                        $getPropertyDetails->house_num,
                        $getPropertyDetails->address1,
                        $getPropertyDetails->address2,
                        $getPropertyDetails->address3,
                        $getPropertyDetails->county,
                        $getPropertyDetails->eircode
                    );
                    $meta = DB::table('tbl_user_meta')->where('fk_user_id',$user->user_id)->orderBy('created_date','desc')->first();
                    // dd($meta);
                    if($meta){
                        $session_other_status = 1;
                        $token = $meta->device_token;
                        $body ="Status of the measure has been changed from ".$data->status." to ".$request->status ." in ". $address;
                        $title = "Measure status has been changed";
                        $addnoti = new NotifiationMobile();
                        $addnoti->fk_user_id = $user->user_id;
                        $addnoti->note = $body;
                        $addnoti->section = "Property";
                        $addnoti->sub_section = "con";
                        $addnoti->route = "property.show";
                        $addnoti->property_id = $data2->property_id;
                        $addnoti->save();
                        $this->send_notifications($token, $title,$body,$session_other_status);
                    }
                }
                if($request->status == "Complete"){
                    $dataNew = ContractorProperty::where('id', $request->id)->first();
                    $checkAllMeasure = ContractorProperty::where('property_id', $dataNew->property_id)->count();
                    $checkCompleteMeasure = ContractorProperty::where('property_id', $dataNew->property_id)->where('status','Complete')->count();
                    if($checkAllMeasure === $checkCompleteMeasure){
                        DB::table('properties')->where('id',$dataNew->property_id)->update(['status' => "completed"]);
                    }
                }
                return response()->json(['success' => true, 'data' => $data, 'message' => 'contractor property updated successfully.']);
            } else {
                return response()->json(['success' => false, 'data' => [], 'message' => 'contractor property updatation failed.']);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function index()
    {
        $data = [];
        //Form and 3rdParty Form Start
        $get3rdPartyForm = DB::table('3rd_party_forms')->orderBy('id', 'asc')->get();
        $data['3rd_party_forms'] = $get3rdPartyForm;

        $forms = DB::table('forms')->orderBy('forms_id', 'asc')->get();
        $data['forms'] = $forms;

        $registeredusers = DB::table('registeredusers')->orderBy('id', 'asc')->get();
        $data['registeredusers'] = $registeredusers;

        $tbl_user = DB::table('tbl_user')->orderBy('id', 'asc')->get();
        $data['tbl_user'] = $tbl_user;
        //Form and 3rdParty Form End

        //Retrofit Form Start
        $areas = DB::table('areas')->orderBy('id', 'asc')->get();
        $data['areas'] = $areas;

        $items = DB::table('items')->orderBy('id', 'asc')->get();
        $data['items'] = $items;

        $questions = DB::table('questions')->orderBy('id', 'asc')->get();
        $data['questions'] = $questions;

        $photoInspItems = PhotoInspectionItem::orderBy('id', 'asc')->get();
        $data['photo_inspection_items'] = $photoInspItems;
        //Retrofit Form End

        //Accessor Start
        $assessor_property = DB::table('assessor_property')->orderBy('id', 'asc')->get();
        $data['assessor_property'] = $assessor_property;
        //Accessor End

        //Bre Data Start
        $bre_areas = DB::table('bre_areas')->orderBy('id', 'asc')->get();
        $data['bre_areas'] = $bre_areas;

        $bre_items = DB::table('bre_items')->orderBy('id', 'asc')->get();
        $data['bre_items'] = $bre_items;

        $bre_questions = DB::table('bre_questions')->orderBy('id', 'asc')->get();
        $data['bre_questions'] = $bre_questions;

        $bre_photo_inspection_items = BrePhotoInspectionItem::orderBy('id', 'asc')->get();
        $data['bre_photo_inspection_items'] = $bre_photo_inspection_items;
        //Bre Data End

        //Contract Form Start
        $contract_forms = DB::table('contract_forms')->orderBy('third_party_forms_id', 'asc')->get();
        $data['contract_forms'] = $contract_forms;

        $contract_forms_pdf = DB::table('contract_forms_pdf')->orderBy('id', 'asc')->get();
        $data['contract_forms_pdf'] = $contract_forms_pdf;
        //Contract Form End

        //Cqa Start
        $cqa_areas = DB::table('cqa_areas')->orderBy('id', 'asc')->get();
        $data['cqa_areas'] = $cqa_areas;

        $cqa_items = DB::table('cqa_items')->orderBy('id', 'asc')->get();
        $data['cqa_items'] = $cqa_items;

        $cqa_questions = DB::table('cqa_questions')->orderBy('id', 'asc')->get();
        $data['cqa_questions'] = $cqa_questions;

        $cqa_photo_inspection_items = CqaPhotoInspectionItem::orderBy('id', 'asc')->get();
        $data['cqa_photo_inspection_items'] = $cqa_photo_inspection_items;
        //Cqa End

        //Heat Pump Start
        $heatpump_code = DB::table('heatpump_code')->orderBy('id', 'asc')->get();
        $data['heatpump_code'] = $heatpump_code;
        //Heat Pump End

        //Inspection Start
        $inspections = DB::table('inspections')->orderBy('id', 'asc')->get();
        $data['inspections'] = $inspections;
        //Inspection End

        //Fuel Start
        $fuel_additional_cost = DB::table('fuel_additional_cost')->orderBy('oss_additional_cost_id', 'asc')->get();
        $data['fuel_additional_cost'] = $fuel_additional_cost;

        $fuel_cost = DB::table('fuel_cost')->orderBy('oss_cost_id', 'asc')->get();
        $data['fuel_cost'] = $fuel_cost;

        $fuel_template = DB::table('fuel_template')->orderBy('oss_id', 'asc')->get();
        $data['fuel_template'] = $fuel_template;
        //Fuel End

        //Housing and Measure Start
        $house_type = DB::table('house_type')->orderBy('house_type_id', 'asc')->get();
        $data['house_type'] = $house_type;

        $housing_additional_cost = DB::table('housing_additional_cost')->orderBy('oss_additional_cost_id', 'asc')->get();
        $data['housing_additional_cost'] = $housing_additional_cost;

        $housing_cost = DB::table('housing_cost')->orderBy('oss_cost_id', 'asc')->get();
        $data['housing_cost'] = $housing_cost;

        $housing_template = DB::table('housing_template')->orderBy('oss_id', 'asc')->get();
        $data['housing_template'] = $housing_template;

        $measure = DB::table('measure')->orderBy('measure_id', 'asc')->get();
        $data['measure'] = $measure;
        //Housing and Measure End

        //Notification Start
        $notifications = DB::table('notifications')->orderBy('id', 'asc')->get();
        $data['notifications'] = $notifications;

        $notifications_mobile = DB::table('notifications_mobile')->orderBy('id', 'asc')->get();
        $data['notifications_mobile'] = $notifications_mobile;
        //Notification End

        //Oss Start
        $oss_additional_cost = DB::table('oss_additional_cost')->orderBy('oss_additional_cost_id', 'asc')->get();
        $data['oss_additional_cost'] = $oss_additional_cost;

        $oss_cost = DB::table('oss_cost')->orderBy('oss_cost_id', 'asc')->get();
        $data['oss_cost'] = $oss_cost;

        $oss_template = DB::table('oss_template')->orderBy('oss_id', 'asc')->get();
        $data['oss_template'] = $oss_template;
        //Oss End

        //Pdf retrofit Start
        $pdf_retrofit = DB::table('pdf_retrofit')->orderBy('id', 'asc')->get();
        $data['pdf_retrofit'] = $pdf_retrofit;
        //Pdf retrofit End

        //PI Data Start
        $pi_additional_photos_notes = DB::table('pi_additional_photos_notes')->orderBy('additional_photos_notes_id', 'asc')->get();
        $data['pi_additional_photos_notes'] = $pi_additional_photos_notes;

        $pi_additional_property_detail = DB::table('pi_additional_property_detail')->orderBy('additional_property_detail_id', 'asc')->get();
        $data['pi_additional_property_detail'] = $pi_additional_property_detail;

        $pi_attic_insulation = DB::table('pi_attic_insulation')->orderBy('attic_insulation_id', 'asc')->get();
        $data['pi_attic_insulation'] = $pi_attic_insulation;

        $pi_building_details = DB::table('pi_building_details')->orderBy('building_details_id', 'asc')->get();
        $data['pi_building_details'] = $pi_building_details;

        $pi_drawings_and_photographs = DB::table('pi_drawings_and_photographs')->orderBy('drawings_and_photographs_id', 'asc')->get();
        $data['pi_drawings_and_photographs'] = $pi_drawings_and_photographs;

        $pi_external_installation = DB::table('pi_external_installation')->orderBy('external_installation_id', 'asc')->get();
        $data['pi_external_installation'] = $pi_external_installation;

        $pi_external_installation2 = DB::table('pi_external_installation2')->orderBy('external_installation2_id', 'asc')->get();
        $data['pi_external_installation2'] = $pi_external_installation2;

        $pi_grand_total = DB::table('pi_grand_total')->orderBy('grand_total_id', 'asc')->get();
        $data['pi_grand_total'] = $pi_grand_total;

        $pi_grants_credits = DB::table('pi_grants_credits')->orderBy('grants_credits_id', 'asc')->get();
        $data['pi_grants_credits'] = $pi_grants_credits;

        $pi_heating_upgrade = DB::table('pi_heating_upgrade')->orderBy('heating_upgrade_id', 'asc')->get();
        $data['pi_heating_upgrade'] = $pi_heating_upgrade;

        $pi_wall_insulation = DB::table('pi_wall_insulation')->orderBy('wall_insulation_id', 'asc')->get();
        $data['pi_wall_insulation'] = $pi_wall_insulation;
        //PI Data End

        //Progress Report Start
        $progress_forms_pdf = DB::table('progress_forms_pdf')->orderBy('id', 'asc')->get();
        $data['progress_forms_pdf'] = $progress_forms_pdf;

        $progress_report = DB::table('progress_report')->orderBy('progress_report_id', 'asc')->get();
        $data['progress_report'] = $progress_report;
        //Progress Report End

        //Property and Surveyor/Assessors Start
        $properties = DB::table('properties')->orderBy('batch_id', 'asc')->get();
        $data['properties'] = $properties;

        $property_assessors = DB::table('property_assessors')->orderBy('id', 'asc')->get();
        $data['property_assessors'] = $property_assessors;

        $property_surveyors = DB::table('property_surveyors')->orderBy('id', 'asc')->get();
        $data['property_surveyors'] = $property_surveyors;
        //Property and Surveyor/Assessors End

        //RS Form Start
        $rs_additional_property_detail = DB::table('rs_additional_property_detail')->orderBy('additional_property_detail_id', 'asc')->get();
        $data['rs_additional_property_detail'] = $rs_additional_property_detail;

        $rs_building_details = DB::table('rs_building_details')->orderBy('building_details_id', 'asc')->get();
        $data['rs_building_details'] = $rs_building_details;

        $rs_coomments_photographs = DB::table('rs_coomments_photographs')->orderBy('coomments_photographs_id', 'asc')->get();
        $data['rs_coomments_photographs'] = $rs_coomments_photographs;

        $rs_roof_conditions = DB::table('rs_roof_conditions')->orderBy('roof_conditions_id', 'asc')->get();
        $data['rs_roof_conditions'] = $rs_roof_conditions;

        $rs_roof_services = DB::table('rs_roof_services')->orderBy('roof_services_id', 'asc')->get();
        $data['rs_roof_services'] = $rs_roof_services;

        $rs_roof_types = DB::table('rs_roof_types')->orderBy('roof_types_id', 'asc')->get();
        $data['rs_roof_types'] = $rs_roof_types;

        $rs_roof_ventilation = DB::table('rs_roof_ventilation')->orderBy('roof_ventilation_id', 'asc')->get();
        $data['rs_roof_ventilation'] = $rs_roof_ventilation;

        $rs_spray_plan_for_roof = DB::table('rs_spray_plan_for_roof')->orderBy('spray_plan_for_roof_id', 'asc')->get();
        $data['rs_spray_plan_for_roof'] = $rs_spray_plan_for_roof;
        //RS Form End
        //SIR Form Start
        $sir_base_coat_complete = DB::table('sir_base_coat_complete')->orderBy('base_coat_complete_id', 'asc')->get();
        $data['sir_base_coat_complete'] = $sir_base_coat_complete;

        $sir_boarding_complete = DB::table('sir_boarding_complete')->orderBy('boarding_complete_id', 'asc')->get();
        $data['sir_boarding_complete'] = $sir_boarding_complete;

        $sir_drawings_photographs = DB::table('sir_drawings_photographs')->orderBy('drawings_and_photographs_id', 'asc')->get();
        $data['sir_drawings_photographs'] = $sir_drawings_photographs;

        $sir_finish_coat_complete = DB::table('sir_finish_coat_complete')->orderBy('finish_coat_complete_id', 'asc')->get();
        $data['sir_finish_coat_complete'] = $sir_finish_coat_complete;

        $sir_job_complete = DB::table('sir_job_complete')->orderBy('job_complete_id', 'asc')->get();
        $data['sir_job_complete'] = $sir_job_complete;

        $sir_preparation_complete = DB::table('sir_preparation_complete')->orderBy('preparation_complete_id', 'asc')->get();
        $data['sir_preparation_complete'] = $sir_preparation_complete;
        //SIR Form End

        //Terraco Form Start
        $terraco_forms = DB::table('terraco_forms')->orderBy('id', 'asc')->get();
        $data['terraco_forms'] = $terraco_forms;

        $terraco_forms_pdf = DB::table('terraco_forms_pdf')->orderBy('id', 'asc')->get();
        $data['terraco_forms_pdf'] = $terraco_forms_pdf;
        //Terraco Form End

        //WS Form Start
        $ws_additional_property_detail = DB::table('ws_additional_property_detail')->orderBy('additional_property_detail_id', 'asc')->get();
        $data['ws_additional_property_detail'] = $ws_additional_property_detail;

        $ws_building_details = DB::table('ws_building_details')->orderBy('building_details_id', 'asc')->get();
        $data['ws_building_details'] = $ws_building_details;

        $ws_building_type = DB::table('ws_building_type')->orderBy('building_type_id', 'asc')->get();
        $data['ws_building_type'] = $ws_building_type;

        $ws_condition_of_inner_leaf = DB::table('ws_condition_of_inner_leaf')->orderBy('condition_of_inner_leaf_id', 'asc')->get();
        $data['ws_condition_of_inner_leaf'] = $ws_condition_of_inner_leaf;

        $ws_condition_of_outer_leaf = DB::table('ws_condition_of_outer_leaf')->orderBy('condition_of_outer_leaf_id', 'asc')->get();
        $data['ws_condition_of_outer_leaf'] = $ws_condition_of_outer_leaf;

        $ws_insulation_present_in_cavity = DB::table('ws_insulation_present_in_cavity')->orderBy('insulation_present_in_cavity_id', 'asc')->get();
        $data['ws_insulation_present_in_cavity'] = $ws_insulation_present_in_cavity;

        $ws_new_build_cavity = DB::table('ws_new_build_cavity')->orderBy('new_build_cavity_id', 'asc')->get();
        $data['ws_new_build_cavity'] = $ws_new_build_cavity;

        $ws_services_in_the_cavity = DB::table('ws_services_in_the_cavity')->orderBy('services_in_the_cavity_id', 'asc')->get();
        $data['ws_services_in_the_cavity'] = $ws_services_in_the_cavity;

        $ws_ventilation_through_the_cavity = DB::table('ws_ventilation_through_the_cavity')->orderBy('ventilation_through_the_cavity_id', 'asc')->get();
        $data['ws_ventilation_through_the_cavity'] = $ws_ventilation_through_the_cavity;
        //WS Form End
        return response()->json(['success' => true, 'data' => $data, 'message' => 'Data Fetched.']);
    }

    public function indexUser()
    {
        $user = auth()->user();
        if ($user) {
            $prop_id = $propX = $get3rdPartyForm = $pdfs = [];
            $properties = PropertySurveyor::select('property_surveyors.id as property_surveyors_id'
            , 'property_surveyors.*', 'properties.*', 'schemes.scheme as scheme', 'clients.name as client_name','properties.status as status','properties.status as prop_status')
                ->join('properties', 'properties.id', 'property_surveyors.property_id')
                ->leftjoin('batches', 'batches.id', 'properties.batch_id')
                ->leftjoin('schemes', 'schemes.id', 'batches.scheme_id')
                ->leftjoin('clients', 'clients.id', 'properties.client_id');
                // ->where('properties.status', '!=', 'completed');
                if (\Auth::user()->appname != "Lite") {
                    $properties->where('properties.status', '!=', 'completed');
                }

            if ($user->is_access != 1) {
                $properties->where('property_surveyors.surveyor_id', $user->user_id);
            }

            $properties = $properties->get();
            $myProp = $properties;
            foreach ($properties as $prp2) {
                $property_notes_array = [];
                $statusBEHT = $statusossT = $statushousingT = $statusfuelT = $statusCQAT = $statusCFData = $statusTERRACOData = $statusPRData = $statusRSData = $statusWSData = $statusSIR =
                $statusPI = $statusBASF = $statusGON = $statusMS = $statusTS = $statusHB = $status3RD = $statusHS = $status56 = $status57 = $status58 = $status59 = $status60 = $status61 = 0;
                $form25 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 25)->first();
                $form26 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 26)->first();
                $form22 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 22)->first();
                $form23 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 23)->first();
                $form24 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 24)->first();
                $form11 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 11)->first();
                $form15 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 15)->first();
                $form13 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 13)->first();
                $form6 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 6)->first();
                $form7 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 7)->first();
                $form14 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 14)->first();
                $form12 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 12)->first();
                $form27 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 27)->first(); //BASF Form Check ID FIRST
                $form5 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 5)->first();
                $form8 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 8)->first();
                $form9 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 9)->first();
                $form10 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 10)->first();
                $form4 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 4)->first();
                $form55 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 55)->first();
                $form56 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 56)->first();
                $form57 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 57)->first();
                $form58 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 58)->first();
                $form59 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 59)->first();
                $form60 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 60)->first();
                $form61 = Inspections::where('fk_property_id', $prp2->property_id)->where('fk_forms_id', 61)->first();
                $property_notes_array = DB::table('property_notes')->select('id', 'text', 'property_id as fk_property_id')->where('property_id', $prp2->property_id)->get();

                if ($form25 != null) {$statusBEHT = 1;}
                if ($form22 != null) {$statusossT = 1;}
                if ($form23 != null) {$statushousingT = 1;}
                if ($form24 != null) {$statusfuelT = 1;}
                if ($form26 != null) {$statusCQAT = 1;}
                if ($form11 != null) {$statusCFData = 1;}
                if ($form15 != null) {$statusTERRACOData = 1;}
                if ($form13 != null) {$statusPRData = 1;}
                if ($form6 != null) {$statusRSData = 1;}
                if ($form7 != null) {$statusWSData = 1;}
                if ($form14 != null) {$statusSIR = 1;}
                if ($form12 != null) {$statusPI = 1;}
                if ($form27 != null) {$statusBASF = 1;}
                if ($form5 != null) {$statusGON = 1;}
                if ($form8 != null) {$statusMS = 1;}
                if ($form9 != null) {$statusTS = 1;}
                if ($form10 != null) {$statusHB = 1;}
                if ($form4 != null) {$status3RD = 1;}
                if ($form55 != null) {$statusHS = 1;}
                if ($form56 != null) {$status56 = 1;}
                if ($form57 != null) {$status57 = 1;}
                if ($form58 != null) {$status58 = 1;}
                if ($form59 != null) {$status59 = 1;}
                if ($form60 != null) {$status60 = 1;}
                if ($form61 != null) {$status61 = 1;}

                $prp2['statusBEHT'] = $statusBEHT;
                $prp2['statusossT'] = $statusossT;
                $prp2['statushousingT'] = $statushousingT;
                $prp2['statusfuelT'] = $statusfuelT;
                $prp2['statusCQAT'] = $statusCQAT;
                $prp2['statusCFData'] = $statusCFData;
                $prp2['statusTERRACOData'] = $statusTERRACOData;
                $prp2['statusPRData'] = $statusPRData;
                $prp2['statusRSData'] = $statusRSData;
                $prp2['statusWSData'] = $statusWSData;
                $prp2['statusSIR'] = $statusSIR;
                $prp2['statusPI'] = $statusPI;
                $prp2['statusBASF'] = $statusBASF;
                $prp2['statusGON'] = $statusGON;
                $prp2['statusMS'] = $statusMS;
                $prp2['statusTS'] = $statusTS;
                $prp2['statusHB'] = $statusHB;
                $prp2['status3RD'] = $status3RD;
                $prp2['statusHS'] = $statusHS;
                $prp2['status56'] = $status56;
                $prp2['status57'] = $status57;
                $prp2['status58'] = $status58;
                $prp2['status59'] = $status59;
                $prp2['status60'] = $status60;
                $prp2['status61'] = $status61;
                $prp2['property_notes_array'] = $property_notes_array;

                $propX[] = $prp2;
                $baseURL = URL::to('/assets/uploads/inspection_pdf');
                $datapdfs = Inspections::select('id', 'fk_forms_id', 'fk_property_id', DB::raw('DATE_FORMAT(date(created_date),"%d/%m/%Y")  as date_added'),'created_date', DB::raw('CONCAT("' . $baseURL . '",`pdf_filename`) AS pdf_path'))
                    ->where('fk_property_id', $prp2->property_id)
                    ->where("pdf_filename", '!=', "n/a")
                    ->orderBy("id", "desc")->get();
                if (sizeOf($datapdfs)) {
                    $pdfs[] = $datapdfs;
                }
            }
            foreach ($properties as $prp) {
                $prop_id[] = $prp->property_id;
            }
            if (sizeOf($pdfs)) {
                foreach ($pdfs as $pdx) {
                    $mrAr = array();

                    foreach ($pdx as $pd) {
                        if($pd->fk_forms_id == 25){
                            $dataChecked = Inspections::where('id', $pd->id)
                                    ->with('bre_snag')
                                    ->first();

                                    if(sizeOf($dataChecked['bre_snag'])){
                                    $angArr = $dataChecked['bre_snag']->toArray();
                                    $totalsnag = sizeOf($angArr);
                                    // dd($angArr);
                                    $reported = array_filter($angArr, function($item){
                                        return $item['status'] == "Open";
                                    });
                                    $closed = array_filter($angArr, function($item){
                                        return $item['status'] == "Closed" && $item['is_letest'] == 1;
                                    });
                                    $mainInsp = array_unique(array_column($angArr, 'fk_main_inspection_id'));
                                    if(sizeOf($mainInsp)){
                                        $inspI = $mainInsp[0];
                                    }else{
                                        $inspI = $pd->id;
                                    }
                                    // dd($closed,$totalsnag);
                                    if(sizeOf($closed) && sizeOf($closed) < $totalsnag){
                                        $closed2 = array_filter($angArr, function($item){
                                        return $item['status'] == "Closed";
                                        });
                                        if(sizeOf($closed2) && sizeOf($closed2) == $totalsnag){
                                        $txt = "(Snag Resolved) (# ".$inspI.")";
                                    }else{
                                        $grup = implode('/',array_unique(array_column($closed, 'fk_type')));
                                        $txt = "(Snag Resolved: ".$grup.") (# ".$inspI.")";
                                    }
                                    }else if(sizeOf($closed) && sizeOf($closed) == $totalsnag){
                                        $txt = "(Snag Resolved) (# ".$inspI.")";
                                    }else{
                                        $txt = "(Snag Recorded) (# ".$inspI.")";
                                    }
                                }else{
                                    $txt = "(No Snag Recorded) (# ".$pd->id.")";
                                }
                                $newF['bre_name'] = $txt;
                        }else{
                            $newF['bre_name'] = null;
                        }
                        $newF['date_added'] = $pd->date_added;
                        $newF['time_added'] = date('h:i A',strtotime($pd->created_date));
                        $newF['id'] = $pd->id;
                        $newF['fk_forms_id'] = $pd->fk_forms_id;
                        $newF['fk_property_id'] = $pd->fk_property_id;

                        $newF['pdf_path'] = $pd->pdf_path;
                        $newFx[] = $newF;
                    }
                    $mrAr = array_merge($mrAr, $newFx);

                }
            } else {
                $mrAr = [];
            }
            $ItemListData = [];
            foreach ($myProp as $prpx) {

                $chck = [];
                $chk2 = null;
                $chck = PhotoInspectionItem::where('fk_user_id', $prpx->surveyor_id)->where('fk_property_id', $prpx->property_id)->where('fk_property_surveyors_id', $prpx->property_surveyors_id)->groupBy('fk_inspection_id')->get();
                if (sizeOf($chck)) {

                    $g = [];
                    foreach ($chck as $key => $pdfDisplayv) {
                        $chk2 = [];

                        $chk2 = Inspections::select('inspections.id', 'inspections.pdf_filename', 'photo_inspection_items.id as fid', 'photo_inspection_items.fk_item_id')
                            ->leftjoin('photo_inspection_items', 'photo_inspection_items.fk_inspection_id', 'inspections.id')
                            ->where('photo_inspection_items.fk_inspection_id', $pdfDisplayv->fk_inspection_id)
                            ->where('inspections.fk_user_id', $pdfDisplayv->fk_user_id)
                            ->where('inspections.fk_property_id', $pdfDisplayv->fk_property_id)
                            ->where('inspections.property_surveyors_id', $pdfDisplayv->fk_property_surveyors_id)->groupBy('inspections.id')->get();

                        $g[] = $chk2;

                    }
                    // }

                    $arrf = [];
                    if (sizeOf($g)) {
                        foreach ($g as $k) {
                            foreach ($k as $arrval) {
                                $inspId = $arrval->id;
                                $pdffilename = $arrval->pdf_filename;
                                $fkItem = $arrval->fk_item_id;
                                $photoinsid = $arrval->fid;
                            }
                            if ($pdffilename == 'n/a') {
                                $pdflink = '';
                            } else {
                                $baseURL = 'https://futurefit.bcrcomply.com/futurefitapi/public/assets/uploads/inspection_pdf';
                                $pdflink = $baseURL . $pdffilename;
                            }

                            $ItemListData[] = [
                                'insp_id' => $inspId,
                                'photo_insp_id' => $photoinsid,
                                'prop_id' => $prpx->property_id,
                                'fk_item_id' => $fkItem,
                                'pdflink' => $pdflink,
                            ];
                        }

                    }
                }
            }
            $filepath = 'https://futurefit.bcrcomply.com/files/';
            // $contractProperty = DB::table('contractor_property')->select('contractor_property.*','users.firstname')
            // ->leftjoin('users','users.id','contractor_property.contractor_id')->orderBy('contractor_property.id', 'asc')->get();
            $contractProperty = DB::table('contractor_property')
                ->select('contractor_property.*', 'users.firstname', 'job_lookups.id as ajob_id', DB::raw("DATE_FORMAT(contractor_property.start_date, '%d-%m-%Y') AS start_date"),
                    DB::raw("DATE_FORMAT(contractor_property.end_date, '%d-%m-%Y') AS end_date")
                    , 'job_lookups.title as job', 'job_lookups.type as lookup_type')
                ->leftjoin('job_lookups', 'job_lookups.id', 'contractor_property.job_id')
                ->leftjoin('users', 'users.id', 'contractor_property.contractor_id')->orderBy('contractor_property.id', 'asc')->get();

            $get3rdPartyFormArr = DB::table('3rd_party_forms')->select('3rd_party_forms.*', DB::raw('CONCAT("' . $filepath . '",`file_path`) AS file_path'))->orderBy('id', 'asc')->get();
            // $get3rdPartyForm = [];
            foreach ($prop_id as $pId) {
                $get3rdPartyForm = [];
                $get3rdPartyForms = DB::table('3rd_party_forms')->select('3rd_party_forms.*', DB::raw('CONCAT("' . $filepath . '",`file_path`) AS file_path'))->where('fk_property_id', $pId)->orderBy('id', 'asc')->get();
                if (sizeOf($get3rdPartyForms)) {
                    $get3rdPartyForm[] = $get3rdPartyForms;
                }
            }
            $datamx = [];
            if (sizeOf($ItemListData)) {
                foreach ($ItemListData as $il) {

                    if ($il['pdflink'] != "") {
                        $datamx[$il['prop_id'] . "+" . $il['fk_item_id']] = $il;
                    }

                }
            }

            $tFpdf = $cFpdf = [];
            foreach ($prop_id as $xpId) {

                $terraco_forms_pdf = DB::table('terraco_forms_pdf')->where('property_id', $xpId)->orderBy('id', 'desc')->first();
                $contract_forms_pdf = DB::table('contract_forms_pdf')->where('property_id', $xpId)->orderBy('id', 'desc')->first();
                if ($terraco_forms_pdf != null) {
                    $tFpdf[] = $terraco_forms_pdf;
                }
                if ($contract_forms_pdf != null) {
                    $cFpdf[] = $contract_forms_pdf;
                }
            }

            $currentDate = date('Y-m-d');
            $inspectionsTodaysData = $inspectionsOverdueData = $inspectionsFutureData = $inspectionsLeadData = [];
            if (\Auth::user()->appname == "Lite") {
                if (sizeOf($propX) && count($propX) > 0) {
                    $newPrxs = $this->filterAndGroupProperty($propX);
                    foreach ($newPrxs as $key => $valueInspectionsData) {
                        // dd($valueInspectionsData);
                        if ($valueInspectionsData['survey_date'] != "" && $valueInspectionsData['survey_date'] != "0000-00-00") {
                            if($valueInspectionsData['prop_status'] == 'completed'){
                                $inspectionsTodaysData[] = $valueInspectionsData;
                            } else{
                                $inspectionsFutureData[] = $valueInspectionsData;
                            }
                        }
                    }
                }
            }else{
                if (sizeOf($propX) && count($propX) > 0) {
                    
                    $newPrxs = $this->filterAndGroupProperty($propX);
                    foreach ($newPrxs as $key => $valueInspectionsData) {
                        
                        if ($valueInspectionsData['survey_date'] != "" && $valueInspectionsData['survey_date'] != "0000-00-00") {
                            if($valueInspectionsData['prop_status'] == 'lead' || $valueInspectionsData['prop_status'] == 'quoted' ||
                            $valueInspectionsData['prop_status'] == 'appointment_booked' || $valueInspectionsData['prop_status'] == 'surveyed' ||
                            $valueInspectionsData['prop_status'] == 'confirmed' || $valueInspectionsData['prop_status'] == 'will-follow-up'){
                                $inspectionsLeadData[] = $valueInspectionsData;
                            } else{
                                $inspectionsOverdueData[] = $valueInspectionsData;
                            }
                        }
                    }
                }
            }
            $getBatches = [];
            $baseURLs = URL::to('/assets/uploads/snag_photo/');
            $getSnag = SnagRecord::select('snag_records.*','bre_items.item')
            ->leftjoin('bre_items','bre_items.id','snag_records.fk_item_id')
            ->orderBy('snag_records.id','desc')
            ->get();
            // ->get()->unique(function ($item) {
            //     if ($item->fk_question_id === null || $item->fk_item_id === null || $item->fk_type === null || $item->fk_main_inspection_id === null) {
            //         return $item->id; // Return a unique identifier for records with null values
            //     }
            //     // If none of the values are null, proceed with the uniqueness comparison
            //     return [$item->fk_question_id, $item->fk_item_id, $item->fk_type,$item->fk_main_inspection_id];
            // })->values() // Reset the keys to sequential
            // ->toArray();
            $getSnagArray = SnagRecordComment::select('snag_records_comments.*'
                , DB::raw("IF(image1 != '', CONCAT('" . $baseURLs . "/', image1), null) AS image1")
                , DB::raw("IF(image2 != '', CONCAT('" . $baseURLs . "/', image2), null) AS image2")
                , DB::raw("IF(image3 != '', CONCAT('" . $baseURLs . "/', image3), null) AS image3")
                , DB::raw("IF(image4 != '', CONCAT('" . $baseURLs . "/', image4), null) AS image4")
                , DB::raw("IF(image5 != '', CONCAT('" . $baseURLs . "/', image5), null) AS image5"))->get();
            $getSnagReplyArray = SnagRecordReplyComment::select('snag_records_reply_comment.*'
                , DB::raw("IF(image1 != '', CONCAT('" . $baseURLs . "/', image1), null) AS image1")
                , DB::raw("IF(image2 != '', CONCAT('" . $baseURLs . "/', image2), null) AS image2")
                , DB::raw("IF(image3 != '', CONCAT('" . $baseURLs . "/', image3), null) AS image3")
                , DB::raw("IF(image4 != '', CONCAT('" . $baseURLs . "/', image4), null) AS image4")
                , DB::raw("IF(image5 != '', CONCAT('" . $baseURLs . "/', image5), null) AS image5"))->get();
            $getSchemes = DB::table('schemes')->select('*')->orderBy('id', 'asc')->get();
            $data['schemes'] = $getSchemes;

            $workOrders = DB::table('works_orders')->select('works_orders.id as id', 'works_orders.file_name as file_name', 'works_orders.fk_contractor_property_id as fkc_id',
                DB::raw("IF(file_path != '', CONCAT('" . $filepath . "/', file_path), null) AS file_path"))->get();
            $filesRecord = DB::table('files')->select('files.id as id', 'files.document as file_name', 'files.contract_id as fkc_id',
                DB::raw("IF(file != '', CONCAT('" . $filepath . "/', file), null) AS file_path"))->get();
            $jobDocs = DB::table('job_documents')->select('job_documents.id', 'job_documents.job_look_id', 'job_documents.title')->get();
            $jobLookup = DB::table('job_lookups')->select('job_lookups.id', 'job_lookups.title', 'job_lookups.type')->where('type', 'contractor_job')->get();
            $docLibrary = DB::table('document_library')->select('document_library.*',
                DB::raw("IF(file != '', CONCAT('" . $filepath . "/', file), null) AS file_path"))->get();
            //Toolbox talk start
            $toolBox = DB::table('toolbox_talk')->where('status','opened')->where('is_archived',0)->orderBy('id','asc')->get();
            $toolBoxItem = DB::table('toolbox_talk_items')->select('toolbox_talk_items.*')->join('toolbox_talk','toolbox_talk.id','toolbox_talk_items.fk_toolbox_talk_id')
            ->where('toolbox_talk.status','opened')->where('toolbox_talk.is_archived',0)->orderBy('toolbox_talk_items.id','asc')->get();

            $data['toolBox'] = $toolBox;
            $data['toolBoxItem'] = $toolBoxItem;
            //Toolbox talk end
            //Start New Integation of Property inspection
            $photo_folder_names = DB::table('photo_folder_names')->select('*')->orderBy('id', 'asc')->get();
            $data['photo_folder_names'] = $photo_folder_names;
            $pifMainStage = DB::table('pif_main_stage')->select('*')->orderBy('id', 'asc')->get();
            $data['pifMainStage'] = $pifMainStage;
            $pif_additional_photo_note = DB::table('pif_additional_photo_note')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_additional_photo_note'] = $pif_additional_photo_note;
            $pif_additional_property_details = DB::table('pif_additional_property_details')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_additional_property_details'] = $pif_additional_property_details;
            $pif_attic_ins = DB::table('pif_attic_ins')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_attic_ins'] = $pif_attic_ins;
            $pif_building_details = DB::table('pif_building_details')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_building_details'] = $pif_building_details;
            $pif_draw_photo = DB::table('pif_draw_photo')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_draw_photo'] = $pif_draw_photo;
            $pif_ext_ins_one = DB::table('pif_ext_ins_one')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_ext_ins_one'] = $pif_ext_ins_one;
            $pif_ext_ins_two = DB::table('pif_ext_ins_two')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_ext_ins_two'] = $pif_ext_ins_two;
            $pif_grand_total = DB::table('pif_grand_total')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_grand_total'] = $pif_grand_total;
            $pif_grant_credit = DB::table('pif_grant_credit')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_grant_credit'] = $pif_grant_credit;
            $pif_heat_upgrade = DB::table('pif_heat_upgrade')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_heat_upgrade'] = $pif_heat_upgrade;
            $pif_iternal = DB::table('pif_iternal')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_iternal'] = $pif_iternal;
            $pif_iternal_room_data = DB::table('pif_iternal_room_data')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_iternal_room_data'] = $pif_iternal_room_data;
            $pif_wall_insulation = DB::table('pif_wall_insulation')->select('*')->orderBy('id', 'asc')->get();
            $data['pif_wall_insulation'] = $pif_wall_insulation;
            $filterData = [];
            $newData = $getSchemes;
            $newData = $newData->toArray();

            $filterData = array_values(array_filter($newData, function($item){
                return $item->scheme == "Leads";
            }));
            if(sizeOf($filterData)){
                $leID = $filterData[0];
                $getBatches = DB::table('batches')->select('*')->where('scheme_id','!=',$leID->id)->get();
                $data['batches'] = $getBatches;
                $getBatches2 = DB::table('batches')->select('*')->where('scheme_id',$leID->id)->get();
                $data['lead_batches'] = $getBatches2;
            }else{
                $getBatches = DB::table('batches')->select('*')->get();
                $data['batches'] = $getBatches;
                $data['lead_batches'] = [];
            }
            //grouped Data Start
            $pifMainStage2 = DB::table('pif_main_stage')->select('id', 'name')->orderBy('id', 'asc')->get();
            $mainSub = $pifMainStage;
            $pifQuestionAnswer = $appointMentArr = [];
            foreach ($mainSub as $pifM) {
                $getSub = DB::table('pif_two_stage')->select('pif_two_stage.fk_main_stage_id as stage_id', 'pif_main_stage.name as stage_name'
                    , 'pif_two_stage.id','pif_two_stage.section_name', 'pif_two_stage.name', 'pif_two_stage.option_type', 'pif_two_stage.option_name')
                    ->join('pif_main_stage', 'pif_main_stage.id', 'pif_two_stage.fk_main_stage_id')
                    ->where('pif_two_stage.fk_main_stage_id', $pifM->id)->orderBy('pif_two_stage.id', 'asc')->get()->toArray();
                $pifQuestionAnswer = array_merge($pifQuestionAnswer, $getSub);
            }
            $groupedArray = collect($pifQuestionAnswer)->groupBy('stage_id')->map(function ($stageGroup) {
                return $stageGroup->groupBy('name');
            })->toArray();
            $appointmentArr = DB::table('appointment_data')
            ->whereRaw("JSON_CONTAINS(JSON_EXTRACT(appointment_contractors, '$'), '{\"id\": \"$user->user_id\"}', '$')")
            ->get();
            $data['pifQuestionAnswer'] = $groupedArray;
            //grouped Data End

            foreach($appointmentArr as $ar){
                $ar->names_list = $ar->prop_name = $ar->prop_num = null;
                $getP = DB::table('properties')->where('id',$ar->property_id)->first();
                if($getP){
                    $ar->prop_name = $getP->wh_fname.' '.$getP->wh_lname;
                    $ar->prop_num = $getP->phone1 ? $getP->phone1 : "";
                }
                $contractors = $names = [];
                $contractors = json_decode($ar->appointment_contractors, true);
                foreach ($contractors as $contractor) {
                    if (isset($contractor['full_name'])) {
                        $names[] = $contractor['full_name'];
                    }
                }
                if(sizeOf($names)){
                    $names_list = implode(', ', $names);
                    $ar->names_list = $names_list;
                }
            }
            $data['appointmentArr'] = $appointmentArr;
            $data['inspectionsTodaysData'] = $inspectionsTodaysData;
            $data['inspectionsOverdueData'] = $inspectionsOverdueData;
            $data['inspectionsLeadData'] = $inspectionsLeadData;
            $data['inspectionsFutureData'] = $inspectionsFutureData;
            $data['contractProperty'] = $contractProperty;
            $data['terraco_forms_pdf'] = $tFpdf;

            $data['contract_forms_pdf'] = $cFpdf;
            $data['contract_forms_single_pdf'] = env("APP_URL").'/assets/uploads/contract_pdf/contract.pdf';
            $data['pdfs'] = $mrAr;
            $data['properties'] = $propX;
            $data['ItemListData'] = array_values($datamx);
            $data['get3rdPartyForm'] = $get3rdPartyFormArr;
            $data['get3rdPartyFormArr'] = $get3rdPartyFormArr;
            $data['getSnag'] = $getSnag;
            $data['getSnagArray'] = $getSnagArray;
            $data['getSnagReplyArray'] = $getSnagReplyArray;
            $data['workOrders'] = $workOrders;
            $data['filesRecord'] = $filesRecord;
            $data['jobDocs'] = $jobDocs;
            $data['jobLookup'] = $jobLookup;
            $data['docLibrary'] = $docLibrary;

            $house_type = DB::table('house_type')->orderBy('house_type_id', 'asc')->get();
            $measure = DB::table('measure')->orderBy('measure_id', 'asc')->get();
            $data['house_type'] = $house_type;
            $data['measure'] = $measure;

            //Retrofit Form Start
            $areas = DB::table('areas')->orderBy('id', 'asc')->get();
            $items = DB::table('items')->orderBy('id', 'asc')->get();
            $questions = DB::table('questions')->orderBy('id', 'asc')->get();
            $data['areas'] = $areas;
            $data['items'] = $items;
            $data['questions'] = $questions;
            //Retrofit Form End

            //Bre Data Start
            $bre_areas = DB::table('bre_areas')->orderBy('id', 'asc')->get();
            $bre_items = DB::table('bre_items')->orderBy('id', 'asc')->get();
            $bre_questions = DB::table('bre_questions')->orderBy('id', 'asc')->get();
            $data['bre_areas'] = $bre_areas;
            $data['bre_items'] = $bre_items;
            $data['bre_questions'] = $bre_questions;
            //Bre Data End

            //Cqa Start
            $cqa_areas = DB::table('cqa_areas')->orderBy('id', 'asc')->get();
            $cqa_items = DB::table('cqa_items')->orderBy('id', 'asc')->get();
            $cqa_questions = DB::table('cqa_questions')->orderBy('id', 'asc')->get();
            $data['cqa_areas'] = $cqa_areas;
            $data['cqa_items'] = $cqa_items;
            $data['cqa_questions'] = $cqa_questions;
            //Cqa End

            //Heat Pump Start
            $heatpump_code = DB::table('heatpump_code')->orderBy('id', 'asc')->get();
            $data['heatpump_code'] = $heatpump_code;
            //Heat Pump End

            return response()->json(['success' => true, 'data' => $data, 'message' => 'Data Fetched.']);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function indexUser2()
    {
        $user = auth()->user();
        if ($user) {

            $properties = PropertySurveyor::select('property_surveyors.id as property_surveyors_id', 'property_surveyors.*', 'properties.*', 'clients.type as scheme')
                ->join('properties', 'properties.id', 'property_surveyors.property_id')
                ->join('clients', 'clients.id', 'properties.client_id')
                ->where('property_surveyors.surveyor_id', $user->user_id)
                ->get();
            foreach ($properties as $prp) {
                $status35 = 0;
                $status33 = 0;
                $status14 = 0;
                $statusAC = 0;
                $statusRS = 0;
                $statusWS = 0;
                $statusMS = 0;
                $statusTS = 0;
                $statusHB = 0;
                $statusCF = 0;
                $statusPI = 0;
                $statusPR = 0;
                $statusSIR = 0;
                $statusTERRACO = 0;
                $statusossT = 0;
                $statushousingT = 0;
                $statusfuelT = 0;
                $statusBEHT = 0;
                $statusCQA = 0;
                $form1 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 1)->first();
                $form2 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 2)->first();
                $form3 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 3)->first();
                $form5 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 5)->first();
                $form6 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 6)->first();
                $form7 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 7)->first();
                $form8 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 8)->first();
                $form9 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 9)->first();
                $form10 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 10)->first();
                $form11 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 11)->first();
                $form12 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 12)->first();
                $form13 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 13)->first();
                $form14 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 14)->first();
                $form15 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 15)->first();
                $form22 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 22)->first();
                $form23 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 23)->first();
                $form24 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 24)->first();
                $form25 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 25)->first();
                $form26 = Inspections::where('fk_property_id', $prp->property_id)->where('fk_forms_id', 26)->first();

                if ($form1 != null) {$status35 = 1;}if ($form2 != null) {$status33 = 1;}if ($form3 != null) {$status14 = 1;}
                if ($form5 != null) {$statusAC = 1;}if ($form6 != null) {$statusRS = 1;}if ($form7 != null) {$statusWS = 1;}
                if ($form8 != null) {$statusMS = 1;}if ($form9 != null) {$statusTS = 1;}if ($form10 != null) {$statusHB = 1;}
                if ($form11 != null) {$statusCF = 1;}if ($form12 != null) {$statusPI = 1;}if ($form13 != null) {$statusPR = 1;}
                if ($form14 != null) {$statusSIR = 1;}if ($form15 != null) {$statusTERRACO = 1;}if ($form22 != null) {$statusossT = 1;}
                if ($form23 != null) {$statushousingT = 1;}if ($form24 != null) {$statusfuelT = 1;}if ($form25 != null) {$statusBEHT = 1;}
                if ($form26 != null) {$statusCQA = 1;}

                $prp['status35'] = $status35;
                $prp['status33'] = $status33;
                $prp['status14'] = $status14;
                $prp['statusAC'] = $statusAC;
                $prp['statusRS'] = $statusRS;
                $prp['statusWS'] = $statusWS;
                $prp['statusMS'] = $statusMS;
                $prp['statusTS'] = $statusTS;
                $prp['statusHB'] = $statusHB;
                $prp['statusCF'] = $statusCF;
                $prp['statusPI'] = $statusPI;
                $prp['statusPR'] = $statusPR;
                $prp['statusSIR'] = $statusSIR;
                $prp['statusTERRACO'] = $statusTERRACO;
                $prp['statusossT'] = $statusossT;
                $prp['statushousingT'] = $statushousingT;
                $prp['statusfuelT'] = $statusfuelT;
                $prp['statusBEHT'] = $statusBEHT;
                $prp['statusCQA'] = $statusCQA;

                $propX[] = $prp;
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function testNotification(Request $request)
    {
        $meta = true;
        if ($meta) {
            $session_other_status = 1;
            $token = 'fqfdFZ7XSHqLrSp0JyU8zR:APA91bHpyMBOU18C9feL9GRsUT0X4mL5yYj62HEaIVmICAZTv13OAqiKFEJ7aNYoU5Vi8cVWnrSdkWnxGalEBVDa54SrlA3NBuUxmXA65gtsjtzBL0sWdaGL1n_rjgiS2sfFcmDYielW';
            $body = "hello USer";
            $title = "Test Notification";
            $fcmUrl = 'https://fcm.googleapis.com/v1/projects/bcr-comply-2/messages:send';

            $token = $token;
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
            if ($token != "") {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $fcmUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                $result = curl_exec($ch);
                dd($result);
                curl_close($ch);
            }
            return true;
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
    public function filterAndGroupProperty($array)
    {
        $result = [];
        $data1 = array_filter($array, function($item1){
            return $item1['surveyor_id'] == \Auth::user()->user_id;
        });
        return $data1;
    }
}
