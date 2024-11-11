<?php
  use Illuminate\Support\Facades\DB;
  use App\Http\Controllers\ContractorMessageController;
  use App\Http\Controllers\PropertyController;
  use App\Models\NotificationMobile;
  use Illuminate\Support\Facades\Auth;

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

if (! function_exists('shortName')) {
    function shortName($name = ""){
        $name = trim($name);
        $name_arr = explode(' ', $name);
        if(sizeof($name_arr) < 2){
            return strtoupper($name);
        }

        $initials = "";

        foreach($name_arr as $n) {
            $initials .= $n[0];
        }

        return strtoupper($initials);
    }
}
if (! function_exists('random_color_part')) {
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
}

if (! function_exists('random_color')) {
    function random_color() {
        return '#'.random_color_part() . random_color_part() . random_color_part();
    }
}


if (! function_exists('random_color_generate')){
    function random_color_generate($index){
        $colors = [
            '#8EF7C9', //(Light Green)
            '#DAC8FF',
            '#80CFFF', //(Light Blue)
            '#FFFA92', //(Light Yellow)
            '#FF9C6E', //(Light Orange)
            '#FF7D86', //(Light Red)
            '#BDBDBD', //(Light Gray)
            '#66FFFF', //(Light Aqua)
            '#FF6852', //(Light Vermilion)
            '#FF77A9', //(Light Fuchsia)
            '#80FF91', //(Light Lime Green)
            '#FF6852', //(Light Deep Orange)
            '#80E8FF', //(Light Cyan)
            '#DA91FF', //(Light Lavender)
            '#FFA040', //(Light Dark Orange)
            '#FF7570', //(Light Crimson)
            '#DCE775', //(Light Lime)
            '#64B5F6', //(Light Dodger Blue)
            '#FF9600', //(Light Amber)
            '#AED581', //(Light Green)
            '#FF6852', //(Light Tomato)
            '#8D6E63', //(Light Brown)
            '#80F8FF', //(Light Turquoise)
            '#DFB8FF', //(Light Purple)
            '#CFF1D1',
            '#EC407A', //(Light Raspberry)
            '#80F8FF', //(Light Sky Blue)
            '#FFD95E', //(Light Sunflower)
            '#FF7575', //(Light Watermelon)
            '#26A69A', //(Light Teal)
            '#B2D7F7',
            '#FFB2D9',
            '#FFECB3',
            '#B2E5E5',
            '#FFD9B3',
            '#FFB2B2',
            '#C6FFC6',
            '#A669A6',
            '#E5FFB2',
            '#C7A275',
            '#FFB2FF',
            '#A8A3C6',
            '#A3FFA3',
            '#FFA68B',
            '#662121',
            '#669999',
            '#FFD2E1',
            '#CFCFCF',
            '#FFEDB2',
            '#96E5E5',
            '#FFC6B2',
            '#B8AED1',
            '#808B8D',
            '#FF77A9', //(Light Pink)
            '#FFE863', //(Light Gold)
        ];
        return $colors[$index] ?? random_color();
    }
}
if (! function_exists('calculateDueDateTime')){

    function calculateDueDateTime($dueDate, $dueTime, $whenTime)
    {
        // Parse the due date and time strings
        $dueDateTime = strtotime($dueDate . ' ' . $dueTime);

        // Calculate the adjusted due date and time based on the offset
        switch ($whenTime) {
            case 'atoe':
                // No adjustment needed for 'At time of event'
                break;
            case '5mb':
                $dueDateTime -= 5 * 60; // Subtract 5 minutes
                break;
            case '10mb':
                $dueDateTime -= 10 * 60; // Subtract 10 minutes
                break;
            case '15mb':
                $dueDateTime -= 15 * 60; // Subtract 15 minutes
                break;
            case '1hb':
                $dueDateTime -= 60 * 60; // Subtract 1 hour
                break;
            case '2hb':
                $dueDateTime -= 2 * 60 * 60; // Subtract 2 hours
                break;
            case '1db':
                $dueDateTime -= 24 * 60 * 60; // Subtract 1 day
                break;
            case '2db':
                $dueDateTime -= 2 * 24 * 60 * 60; // Subtract 2 days
                break;
            case '1wb':
                $dueDateTime -= 7 * 24 * 60 * 60; // Subtract 1 week
                break;
            case '1wb':
                $dueDateTime -= 7 * 24 * 60 * 60; // Subtract 1 week
                break;
            case '2wb':
                $dueDateTime -= 2 * 7 * 24 * 60 * 60; // Subtract 2 week
                break;
            case '3wb':
                $dueDateTime -= 3 * 7 * 24 * 60 * 60; // Subtract 3 week
                break;
            case '1mb':
                $dueDateTime -= 30 * 24 * 60 * 60; // Subtract 1 month
                break;
            case '2mb':
                $dueDateTime -= 60 * 24 * 60 * 60; // Subtract 2 month
                break;
        }

        return date('Y-m-d H:i', $dueDateTime);
    }
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
        // dd($timezone);
        return $timezone;
    }
}
if (! function_exists('getRelativeTime')){
    function getRelativeTime($date)
	{
		$diff = time() - strtotime($date);

		if ($diff < 10)
			return "just now";
		else if ($diff < 60)
			return "just now";

		$diff = round($diff / 60);
		if ($diff < 60)
			return $diff . " min". pluralize($diff) ." ago";
		$diff = round($diff / 60);
		if ($diff < 24)
			return $diff . " hour" . pluralize($diff) . " ago";
		$diff = round($diff / 24);
		if ($diff == 1)
		{
			return "yesterday";
		}
		elseif($diff < 7 )
		{
			return $diff . " day" . pluralize($diff) . " ago";
		}
		$days = $diff;
		$diff = round($diff / 7);
		if ($diff < 5)
		{
			return $diff . " week" . pluralize($diff) . " ago";
		}
		if($days < 30)
		{
			return "1 month" . pluralize($diff) . " ago";
		}
		$diff = round($days / 30);
		if($diff < 12 )
		{
			return $diff . " month" . pluralize($diff) . " ago";
		}
		$diff = round($diff / 12);
		return $diff . " year" . pluralize($diff) . " ago";

	}
}

