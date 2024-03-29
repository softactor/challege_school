<?php

use App\Event;
use App\Template;
use App\Usertype;
use App\custom_fields;
use App\custom_field_metas;
use Illuminate\Support\Facades\DB;
use JeroenDesloovere\VCard\VCard;
use QR_Code\QR_Code;
use Illuminate\Support\Facades\View;

if(!function_exists('getEventName'))
{
	function getEventName($eventId)
	{
		$event = Event::find($eventId);
		if(!empty($event))
		{
			return $event->name;
		}
	}
}

if(!function_exists('getTypeName'))
{
	function getTypeName($typeId)
	{
		$type = Usertype::find($typeId);
		if(!empty($type))
		{
			return $type->type_name;
		}
                
                return '';
	}
}

if(!function_exists('getTypeIdByName'))
{
	function getTypeIdByName($typeName)
	{
		$type = DB::table('usertypes')->where('type_name', '=', $typeName)->first();
		if(!empty($type))
		{
			return $type->id;
		}
                
                return '';
	}
}

if(!function_exists('getTemplateName'))
{
	function getTemplateName($templateId)
	{
		$template = Template::find($templateId);
		if(!empty($template))
		{
			return $template->template_name;
		}
	}
}

if(!function_exists('getCustomFieldByModule'))
{
	function getCustomFieldByModule($module_name)
	{
		$CustomFields = custom_fields::where(['module'=>$module_name,'field_visibility'=>1])->get();
		return json_encode($CustomFields);
	}
}

if(!function_exists('getCustomFieldValue'))
{
	function getCustomFieldValue($module,$record_id,$custom_field_id)
	{
		$data = custom_field_metas::where(['module'=>$module,'reference_record'=>$record_id,'custom_fields_id'=>$custom_field_id])->first();
		if($data){
			return $data->field_value;
		}else{
			return NULL;
		}
	}
}

if(!function_exists('getCustomFieldIdBySlug'))
{
	function getCustomFieldIdBySlug($slug)
	{
		$row = custom_fields::where(['field_slug'=>$slug])->first();
		if(!empty($row)){
			return $row->id;
		}else{
			return NULL;
		}
	}
}
function get_seat_item_color_name_by_name($name) {
    $data = DB::table('event_seat_arrangements')
                    ->where('name', $name)
                    ->first();
    if(isset($data) && !empty($data)){
        if(isset($data->bg_color) && !empty($data->bg_color)){
            return $data->bg_color;
        }else{
            return '';
        }
    }
    return '';
}
function get_country_id_by_name($country_name) {
    $data = DB::table('countries')
                    ->where('country_name', $country_name)
                    ->first();
    if(isset($data) && !empty($data)){
        if(isset($data->id) && !empty($data->id)){
            return $data->id;
        }else{
            return '';
        }
    }
    return '';
}
function get_table_data_by_clause($data) {
    $result = DB::table($data['table'])
            ->where($data['where']);
    if (isset($data['order_by'])) {
        $result->orderBy($data['order_by_column'], $data['order_by']);
    }
    $result_data = $result->get();
    if (isset($result_data) && !empty($result_data)) {
        return $result_data;
    } else {
        return false;
    }
}
function image_file_store($file_data, $store_path) {
    $image_file_name    = $file_data['image_file_name'];
    $fileName           = $file_data['fileName'];
    $newDirtory         = $file_data['newDirtory'];
    $filePrefix         = $file_data['filePrefix'];
    $image_errors       = [];
    $image_status       = false;
    if (isset($_FILES[$image_file_name]['name']) && !empty($_FILES[$image_file_name]['name'])) {
        $uploadOk = 1;
        $imageFileType  = strtolower(pathinfo($_FILES[$image_file_name]['name'], PATHINFO_EXTENSION));
        $fileName       = $filePrefix .$fileName;
        $target_file    = $newDirtory . "/" . $fileName;
        // Check if image file is a actual image or fake image
        list($width, $height) = getimagesize($_FILES[$image_file_name]["tmp_name"]);
        $check = getimagesize($_FILES[$image_file_name]["tmp_name"]);
        if ($check == false) {
            $uploadOk = 0;
            array_push($image_errors, "Please upload a image file");
        }
        // Check file size
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $uploadOk = 0;
            array_push($image_errors, "Sorry, only JPG, JPEG, PNG files are allowed.");
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['error'] = "Sorry, Failed to upload image.";
            $feedbackData   =   [
                'status'    => "error",
                'message'   => "Failed to image uploaded",
                'data'      => $image_errors,
            ];
        } else {
            if (move_uploaded_file($_FILES[$image_file_name]["tmp_name"], $target_file)) {
                $feedbackData   =   [
                    'status'    => "success",
                    'message'   => "File have been successfully uploaded",
                    'data'      => $fileName,
                ];
            }
        }// Image not selected!
    }else{
        $feedbackData   =   [
            'status'    => "error",
            'message'   => "Failed to image uploaded",
            'data'      => array_push($image_errors, "There was no file."),
        ];
    }
    return $feedbackData;
}

