<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ContractorMessage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Notifications\MessageNotification;
use App\Models\ContractorProperty;
use Pusher\Pusher;
use DateTime;
use DB;
use Auth;

class ContractorMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_user' => 'required',
            'from_user' => 'required',
            'content' => 'required',
            'property_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        ContractorMessage::create([
            'from_user' => $request->from_user,
            'to_user' => $request->to_user,
            'content' => $request->content,
            'property_id'=>$request->property_id,
            'message_time'=> date('Y-m-d H:i:s')
        ]);

        $url = route('chat.open', ['id' => Crypt::encrypt($request->to_user)]);

        $user_details = ['user_name' => auth()->user()->firstname . ' ' . auth()->user()->lastname, 'user_id' => $request->from_user];
        User::find($request->to_user)->notify(new MessageNotification($user_details));

        return response()->json(['success' => true, 'url' => $url]);
    }

    public function openChatNoti()
    {
        $messages = [];
        $chat_users = ContractorMessage::selectRaw('DISTINCT from_user, to_user')
        ->where(function($query) {
            $query->where('from_user', auth()->user()->id)
                ->orWhere('to_user', auth()->user()->id);
        })
        ->whereNotNull('property_id')
        ->get();
        $chats = [];
        foreach ($chat_users as $chat_user) {
            if (!in_array($chat_user->from_user, $chats)) {
                if ($chat_user->from_user != auth()->user()->id)
                    array_push($chats, $chat_user->from_user);
            }
            if (!in_array($chat_user->to_user, $chats)) {
                if ($chat_user->to_user != auth()->user()->id)
                    array_push($chats, $chat_user->to_user);
            }
        }

        $all_chats = [];
        foreach ($chats as $chat) {
            $messagesx = ContractorMessage::whereNotNull('property_id')
            ->where(function($query) use ($chat) {
                $query->where([
                        ['from_user', '=', auth()->user()->id],
                        ['to_user', '=', $chat],
                    ])
                    ->orWhere([
                        ['from_user', '=', $chat],
                        ['to_user', '=', auth()->user()->id],
                    ]);
            })
            // ->groupBy('property_id')
            ->orderBy('id', 'DESC')
            ->get()->unique('property_id');
            foreach($messagesx as $message){

            if ($message->from_user != auth()->user()->id) {
                $user_data = User::where('id', $chat)->first();
            }
            if ($message->to_user != auth()->user()->id) {
                $user_data = User::where('id', $chat)->first();
            }
            if ($message->from_user == auth()->user()->id || $message->to_user == auth()->user()->id) {
                if($message->is_read == 1 && $message->to_user == auth()->user()->id){
                    $is_read = $message->is_read;
                }else{
                $is_read = 0;
                }
            }else{
                $is_read = 0;
            }
            if($message->content == "" && $message->attachment != null){
                $msg = $message->attachment;
            }else{
                $msg = $message->content;
            }
            if($user_data != null){

                $appname = null;
                $appnames = DB::table('tbl_user')->where('contractor_id',$user_data->id)->first();
                if($appnames){
                    $appname = $appnames->appname;
                }
                if($appname == null){
                    $user = Auth::user();
                    // $appname = $user->role;
                    if($user->role == "admin"){
                        $appname = "Assessor";
                    }else{
                        $appname = "Admin";
                    }
                }
                $getProp = DB::table('properties')->select('*')->where('id',$message->property_id)->first();
                if($getProp){
                    $address = format_address($getProp->house_num,$getProp->address1,$getProp->address2,$getProp->address3,$getProp->county,$getProp->eircode);
                }else{
                    $address = "";
                }
                if($message->message_time != null){
                   $date = new DateTime($message->message_time);
                   $formatted_date = $date->format('Y-m-d\TH:i:s.u\Z');
                }else{
                    $formatted_date = $message->created_at;
                }

                array_push(
                    $all_chats,
                    array(
                        'id' => Crypt::encrypt($user_data->id),
                        'noti_id' => Crypt::encrypt($message->id),
                        'name' => $user_data->firstname . ' ' . $user_data->lastname,
                        'firstname' => $user_data->firstname,
                        'lastname' => $user_data->lastname,
                        'last_msg' => $message->content,
                        'last_img' => $message->attachment,
                        'is_read' => $is_read,
                        'address' => $address,
                        'appname' => $appname,
                        'property_id' => $message->property_id,
                        'msg_date' => $formatted_date
                    )
                );
                }
            }
        }
        usort($all_chats, function ($a, $b) {
            return strtotime($b['msg_date']) - strtotime($a['msg_date']);
        });
            return $all_chats;
    }
    public function getProp(Request $request)
    {
        $properties = [];
        if($request->type != 'admin'){
            $usr = DB::table('users')->where('id',$request->value)->first();
            // dd($usr);
            if($usr->role == "hea/ber-assessor"){
                if($usr != null){
                    $properties = DB::table('assessor_property')->select('properties.*')
                    ->join('properties', 'properties.id', 'assessor_property.property_id')
                    ->join('clients', 'clients.id', 'properties.client_id')
                    ->where('assessor_property.assessor_id', $usr->id)
                    ->groupBy('assessor_property.property_id')
                    ->get()->toArray();
                }
            }else{
                $get = DB::table('tbl_user')->where('contractor_id',$request->value)->first();
                if($get != null){
                    $properties = DB::table('property_surveyors')->select('properties.*')
                    ->join('properties', 'properties.id', 'property_surveyors.property_id')
                    ->join('clients', 'clients.id', 'properties.client_id')
                    ->where('property_surveyors.surveyor_id', $get->user_id)
                    ->groupBy('property_surveyors.property_id')
                    ->get()->toArray();
                }
            }
        }else{
            $get = null;
            $user = Auth::user();
            if($user->role == "hea/ber-assessor"){
                $get = DB::table('users')->where('id',$user->id)->first();
           
                if($get != null){
                    $properties = DB::table('assessor_property')->select('properties.*')
                    ->join('properties', 'properties.id', 'assessor_property.property_id')
                    ->join('clients', 'clients.id', 'properties.client_id')
                    ->where('assessor_property.assessor_id', $get->id)
                    ->groupBy('assessor_property.property_id')
                    ->get()->toArray();
                }
            }else{
                $get = DB::table('tbl_user')->where('contractor_id',$user->id)->first();
                // dd($get);
                if($get != null){
                    $properties = DB::table('property_surveyors')->select('properties.*')
                    ->join('properties', 'properties.id', 'property_surveyors.property_id')
                    ->join('clients', 'clients.id', 'properties.client_id')
                    ->where('property_surveyors.surveyor_id', $get->user_id)
                    ->groupBy('property_surveyors.property_id')
                    ->get()->toArray();
                }
            }
            // dd($properties);
        }
        if($properties){
            return response()->json(['success'=>true,'data'=>$properties,'message'=>'Properties Available.']);
        }else{
            return response()->json(['success'=>false,'data'=>$properties,'message'=>'Properties Not Available.']);
        }
    }
    public function openChat(Request $request, $id = false, $notification_id = false)
    {
        $messages = [];
        $newAddress = $appname = null;
        $cid = null;
        if ($id && isset($request->cid)) {
            $cid = $request->cid;
            $id = Crypt::decrypt($id);
            // dd($id);
            $contractor = User::where('id', $id)->first();
            $getProp = DB::table('properties')->select('*')->where('id',$request->cid)->first();
            $appnames = DB::table('tbl_user')->where('contractor_id',$contractor->id)->first();
            if($appnames){
                $appname = $appnames->appname;
                $to_user_id = $appnames->user_id;
            }
            // dd($contractor->email);
            if($getProp){
                $newAddress = format_address($getProp->house_num,$getProp->address1,$getProp->address2,$getProp->address3,$getProp->county,$getProp->eircode);
            }else{
                $newAddress = "";
            }
            $messages = ContractorMessage::where('property_id',$request->cid)
            ->where(function($query) use ($id) {
                $query->where([
                        ['from_user', '=', auth()->user()->id],
                        ['to_user', '=', $id],
                    ])
                    ->orWhere([
                        ['from_user', '=', $id],
                        ['to_user', '=', auth()->user()->id],
                    ]);
            })
            ->orderBy('id', 'ASC')
            ->get();
        }
        if(sizeof($messages)){
            foreach($messages as $msg){
                $up = ContractorMessage::where('property_id',$request->cid)->where([
                    ['from_user', '=', $id],
                    ['to_user', '=', auth()->user()->id]
                ])->update(['is_read' => 0]);
                // dd($up);
                // $up->is_read = 0;
                // $up->update();
                // ->update(['is_read' => 0]);

            }
        }
        // if ($notification_id) {
        //     auth()->user()->unreadNotifications->where('id', $notification_id)->markAsRead();
        // }

        $chat_users = ContractorMessage::selectRaw('DISTINCT from_user, to_user')
        ->where(function($query) {
            $query->where('from_user', auth()->user()->id)
                ->orWhere('to_user', auth()->user()->id);
        })
        ->whereNotNull('property_id')
        ->get();
        $chats = [];
        foreach ($chat_users as $chat_user) {
            if (!in_array($chat_user->from_user, $chats)) {
                if ($chat_user->from_user != auth()->user()->id)
                    array_push($chats, $chat_user->from_user);
            }
            if (!in_array($chat_user->to_user, $chats)) {
                if ($chat_user->to_user != auth()->user()->id)
                    array_push($chats, $chat_user->to_user);
            }
        }

        $all_chats = [];
        foreach ($chats as $chat) {
            $messagesx = ContractorMessage::whereNotNull('property_id')
            ->where(function($query) use ($chat) {
                $query->where([
                        ['from_user', '=', auth()->user()->id],
                        ['to_user', '=', $chat],
                    ])
                    ->orWhere([
                        ['from_user', '=', $chat],
                        ['to_user', '=', auth()->user()->id],
                    ]);
            })
            // ->groupBy('property_id')
            ->orderBy('id', 'DESC')
            ->get()->unique('property_id');
            $sumIsRead = $i = 1;
            foreach($messagesx as $message){

            if ($message->from_user != auth()->user()->id) {
                $user_data = User::where('id', $chat)->first();
            }
            if ($message->to_user != auth()->user()->id) {
                $user_data = User::where('id', $chat)->first();
            }
            if($message->from_user != auth()->user()->id && $message->is_read == 1){
                $sumIsRead += $message->is_read;
            }else{
                $sumIsRead = 0;
            }
            if($user_data != null && $message->property_id != null){
                $appname = null;
                $appnames = DB::table('tbl_user')->where('contractor_id',$user_data->id)->first();
                if($appnames){
                    $appname = $appnames->appname;
                }
                if($appname == null){
                    $user = Auth::user();
                    // $appname = $user->role;
                    if($user->role == "admin"){
                        $appname = "Assessor";
                    }else{
                        $appname = "Admin";
                    }
                }
                $getProp = DB::table('properties')->select('*')->where('id',$message->property_id)->first();
                if($getProp){
                    $address = format_address($getProp->house_num,$getProp->address1,$getProp->address2,$getProp->address3,$getProp->county,$getProp->eircode);
                }else{
                    $address = "";
                }

                array_push(
                $all_chats,
                array(
                    'id' => Crypt::encrypt($user_data->id),
                    'name' => $user_data->firstname . ' ' . $user_data->lastname,
                    'last_msg' => $message->content,
                    'last_img' => $message->attachment,
                    'address' => $address,
                    'is_read' => $message->is_read,
                    'is_read_count' => $sumIsRead,
                    'appname' => $appname,
                    'property_id' => $message->property_id,
                    'msg_date' => $message->message_time == null ? $message->created_at : $message->message_time,
                    'first_name' => $user_data->firstname
                )
            );
            }
            }
        }
        usort($all_chats, function ($a, $b) {
            return strtotime($b['msg_date']) - strtotime($a['msg_date']);
        });
        // dd($all_chats,$contractor->firstname);
        // $contractors = DB::table('users')
        // ->join('tbl_user', 'tbl_user.contractor_id','users.id')
        // ->select('users.*')
        // ->where('users.role', 'contractor')
        // ->where('tbl_user.contractor_id', '!=',null)
        // ->get();
        // // dd($contractors);
        // 
        // $appUsers = DB::table('tbl_user')
        // ->where('role', 2)
        // ->where('contractor_id', '!=',null)
        // ->where('appname', 'Main app')
        // ->get();
        $accessors = User::where('role', 'hea/ber-assessor')->get();
        $mainAppUsers = DB::table('tbl_user')
        ->where('role', 2)
        ->where('contractor_id', '!=',null)
        ->where('appname', 'Main app')
        ->get();
        $litAppUsers = DB::table('tbl_user')
        ->where('role', 2)
        ->where('contractor_id', '!=',null)
        ->where('appname', 'Lite')
        ->get();
        $admins = User::where('role', 'admin')->get();
        $msg = json_encode($messages);
        return view('dashboard.chat.index', get_defined_vars());
    }

    public function sendMessage(Request $request)
    {
        $adm = auth()->user();
        // dd($adm);
        // $request->validate([
        //     'file' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,csv,xlsx,xls,txt,pdf|max:2048',
        // ]);


        $attachment = $extension = NULL;

        if ($image = $request->file('file')) {
            $file_frontimage = $request->file('file');
            $actual_filename_frontimage = $file_frontimage->getClientOriginalName();
            $destinationPath = public_path('uploads/chat-attachments');
            !is_dir($destinationPath) && mkdir($destinationPath, 0777, true);
            $profileImage = time()."_".$actual_filename_frontimage;
            $image->move($destinationPath, $profileImage);
            $attachment = $profileImage;
            $extension = $request->file->getClientOriginalExtension();
        }
        if($adm->role != "hea/ber-assessor"){
            $getUser = DB::table('tbl_user')->where('contractor_id',$request->to_user)->first();
            if($getUser){
                $meta = DB::table('tbl_user_meta')->where('fk_user_id',$getUser->user_id)->orderBy('created_date','desc')->first();
            }else{
                $meta = null;
            }
        }else{
            $meta = null;
        }
        // dd($meta);
        $timezone = thisismyip();
        date_default_timezone_set($timezone);
        ContractorMessage::create([
            'from_user' => $request->from_user,
            'to_user' => $request->to_user,
            'content' => $request->content ?? '',
            'attachment' => $attachment,
            'property_id' => $request->property_id,
            'message_time' => date('Y-m-d H:i:s'),
            'extension' => $extension

        ]);

        $user_details = ['user_name' => auth()->user()->firstname . ' ' . auth()->user()->lastname, 'user_id' => $request->from_user];

        if($meta){
        $session_other_status = 1;
        $token = $meta->device_token;
        $body = $request->content ? $request->content : "";
        $title = "New Message from ".$adm->firstname.' '.$adm->lastname;

        $this->send_notifications($token, $title,$body,$session_other_status);
        }
        User::find($request->to_user)->notify(new MessageNotification($user_details));
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

        $data = ['from' => $request->from_user, 'to' => $request->to_user]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
        return back();
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
    // public function send_notifications($token, $title,$body,$session_other_status=null)
    // {
    //     if($session_other_status == 1){
    //     // dd($token, $body, $id, $type,$f);
    //     $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    //     //$token=$token;
    //     //$tokenList = $tokenlist;
    //         $notification = [
    //             'title' => $title,
    //             'body' => $body,
    //             'sound' => true,
    //             'type_name' => 'announcement',
    //         ];

    //         $extraNotificationData = ["message" => $notification,'click_action' => 'FLUTTER_NOTIFICATION_CLICK'];

    //     $fcmNotification = [
    //         'to' => $token,
    //         'notification' => $notification,
    //         'data' => $extraNotificationData,
    //         'priority' => 'high',
    //     ];
    //     // dd($fcmNotification);
    //     $headers = [
    //         'Authorization: key=' . env('FIREBASE_SERVER_KEY', 'NULL'),
    //         'Content-Type: application/json',
    //     ];

    //     if ($token != "") {
    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL, $fcmUrl);
    //         curl_setopt($ch, CURLOPT_POST, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    //         $result = curl_exec($ch);
    //         curl_close($ch);
    //     }

    //     return true;
    //         }else{
    //         return false;
    //     }
    // }

    public function userLoginStatus(Request $request,$id)
    {
        $status = DB::table('tbl_user')->where('user_id',$id)->first()->user_login_status;
        return response()->json(['success' => true,'status' => $status, 'msg'=> 'Fetched Successfully']);
    }
}