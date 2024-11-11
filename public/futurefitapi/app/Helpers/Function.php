<?php

use App\Models\Inspections;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use App\Models\NotifiationMobile;

/**
 * Success response method
 *
 * @param $result
 * @param $message
 * @return \Illuminate\Http\JsonResponse
 */
function sendResponse($result, $message)
{
    $response = [
        'success' => true,
        'data' => $result,
        'message' => $message,
    ];

    return response()->json($response, 200);
}

/**
 * Return error response
 *
 * @param       $error
 * @param array $errorMessages
 * @param int   $code
 * @return \Illuminate\Http\JsonResponse
 */
function sendError($error, $errorMessages = [], $code = 404)
{
    $response = [
        'success' => false,
        'message' => $error,
    ];

    !empty($errorMessages) ? $response['data'] = $errorMessages : null;

    return response()->json($response, $code);
}
if (! function_exists('thisismyip')){
    function thisismyip()
	{
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $localIP = $_SERVER['HTTP_CLIENT_IP'];
        }
        //if user is from the proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $localIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //if user is from the remote address
        else{
            $localIP = $_SERVER['REMOTE_ADDR'];
        }
        $timezone = "Europe/London";
        // $ipInfo = file_get_contents('http://ip-api.com/json/' . $localIP);
        // $ipInfo = json_decode($ipInfo);
        // $timezone = $ipInfo->timezone;
        return $timezone;
    }
}
if (! function_exists('format_address')) {
    function format_address($house_no = '', $address1 = '', $address2 = '', $address3 = '', $county = '', $other = '')
    {
        $address  = "";

        $address1 = in_array($address1, ['null', 'NULL', NULL])  ? '' : $address1;
        $address2 = in_array($address2, ['null', 'NULL', NULL])  ? '' : $address2;
        $address3 = in_array($address3, ['null', 'NULL', NULL])  ? '' : $address3;

        $address = $house_no;
        $address .= trim($address) ? trim($address1) ? ', '.$address1 : '' : $address1;
        $address .= trim($address) ? trim($address2) ? ', '.$address2 : '' : $address2;
        $address .= trim($address) ? trim($address3) ? ', '.$address3 : '' : $address3;
        $address .= trim($address) ? trim($county) ? ', '.$county : '' : $county;
        $address .= trim($address) ? trim($other) ? ', '.$other : '' : $other;

        return $address;
    }
}
if (!function_exists('getGoogleAccessToken')) {
function getGoogleAccessToken(){
    $credentialsFilePath = '/mnt/data/home/500964.cloudwaysapps.com/ypjvsrdfbx/public_html/public/futurefitapi/public/firebase-service.json'; //replace this with your actual path and file name
    $client = new \Google_Client();
    $client->setAuthConfig($credentialsFilePath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    $token = $client->getAccessToken();
    // dd($token);
    return $token['access_token'];
}
}
if (!function_exists('test_method')) {
    function test_method($indsID)
    {
        // <?php
        include './pdfcrowd.php';

        $year = date('Y');
        $month = date('m');

        $inspectionid = $indsID;
        // $dbname = "fvvhfvxebd";
        // $servername = "localhost";
        // // $username = "fvvhfvxebd";
        // $username = "root";
        // $password = "";
        // // $password = "a38nCWuD3b";

        // // Create connection
        // $conn = new mysqli($servername, $username, $password, $dbname);
        // // Check connection
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }

        // $sql = "SELECT properties.address1, inspections.fk_forms_id, forms.name FROM properties INNER JOIN  inspections ON properties.id = inspections.fk_property_id INNER JOIN  forms ON inspections.fk_forms_id = forms.forms_id WHERE inspections.id = $inspectionid";
        // $result = $conn->query($sql);
        $result = DB::table('properties')->select('properties.id as property_id','properties.address1', 'inspections.fk_forms_id','inspections.name as by_name', 'forms.forms_id as name', 'forms.name as form_name')
            ->join('inspections', 'inspections.fk_property_id', 'properties.id')
            ->join('forms', 'forms.forms_id', 'inspections.fk_forms_id')
            ->where('inspections.id', $inspectionid)
            ->first();

        if ($result) {
            if($result->name == "" || $result->address1 == "" || $result->name == null || $result->address1 == null){
                return true;
            }else{

            $form = $result->name;
            $file_formname = str_replace(" ", "_", $form);

            $address = $result->address1;
            $file_address = str_replace(" ", "_", $address);
            $file_address = str_replace("/", "_", $file_address);

        try
        {
            $client = new \Pdfcrowd\HtmlToPdfClient("Sean", "1306a3dfb8cebf24565396c60bcab0f4");
            $client->setImageDpi(175);
            $uri = 'https://futurefit.bcrcomply.com/dashboard/property/report/' . $inspectionid .'/print';
            $pdf = $client->convertUrl($uri);
            // dd(public_path());
            // if($uploadPath == ""){

            if (!is_dir('assets/uploads/inspection_pdf/' . $year)) {
                mkdir('./assets/uploads/inspection_pdf/' . $year . '/' . $month, 0777, true);
            } else if (is_dir('assets/uploads/inspection_pdf/' . $year)) {
                if (!is_dir('assets/uploads/inspection_pdf/' . $year . '/' . $month)) {
                    mkdir('./assets/uploads/inspection_pdf/' . $year . '/' . $month, 0777, true);
                }
            }
            $upath = 'https://futurefit.bcrcomply.com/futurefitapi/assets/uploads/inspection_pdf/assets/uploads/inspection_pdf/' . $year . '/' . $month;
            // file_put_contents($upath, $pdf);

            $path = "/mnt/data/home/500964.cloudwaysapps.com/ypjvsrdfbx/public_html/public/futurefitapi/public/assets/uploads/inspection_pdf/" . $year . "/" . $month . "/Address" . $file_address . "InspectionID" . $inspectionid . "_Form" . $file_formname . ".pdf";

            // print_r($path);die;
            $out_file = fopen($path, "wb");
            if (!$out_file) {die("Can't open file:" . error_get_last());}
            if (!fwrite($out_file, $pdf)) {die("Can't write file");}
            if (!fclose($out_file)) {die("Can't close file");}
            $filenamelink = '/' . $year . "/" . $month . "/Address" . $file_address . "InspectionID" . $inspectionid . "_Form" . $file_formname . ".pdf";
            // return $filenamelink;
            // $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = Inspections::find($inspectionid);
            $sql->pdf_filename = $filenamelink;
            $sql->update();
        } catch (PdfcrowdException $why) {
            echo "Pdfcrowd Error: " . $why;
        }


            }
            $body = $result->form_name." has been submitted in ".$result->address1." by ".$result->by_name;
            $addnoti = new NotifiationMobile();
            $addnoti->fk_user_id = $result->fk_forms_id;
            $addnoti->note = $body;
            $addnoti->sub_section = "ins";
            $pptype = propertyType($result->property_id);
            if($pptype == "Property"){
                $addnoti->section = "Property";
                $addnoti->route = "property.show";
            }
            if($pptype == "Lead"){
                $addnoti->section = "Leads";
                $addnoti->route = "lead.show";
            }
            $addnoti->property_id = $result->property_id;
            $addnoti->save();
        }

    }
}
if (!function_exists('newNotification')) {
    function newNotification($details) {

        $addnoti = new NotifiationMobile();
        $addnoti->fk_user_id = $details["authid"];
        $addnoti->note = $details["body"];
        $addnoti->section = isset($details["section"]) ? $details["section"] : null;
        $addnoti->sub_section = isset($details["sub_section"]) ? $details["sub_section"] : null;
        $addnoti->section_id = isset($details["sec_id"]) ? $details["sec_id"] : null;
        $addnoti->route = isset($details["route"]) ? $details["route"] : null;
        $addnoti->property_id = isset($details["property_id"]) ? $details["property_id"] : null;
        $addnoti->save();
    }
}
if (!function_exists('propertyType')) {
    function propertyType($id) {
        $checkProperty = $getLeadId = $getBatch = null;
        $getLeadId = DB::table('schemes')->where('scheme', 'like', '%' . 'Leads' . '%')->first();
        if($getLeadId){
            $getBatch = DB::table('batches')->where('scheme_id',$getLeadId->id)->first();
            if($getBatch){
                $checkProperty = DB::table('properties')->select('id','batch_id','lead_type','lead_value','lead_source','status')
                ->where('id',$id)->where('batch_id',$getBatch->id)->first();
                if($checkProperty){
                    return 'Lead';
                }else{
                    return 'Property';
                }
            }else{
                return 'Property';
            }
        }else{
            return 'Property';
        }
    }
}