// CHECK DUPLICATE DATA ENTRY:

function check_duplicate_data($data){
    $result     =    DB::table($data['table'])->where($data['where'])->first();
    if(isset($result) && !empty($result)){
        return $result->id;
    }else{
        return false;
    }
}
function getNameBadgeTemplatedata($param) {        
    $result     =    DB::table('templates')->where($param)->first();
    if(isset($result) && !empty($result)){
        return $result;
    }else{
        return false;
    }
}
function getTypeBackgroundColor($id){
    return DB::table('usertypes')->where('id', '=', $id)->first()->background_color;
}
function getTypeTextColor($id){
    return DB::table('usertypes')->where('id', '=', $id)->first()->text_clor;
}

/**************APP SETTINGS************************/

function event_enable_vcard($event_id){
    $vcard_data =  DB::table('app_settings')
            ->select('enable_vcard')
            ->where('event_id', '=', $event_id)
            ->first();
    if(isset($vcard_data) && !empty($vcard_data)){
        return $vcard_data->enable_vcard;
    }

    return 0;
}

function event_enable_qrcode($event_id){
    $qrcode_data =  DB::table('app_settings')
            ->select('enable_qrcode')
            ->where('event_id', '=', $event_id)
            ->first();

    if(isset($qrcode_data) && !empty($qrcode_data)){
        return $qrcode_data->enable_qrcode;
    }

    return 0;
}
function event_enable_barcode($event_id){
    $barcode_data =  DB::table('app_settings')
            ->select('enable_barcode')
            ->where('event_id', '=', $event_id)
            ->first();
    if(isset($barcode_data) && !empty($barcode_data)){
        return $barcode_data->enable_barcode;
    }

    return 0;
}
function event_enable_sync_dashboard($event_id){
    $sync_data  =    DB::table('app_settings')
            ->select('enable_sync_dashboard')
            ->where('event_id', '=', $event_id)
            ->first();
    if(isset($sync_data) && !empty($sync_data)){
        return $sync_data->enable_sync_dashboard;
    }

    return 0;
}


function get_sync_dashboard_api(){
    return DB::table('app_settings')
            ->select('sync_dashboard_api')
            ->first()->sync_dashboard_api;
}
function get_registro_dashboard_url(){
    $app_data   =    DB::table('app_settings')
            ->select('registro_dashboard_url')
            ->first();
    
    if(isset($app_data) && !empty($app_data)){
        return $app_data->registro_dashboard_url;
    }
    return '';
}


function is_qrcode_enable($event_id){
    $app_data   =  DB::table('app_settings')
    ->select('enable_qrcode', 'qrcode_type')
    ->where('event_id', $event_id)
    ->first();

    if(isset($app_data) && !empty($app_data)){
        if($app_data->enable_qrcode == 1){
            return $app_data->qrcode_type;
        } 
    }

    return 0;

}


