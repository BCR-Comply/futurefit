<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Inspections;
use App\Models\NotifiationMobile;
use App\Models\PhotoFolderName;
use App\Models\PropertySurveyor;
use App\Models\PropertyNotes;
use App\Models\TblUser;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\User;
use App\Models\Properties;
use App\Models\ContractorMessage;
use Carbon\Carbon;
use App\Models\ContactFormPdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;
use DateTime;

class GeneralController extends Controller
{
    public function index(Request $request)
    {
        $success = [];
        $message = 'Hello Succeded.';
        return sendResponse('', $message);
    }
    public function userLoginStatus(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $updateData = TblUser::find($user->user_id);
            $updateData->user_login_status = $request->user_login_status;
            $updateData->update();
            if ($updateData) {
                $data = TblUser::select('user_id', 'full_name', 'email', 'phone_number', 'user_login_status')->where('user_id', $user->user_id)->first();
                return response()->json(['success' => true, "userData" => $data, 'message' => 'User status updated.', 'code' => 200]);
            } else {
                return response()->json(['success' => false, "userData" => [], 'message' => 'User status update failed.', 'code' => 404]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    function reportDelete(Request $request, $inspection_id, $type, $mode = 'delete')
    {
        // dd($request, $inspection_id, $type, $mode);
        $template = '';
        $data = [];
        if ($type == 13) { //Progress Report

            $progR = DB::table('progress_report')->where('fk_inspection_id',$inspection_id)->delete();
            $deleteInsp = DB::table('inspections')->where('id',$inspection_id)->delete();
            if ($progR && $deleteInsp) {
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } else {
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 12) { //Pre Works Inspection
                DB::beginTransaction();
                try {
                    DB::table('pi_building_details')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_wall_insulation')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_external_installation')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_external_installation2')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_attic_insulation')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_heating_upgrade')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_grand_total')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_grants_credits')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_additional_photos_notes')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_drawings_and_photographs')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_additional_property_detail')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('pi_iternal_insulation')->where('fk_inspection_id', $inspection_id)->delete();

                    DB::table('inspections')->where('id', $inspection_id)->delete();
                    DB::commit();
                    return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
                }
        } else if ($type == 22) { //OSS Quotation
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('oss_template')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('oss_cost')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 24) { //Fuel Quotation
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('fuel_template')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('fuel_cost')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 23) { //Hosuing Quotation
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('housing_template')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('housing_cost')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 25) { //Better Energy Homes QA
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('bre_photo_inspection_items')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 21) { // Installer Progress Report
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('photo_inspection_items')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 7) { // CWI Survey
            DB::beginTransaction();
                try {
                    DB::table('ws_additional_property_detail')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_building_details')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_building_type')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_condition_of_inner_leaf')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_condition_of_outer_leaf')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_insulation_present_in_cavity')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_new_build_cavity')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_services_in_the_cavity')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('ws_ventilation_through_the_cavity')->where('fk_inspection_id', $inspection_id)->delete();

                    DB::table('inspections')->where('id', $inspection_id)->delete();
                    DB::commit();
                    return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
                }
        } else if ($type == 14) { // EWI Installer Progress Report
            DB::beginTransaction();
                try {
                    DB::table('sir_base_coat_complete')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('sir_boarding_complete')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('sir_drawings_photographs')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('sir_finish_coat_complete')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('sir_job_complete')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('sir_preparation_complete')->where('fk_inspection_id', $inspection_id)->delete();

                    DB::table('inspections')->where('id', $inspection_id)->delete();
                    DB::commit();
                    return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
                }

        } else if ($type == 26) { // Contractors QA
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('cqa_photo_inspection_items')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        } else if ($type == 6) { // Roof Survey
            DB::beginTransaction();
                try {
                    DB::table('rs_additional_property_detail')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_building_details')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_coomments_photographs')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_roof_conditions')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_roof_services')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_roof_types')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_roof_ventilation')->where('fk_inspection_id', $inspection_id)->delete();
                    DB::table('rs_spray_plan_for_roof')->where('fk_inspection_id', $inspection_id)->delete();

                    DB::table('inspections')->where('id', $inspection_id)->delete();
                    DB::commit();
                    return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
                } catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
                }

        } else if ($type == 55){
            DB::beginTransaction();
            try {
                // Delete records from related tables
                DB::table('risk_safety_form')->where('fk_inspection_id', $inspection_id)->delete();
                DB::table('inspections')->where('id', $inspection_id)->delete();
                DB::commit();
                return response()->json(['success' => true,"data" => [], 'message' => 'Inspection & Report Deleted Successfully..', 'code' => 200]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            }
        }else {
            return response()->json(['success' => false, "userData" => [], 'message' => 'Failed to delete Inspection & Report.', 'code' => 404]);
            abort(404);
        }

    }
    public function notiCount(Request $request)
    {
        $user = auth()->user();
        $subCount = [];
        if ($user) {
            // dd($user);
            $allcount = DB::table('contractor_message')->select(DB::raw('COUNT(CASE WHEN is_read = 1 THEN 1 ELSE NULL END) as is_read_count'))->where('to_user',$user->contractor_id)->first();
            $subCount = DB::table('contractor_message')
            ->select('from_user', DB::raw('COUNT(CASE WHEN is_read = 1 THEN 1 ELSE NULL END) as is_read_count'))
            ->where('to_user', $user->contractor_id)
            ->groupBy('from_user')
            ->get();
            // dd($allcount,$subCount);
            if($allcount){
                return response()->json(['success' => true, "allCount" => $allcount,"subCount" => $subCount, 'message' => 'User data fetched.', 'code' => 200]);
            }else{
                return response()->json(['success' => false, "userData" => [], 'message' => 'User data updat failed.', 'code' => 404]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function chatList(Request $request)
    {
        $user = auth()->user();
        $chatData = [];
        $messages = [];
        if ($user) {

        $contractorId = $user->contractor_id;
        $chat_users = ContractorMessage::selectRaw('DISTINCT from_user, to_user')
        ->where(function($query) use ($contractorId){
            $query->where('from_user', $contractorId)
                ->orWhere('to_user', $contractorId);
        })
        ->whereNotNull('property_id')
        ->orderBy('message_time','desc')
        ->get();
        $chats = [];
        foreach ($chat_users as $chat_user) {
            if (!in_array($chat_user->from_user, $chats) && $chat_user->from_user != $contractorId) {
                array_push($chats, $chat_user->from_user);
            }
            if (!in_array($chat_user->to_user, $chats) && $chat_user->to_user != $contractorId) {
                array_push($chats, $chat_user->to_user);
            }
        }

        $chatData = [];
        foreach ($chats as $chat) {
            // $messages = ContractorMessage::where(function ($query) use ($contractorId, $chat) {
            //     $query->where('from_user', $contractorId)->where('to_user', $chat);
            // })->orWhere(function ($query) use ($contractorId, $chat) {
            //     $query->where('from_user', $chat)->where('to_user', $contractorId);
            // })->orderBy('id', 'DESC')->get();
            $messagesx = ContractorMessage::whereNotNull('property_id')
            ->where(function($query) use ($chat,$contractorId) {
                $query->where([
                        ['from_user', '=', $contractorId],
                        ['to_user', '=', $chat],
                    ])
                    ->orWhere([
                        ['from_user', '=', $chat],
                        ['to_user', '=', $contractorId],
                    ]);
            })
            // ->groupBy('property_id')
            ->orderBy('id','desc')
            ->get()->unique('property_id');
            // $message = $messages->first();
            foreach($messagesx as $message){

            if($message->from_user == $contractorId){
                $oppositeId =  $message->to_user;
                $sumIsRead = 0;
            }else{
                $sumIsRead = $messagesx->sum('is_read');
                $oppositeId =  $message->from_user;
            }
            $user_data = User::where('id', $chat)->first();
            if($user_data != null){
                $getProp = DB::table('properties')->select('*')->where('id',$message->property_id)->first();
                $address = format_address($getProp->house_num,$getProp->address1,$getProp->address2,$getProp->address3,$getProp->county,$getProp->eircode);
                if($message->message_time != null){
                   $date = new DateTime($message->message_time);
                   $formatted_date = $date->format('Y-m-d\TH:i:s.u\Z');
                }else{
                    $formatted_date = $message->created_at;
                }
            array_push(
                $chatData,
                array(
                    'id' => $message->id,
                    'opposite_id' => $oppositeId,
                    'firstname' => $user_data->firstname,
                    'lastname' => $user_data->lastname,
                    'content' => $message->content,
                    'created_at' => $message->created_at,
                    'updated_at' => $message->updated_at,
                    'attachment' => $message->attachment,
                    'extension' => $message->extension,
                    'from_user' => $message->from_user,
                    'to_user' => $message->to_user,
                    'is_read' => $message->is_read,
                    'is_read_count' => $sumIsRead,
                    'address' => $address,
                    'property_id' => $message->property_id,
                    'msg_date' => $formatted_date
                )
            );
            }else{
                $chatData = [];
            }
            }
        }
        // dd($all_chats);
            if($chatData){
                return response()->json(['success' => true,"chatData" => $chatData, 'message' => 'Chat list fetched successfully.', 'code' => 200]);
            }else{
                return response()->json(['success' => false, "chatData" => [], 'message' => 'No chats available.', 'code' => 404]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function myPropertyList()
    {
        $user = auth()->user();
        $properties = [];
        if ($user) {
            $properties = DB::table('property_surveyors')->select('properties.*')
                ->join('properties', 'properties.id', 'property_surveyors.property_id')
                ->join('clients', 'clients.id', 'properties.client_id')
                ->where('property_surveyors.surveyor_id', $user->user_id)
                ->groupBy('property_surveyors.property_id')
                ->get();
            if(sizeOf($properties))
            {
                return response()->json(['success' => true,"properties" => $properties, 'message' => 'Properties list fetched successfully.', 'code' => 200]);
            }else{
                return response()->json(['success' => false, "properties" => [], 'message' => 'No Properties available.', 'code' => 404]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function chatListByUser(Request $request)
    {
        $user = auth()->user();
        $chatData = [];
        if ($user) {
            // dd($user->contractor_id);
            $chatData2 = DB::table('contractor_message')->where('from_user',$request->from_user)->where('to_user',$user->contractor_id)->update([
                    "is_read"   => 0
                ]);
            $baseURL = URL::to('/uploads/chat-attachments');

            $chatData = DB::table('contractor_message')
            ->select('contractor_message.*', 'users.firstname', 'users.lastname','message_time as created_at','message_time as updated_at', DB::raw('CONCAT("https://futurefit.bcrcomply.com/uploads/chat-attachments/", contractor_message.attachment) AS attachment_path'))
            ->join('users', 'users.id', '=', 'contractor_message.from_user')
            ->where(function ($query) use ($request, $user) {
                $query->where([
                    ['contractor_message.from_user', '=', $request->from_user],
                    ['contractor_message.to_user', '=', $user->contractor_id]
                ])->orWhere([
                    ['contractor_message.from_user', '=', $user->contractor_id],
                    ['contractor_message.to_user', '=', $request->from_user]
                ]);
            })
            ->where('property_id', $request->property_id)
            ->orderBy('contractor_message.message_time', 'asc')
            ->get();

            if($chatData){

                return response()->json(['success' => true,"chatData" => $chatData, 'message' => 'Chat list fetched successfully.', 'code' => 200]);
            }else{
                return response()->json(['success' => false, "userData" => [], 'message' => 'No chats available.', 'code' => 404]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function listAdmins(Request $request)
    {
        $user = auth()->user();
        $data = [];
        if ($user) {
            $data = User::select('id','firstname','lastname','email','role as role','usertype')->where('role','admin')->where('status', 1)->get()->toArray();

            if($data){
                return response()->json(['success' => true, "userData" => $data, 'message' => 'User data fetched.', 'code' => 200]);
            }else{
                return response()->json(['success' => false, "userData" => [], 'message' => 'User data updat failed.', 'code' => 404]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function sendApiMessage(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // dd($request->all());
            $timezone = thisismyip();
            date_default_timezone_set($timezone);
            if($request->content == null){
                $contant = "";
            }else{
                $contant = $request->content;
            }
            $attachment = NULL;
            if ($request->hasFile('attachment')) {

                $file_frontimage = $request->file('attachment');
                $actual_filename_frontimage = $file_frontimage->getClientOriginalName();
                $filename_frontimage = 'attachment_' . time() . '_' . $actual_filename_frontimage;
                $file_frontimage->storeAs('uploads/chat-attachments', $filename_frontimage, 'parent_disk');
                $attachment = $filename_frontimage;
            }
                $saveN = DB::table('contractor_message')->insert([
                    'from_user' => $user->contractor_id,
                    'to_user' => $request->to_user,
                    'content' => $contant,
                    'is_read' => 1,
                    'attachment' => $attachment,
                    'property_id'=>$request->property_id,
                    'message_time'=> date('Y-m-d H:i:s'),
                    'extension'=> isset($request->extension) ? $request->extension : ""
                ]);
                $options = array(
                    'cluster' => 'eu',
                    'useTLS' => true,
                );

                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );

                $data = ['from' => $user->contractor_id, 'to' => $request->to_user]; // sending from and to user id when pressed enter
                $pusher->trigger('my-channel', 'my-event', $data);
                if($saveN){
                    return response()->json(['success' => true, "userData" => $saveN, 'message' => 'Message Sent Successfully.', 'code' => 200]);
                }else{
                    return response()->json(['success' => false, "userData" => [], 'message' => 'Message send failed.', 'code' => 404]);
                }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function userRegisterDisplay()
    {
        $user = auth()->user();
        if ($user) {
            $data = TblUser::select('user_id', 'full_name', 'email', 'phone_number', 'company')->where('user_id', $user->user_id)->first();
            $getConf = DB::table('config')->select('id as config_id','email as company_email', DB::raw('CONCAT("https://futurefit.bcrcomply.com/assets/images/company_logo/", company_logo) AS company_logo'),'name','phone','mobile','website','instagram_link','linkedin_link','youtube_link','facebook_link','tiktok_link','x_link','android_path','ios_path')->first();
            $mergedData = collect($data)->merge((array)$getConf);
            return response()->json(['success' => true, "userData" => $mergedData, 'message' => 'User data fetched.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function imageWork($image)
    {
        $year = date('Y');
        $month = date('m');
        if (!is_dir('assets/uploads/user_signinout/' . $year)) {
            mkdir('./assets/uploads/user_signinout/' . $year . '/' . $month, 0777, true);
        } else if (is_dir('assets/uploads/user_signinout/' . $year)) {
            if (!is_dir('assets/uploads/user_signinout/' . $year . '/' . $month)) {
                mkdir('./assets/uploads/user_signinout/' . $year . '/' . $month, 0777, true);
            }
        }
        $uploadPath = "./assets/uploads/user_signinout/" . $year . "/" . $month . "/";
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
        // $mP = "http://localhost/LiveProjects/bcrRetro/public/bcrapi/public/assets/uploads/user_signinout/";
        return $year . "/" . $month . "/" . $imageName;
    }
    public function imgFunctionGlobal2($image)
    {
        $year = date('Y');
        $month = date('m');
        $image_path = "assets/uploads/user_signinout/{$year}/{$month}/";
        if (!is_dir(public_path($image_path))) {
            mkdir(public_path($image_path), 0777, true);
        }
        $photo = $image;
        $imageName = 'img-' . time() . '_' . mt_rand(11111, 99999) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path($image_path), $imageName);
        $imagePath = "{$year}/{$month}/{$imageName}";

        return $imagePath;
    }
    public function userRegisterUpdate(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'phone_number' => 'required',
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return sendError('Validation Error.', $validator->errors(), 422);
            }
            $updateData = TblUser::find($user->user_id);
            $updateData->full_name = $request->full_name;
            $updateData->phone_number = $request->phone_number;
            $updateData->email = $request->email;
            $updateData->update();
            if ($updateData) {
                $data = TblUser::select('user_id', 'full_name', 'email', 'phone_number', 'company')->where('user_id', $user->user_id)->first();
                return response()->json(['success' => true, "userData" => $data, 'message' => 'User data updated.', 'code' => 200]);
            } else {
                return response()->json(['success' => false, "userData" => [], 'message' => 'User data updat failed.', 'code' => 404]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function thirdPartyForms(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $propertyID = $request->property_id;
            $getForm = DB::table('3rd_party_forms')->where('fk_property_id', $propertyID)->where('archived', 0)->orderBy('id', 'asc')->get();
            foreach ($getForm as $value) {
                $filepath = 'https://futurefit.bcrcomply.com/files/' . $value->file_path;
                $Data1[] = [
                    'id' => $value->id,
                    'fk_property_id' => $value->fk_property_id,
                    'type' => $value->type,
                    'supplied_by' => $value->supplied_by,
                    'file_path' => $filepath,
                    'notes' => $value->notes,
                    'created_at' => $value->created_at,
                    'updated_at' => $value->updated_at,

                ];
            }
            return response()->json(['success' => true, "data" => $Data1, 'message' => 'User data fetched.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function userNotificationList()
    {
        $user = auth()->user();
        if ($user) {
            $notif = NotifiationMobile::where('fk_user_id', $user->user_id)->orderBy('id', 'desc')->get();
            foreach ($notif as $nf) {
                $update = NotifiationMobile::find($nf->id);
                $update->seen = 'y';
                $update->update();
            }
            $data = NotifiationMobile::where('fk_user_id', $user->user_id)->orderBy('id', 'desc')->get();
            return response()->json(['success' => true, "notificationList" => $data, 'message' => 'Notification list fetched.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function userNotificationCount()
    {
        $user = auth()->user();
        if ($user) {

            $data = NotifiationMobile::where('fk_user_id', $user->user_id)->orderBy('id', 'desc')->get();
            return response()->json(['success' => true, "notification_count" => count($data), 'message' => 'Notification count fetched.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function getClients()
    {
        $user = auth()->user();
        if ($user) {
            $clients = [];
            $clients = DB::table('clients')->select('id', 'name', 'email')->groupBy('email')->get();

            return response()->json(['success' => true, "data" => $clients, 'message' => 'Clients fetched.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }

    }

    public function signInOutPropUser(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            if (isset($request->inoutid) && $request->inoutid != '') {
                // if ($request->signout_image1 != "null" && sizeOf(json_decode($request->signout_image1))) {
                //     $outimageName1 = $this->imageWork($request->signout_image1);
                // } else {
                //     $outimageName1 = "";
                // }
                // if ($request->signout_image2 != "null" && sizeOf(json_decode($request->signout_image2))) {
                //     $outimageName2 = $this->imageWork($request->signout_image2);
                // } else {
                //     $outimageName2 = "";
                // }
                // if ($request->signout_image3 != "null" && sizeOf(json_decode($request->signout_image3))) {
                //     $outimageName3 = $this->imageWork($request->signout_image3);
                // } else {
                //     $outimageName3 = "";
                // }
                // if ($request->signout_image4 != "null" && sizeOf(json_decode($request->signout_image4))) {
                //     $outimageName4 = $this->imageWork($request->signout_image4);
                // } else {
                //     $outimageName4 = "";
                // }
                // if ($request->signout_image5 != "null" && sizeOf(json_decode($request->signout_image5))) {
                //     $outimageName5 = $this->imageWork($request->signout_image5);
                // } else {
                //     $outimageName5 = "";
                // }
                // if ($request->signout_image6 != "null" && sizeOf(json_decode($request->signout_image6))) {
                //     $outimageName6 = $this->imageWork($request->signout_image6);
                // } else {
                //     $outimageName6 = "";
                // }
                // if ($request->signout_image7 != "null" && sizeOf(json_decode($request->signout_image7))) {
                //     $outimageName7 = $this->imageWork($request->signout_image7);
                // } else {
                //     $outimageName7 = "";
                // }
                // if ($request->signout_image8 != "null" && sizeOf(json_decode($request->signout_image8))) {
                //     $outimageName8 = $this->imageWork($request->signout_image8);
                // } else {
                //     $outimageName8 = "";
                // }
                // if ($request->signout_image9 != "null" && sizeOf(json_decode($request->signout_image9))) {
                //     $outimageName9 = $this->imageWork($request->signout_image9);
                // } else {
                //     $outimageName9 = "";
                // }
                // if ($request->signout_image10 != "null" && sizeOf(json_decode($request->signout_image10))) {
                //     $outimageName10 = $this->imageWork($request->signout_image10);
                // } else {
                //     $outimageName10 = "";
                // }
                // if ($request->signout_image11 != "null" && sizeOf(json_decode($request->signout_image11))) {
                //     $outimageName11 = $this->imageWork($request->signout_image11);
                // } else {
                //     $outimageName11 = "";
                // }
                // if ($request->signout_image12 != "null" && sizeOf(json_decode($request->signout_image12))) {
                //     $outimageName12 = $this->imageWork($request->signout_image12);
                // } else {
                //     $outimageName12 = "";
                // }
                // if ($request->signout_image13 != "null" && sizeOf(json_decode($request->signout_image13))) {
                //     $outimageName13 = $this->imageWork($request->signout_image13);
                // } else {
                //     $outimageName13 = "";
                // }
                // if ($request->signout_image14 != "null" && sizeOf(json_decode($request->signout_image14))) {
                //     $outimageName14 = $this->imageWork($request->signout_image14);
                // } else {
                //     $outimageName14 = "";
                // }
                // if ($request->signout_image15 != "null" && sizeOf(json_decode($request->signout_image15))) {
                //     $outimageName15 = $this->imageWork($request->signout_image15);
                // } else {
                //     $outimageName15 = "";
                // }
                if ($request->hasFile('signout_signature')) {

                    $file_frontimage = $request->file('signout_signature');
                    $actual_filename_frontimage = $file_frontimage->getClientOriginalName();
                    $filename_frontimage = 'signinout_' . time() . '_' . $actual_filename_frontimage;
                    $file_frontimage->storeAs('signinout_signature', $filename_frontimage, 'parent_disk');
                    // $save = DB::table('user_prop_signin_out')->where('id', $request->inoutid)->update([
                    //     'sign_date' => $request->sign_date,
                    //     'sign_time' => $request->sign_time,
                    //     'sign_tt' => $request->sign_tt,
                    //     'sign_e_date' => $request->sign_e_date,
                    //     'sign_e_time' => $request->sign_e_time,
                    //     'sign_e_tt' => $request->sign_e_tt,
                    //     'property_id' => $request->property_id,
                    //     'type' => $request->type,
                    //     'signout_text' => $request->signout_text,
                    //     'signout_signature' => $filename_frontimage,
                    //     'user_id' => $user->user_id,
                    //     'signout_image1' => $outimageName1,
                    //     'signout_image2' => $outimageName2,
                    //     'signout_image3' => $outimageName3,
                    //     'signout_image4' => $outimageName4,
                    //     'signout_image5' => $outimageName5,
                    //     'signout_image6' => $outimageName6,
                    //     'signout_image7' => $outimageName7,
                    //     'signout_image8' => $outimageName8,
                    //     'signout_image9' => $outimageName9,
                    //     'signout_image10' => $outimageName10,
                    //     'signout_image11' => $outimageName11,
                    //     'signout_image12' => $outimageName12,
                    //     'signout_image13' => $outimageName13,
                    //     'signout_image14' => $outimageName14,
                    //     'signout_image15' => $outimageName15,
                    //     // 'created_at' => Carbon::now(),
                    //     'updated_at' => Carbon::now(),
                    // ]);
                    $saveData = [
                        'sign_date' => $request->sign_date,
                        'sign_time' => $request->sign_time,
                        'sign_tt' => $request->sign_tt,
                        'sign_e_date' => $request->sign_e_date,
                        'sign_e_time' => $request->sign_e_time,
                        'sign_e_tt' => $request->sign_e_tt,
                        'property_id' => $request->property_id,
                        'type' => $request->type,
                        'signout_text' => $request->signout_text,
                        'signout_signature' => $filename_frontimage,
                        'user_id' => $user->user_id,
                        'updated_at' => Carbon::now(),
                    ];
                    for ($i = 1; $i <= 15; $i++) {
                        $fieldName = 'signout_image' . $i;
                        if ($request->hasFile($fieldName)) {
                            $imageName = $this->imgFunctionGlobal2($request->file($fieldName));
                            $saveData[$fieldName] = $imageName;
                        } else {
                            $saveData[$fieldName] = "";
                        }

                    }
                    $save = DB::table('user_prop_signin_out')->where('id', $request->inoutid)->update($saveData);
                } else {
                    $saveData = [
                        'sign_date' => $request->sign_date,
                        'sign_time' => $request->sign_time,
                        'sign_tt' => $request->sign_tt,
                        'sign_e_date' => $request->sign_e_date,
                        'sign_e_time' => $request->sign_e_time,
                        'sign_e_tt' => $request->sign_e_tt,
                        'property_id' => $request->property_id,
                        'type' => $request->type,
                        'signout_text' => $request->signout_text,
                        'user_id' => $user->user_id,
                        'updated_at' => Carbon::now(),
                    ];
                    for ($i = 1; $i <= 15; $i++) {
                        $fieldName = 'signout_image' . $i;
                        if ($request->hasFile($fieldName)) {
                            $imageName = $this->imgFunctionGlobal2($request->file($fieldName));
                            $saveData[$fieldName] = $imageName;
                        } else {
                            $saveData[$fieldName] = "";
                        }

                    }
                    $save = DB::table('user_prop_signin_out')->where('id', $request->inoutid)->update($saveData);
                    // $save = DB::table('user_prop_signin_out')->where('id', $request->inoutid)->update([
                    //     'sign_date' => $request->sign_date,
                    //     'sign_time' => $request->sign_time,
                    //     'sign_tt' => $request->sign_tt,
                    //     'sign_e_date' => $request->sign_e_date,
                    //     'sign_e_time' => $request->sign_e_time,
                    //     'sign_e_tt' => $request->sign_e_tt,
                    //     'property_id' => $request->property_id,
                    //     'type' => $request->type,
                    //     'signout_text' => $request->signout_text,
                    //     'user_id' => $user->user_id,
                    //     'signout_image1' => $outimageName1,
                    //     'signout_image2' => $outimageName2,
                    //     'signout_image3' => $outimageName3,
                    //     'signout_image4' => $outimageName4,
                    //     'signout_image5' => $outimageName5,
                    //     'signout_image6' => $outimageName6,
                    //     'signout_image7' => $outimageName7,
                    //     'signout_image8' => $outimageName8,
                    //     'signout_image9' => $outimageName9,
                    //     'signout_image10' => $outimageName10,
                    //     'signout_image11' => $outimageName11,
                    //     'signout_image12' => $outimageName12,
                    //     'signout_image13' => $outimageName13,
                    //     'signout_image14' => $outimageName14,
                    //     'signout_image15' => $outimageName15,
                    //     // 'created_at' => Carbon::now(),
                    //     'updated_at' => Carbon::now(),
                    // ]);
                }
            } else {
                // if ($request->signin_image1 != "null" && sizeOf(json_decode($request->signin_image1))) {
                //     $inimageName1 = $this->imageWork($request->signin_image1);
                // } else {
                //     $inimageName1 = "";
                // }
                // if ($request->signin_image2 != "null" && sizeOf(json_decode($request->signin_image2))) {
                //     $inimageName2 = $this->imageWork($request->signin_image2);
                // } else {
                //     $inimageName2 = "";
                // }
                // if ($request->signin_image3 != "null" && sizeOf(json_decode($request->signin_image3))) {
                //     $inimageName3 = $this->imageWork($request->signin_image3);
                // } else {
                //     $inimageName3 = "";
                // }
                // if ($request->signin_image4 != "null" && sizeOf(json_decode($request->signin_image4))) {
                //     $inimageName4 = $this->imageWork($request->signin_image4);
                // } else {
                //     $inimageName4 = "";
                // }
                // if ($request->signin_image5 != "null" && sizeOf(json_decode($request->signin_image5))) {
                //     $inimageName5 = $this->imageWork($request->signin_image5);
                // } else {
                //     $inimageName5 = "";
                // }
                // if ($request->signin_image6 != "null" && sizeOf(json_decode($request->signin_image6))) {
                //     $inimageName6 = $this->imageWork($request->signin_image6);
                // } else {
                //     $inimageName6 = "";
                // }
                // if ($request->signin_image7 != "null" && sizeOf(json_decode($request->signin_image7))) {
                //     $inimageName7 = $this->imageWork($request->signin_image7);
                // } else {
                //     $inimageName7 = "";
                // }
                // if ($request->signin_image8 != "null" && sizeOf(json_decode($request->signin_image8))) {
                //     $inimageName8 = $this->imageWork($request->signin_image8);
                // } else {
                //     $inimageName8 = "";
                // }
                // if ($request->signin_image9 != "null" && sizeOf(json_decode($request->signin_image9))) {
                //     $inimageName9 = $this->imageWork($request->signin_image9);
                // } else {
                //     $inimageName9 = "";
                // }
                // if ($request->signin_image10 != "null" && sizeOf(json_decode($request->signin_image10))) {
                //     $inimageName10 = $this->imageWork($request->signin_image10);
                // } else {
                //     $inimageName10 = "";
                // }
                // if ($request->signin_image11 != "null" && sizeOf(json_decode($request->signin_image11))) {
                //     $inimageName11 = $this->imageWork($request->signin_image11);
                // } else {
                //     $inimageName11 = "";
                // }
                // if ($request->signin_image12 != "null" && sizeOf(json_decode($request->signin_image12))) {
                //     $inimageName12 = $this->imageWork($request->signin_image12);
                // } else {
                //     $inimageName12 = "";
                // }
                // if ($request->signin_image13 != "null" && sizeOf(json_decode($request->signin_image13))) {
                //     $inimageName13 = $this->imageWork($request->signin_image13);
                // } else {
                //     $inimageName13 = "";
                // }
                // if ($request->signin_image14 != "null" && sizeOf(json_decode($request->signin_image14))) {
                //     $inimageName14 = $this->imageWork($request->signin_image14);
                // } else {
                //     $inimageName14 = "";
                // }
                // if ($request->signin_image15 != "null" && sizeOf(json_decode($request->signin_image15))) {
                //     $inimageName15 = $this->imageWork($request->signin_image15);
                // } else {
                //     $inimageName15 = "";
                // }
                if ($request->hasFile('signature')) {
                    $file_frontimage = $request->file('signature');
                    $actual_filename_frontimage = $file_frontimage->getClientOriginalName();
                    $filename_frontimage = 'signinout_' . time() . '_' . $actual_filename_frontimage;
                    $file_frontimage->storeAs('signinout_signature', $filename_frontimage, 'parent_disk');
                    $saveData = [
                        'sign_date' => $request->sign_date,
                        'sign_time' => $request->sign_time,
                        'sign_tt' => $request->sign_tt,
                        'sign_e_date' => $request->sign_e_date,
                        'sign_e_time' => $request->sign_e_time,
                        'sign_e_tt' => $request->sign_e_tt,
                        'property_id' => $request->property_id,
                        'type' => $request->type,
                        'text' => $request->text,
                        'signature' => $filename_frontimage,
                        'user_id' => $user->user_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                    for ($i = 1; $i <= 15; $i++) {
                        $fieldName = 'signin_image'.$i;
                        if ($request->hasFile($fieldName)) {
                            $imageName = $this->imgFunctionGlobal2($request->file($fieldName));
                            $saveData[$fieldName] = $imageName;
                        } else {
                            $saveData[$fieldName] = "";
                        }

                    }
                    $save = DB::table('user_prop_signin_out')->insert($saveData);
                    // $save = DB::table('user_prop_signin_out')->insert([
                    //     'sign_date' => $request->sign_date,
                    //     'sign_time' => $request->sign_time,
                    //     'sign_tt' => $request->sign_tt,
                    //     'sign_e_date' => $request->sign_e_date,
                    //     'sign_e_time' => $request->sign_e_time,
                    //     'sign_e_tt' => $request->sign_e_tt,
                    //     'property_id' => $request->property_id,
                    //     'type' => $request->type,
                    //     'text' => $request->text,
                    //     'signature' => $filename_frontimage,
                    //     'user_id' => $user->user_id,
                    //     'signin_image1' => $inimageName1,
                    //     'signin_image2' => $inimageName2,
                    //     'signin_image3' => $inimageName3,
                    //     'signin_image4' => $inimageName4,
                    //     'signin_image5' => $inimageName5,
                    //     'signin_image6' => $inimageName6,
                    //     'signin_image7' => $inimageName7,
                    //     'signin_image8' => $inimageName8,
                    //     'signin_image9' => $inimageName9,
                    //     'signin_image10' => $inimageName10,
                    //     'signin_image11' => $inimageName11,
                    //     'signin_image12' => $inimageName12,
                    //     'signin_image13' => $inimageName13,
                    //     'signin_image14' => $inimageName14,
                    //     'signin_image15' => $inimageName15,
                    //     'created_at' => Carbon::now(),
                    //     'updated_at' => Carbon::now(),
                    // ]);
                } else {
                    $saveData = [
                        'sign_date' => $request->sign_date,
                        'sign_time' => $request->sign_time,
                        'sign_tt' => $request->sign_tt,
                        'sign_e_date' => $request->sign_e_date,
                        'sign_e_time' => $request->sign_e_time,
                        'sign_e_tt' => $request->sign_e_tt,
                        'property_id' => $request->property_id,
                        'type' => $request->type,
                        'text' => $request->text,
                        'user_id' => $user->user_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                    for ($i = 1; $i <= 15; $i++) {
                        $fieldName = 'signin_image' . $i;
                        if ($request->hasFile($fieldName)) {
                            $imageName = $this->imgFunctionGlobal2($request->file($fieldName));
                            $saveData[$fieldName] = $imageName;
                        } else {
                            $saveData[$fieldName] = "";
                        }

                    }
                    $save = DB::table('user_prop_signin_out')->insert($saveData);
                    // $save = DB::table('user_prop_signin_out')->insert([
                    //     'sign_date' => $request->sign_date,
                    //     'sign_time' => $request->sign_time,
                    //     'sign_tt' => $request->sign_tt,
                    //     'sign_e_date' => $request->sign_e_date,
                    //     'sign_e_time' => $request->sign_e_time,
                    //     'sign_e_tt' => $request->sign_e_tt,
                    //     'property_id' => $request->property_id,
                    //     'type' => $request->type,
                    //     'text' => $request->text,
                    //     'user_id' => $user->user_id,
                    //     'signin_image1' => $inimageName1,
                    //     'signin_image2' => $inimageName2,
                    //     'signin_image3' => $inimageName3,
                    //     'signin_image4' => $inimageName4,
                    //     'signin_image5' => $inimageName5,
                    //     'signin_image6' => $inimageName6,
                    //     'signin_image7' => $inimageName7,
                    //     'signin_image8' => $inimageName8,
                    //     'signin_image9' => $inimageName9,
                    //     'signin_image10' => $inimageName10,
                    //     'signin_image11' => $inimageName11,
                    //     'signin_image12' => $inimageName12,
                    //     'signin_image13' => $inimageName13,
                    //     'signin_image14' => $inimageName14,
                    //     'signin_image15' => $inimageName15,
                    //     'created_at' => Carbon::now(),
                    //     'updated_at' => Carbon::now(),
                    // ]);
                }
            }
            $save2 = DB::table('user_prop_signin_out')->select('user_prop_signin_out.*', DB::raw("CONCAT('https://futurefit.bcrcomply.com/signinout_signature/', signature) AS signature"), 'properties.house_num'
                , 'properties.address1', 'properties.address2', 'properties.address3', 'properties.county', 'properties.eircode', 'tbl_user.full_name')
                ->join('properties', 'properties.id', 'user_prop_signin_out.property_id')
                ->join('tbl_user', 'tbl_user.user_id', 'user_prop_signin_out.user_id')
                ->where('user_prop_signin_out.user_id', $user->user_id)->orderBy('user_prop_signin_out.created_at', 'desc')->get();
                $getProp = DB::table('properties')->where('id',$request->property_id)->first();
                $fulladdress = implode(",", array_filter([$getProp->house_num, $getProp->address1,$getProp->address2,$getProp->address3])) ;

                $saveD = DB::table('logs')->insert([
                    'author' => $user->full_name,
                    'type' => $request->type,
                    'address' => $fulladdress,
                    'property_id' => $request->property_id,
                    'first_name' => 'N/A',
                    'last_name' => 'N/A',

                ]);
            return response()->json(['success' => true, "userData" => $save2, 'message' => 'You have ' . $request->type . ' Successfully.', 'code' => 200]);

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function getTimeSheetStatus($id)
    {
        $user = auth()->user();
        $url = 'https://futurefit.bcrcomply.com/files/';
        $baseURL2 = URL::to('/assets/uploads/user_signinout');

        if ($user) {
            $save2 = DB::table('user_prop_signin_out')->select('user_prop_signin_out.*'
            , DB::raw("CONCAT('https://futurefit.bcrcomply.com/signinout_signature/', signature) AS signature")
            , DB::raw("IF(signout_signature != '',CONCAT('https://futurefit.bcrcomply.com/signinout_signature/', signout_signature), null) AS signout_signature")
            , DB::raw("IF(signin_image1 != '', CONCAT('".$baseURL2."/', signin_image1), null) AS signin_image1")
            , DB::raw("IF(signin_image2 != '', CONCAT('".$baseURL2."/', signin_image2), null) AS signin_image2")
            , DB::raw("IF(signin_image3 != '', CONCAT('".$baseURL2."/', signin_image3), null) AS signin_image3")
            , DB::raw("IF(signin_image4 != '', CONCAT('".$baseURL2."/', signin_image4), null) AS signin_image4")
            , DB::raw("IF(signin_image5 != '', CONCAT('".$baseURL2."/', signin_image5), null) AS signin_image5")
            , DB::raw("IF(signin_image6 != '', CONCAT('".$baseURL2."/', signin_image6), null) AS signin_image6")
            , DB::raw("IF(signin_image7 != '', CONCAT('".$baseURL2."/', signin_image7), null) AS signin_image7")
            , DB::raw("IF(signin_image8 != '', CONCAT('".$baseURL2."/', signin_image8), null) AS signin_image8")
            , DB::raw("IF(signin_image9 != '', CONCAT('".$baseURL2."/', signin_image9), null) AS signin_image9")
            , DB::raw("IF(signin_image10 != '', CONCAT('".$baseURL2."/', signin_image10), null) AS signin_image10")
            , DB::raw("IF(signin_image11 != '', CONCAT('".$baseURL2."/', signin_image11), null) AS signin_image11")
            , DB::raw("IF(signin_image12 != '', CONCAT('".$baseURL2."/', signin_image12), null) AS signin_image12")
            , DB::raw("IF(signin_image13 != '', CONCAT('".$baseURL2."/', signin_image13), null) AS signin_image13")
            , DB::raw("IF(signin_image14 != '', CONCAT('".$baseURL2."/', signin_image14), null) AS signin_image14")
            , DB::raw("IF(signin_image15 != '', CONCAT('".$baseURL2."/', signin_image15), null) AS signin_image15")
            , DB::raw("IF(signout_image1 != '', CONCAT('".$baseURL2."/', signout_image1), null) AS signout_image1")
            , DB::raw("IF(signout_image2 != '', CONCAT('".$baseURL2."/', signout_image2), null) AS signout_image2")
            , DB::raw("IF(signout_image3 != '', CONCAT('".$baseURL2."/', signout_image3), null) AS signout_image3")
            , DB::raw("IF(signout_image4 != '', CONCAT('".$baseURL2."/', signout_image4), null) AS signout_image4")
            , DB::raw("IF(signout_image5 != '', CONCAT('".$baseURL2."/', signout_image5), null) AS signout_image5")
            , DB::raw("IF(signout_image6 != '', CONCAT('".$baseURL2."/', signout_image6), null) AS signout_image6")
            , DB::raw("IF(signout_image7 != '', CONCAT('".$baseURL2."/', signout_image7), null) AS signout_image7")
            , DB::raw("IF(signout_image8 != '', CONCAT('".$baseURL2."/', signout_image8), null) AS signout_image8")
            , DB::raw("IF(signout_image9 != '', CONCAT('".$baseURL2."/', signout_image9), null) AS signout_image9")
            , DB::raw("IF(signout_image10 != '', CONCAT('".$baseURL2."/', signout_image10), null) AS signout_image10")
            , DB::raw("IF(signout_image11 != '', CONCAT('".$baseURL2."/', signout_image11), null) AS signout_image11")
            , DB::raw("IF(signout_image12 != '', CONCAT('".$baseURL2."/', signout_image12), null) AS signout_image12")
            , DB::raw("IF(signout_image13 != '', CONCAT('".$baseURL2."/', signout_image13), null) AS signout_image13")
            , DB::raw("IF(signout_image14 != '', CONCAT('".$baseURL2."/', signout_image14), null) AS signout_image14")
            , DB::raw("IF(signout_image15 != '', CONCAT('".$baseURL2."/', signout_image15), null) AS signout_image15")
            , 'properties.house_num'
                , 'properties.address1', 'properties.address2', 'properties.address3', 'properties.county', 'properties.eircode', 'tbl_user.full_name')
                ->join('properties', 'properties.id', 'user_prop_signin_out.property_id')
                ->join('tbl_user', 'tbl_user.user_id', 'user_prop_signin_out.user_id')
                ->where('user_prop_signin_out.user_id', $user->user_id)
                ->where('user_prop_signin_out.property_id', $id)
                ->whereNotNull('user_prop_signin_out.sign_date')
                ->whereNull('user_prop_signin_out.sign_e_date')
                ->orderBy('user_prop_signin_out.created_at', 'desc')->first();
            return response()->json(['success' => true, "userData" => $save2, 'message' => 'User data fetched.', 'code' => 200]);

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function safepassUpdate(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            if ($request->hasFile('contractor_safe_pass_photo')) {
                $file_frontimage = $request->file('contractor_safe_pass_photo');
                $actual_filename_frontimage = $file_frontimage->getClientOriginalName();
                $filename_frontimage = 'safepass_' . time() . '_' . $actual_filename_frontimage;
                $file_frontimage->storeAs('files', $filename_frontimage, 'parent_disk');
                $find = DB::table('users')->where('email', $user->email)->update([
                    'contractor_next_of_kin_name' => $request->contractor_next_of_kin_name,
                    'contractor_next_of_kin_phone' => $request->contractor_next_of_kin_phone,
                    'contractor_safe_pass_expiry' => $request->contractor_safe_pass_expiry,
                    'contractor_medical_issue' => $request->contractor_medical_issue,
                    'contractor_agree_to_health_and_safety_procedure' => $request->contractor_agree_to_health_and_safety_procedure,
                    'contractor_safe_pass_photo' => $filename_frontimage,
                ]);
            } else {
                $find = DB::table('users')->where('email', $user->email)->update([
                    'contractor_next_of_kin_name' => $request->contractor_next_of_kin_name,
                    'contractor_next_of_kin_phone' => $request->contractor_next_of_kin_phone,
                    'contractor_safe_pass_expiry' => $request->contractor_safe_pass_expiry,
                    'contractor_medical_issue' => $request->contractor_medical_issue,
                    'contractor_agree_to_health_and_safety_procedure' => $request->contractor_agree_to_health_and_safety_procedure,
                ]);
            }
            $find2 = DB::table('users')->select('users.*', DB::raw("IF(contractor_safe_pass_photo != '', CONCAT('https://futurefit.bcrcomply.com/files/', contractor_safe_pass_photo), null) AS contractor_safe_pass_photo"))->where('email', $user->email)->first();

            return response()->json(['success' => true, "userData" => $find2, 'message' => 'Safepass data updated.', 'code' => 200]);

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function safepassData()
    {
        $user = auth()->user();
        $url = 'https://futurefit.bcrcomply.com/files/';
        if ($user) {
            $getUsr = DB::table('users')->where('email', $user->email)->first();
            if ($getUsr == null) {
                $nameArr = explode(' ', trim($user->full_name));
                $firstName = $nameArr[0] ?? null;
                $lastName = ($nameArr[1] ?? null) ? implode(' ', array_slice($nameArr, 1)) : null;
                $new = new User();
                $new->firstname = $firstName;
                $new->lastname = $lastName;
                $new->email = $user->email;
                $new->password = $user->password;
                $new->usertype = 'User';
                $new->role = 'contractor';
                $new->phone = $user->phone_number;
                $new->company = $user->company;
                $new->save();

                $data1 = DB::table('users')->select('users.*', DB::raw("IF(contractor_safe_pass_photo != '', CONCAT('https://futurefit.bcrcomply.com/files/', contractor_safe_pass_photo), null) AS contractor_safe_pass_photo"))->where('email', $user->email)->first();
                $data = $data1;
            } else {
                $data = DB::table('users')->select('users.*', DB::raw("IF(contractor_safe_pass_photo != '', CONCAT('https://futurefit.bcrcomply.com/files/', contractor_safe_pass_photo), null) AS contractor_safe_pass_photo"))->where('email', $user->email)->first();
            }

            return response()->json(['success' => true, "userData" => $data, 'message' => 'Safepass data retrived.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function getSignInOutPropUser(Request $request)
    {
        $user = auth()->user();
        if ($user) {
        $baseURL2 = URL::to('/assets/uploads/user_signinout');

            $save2 = DB::table('user_prop_signin_out')->select('user_prop_signin_out.*'
            , DB::raw("CONCAT('https://futurefit.bcrcomply.com/signinout_signature/', signature) AS signature")
            , DB::raw("IF(signout_signature != '',CONCAT('https://futurefit.bcrcomply.com/signinout_signature/', signout_signature), null) AS signout_signature")
            , DB::raw("IF(signin_image1 != '', CONCAT('".$baseURL2."/', signin_image1), null) AS signin_image1")
            , DB::raw("IF(signin_image2 != '', CONCAT('".$baseURL2."/', signin_image2), null) AS signin_image2")
            , DB::raw("IF(signin_image3 != '', CONCAT('".$baseURL2."/', signin_image3), null) AS signin_image3")
            , DB::raw("IF(signin_image4 != '', CONCAT('".$baseURL2."/', signin_image4), null) AS signin_image4")
            , DB::raw("IF(signin_image5 != '', CONCAT('".$baseURL2."/', signin_image5), null) AS signin_image5")
            , DB::raw("IF(signin_image6 != '', CONCAT('".$baseURL2."/', signin_image6), null) AS signin_image6")
            , DB::raw("IF(signin_image7 != '', CONCAT('".$baseURL2."/', signin_image7), null) AS signin_image7")
            , DB::raw("IF(signin_image8 != '', CONCAT('".$baseURL2."/', signin_image8), null) AS signin_image8")
            , DB::raw("IF(signin_image9 != '', CONCAT('".$baseURL2."/', signin_image9), null) AS signin_image9")
            , DB::raw("IF(signin_image10 != '', CONCAT('".$baseURL2."/', signin_image10), null) AS signin_image10")
            , DB::raw("IF(signin_image11 != '', CONCAT('".$baseURL2."/', signin_image11), null) AS signin_image11")
            , DB::raw("IF(signin_image12 != '', CONCAT('".$baseURL2."/', signin_image12), null) AS signin_image12")
            , DB::raw("IF(signin_image13 != '', CONCAT('".$baseURL2."/', signin_image13), null) AS signin_image13")
            , DB::raw("IF(signin_image14 != '', CONCAT('".$baseURL2."/', signin_image14), null) AS signin_image14")
            , DB::raw("IF(signin_image15 != '', CONCAT('".$baseURL2."/', signin_image15), null) AS signin_image15")
            , DB::raw("IF(signout_image1 != '', CONCAT('".$baseURL2."/', signout_image1), null) AS signout_image1")
            , DB::raw("IF(signout_image2 != '', CONCAT('".$baseURL2."/', signout_image2), null) AS signout_image2")
            , DB::raw("IF(signout_image3 != '', CONCAT('".$baseURL2."/', signout_image3), null) AS signout_image3")
            , DB::raw("IF(signout_image4 != '', CONCAT('".$baseURL2."/', signout_image4), null) AS signout_image4")
            , DB::raw("IF(signout_image5 != '', CONCAT('".$baseURL2."/', signout_image5), null) AS signout_image5")
            , DB::raw("IF(signout_image6 != '', CONCAT('".$baseURL2."/', signout_image6), null) AS signout_image6")
            , DB::raw("IF(signout_image7 != '', CONCAT('".$baseURL2."/', signout_image7), null) AS signout_image7")
            , DB::raw("IF(signout_image8 != '', CONCAT('".$baseURL2."/', signout_image8), null) AS signout_image8")
            , DB::raw("IF(signout_image9 != '', CONCAT('".$baseURL2."/', signout_image9), null) AS signout_image9")
            , DB::raw("IF(signout_image10 != '', CONCAT('".$baseURL2."/', signout_image10), null) AS signout_image10")
            , DB::raw("IF(signout_image11 != '', CONCAT('".$baseURL2."/', signout_image11), null) AS signout_image11")
            , DB::raw("IF(signout_image12 != '', CONCAT('".$baseURL2."/', signout_image12), null) AS signout_image12")
            , DB::raw("IF(signout_image13 != '', CONCAT('".$baseURL2."/', signout_image13), null) AS signout_image13")
            , DB::raw("IF(signout_image14 != '', CONCAT('".$baseURL2."/', signout_image14), null) AS signout_image14")
            , DB::raw("IF(signout_image15 != '', CONCAT('".$baseURL2."/', signout_image15), null) AS signout_image15")
            , 'properties.house_num'
                , 'properties.address1', 'properties.address2', 'properties.address3', 'properties.county', 'properties.eircode', 'tbl_user.full_name')
                ->join('properties', 'properties.id', 'user_prop_signin_out.property_id')
                ->join('tbl_user', 'tbl_user.user_id', 'user_prop_signin_out.user_id')
                ->where('user_prop_signin_out.user_id', $user->user_id)->orderBy('user_prop_signin_out.created_at', 'desc')->get();
            // dd($save2,$user);
            return response()->json(['success' => true, "userData" => $save2, 'message' => 'SignIn/Out data retrived.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }

    public function propertyDetails(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $propertySurveyorsID = $request->property_surveyors_id;
            $data = [];
            $getData = PropertySurveyor::select('property_surveyors.id as property_surveyors_id', 'property_surveyors.*', 'properties.*', 'clients.type as scheme')
                ->join('properties', 'properties.id', 'property_surveyors.property_id')
                ->join('clients', 'clients.id', 'properties.client_id');
            if ($propertySurveyorsID != null) {
                $getData->where('property_surveyors.surveyor_id', $propertySurveyorsID);
            }
            $propertyDataNew = $getData->get();
            if (sizeOf($propertyDataNew) && count($propertyDataNew) > 0) {
                foreach ($propertyDataNew as $key => $valuePropertyData) {
                    $datax = array(
                        "property_surveyors_id" => $propertySurveyorsID,
                        "property_id" => $valuePropertyData->property_id,
                        "surveyor_id" => $valuePropertyData->surveyor_id,
                        "scheme" => $valuePropertyData->scheme,
                        "house_num" => $valuePropertyData->house_num,
                        "address1" => $valuePropertyData->address1,
                        "address2" => $valuePropertyData->address2,
                        "address3" => $valuePropertyData->address3,
                        "county" => $valuePropertyData->county,
                        "eircode" => $valuePropertyData->eircode,
                        "notes" => $valuePropertyData->notes,
                        "survey_date" => date("d M Y", strtotime($valuePropertyData->survey_date)),
                        "phone1" => $valuePropertyData->phone1,
                        "phone2" => $valuePropertyData->phone2,
                        "occupants_name" => $valuePropertyData->wh_fname . ' ' . $valuePropertyData->wh_lname,
                    );
                    $data[] = $datax;
                }
            }
            return response()->json(['success' => true, "property_data" => $data, 'message' => 'Property details fetched.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }

    public function surveyorInspectionsList()
    {
        $user = auth()->user();
        $inspectionsTodaysData = $inspectionsOverdueData = $inspectionsFutureData = $inspectionsAllData = [];
        $currentDate = date('Y-m-d');
        $getData = PropertySurveyor::select('property_surveyors.id as property_surveyors_id', 'property_surveyors.survey_date AS survey_date_new', 'property_surveyors.*', 'properties.*')
            ->leftjoin('properties', 'properties.id', 'property_surveyors.property_id');
        if ($user) {
            $getData->where('property_surveyors.surveyor_id', $user->user_id)->where('properties.show_in_app', 'y');
        }
        $inspectionsAllData = $getData->get();
        if (sizeOf($inspectionsAllData) && count($inspectionsAllData) > 0) {
            foreach ($inspectionsAllData as $key => $valueInspectionsData) {
                if ($valueInspectionsData->survey_date_new != "" && $valueInspectionsData->survey_date_new != "0000-00-00") {

                    if ($valueInspectionsData->today_date_status == 1) {
                        $inspectionsOverdueData[] = array(
                            "property_surveyors_id" => $valueInspectionsData->property_surveyors_id,
                            "property_id" => $valueInspectionsData->property_id,
                            "surveyor_id" => $valueInspectionsData->surveyor_id,
                            "client_id" => $valueInspectionsData->client_id,
                            "house_num" => $valueInspectionsData->house_num,
                            "address1" => $valueInspectionsData->address1,
                            "address2" => $valueInspectionsData->address2,
                            "address3" => $valueInspectionsData->address3,
                            "county" => $valueInspectionsData->county,
                            "eircode" => $valueInspectionsData->eircode,
                            "notes" => $valueInspectionsData->notes,
                            "survey_date" => date("d M Y", strtotime($valueInspectionsData->survey_date_new)),
                        );
                    } else if ($currentDate == $valueInspectionsData->survey_date_new || ($currentDate > $valueInspectionsData->survey_date_new && $valueInspectionsData->today_date_status == 0)) {
                        $inspectionsTodaysData[] = array(
                            "property_surveyors_id" => $valueInspectionsData->property_surveyors_id,
                            "property_id" => $valueInspectionsData->property_id,
                            "surveyor_id" => $valueInspectionsData->surveyor_id,
                            "client_id" => $valueInspectionsData->client_id,
                            "house_num" => $valueInspectionsData->house_num,
                            "address1" => $valueInspectionsData->address1,
                            "address2" => $valueInspectionsData->address2,
                            "address3" => $valueInspectionsData->address3,
                            "county" => $valueInspectionsData->county,
                            "eircode" => $valueInspectionsData->eircode,
                            "notes" => $valueInspectionsData->notes,
                            "survey_date" => date("d M Y", strtotime($valueInspectionsData->survey_date_new)),
                        );
                    } else if ($currentDate > $valueInspectionsData->survey_date_new && $valueInspectionsData->today_date_status == 1) {
                        $inspectionsOverdueData[] = array(
                            "property_surveyors_id" => $valueInspectionsData->property_surveyors_id,
                            "property_id" => $valueInspectionsData->property_id,
                            "surveyor_id" => $valueInspectionsData->surveyor_id,
                            "client_id" => $valueInspectionsData->client_id,
                            "house_num" => $valueInspectionsData->house_num,
                            "address1" => $valueInspectionsData->address1,
                            "address2" => $valueInspectionsData->address2,
                            "address3" => $valueInspectionsData->address3,
                            "county" => $valueInspectionsData->county,
                            "eircode" => $valueInspectionsData->eircode,
                            "notes" => $valueInspectionsData->notes,
                            "survey_date" => date("d M Y", strtotime($valueInspectionsData->survey_date_new)),
                        );
                    } else if ($currentDate < $valueInspectionsData->survey_date_new) {
                        $inspectionsFutureData[] = array(
                            "property_surveyors_id" => $valueInspectionsData->property_surveyors_id,
                            "property_id" => $valueInspectionsData->property_id,
                            "surveyor_id" => $valueInspectionsData->surveyor_id,
                            "client_id" => $valueInspectionsData->client_id,
                            "house_num" => $valueInspectionsData->house_num,
                            "address1" => $valueInspectionsData->address1,
                            "address2" => $valueInspectionsData->address2,
                            "address3" => $valueInspectionsData->address3,
                            "county" => $valueInspectionsData->county,
                            "eircode" => $valueInspectionsData->eircode,
                            "notes" => $valueInspectionsData->notes,
                            "survey_date" => date("d M Y", strtotime($valueInspectionsData->survey_date_new)),
                        );
                    } else {

                    }
                }
            }
        }
        if (sizeOf($inspectionsAllData)) {
            return response()->json(['success' => true, "inspections_todays_data" => $inspectionsTodaysData, "inspections_overdue_data" => $inspectionsOverdueData, "inspections_future_data" => $inspectionsFutureData, 'message' => 'Inspection List fetched successfully.', 'code' => 200]);
        } else {
            return response()->json(['success' => true, "inspections_todays_data" => $inspectionsTodaysData, "inspections_overdue_data" => $inspectionsOverdueData, "inspections_future_data" => $inspectionsFutureData, 'message' => 'No data Found.', 'code' => 200]);
        }
    }

    public function viewPdfFormReport(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            $propertyID = $request->property_id;
            $propertySurveyorsID = $request->property_surveyor_id;
            $formsNumber = $request->forms_number;
            $data = [];

            $baseURL = URL::to('/assets/uploads/inspection_pdf/');
            $data = Inspections::select('id', DB::raw('DATE_FORMAT(date(created_date),"%d/%m/%Y")  as date_added'), DB::raw('CONCAT("' . $baseURL . '",`pdf_filename`) AS pdf_path'))
                ->where('fk_property_id', $propertyID)->where('property_surveyors_id', $propertySurveyorsID)->where("fk_forms_id", $formsNumber)
                ->where("pdf_filename", '!=', "n/a")
                ->orderBy("id", "desc")->get();

            if (sizeOf($data)) {
                return response()->json(['success' => "1", "data" => $data, 'message' => 'PDF Found.', 'code' => 200]);
            } else {
                return response()->json(['success' => "0", 'message' => 'No PDF Found.', 'code' => 200]);
            }

        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function generatePdf(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $inspId = $request->ins_id;
            $response = test_method($inspId);
            return response()->json(['success' => "1", "data" => $response, 'message' => 'Successfully Generated.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function addProperty(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $validator = Validator::make($request->all(), [
                // 'client_name' => 'required',
                'address1' => 'required',
                'address2' => 'required',
                'county' => 'required',
                'survey_date' => 'required',
                'phone' => 'required',
            ]);
            if ($validator->fails()) {
                return sendError('Validation Error.', $validator->errors(), 422);
            }
            $comp = $user->company;
            $survey_date1 = isset($request->survey_date) ? date('Y-m-d',strtotime($request->survey_date)) : date('y-m-d');
            // dd($survey_date1);


            $cSave = new Client();
            $cSave->type = 'private';
            $cSave->name = $request->client_name;
            $cSave->email = $user->email;
            $cSave->address1 = $request->address1;
            $cSave->address2 = $request->address2;
            $cSave->address3 = $request->address3;
            $cSave->county = $request->county;
            $cSave->eircode = $request->eircode;
            $cSave->phone = $request->phone;
            $cSave->save();


            $pSave = new Projects();
            $pSave->client_id = $cSave->id;
            $pSave->our_ref = $request->client_name;
            $pSave->batch = 'N/A';
            $pSave->quote = 'No';
            $pSave->save();

            $nameArr   = explode(' ', trim($request->client_name));
            $firstName = $nameArr[0] ?? null;
            $lastName  = ($nameArr[1] ?? null) ? implode(' ', array_slice($nameArr, 1)) : null;

            $sProp = new Properties();
            $sProp->batch_id = $request->batch_id;
            $sProp->email = $request->email;
            $sProp->house_num = $request->house_num;
            $sProp->client_name = $request->client_name;
            $sProp->address1 = $request->address1;
            $sProp->address2 = $request->address2;
            $sProp->address3 = $request->address3;
            $sProp->county = $request->county;
            $sProp->eircode = $request->eircode;
            // $sProp->notes = $request->notes;
            $sProp->wh_mprn = $request->wh_mprn;
            $sProp->wh_fname = $firstName;
            $sProp->wh_lname = $lastName;
            $sProp->survey_date1 = $survey_date1;
            if(isset($request->is_lead) && $request->is_lead == "1"){
                $sProp->start_date = isset($request->start_date) ? date('Y-m-d',strtotime($request->start_date)) : date('Y-m-d');
                $sProp->end_date = isset($request->end_date) ? date('Y-m-d',strtotime($request->end_date)) : date('Y-m-d');
                $sProp->status = $request->lead_stage;
            }else{
                $sProp->start_date = date('Y-m-d');
                $sProp->end_date = date('Y-m-d');
                $sProp->status = "Pending";
            }
            $sProp->client_id = $cSave->id;
            $sProp->phone1 = $request->phone;
            $sProp->phone2 = $request->phone;
            $sProp->project_id = $pSave->id;
            $sProp->lead_source = isset($request->lead_source) ? $request->lead_source : null;
            $sProp->lead_type = isset($request->lead_type) ? $request->lead_type : null;
            $sProp->lead_value = isset($request->lead_value) ? $request->lead_value : null;
            $sProp->company = $comp;
            $sProp->save();

            $ssSave = new PropertySurveyor();
            $ssSave->surveyor_id = $user->user_id;
            $ssSave->property_id = $sProp->id;
            $ssSave->survey_date = $survey_date1;
            $ssSave->today_date_status = 0;
            $ssSave->save();

            $pId = $sProp->id;
            $getUsers = TblUser::where('is_access',1)->get();
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
            if(isset($request->notes) && $request->notes != ""){
                $snSave = new PropertyNotes();
                $snSave->property_id = $sProp->id;
                $snSave->text = $request->notes;
                $snSave->save();
            }

            $cSave = new ContactFormPdf();
            $cSave->form_type = 'Complete Admin';
            $cSave->date_added = date("Y-m-d H:i:s");
            $cSave->property_id = $sProp->id;
            $cSave->note = null;
            $cSave->pdf_path = 'http://bcrretrofit.buildingcontrolregister.ie/bcrretrofit_Insulations_Contract_Form.pdf';
            $cSave->save();

            return response()->json(['success' => true, 'message' => 'Survey Added Successfully.', 'code' => 200]);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function storeProperty(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            $client_id = $request->client_id;
        if ($request->client_select_type == 'select_from_clients') {
            $client_id = $request->client_id;
        } else if ($request->client_select_type == 'use_above_client') {

            $created_client = Client::create([
                'email' => '',
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
        } else if ($request->client_select_type == 'create_new_client') {

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

        $created_property = Properties::create([
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
            'hea_status' => "Pending",
            'contractor_status' => "Pending",
            'status' => isset($request->status) ? $request->status : "Pending",
            'email' => $request->email,
            'pre_ber' => "N/A",
            'post_ber' => "N/A",
            'wh_ref' => "",
        ]);

        $ssSave = new PropertySurveyor();
        $ssSave->surveyor_id = $user->user_id;
        $ssSave->property_id = $created_property->id;
        $ssSave->survey_date = $request->start_date;
        $ssSave->today_date_status = 0;
        $ssSave->save();

        $pId = $created_property->id;
        $getUsers = TblUser::where('is_access',1)->get();
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

        $address = format_address(
            $created_property->house_num,
            $created_property->address1,
            $created_property->address2,
            $created_property->address3,
            $created_property->county,
            $created_property->eircode
        );

        $preFolder = PhotoFolderName::where("name","Pre-Works BER Photos")->first();
        $postFolder = PhotoFolderName::where("name","Post-Works BER Photos")->first();

        if($preFolder == null){
            PhotoFolderName::create(['name' => "Pre-Works BER Photos"]);
        }if($postFolder == null){
            PhotoFolderName::create(['name' => "Post-Works BER Photos"]);
        }

        if ($created_property->wasRecentlyCreated === true) {
            $details = [
                "body" => "New Property has been created: ".$address,
                "section" => "Property",
                "route" => "property",
                // "property_id" => $created_property->id,
                "authid" => $user->user_id
            ];
            newNotification($details);

            $cname = $created_property->client->name;
            $details = [
                "body" => "Client " ."($cname)". " has been added to a Property: ".$address,
                "section" => "Client",
                "route" => "client",
                "authid" => $user->user_id
            ];
            newNotification($details);

            $details = [
                "body" => "Property " ."($address)". " has been added to Batch: ".$created_property->batch->our_ref,
                "section" => "Property",
                "route" => "property",
                // "property_id" => $created_property->id,
                "authid" => $user->user_id
            ];
            newNotification($details);
        }

        return response()->json(['success' => true, 'message' => 'Survey Added Successfully.', 'code' => 200]);
    } else {
        return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
    }
    }
    public function appointmentChange(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $value = $request->status;
            $id = $request->id;
            $data = DB::table('appointment_data')->where('id',$id)->update(['status'=>$value]);
            if($data){
                return response()->json(['success' => true, 'message' => 'Status Changed Successfully.', 'code' => 200]);
            }else{
                return response()->json(['success' => false, 'message' => 'Status Not Changed.', 'code' => 200]);
            }
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
}