if (! function_exists('pluralize')){
    function pluralize($num)
	{
		if ((int)$num != 1)
			return "s";
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
        $result = DB::table('properties')->select('properties.address1', 'inspections.fk_forms_id', 'forms.forms_id as name')
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
            $uri = 'https://futurefit.bcrcomply.com/dashboard/property/report/'.$inspectionid.'/print';

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
            $sql = DB::table('inspections')->where('id',$inspectionid)->update([
                'pdf_filename' => $filenamelink
            ]);
        } catch (PdfcrowdException $why) {
            echo "Pdfcrowd Error: " . $why;
        }


            }
        }

    }
}
if (!function_exists('compareFiles')) {
    function compareFiles($file1, $file2) {
        // dd($file1, $file2);
      // Check if files exist
      // Generate hashes (MD5 for simplicity)
      $hash1 = md5_file($file1);
      $hash2 = md5_file($file2);

      // Return comparison result (0 for match, 1 for difference)
      return ($hash1 === $hash2) ? 0 : 1;
    }
}
if (!function_exists('getOldPdfData')) {
    function getOldPdfData($indsID)
    {
        ini_set('memory_limit', '-1');
        // <?php
        include './pdfcrowd.php';

        $year = date('Y');
        $month = date('m');

        $inspectionid = $indsID;
        $result = DB::table('properties')->select('properties.address1', 'inspections.fk_forms_id', 'forms.forms_id as name')
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
            $uri = 'https://futurefit.bcrcomply.com/dashboard/property/report/'.$inspectionid.'/print';

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

            $out_file = fopen($path, "wb");
            if (!$out_file) {die("Can't open file:" . error_get_last());}
            if (!fwrite($out_file, $pdf)) {die("Can't write file");}
            if (!fclose($out_file)) {die("Can't close file");}
            $filenamelink = '/' . $year . "/" . $month . "/Address" . $file_address . "InspectionID" . $inspectionid . "_Form" . $file_formname . ".pdf";
            // $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = DB::table('inspections')->where('id',$inspectionid)->update([
                'pdf_filename' => $filenamelink
            ]);

            return $filenamelink;
        } catch(\Pdfcrowd\Error $why)
        {
            // print the error
            error_log("Pdfcrowd Error: {$why}\n");

            // print the error code
            error_log("Pdfcrowd Error Code: {$why->getCode()}\n");

            // print the error message
            error_log("Pdfcrowd Error Message: {$why->getMessage()}\n");
        }


            }
        }

    }
}
if (!function_exists('getMessagesAll')) {
    function getMessagesAll()
    {
        $auth = Auth::user();
        $result = (new ContractorMessageController)->openChatNoti();
        // dd($result);
        return $result;
        // dd($auth);
    }
}
if (!function_exists('getRemindersAll')) {
    function getRemindersAll()
    {
        $auth = Auth::user();
        $result = (new PropertyController)->checkReminder2();
        return $result;
        // dd($auth);
    }
}
if (!function_exists('notificationMobile')) {
    function notificationMobile()
    {
        $auth = Auth::user();
        // $result = NotificationMobile::where('note', 'like', '%' . "Snag recorded" . '%')->orWhere('note', 'like', '%' . "Snag Resolved" . '%')->orderBy('date','desc')->get();
        // $result = NotificationMobile::orderBy('date','desc')->get();

        function transformNotifications($notifications) {
            return $notifications->map(function ($notification) {
                return [
                    'note' => $notification->data['notify'],
                    'date' => $notification->created_at,
                    'section' => null,
                    'route' =>null,
                    'section_id' => null,
                    'sub_section' => null,
                    'property_id' => null,
                ];
            });
        }

        $unRead = $auth->unreadNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject');
        $transformedUnRead = transformNotifications($unRead);

        $Read = $auth->readNotifications->where('type', 'App\Notifications\ContractorJobAcceptReject');
        $transformedRead = transformNotifications($Read);

        $mobileNotifications = NotificationMobile::orderBy('date', 'desc')->get();
        $transformedMobileNotifications = $mobileNotifications->map(function ($notification) {
            return [
                'note' => $notification->note,
                'date' => $notification->date,
                'section' => $notification->section,
                'route' => $notification->route,
                'section_id' => $notification->section_id,
                'sub_section' => $notification->sub_section,
                'property_id' => $notification->property_id,
            ];
        });

        $mergedNotifications = collect();
        if ($transformedUnRead->isNotEmpty()) {
            $mergedNotifications = $mergedNotifications->merge($transformedUnRead);
        }
        if ($transformedRead->isNotEmpty()) {
            $mergedNotifications = $mergedNotifications->merge($transformedRead);
        }
        if ($transformedMobileNotifications->isNotEmpty()) {
            $mergedNotifications = $mergedNotifications->merge($transformedMobileNotifications);
        }
        $sortedNotifications = $mergedNotifications->sortByDesc('date')->values()->all();
        // dd($sortedNotifications);
        return $sortedNotifications;
    }
}
if (!function_exists('getLogoUrl')) {
    function getLogoUrl($attachment) {
        $fileExtension = strtolower(pathinfo($attachment, PATHINFO_EXTENSION));
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv', 'webm', 'm4v', '3gp', 'mpeg', 'mpg'];
        $audioExtensions = ['mp3', 'wav', 'ogg', 'flac', 'aac', 'm4a', 'wma', 'aiff', 'ape', 'opus'];
        $otherExtensions = ['txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'zip', 'rar', '7z', 'tar', 'gz', 'html', 'htm', 'css', 'js', 'php', 'cpp', 'java', 'py', 'csv', 'json', 'xml', 'epub', 'svg', 'ico', 'psd', 'ai', 'max', 'dwg'];

        $base = url('/');
        $defaultLogo = $base . '/public/assets/images/extension/word.svg';
        $videoLogo = $base . '/public/assets/images/extension/video.svg';
        $audioLogo = $base . '/public/assets/images/extension/audio.svg';
        $imageLogo = $base . '/public/assets/images/extension/image.svg';
        $excelLogo = $base . '/public/assets/images/extension/excel.svg';
        $slideLogo = $base . '/public/assets/images/extension/slide.svg';
        $wordLogo = $base . '/public/assets/images/extension/word.svg';

        $logoUrl = $defaultLogo;
        if (in_array($fileExtension, $imageExtensions)) {
            $logoUrl = $imageLogo;
        } elseif (in_array($fileExtension, $videoExtensions)) {
            $logoUrl = $videoLogo;
        } elseif (in_array($fileExtension, $audioExtensions)) {
            $logoUrl = $audioLogo;
        } elseif ($fileExtension === 'xls' || $fileExtension === 'xlsx') {
            $logoUrl = $excelLogo;
        } elseif ($fileExtension === 'ppt' || $fileExtension === 'pptx') {
            $logoUrl = $slideLogo;
        } elseif ($fileExtension === 'doc' || $fileExtension === 'docx') {
            $logoUrl = $wordLogo;
        }
        return $logoUrl;
    }
}
if (!function_exists('newNotification')) {
    function newNotification($details) {
        $addnoti = new NotificationMobile();
        $addnoti->fk_user_id = Auth::user()->id;
        $addnoti->note = $details["body"];
        $addnoti->section = isset($details["section"]) ? $details["section"] : null;
        $addnoti->sub_section = isset($details["sub_section"]) ? $details["sub_section"] : null;
        $addnoti->section_id = isset($details["sec_id"]) ? $details["sec_id"] : null;
        $addnoti->route = isset($details["route"]) ? $details["route"] : null;
        $addnoti->property_id = isset($details["property_id"]) ? $details["property_id"] : null;
        $addnoti->save();
    }
}
if (!function_exists('snagReportPDF')) {
    function snagReportPDF($snagID,$snag)
    {
        // <?php
        include './pdfcrowd.php';

        $year = date('Y');
        $month = date('m');

        if ($snag) {
            if($snag->item_name == "" || $snag->item_name == null){
                return true;
            }else{
                $form = $snag->item_name;
                $file_formname = str_replace(" ", "_", $form);

                try {
                    $client = new \Pdfcrowd\HtmlToPdfClient("Sean", "1306a3dfb8cebf24565396c60bcab0f4");
                    $client->setImageDpi(175);
                    $uri = 'https://futurefit.bcrcomply.com/dashboard/property/snag_report/'.$snagID.'/print';
                    $pdf = $client->convertUrl($uri);
                    // dd(public_path());
                    // if($uploadPath == ""){

                    if (!is_dir('futurefitapi/public/assets/uploads/snag_pdf/' . $year)) {
                        mkdir('./futurefitapi/public/assets/uploads/snag_pdf/' . $year . '/' . $month, 0777, true);
                    } else if (is_dir('futurefitapi/public/assets/uploads/snag_pdf/' . $year)) {
                        if (!is_dir('futurefitapi/public/assets/uploads/snag_pdf/' . $year . '/' . $month)) {
                            mkdir('./futurefitapi/public/assets/uploads/snag_pdf/' . $year . '/' . $month, 0777, true);
                        }
                    }
                    $upath = 'https://futurefit.bcrcomply.com/futurefitapi/assets/uploads/snag_pdf/assets/uploads/snag_pdf/' . $year . '/' . $month;
                    // file_put_contents($upath, $pdf);

                    $path = "/mnt/data/home/500964.cloudwaysapps.com/ypjvsrdfbx/public_html/public/futurefitapi/public/assets/uploads/snag_pdf/" . $year . "/" . $month . "/SangID" . $snagID . "_Name" . $file_formname . ".pdf";

                    // print_r($path);die;
                    $out_file = fopen($path, "wb");
                    if (!$out_file) {die("Can't open file:" . error_get_last());}
                    if (!fwrite($out_file, $pdf)) {die("Can't write file");}
                    if (!fclose($out_file)) {die("Can't close file");}
                    $filenamelink = '/' . $year . "/" . $month . "/SangID" . $snagID . "_Name" . $file_formname . ".pdf";

                    $sql = DB::table('snag_records')->where('id',$snagID)->update([
                        'pdf_filename' => $filenamelink
                    ]);

                    return $filenamelink;
                } catch (PdfcrowdException $why) {
                    echo "Pdfcrowd Error: " . $why;
                }

            }
        }

    }
}
if (!function_exists('genrateContractPdf')) {
    function genrateContractPdf()
    {
        // <?php
        include './pdfcrowd.php';

        $year = date('Y');
        $month = date('m');

        $file_formname = "contract";

                try {
                    $client = new \Pdfcrowd\HtmlToPdfClient("Sean", "1306a3dfb8cebf24565396c60bcab0f4");
                    $client->setImageDpi(175);
                    $uri = 'https://futurefit.bcrcomply.com/con-form-view';
                    $pdf = $client->convertUrl($uri);

                    if (!is_dir('futurefitapi/public/assets/uploads/contract_pdf')) {
                        mkdir('./futurefitapi/public/assets/uploads/contract_pdf', 0777, true);
                    }

                    $path = "/mnt/data/home/500964.cloudwaysapps.com/ypjvsrdfbx/public_html/public/futurefitapi/public/assets/uploads/contract_pdf/" . $file_formname . ".pdf";

                    // print_r($path);die;
                    $out_file = fopen($path, "wb");
                    if (!$out_file) {die("Can't open file:" . error_get_last());}
                    if (!fwrite($out_file, $pdf)) {die("Can't write file");}
                    if (!fclose($out_file)) {die("Can't close file");}

                } catch (PdfcrowdException $why) {
                    echo "Pdfcrowd Error: " . $why;
                }

    }
}