function get_qrcode_address_type($event_id){
    return DB::table('app_settings')
    ->select('registro_dashboard_url')
    ->first()->registro_dashboard_url;
}



/**************APP SETTINGS************************/

function human_format_date($timestamp) {
    return date("jS M, Y h:i:a", strtotime($timestamp)); //September 30th, 2013
}

function getAttendeePrintedStatus($id){
    $attendeeData   =   DB::table('attendees')->where('id', '=', $id)->first();
    if($attendeeData->print_status){
        $printingStatus     =   '<span class="badge badge-success">Printed</span>';
    }else{
        $printingStatus     =   '<span class="badge badge-warning">Not Printed</span>';
    }
    
    return $printingStatus;
}
function getAttendeePrintedDate($id){
    $attendeeData   =   DB::table('attendees')->where('id', '=', $id)->first();
    if($attendeeData->print_status){
        $printingDate     = human_format_date($attendeeData->print_date);
    }else{
        $printingDate     =   '';
    }
    
    return $printingDate;
}
function getAttendeenop($id){
    $attendeeNopHisResp        =   DB::table('print_history')->where('attendee_id', '=', $id)->get();
    return count($attendeeNopHisResp);
}

function create_attendee_qrcode($data){
    $qrcodeData = [
        'pathname'      => $data->path,
        'qrcode_data'   => $data->qrcode_data
    ];
    getQRCode($qrcodeData);
}

function getQRCode($data) {
    QR_Code::png($data['qrcode_data'], $data['pathname']);
}

function create_attendee_vcard($data=''){
    $vcard  =   new VCard();
    $lastname = 'Desloovere';
    $firstname = 'Jeroen';
    $additional = '';
    $prefix = '';
    $suffix = '';

    // add personal data
    $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);

    // add work data
    $vcard->addCompany('Siesqo');
    $vcard->addJobtitle('Web Developer');
    $vcard->addRole('Data Protection Officer');
    $vcard->addEmail('info@jeroendesloovere.be');
    $vcard->addPhoneNumber(123456789, 'WORK');

    // return vcard as a string
    //return $vcard->getOutput();

    // return vcard as a download
    //return $vcard->download();

    // save vcard on disk
    $vcardPath                  = public_path('vcards/');
    
    $vcard->setSavePath($vcardPath);
    $vcard->save();
}
function create_attendee_qr_vcard($profile=''){
    $vcardPath                  = $profile->pathName;
    $vcardData  =   '';
    $vcardData.="BEGIN:VCARD\r\n";
    $vcardData.="VERSION:3.0\r\n";
    $vcardData.="N:$profile->lastName;$profile->fastName;;$profile->salutation\r\n";
    $vcardData.="FN:$profile->fullName\r\n";
    $vcardData.="ORG:$profile->organizationName\r\n";
    $vcardData.="EMAIL:$profile->email\r\n";
    $vcardData.="REV:2008-04-24T19:52:43Z\r\n";
    $vcardData.="END:VCARD\r\n";
    
    QR_Code::png($vcardData, $vcardPath);
}
function get_table_data_by_table($table, $order_by = null, $colums=null) {
    $result = DB::table($table);
    if (isset($colums) && !empty($colums)) {
        $result->select($colums);
    }
    if (isset($order_by['order_by'])) {
        $result->orderBy($order_by['order_by_column'], $order_by['order_by']);
    }
    return $result->get();
}

function getTableTotalRows($data) {
    $field = $data['field'];
    $total_row = DB::table($data['table'])
            ->select(DB::raw("count($field) as total"))
            ->where($data['where'])
            ->first();
    return $total_row;
}
function calculate_time_span($date){
    $seconds  = strtotime(date('Y-m-d H:i:s')) - strtotime($date);

        $months = floor($seconds / (3600*24*30));
        $day = floor($seconds / (3600*24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours*3600)) / 60);
        $secs = floor($seconds % 60);

        if($seconds < 60)
            $time = $secs." seconds ago";
        else if($seconds < 60*60 )
            $time = $mins." min ago";
        else if($seconds < 24*60*60)
            $time = $hours." hours ago";
        else if($seconds < 24*60*60)
            $time = $day." day ago";
        else
            $time = $months." month ago";

        return $time;    
}

