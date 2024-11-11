<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;
use App\Models\ReportConfig;
use App\Models\QuotationWorkDesc;
use App\Models\JobLookup;
use DB;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    function index(){
        $config = Config::first();
        // dd($config->company_logo);
        return view('dashboard.config.index', compact('config'));
    }

    function reportIndex(){
        $config = ReportConfig::first();
        $contractor_jobs = DB::table('measure')->where('formid',22)->where('fk_house_type_id',1)->get();
        $quotWorkDesc = DB::table('quot_work_desc')->get();

        return view('dashboard.config.reportindex', compact('config','contractor_jobs','quotWorkDesc'));
    }

    function updateConfig(UpdateConfigRequest $request) {
        Config::updateOrInsert([ 'id' => 1 ], [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'website' => $request->website,
            'android_path' => $request->android_path,
            'android_lite_path' => $request->android_lite_path,
            'ios_path' => $request->ios_path,
            'ios_lite_path' => $request->ios_lite_path,
            'instagram_link' => $request->instagram_link,
            'facebook_link' => $request->facebook_link,
            'linkedin_link' => $request->linkedin_link,
            'tiktok_link' => $request->tiktok_link,
            'youtube_link' => $request->youtube_link,
            'x_link' => $request->x_link
        ]);

        $Config = Config::where('id',1)->first();
        if ($request->file('company_logo')) {
            $image_path = "/assets/images/company_logo/";
            $photo = $request->file('company_logo');
            $imageName = 'company_logo-' . time() . '.' . request()->company_logo->getClientOriginalExtension();
            $photo->move(public_path($image_path), $imageName);
            $Config->company_logo = $imageName;
        }else{
            if($request->company_logo_filename == null){
                $Config->company_logo = null;
            }
        }
        if($Config->update()){
            $details = [
                "body" => "Config has been updated",
                "section" => "Application Config",
                "route" => "config"
            ];
            newNotification($details);
            return redirect()->back()->with('success','Application Config Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Application Config Updatation Failed.');
        }
    }

    function ReportUpdateConfig(UpdateConfigRequest $request) {
        ReportConfig::updateOrInsert([ 'id' => 1 ], [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website
        ]);

        $Config = ReportConfig::where('id',1)->first();
        if ($request->file('company_logo')) {
            $image_path = "/assets/images/report_company_logo/";
            $photo = $request->file('company_logo');
            $imageName = 'company_logo-' . time() . '.' . request()->company_logo->getClientOriginalExtension();
            $photo->move(public_path($image_path), $imageName);
            $Config->company_logo = $imageName;
        }else{
            if($request->company_logo_filename == null){
                $Config->company_logo = null;
            }
        }
        if($Config->update()){
            $details = [
                "body" => "Report Config has been updated",
                "section" => "Report Config",
                "route" => "report-config"
            ];
            newNotification($details);
            return redirect()->back()->with('success','Report Config Updated Successfully.');
        }else{
            return redirect()->back()->with('error','Report Config Updatation Failed.');
        }
    }

    function createDescWork(Request $request) {
        $request->validate([
            'measure' => ['required'],
            'ckeditor' => ['required']
        ]);

        $workDesc = new QuotationWorkDesc();
        $workDesc->name = $request->measure;
        $workDesc->description = $request->ckeditor;
        $workDesc->save();

        if ($workDesc->wasRecentlyCreated === true) {
            $details = [
                "body" => "New Description has been added for ".$request->measure,
                "section" => "Report Config",
                "route" => "report-config"
            ];
            newNotification($details);
            return redirect()->back()->with('success', "Description added successfully to measure");
        }else {
            return redirect()->back()->with('error','Description addition Failed.');
        }

    }

    function updateDescWork(Request $request) {
        $request->validate([
            'editCkeditor' => ['required']
        ]);

        $workDesc = QuotationWorkDesc::where('id', $request->desc_id)->first();
        $workDesc->description = $request->editCkeditor;
        $workDesc->update();

        if($workDesc){
            $details = [
                "body" => "New Description has been updated for ".$workDesc->measure,
                "section" => "Report Config",
                "route" => "report-config"
            ];
            newNotification($details);
            return redirect()->back()->with('success', "Description updted successfully to measure");
        }else{
            return redirect()->back()->with('error','Description updation Failed.');
        }
    }

    function viewDescWork(Request $request) {
        $descWork = QuotationWorkDesc::where('id', $request->id)->first();
        if($descWork){
            return response()->json(['success' => true, 'data' => $descWork]);
        }else{
            return response()->json(['success' => false, 'message' => "Something went wrong."]);
        }
    }

    function deleteDescWork(Request $request) {
        $descWorkData = QuotationWorkDesc::where('id', $request->id)->first();
        $descWork = QuotationWorkDesc::where('id', $request->id)->delete();
        if($descWork) {
            $details = [
                "body" => $descWorkData->name." description has been deleted",
                "section" => "Report Config",
                "route" => "report-config"
            ];
            newNotification($details);
        }
        return redirect()->back()->with('success','Description deleted successfully.');
    }
}
