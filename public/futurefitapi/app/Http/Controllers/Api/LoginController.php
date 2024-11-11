<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegisteredUser;
use App\Models\TblUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DB;

class LoginController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getToken()
    {
        $token = getGoogleAccessToken();

        return response()->json(['data'=>$token]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors(), 422);
        }
        $flag = $flag2 = 0;
        if(isset($request->appname)){	
            $appname = $request->appname;	
            $chk22 = TblUser::where('email', $request->email)->where('appname',$appname)->first();
            if(!$chk22){
                $flag = 1;
            }
            $checkE = TblUser::where('email', $request->email)->where('appname',"Main app")->first();
            if(!$checkE){
                $flag2 = 1;
            }
        }else{	
            $appname = 'Main app';	
            $chk22 = TblUser::where('email', $request->email)->where('appname',$appname)->first();
            if(!$chk22){
                $flag2 = 1;
            }
            $checkE = TblUser::where('email', $request->email)->where('appname',"lite")->first();
            if(!$checkE){
                $flag = 1;
            }
        }	
        if($chk22 == null){	
            if($flag == 1 && $flag2 == 1){
                return response()->json(['success'=>false,'message'=>'You have entered an invalid email or password.','code'=>404]);	
            }else{
                return response()->json(['success'=>false,'message'=>'This user registered with other app.','code'=>404]);	
            }
        }
        $credentials = $request->only('email', 'password', 'role');
        if (Auth::attempt($credentials)) {
            $chk = TblUser::where('email', $request->email)->where('status', 0)->first();
            if ($chk) {
                foreach (TblUser::find(Auth::user()->id)->tokens as $token) {
                    $token->revoke();
                }
                TblUser::where('email', $request->email)->update(['user_login_status'=>0]);
                return response()->json(['success' => false, 'message' => 'Your account is deactivated.', 'code' => 404]);
            }
            
            $user = Auth::user();

            if(isset($request->device_type) && isset($request->device_token)){
                $insertDevice = DB::table('tbl_user_meta')->insert([
                    'fk_user_id' => $user->user_id,
                    'device_type' => $request->device_type,
                    'access_token' => $user->createToken('accessToken')->accessToken,
                    'device_token' => $request->device_token,
                ]);
            }
            $success['id'] = $user->user_id;
            $success['role'] = $user->role;
            $success['full_name'] = $user->full_name;
            $success['email'] = $user->email;
            $success['phone_number'] = $user->phone_number;
            $success['status'] = $user->status;
            $success['appname'] = $user->appname;
            $success['company'] = $user->company;
            $success['contractor_id'] = $user->contractor_id;
            $success['token'] = $user->createToken('accessToken')->accessToken;

            $insertLog = DB::table('login_log')->insert([
                'email' => $user->email,
                'device' => 'APP',
                'date_time'=> Carbon::now(),
            ]);
            
            
            return sendResponse($success, 'You are successfully logged in.');
        } else {
            return sendError('Please, try another password', ['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * User registration API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'role' => 'required',
            'phone_number' => 'required',
            'appname' => 'required',
            'company' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $checkEmail = TblUser::where('email', $request->email)->first();
            if ($checkEmail) {
                return response()->json(['success' => false, 'message' => 'This email is already in use.']);
            }
            $checkcompany = TblUser::where('company', $request->company)->first();
            if ($checkcompany) {
                return response()->json(['success' => false, 'message' => 'This Company name is already in use.']);
            }
            $user = TblUser::create([
                'full_name' => $request->full_name,
                'role' => $request->role,
                'phone_number' => $request->phone_number,
                'appname' => $request->appname,
                'company' => $request->company,
                'status' => 1,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $regUser = new RegisteredUser();
            $regUser->email = $request->email;
            $regUser->password = $request->password;
            $regUser->usertype = 'Admin';
            $regUser->firstname = $request->full_name;
            $regUser->lastname = "";
            $regUser->company = $request->company;
            $regUser->save();

            $success['full_name'] = $user->full_name;
            $success['role'] = $user->role;
            $success['phone_number'] = $user->phone_number;
            $success['appname'] = $user->appname;
            $success['company'] = $user->company;
            $success['status'] = $user->status;
            $success['email'] = $user->email;
            $success['device_type'] = $user->device_type;
            $success['device_token'] = $user->device_token;
            $success['contractor_id'] = $user->contractor_id;
            $message = 'Yay! A user has been successfully created.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
        } catch (Exception $e) {
            $success['token'] = [];
            $message = 'Oops! Unable to create a new user.';
        }

        return sendResponse($success, $message);
    }

    public function logout()
    {
        if (Auth::user()) {
            $muser = Auth::user();
            TblUser::where('user_id', $muser->user_id)->update(['user_login_status'=>0]);
            $user = Auth::user()->token();
            $user->revoke();
            
            return response()->json(['success' => true, 'message' => 'You are successfully logged out.']);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
}