function get_namebadge_last_printed_time(){
    return DB::table('print_history')->latest('created_at')->first();
}


function show_attendee_qrcode($dashboardUrl, $dashboardQrImage, $attendee){
    $qrcode     =   '';
    if(isset($dashboardQrImage) && $dashboardQrImage==2){
        $path = $dashboardUrl . 'pdf/' . $attendee->event_id . "/" . $attendee->attendee_live_qr_code;            
    }elseif(($dashboardQrImage) && $dashboardQrImage==3){
        $path =  $attendee->client_qrcode_address;                    
    }elseif(($dashboardQrImage) && $dashboardQrImage==1){
        $path =  asset('public/qrcodes/'.$attendee->client_qrcode_address);                    
    }   
    if(isset($path) && !empty($path)){ 
        $qrcode     =    '<img id="reg_qrcode_image" src="'.$path.'" >';
    }
    return $qrcode;
}

function show_attendee_phoho($attendee_photo_path, $conf){
    $qrcode     =   '';
    if(!empty($attendee_photo_path)){
        $path = asset('public/uploads/'.$attendee_photo_path);            
        $qrcode     =    '<img id="reg_qrcode_image" src="'.$path.'" width="'.$conf->width.'" height="'.$conf->height.'" >';
    }  
    return $qrcode;
}

function upload_attendee_photo($file_name, $target_dir) {
    $tmp = explode('.', $_FILES[$file_name]["name"]);
    $file_extension = end($tmp);
    $file_base_name      =   'attendee_photo_'.time().'.'.$file_extension;
    
    
    $target_file    = $target_dir . $file_base_name;
    $uploadOk       = 1;
    $imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $message  =   '';
    $status         =   'error';

// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES[$file_name]["tmp_name"]);
    if ($check == false) {
        $message.= "File is not an image.<br>";
        $uploadOk = 0;
    }

// Check if file already exists
//    if (file_exists($target_file)) {
//        $error_message.=  "Sorry, file already exists.";
//        $uploadOk = 0;
//    }

// Check file size
    if ($_FILES[$file_name]["size"] > 700000) {
        $message.= "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $message.= "Sorry, only JPG, JPEG & PNG files are allowed.";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message.=   "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file)) {
            $message.=  "The file " . htmlspecialchars(basename($_FILES[$file_name]["name"])) . " has been uploaded.";
            $status     =  'success';
        } else {
            $uploadOk = 0;
            $error_message.=  "Sorry, there was an error uploading your file.";
        }
    }
    
    $response   =   (object)[
        'status'            =>  $status,
        'message'           =>  $message,
        'name'              =>  $file_base_name,
    ];
    
    return $response;
}


function get_business_owners_details_serial_number($profile_data){
    $ebodParam['table'] = 'attendees';
    $ebodParam['field'] = 'id';
    $ebodParam['where'] = [
        'event_id'      => $profile_data['event_id']
    ];
    $serialParam = [
        'event_id'      => $profile_data['event_id'],
        'alphanum'      => strtoupper(substr(str_shuffle(str_repeat('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789', 10)), 0, 6)),
        'next_id'       => getTableTotalRows($ebodParam)->total + 1,
        'serial_prefix' => (isset($profile_data['serial_prefix']) && !empty($profile_data['serial_prefix']) ? $profile_data['serial_prefix'] : ''),
    ];
    return generate_serial_number($serialParam);
}


function generate_serial_number($data) {
    $formater_length = 6;
    $alphanum = $data['alphanum'];
    if (isset($data['serial_prefix']) && !empty($data['serial_prefix'])) {
        $length_of_serial_prefix = strlen($data['serial_prefix']);
        if ($length_of_serial_prefix <= 4) {
            $formater_length = (6 - $length_of_serial_prefix);
            $final_formater_length = $formater_length . 'd';
            $next_id = sprintf('%0' . $final_formater_length, $data['next_id']);
            $comingDigit = $data['serial_prefix'] .$alphanum. $next_id;
            return $comingDigit;
        } else {
            $next_id = sprintf('%0' . $formater_length . 'd', $data['next_id']);
        }
    } else {
        $next_id = sprintf('%0' . $formater_length . 'd', $data['next_id']);
    }

    
    $event = sprintf('%04d', $data['event_id']);
    $comingDigit = $event . $alphanum . $next_id;
    return $comingDigit;
}


    function generate_barcode($barcode_param){
        $bar = App::make('BarCode');
        $barcode = [
            'size'              => 30,
            'orientation'       => 'horizontal',
            'code_type'         => 'code128',
            'print'             => true,
            'sizefactor'        => 1,
            'text'              => $barcode_param->text,
            'filename'          => $barcode_param->filename,
            'filepath'          => $barcode_param->filepath
        ];
        $barcontent = $bar->barcodeFactory()->renderBarcode(
            $text=$barcode["text"], 
            $size=$barcode['size'], 
            $orientation=$barcode['orientation'], 
            $code_type=$barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar 
            $print=$barcode['print'], 
            $sizefactor=$barcode['sizefactor'],
            $filename = $barcode['filename'],
            $filepath = $barcode['filepath']
    )->filename($barcode['filename']);
    }
    
    
    function make_attendee_namebadge($attendee){
        $namebadge                  =   '<span class="badge badge-warning">No template Found</span>';
        $nameBadgeTemplateParam     =   [
            'event_id'  => $attendee->event_id,
            'type_id'   => $attendee->type_id
        ];
        $templateInfo       =   getNameBadgeTemplatedata($nameBadgeTemplateParam);
        if(isset($templateInfo) && !empty($templateInfo)){
            $nameBadgeConfData  =   json_decode($templateInfo->namebadge_print_data);
            
            
            
            $attendeeData       =   [
                'serial_number'         =>  $attendee->serial_number,
                'event_id'              =>  $attendee->event_id,
                'salutation'            =>  $attendee->salutation,
                'first_name'            =>  $attendee->first_name,
                'last_name'             =>  $attendee->last_name,
                'email'                 =>  $attendee->email,
                'namebadge_user_label'  =>  getTypeName($attendee->type_id),
                'country_id'            =>  $attendee->country,
                'company_name'          =>  $attendee->company,
                'type_id'               =>  $attendee->type_id,
                'vcard_path'            =>  $attendee->vcard_path,
                'attendee_live_qr_code' =>  $attendee->attendee_live_qr_code,
                'client_qrcode_address' =>  $attendee->client_qrcode_address,
                'zone'                  =>  $attendee->zone,
                'table_name'            =>  $attendee->table_name,
                'seat'                  =>  $attendee->seat,
                'zone_bg_color'         =>  $attendee->zone_bg_color,
                'designation'           =>  $attendee->designation,
                'attendee_photo'        =>  $attendee->attendee_photo,
                'bar_code_path'         =>  $attendee->bar_code_path,
            ];  
            $viewParamData['user_id']             = $attendee->id;
            $viewParamData['event_id']            = $attendee->event_id;
            $viewParamData['qrCodeFinalData']     = $attendeeData;
            $viewParamData['templatesDatas']      = $templateInfo;
            $viewParamData['nameBadgeConfData']   = $nameBadgeConfData;
            $viewParam                            = (object)$viewParamData;
            $namebadgeViewData                    =   View::make('attendee.attendee_namebadge', compact('viewParam'));
            $namebadge                            =   $namebadgeViewData->render();
        }
        return $namebadge;
    }


?>