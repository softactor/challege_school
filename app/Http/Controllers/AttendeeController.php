<?php

namespace App\Http\Controllers;

use auth;
use Response;
use App\Event;
use App\Usertype;
use App\Attendee;
use App\custom_fields;
use App\custom_field_metas;
use Illuminate\Http\Request;
use App\Http\Requests\attendeeStore;
use App\Http\Requests\uploadCSV;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendeeController extends Controller {
    
    
    private $attendee_insert_id;
    private $attendee_photo_path;
    private $attendee_photo_upload_error;
    private $event_id;
    private $attendee_data_request;
    private $client_qrcode_text;
    private $serial_number;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $attendees = attendee::all();
        return view('attendee.index', compact(['attendees']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_attendee() {
        $events         = DB::table('events')->get();
        $usertypes      = DB::table('usertypes')->get();
        $salutations    = DB::table('salutations')->get();
        $countries      = DB::table('countries')->get();
        $attendee = Attendee::orderBy("id", "Desc")->first();

        if ($attendee == null) {
            $serial_number = 1;
        } else {
            $serial_number = $attendee->id + 1;
        }
        return view('attendee.add_attendee_form', compact('events','usertypes','salutations','countries','serial_number'));
    }
    public function create($event) {
        $event_id = $event;
        $salutations = DB::table('salutations')->get();
        $countries = DB::table('countries')->get();
        $attendee = Attendee::orderBy("id", "Desc")->first();

        if ($attendee == null) {
            $serial_number = 1;
        } else {
            $serial_number = $attendee->serial_number + 1;
        }
        $events         = Event::get()->pluck('name', 'id');
        $userTypes      = Usertype::get()->pluck('type_name', 'id');
        $CustomFields   = getCustomFieldByModule('attendee');
        return view('attendee.create', compact(['event_id', 'events', 'serial_number', 'userTypes', 'CustomFields', 'countries', 'salutations']));
    }
    
    
    
    public function attendee_data_save_n_print(Request $request){
        
        $validationRules = [
            'event_id'  => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email'     => 'required',
            'type_id'   => 'required',
            'country'   => 'required',
            'company'   => 'required',
            'fax'       => 'required'
        ];
        
        $messages =  [
                'event_id.required' => 'Event is required',
                'salutation.required' => 'Salutation is required',
                'first_name.required' => 'First Name is required',
                'last_name.required' => 'Last Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Invalid Email format',
                'email.unique' => 'Email already exist',
                'type_id.required' => 'User Type is required',
                'country.required' => 'Country is required',
                'company.required' => 'Company is required',
                'fax.required' => 'National ID / Passport Number is required',
        ];
        
        
        $validator = Validator::make($request->all(), $validationRules, $messages);
        
        if ($validator->fails()) {
            $response   =   (object)[
                'status'        => 'error',
                'data'          => $validator->errors()->all(),
                'message'       => 'Form data have error'
            ];

            echo json_encode($response);
            
        }else{
        
            $this->attendee_data_request   =   $request;

            $this->attendee_store_process();


            $attendee = Attendee::find($this->attendee_insert_id);

            $preview_id     =   "print_preview_".$this->attendee_insert_id;
            $namebadge  =   "<div id='$preview_id'>";
            $namebadge  .=   make_attendee_namebadge($attendee);
            $namebadge  .=   "</div>";

            $response   =   (object)[
                'attendee_id'   => $this->attendee_insert_id,
                'namebadge'     => $namebadge,
                'status'        => 'success',
                'message'       => 'Attendee has been already added'
            ];

            echo json_encode($response);  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(attendeeStore $request) {
        
        $this->attendee_data_request   =   $request;
        
        
        
        
        $this->attendee_store_process();
        
        
        

        return redirect()->route('attendeeList')->with('success', 'Attendee Added successfully.');
    }
    
    
    public function attendee_store_process(){
        
        // Process1
        $this->attendee_image_upload_process();
        
        // Process2
        $this->attendee_data_store_process();
        
        // Process3        
        $this->attendee_sync_dashboard();
        
        
        // Process4       
        $this->attendee_vcard();
        
        // Process5       
        $this->attendee_vcard();
        
        
        // Process6      
        $this->attendee_barcode();
        
    }
    
    
    public function attendee_barcode(){
        $request    =   $this->attendee_data_request;
        $barcode_gen_status  =   event_enable_barcode($request->event_id);
        if($barcode_gen_status && $barcode_gen_status == 1){
            $barcode_file_path  =   public_path('barcodes/');
            
            $qrfilename         = 'attendee_barcode_' . $this->attendee_insert_id .  '.png';

            $qrparam    =   (object)[
                'text'          => $this->serial_number,
                'filename'      => $qrfilename,
                'filepath'      => $barcode_file_path
            ];
            generate_barcode($qrparam);
            $update = Attendee::find($this->attendee_insert_id);
            $update->bar_code_path = $qrfilename;
            $update->save();
        }
        
    }
    
    public function attendee_qrcode(){
        $request    =   $this->attendee_data_request;
        $qrcode_gen_status  =   is_qrcode_enable($request->event_id);
        if($qrcode_gen_status && $qrcode_gen_status == 1){
            $qrdestPath = public_path('qrcodes/');
            
            $qrfilename         = 'attendee_qrcode_' . $this->attendee_insert_id .  '.png';
            $qr_path_with_file  = $qrdestPath . $qrfilename;

            $qrparam    =   (object)[
                'path'          =>  $qr_path_with_file,
                'qrcode_data'   =>  $this->client_qrcode_text
            ];

            create_attendee_qrcode($qrparam);
            $update = Attendee::find($this->attendee_insert_id);
            $update->client_qrcode_address = $qrfilename;
            $update->save();
        }
        
    }
    
    public function attendee_vcard(){
        $request    =   $this->attendee_data_request;
        if(event_enable_vcard($request->event_id)){
            $vcardName          =   'attendee_vcard_'.$request->event_id.'_'.$this->attendee_insert_id.'.png';        
            $vcardParam         =   (object)[
                'lastName'          =>  $request->last_name,
                'fastName'          =>  $request->first_name,
                'salutation'        =>  $request->salutation,
                'fullName'          =>  $request->first_name. ' ' .$request->last_name,
                'organizationName'  =>  $request->company,
                'mobile'            =>  $request->mobile,
                'office_number'     =>  $request->office_number,
                'email'             =>  $request->email,
                'pathName'          =>  public_path('vcards/'.$vcardName)
            ];

            create_attendee_qr_vcard($vcardParam);
            $update = Attendee::find($this->attendee_insert_id);
            $update->vcard_path = $vcardName;
            $update->save();
        }
        
    }
    
    public function attendee_sync_dashboard(){
        $request    =   $this->attendee_data_request;
        if(event_enable_sync_dashboard($request->event_id)){
            $sync_response  =   $this->sync_dashboard_attendee($request);
            if($sync_response->status == 'success'){
                
                $update_attendee                        = Attendee::find($this->attendee_insert_id);
                $update_attendee->serial_number         = $sync_response->serial_digit;
                $update_attendee->attendee_live_qr_code = $sync_response->qrcode_path;
                $update_attendee->save();
            }
            
        }
        
    }
    
    
    
    public function attendee_data_store_process(){
        $request                =   $this->attendee_data_request;
        $attendee_photo_path    =   ((!$this->attendee_photo_upload_error) ?  $this->attendee_photo_path : "");
        
        $insert = new attendee();
        
        $event_id               =   $request->event_id;
        $gen_serial_number      =   [
            'event_id'          =>  $event_id,
            'serial_prefix'     =>  'C02'
        ];

        $insert->serial_number      = get_business_owners_details_serial_number($gen_serial_number);
        $this->serial_number        = $insert->serial_number;
        $insert->event_id           = $event_id;
        $insert->salutation         = $request->salutation;
        $insert->first_name         = $request->first_name;
        $insert->last_name          = $request->last_name;
        $insert->email              = $request->email;
        $insert->type_id            = $request->type_id;
        $insert->country            = $request->country;
        $insert->company            = $request->company;
        
        $insert->designation        = $request->designation;
        $insert->mobile             = $request->mobile;
        $insert->office_number      = $request->office_number;
        $insert->postal_code        = $request->postal_code;
        $insert->fax                = $request->fax;
        
        $insert->zone               = $request->zone;
        $insert->table_name         = $request->table_name;
        $insert->seat               = $request->seat;
        $insert->zone_bg_color      = (isset($request->zone) && !empty($request->zone) ? get_seat_item_color_name_by_name($request->zone) : '');
        $insert->add_type           = (isset($request->add_type) && !empty($request->add_type) ? $request->add_type: 1);
        
        $insert->created_by         = Auth::User()->id;
        $insert->edited_by          = Auth::User()->id;
        $insert->attendee_photo     = $attendee_photo_path;
        $insert->save();
        
        $this->attendee_insert_id  =   $insert->id;
        
    }
    
    
    
    public function attendee_image_upload_process(){
        
        $attendee_photo_path    =   '';
        $is_error               =   false;
        $message                =   '';
        if(isset($_FILES['attendee_photo']['name']) && !empty($_FILES['attendee_photo']['name'])){
            $file_name      =   'attendee_photo';
            $store_path     =   public_path('/uploads/');
            $photo_response =   upload_attendee_photo($file_name,$store_path);
            if($photo_response->status == 'error'){
                $is_error               =   true;
                $message                =   $photo_response->message;
            }else{
                $message                =   'Photo upload was successfull';
                $attendee_photo_path    =   $photo_response->name;
            }
        }
        
        $this->attendee_photo_path          =   $attendee_photo_path;
        $this->attendee_photo_upload_error  =   $is_error;
        
    }
    
    
    // this method will send data to registro dashboard for generate qrcode and other information
    function sync_dashboard_attendee($request){       
        
        $api    = get_sync_dashboard_api();
        
        if(isset($api) && !empty($api)){

            $url = $api;

            $event_business_owners  =   [
                'event_id'              => $request->event_id,
                'registration_type'     => 'Namebadge',// here need text like visitor, Exibitor etc
                'company_name'          => $request->company,
                'postal_code'           => $request->postal_code,
                'office_number'         => $request->office_number,            
                'salutation'            => $request->salutation, 
                'first_name'            => $request->first_name, 
                'last_name'             => $request->last_name,
                'designation'           => $request->designation,
                'mobile'                => $request->mobile,
                'country_id'            => get_country_id_by_name($request->country), 
                'email'                 => $request->email,
                'namebadge_user_label'  => getTypeName($request->type_id),// here need text like visitor, Exibitor etc
                'created_at'            => date('Y-m-d H:i:s'),            
            ];
            
            
                $client = new \GuzzleHttp\Client();
                $response = $client->post($url, ['form_params' => $event_business_owners]);
                $response = $response->getBody()->getContents();
                $sync_response  = json_decode($response);
                return  $sync_response;
        }
        
    }

    /**
      Import CSV
     */
    public function importCSV() {
        return view('attendee.importCSV');
    }

    /**
      Upload CSV
     */
    public function upload_attendee_csv(Request $request) {
        $fileHaveError = false;
        $importSuccess = 0;
        $importError = 0;
        $fileErrorMessage = [];
        $allowed = array('csv');
        $filename = $_FILES['attendee_csv']['name'];
        if ($_FILES['attendee_csv']['error'] > 0) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please select an import file first');
        }
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please import only CSV file');
        }
        if (!$fileHaveError) {
            $file    = $_FILES['attendee_csv']['tmp_name'];
            $csvdata = $this->csvToArray($file);            
            if (isset($csvdata) && !empty($csvdata)) {
                $offlineData = [];
                foreach ($csvdata as $importData) {
                    $attendee_exist = Attendee::where('email', $importData[5])->count();
                    if(isset($importData[6]) && !empty($importData[6])){
                        $attendeeTypeId     =   (is_numeric($importData[6]) ? $importData[6] : getTypeIdByName($importData[6]));
                        if(isset($attendeeTypeId) && !empty($attendeeTypeId)){
                            if ($attendee_exist == 0) {
                                $insert = new Attendee();
                                $event_id               =   $importData[1];
                                $gen_serial_number      =   [
                                    'event_id'          =>  $event_id,
                                    'serial_prefix'     =>  'C02'
                                ];
                                
                                $insert->serial_number  = get_business_owners_details_serial_number($gen_serial_number);
                                $insert->event_id       = $event_id;
                                $insert->salutation     = $importData[2];
                                $insert->first_name     = $importData[3];
                                $insert->last_name      = $importData[4];
                                $insert->email          = $importData[5];
                                $insert->type_id        = $attendeeTypeId;
                                $insert->country        = $importData[7];
                                $insert->company        = $importData[8];
                                $insert->designation    = (isset($importData[9]) && !empty($importData[9]) ? $importData[9] : '');
                                $insert->mobile         = (isset($importData[10]) && !empty($importData[10]) ? $importData[10] : '');
                                $insert->office_number  = (isset($importData[11]) && !empty($importData[11]) ? $importData[11] : '');
                                $insert->postal_code    = (isset($importData[12]) && !empty($importData[12]) ? $importData[12] : '');
                                $insert->zone           = (isset($importData[13]) && !empty($importData[13]) ? $importData[13] : '');
                                $insert->table_name     = (isset($importData[14]) && !empty($importData[14]) ? $importData[14] : '');
                                $insert->seat           = (isset($importData[15]) && !empty($importData[15]) ? $importData[15] : '');
                                $insert->zone_bg_color  = (isset($importData[16]) && !empty($importData[16]) ? $importData[16] : '');
                                $insert->client_qrcode_text  = (isset($importData[17]) && !empty($importData[17]) ? $importData[17] : '');
                                $insert->created_by     = Auth::User()->id;
                                $insert->edited_by      = Auth::User()->id;
                                $insert->save();
                                
                                
                                if(event_enable_sync_dashboard($insert->event_id)){
                                    $sync_response  =   $this->sync_dashboard_attendee($insert);
                                    if($sync_response->status == 'success'){
                                        $update_attendee                        = Attendee::find($insert->id);
                                        $update_attendee->serial_number         = $sync_response->serial_digit;
                                        $update_attendee->attendee_live_qr_code = $sync_response->qrcode_path;
                                        $update_attendee->save();
                                    }

                                } 

                                if(event_enable_vcard($insert->event_id)){
                                
                                    $vcardName          =   'attendee_vcard_'.$importData[1].'_'.$insert->id.'.png';
                                    $vcardPath          =   public_path('vcards/'.$vcardName);
                                    $vcardParam         =   (object)[
                                        'lastName'          =>  $importData[4],
                                        'fastName'          =>  $importData[3],
                                        'salutation'        =>  $importData[2],
                                        'fullName'          =>  $importData[3]. ' ' .$importData[4],
                                        'organizationName'  =>  $importData[8],
                                        'mobile'            =>  (isset($importData[10]) && !empty($importData[10]) ? $importData[10] : ''),
                                        'office_number'     =>  (isset($importData[11]) && !empty($importData[11]) ? $importData[11] : ''),
                                        'email'             =>  $importData[5],
                                        'pathName'          =>  $vcardPath
                                    ];
                                    // create attendee vcard qrcode:
                                    create_attendee_qr_vcard($vcardParam);
                                    // update attendee with vcard path:
                                    $update = Attendee::find($insert->id);
                                    $update->vcard_path = $vcardName;
                                    $update->save();
                                }

                                $qrcode_gen_status  =   is_qrcode_enable($insert->event_id);
                                if($qrcode_gen_status && $qrcode_gen_status == 1){
                                    $qrdestPath = public_path('qrcodes/');
                                    
                                    $qrfilename         = 'attendee_qrcode_' . $insert->id .  '.png';
                                    $qr_path_with_file  = $qrdestPath . $qrfilename;

                                    $qrparam    =   (object)[
                                        'path'          =>  $qr_path_with_file,
                                        'qrcode_data'   =>  $insert->client_qrcode_text
                                    ];

                                    create_attendee_qrcode($qrparam);
                                    $update = Attendee::find($insert->id);
                                    $update->client_qrcode_address = $qrfilename;
                                    $update->save();
                                }
                                
                                
                                $barcode_gen_status  =   event_enable_barcode($insert->event_id);
                                if($barcode_gen_status && $barcode_gen_status == 1){
                                    $barcode_file_path  =   public_path('barcodes/');
                                    
                                    $qrfilename         = 'attendee_barcode_' . $insert->id .  '.png';

                                    $qrparam    =   (object)[
                                        'text'          => $insert->serial_number,
                                        'filename'      => $qrfilename,
                                        'filepath'      => $barcode_file_path
                                    ];
                                    generate_barcode($qrparam);
                                    $update = Attendee::find($insert->id);
                                    $update->bar_code_path = $qrfilename;
                                    $update->save();
                                }
                                
                                
                            } else {
                                $duplicate[] = $importData[5];
                            }
                        }
                    }
                } // Foreach csv end;
                if (!empty($duplicate)) {
                    $emailsArrays   = implode(',', $duplicate);
                    $errorText      =   'Found duplicate attendee. Duplicates emails: '.$emailsArrays;
                    return redirect()->route('attendeeList')->with('error', $errorText);
                } else {
                    return redirect()->route('attendeeList')->with('success', 'CSV imported successfully.');
                }
            }
        }
    }

    public function uploadCSV(uploadCSV $request) {
        $file = $request->file('attendee_csv');

        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {

                $new_name = time() . "." . $extension;
                Storage::put('public/attendee_csv/' . $new_name, file_get_contents($file->getRealPath()), 'public');

                // Import CSV to Database
                $filepath = public_path('storage/attendee_csv' . "/" . $new_name);
                // dd($filepath);
                // Reading file
                $file = fopen($filepath, "r");

                $importData_arr = array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata);

                    // Skip first row (Remove below comment if you want to skip the first row)
                    /* if($i == 0){
                      $i++;
                      continue;
                      } */
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                    }
                    $i++;
                }
                fclose($file);
                unlink($filepath);
                // Insert to MySQL database
                $fields_name = $importData_arr[0];
                $default_field = array("serial_number", "event_id", "salutation", "first_name", "last_name", "email", "type_id", "country", "company");
                $custom_field = array_diff($fields_name, $default_field);

                $custom_fileds_id = array();

                foreach ($custom_field as $key => $value) {
                    $custom_fileds_id[$key] = getCustomFieldIdBySlug($value);
                }
                unset($importData_arr[0]);
                $duplicate = array();
                foreach ($importData_arr as $importData) {
                    $attendee_exist = Attendee::where('email', $importData[5])->count();
                    if ($attendee_exist == 0) {
                        $insert = new Attendee();
                        $insert->serial_number = $importData[0];
                        $insert->event_id = $importData[1];
                        $insert->salutation = $importData[2];
                        $insert->first_name = $importData[3];
                        $insert->last_name = $importData[4];
                        $insert->email = $importData[5];
                        $insert->type_id = $importData[6];
                        $insert->country = $importData[7];
                        $insert->company = $importData[8];
                        $insert->created_by = Auth::User()->id;
                        $insert->edited_by = Auth::User()->id;
                        $insert->save();

                        foreach ($custom_fileds_id as $key => $value) {
                            $custom = new custom_field_metas;
                            $custom->user_id = Auth::User()->id;
                            $custom->custom_fields_id = $value;
                            $custom->module = "attendee";
                            $custom->reference_record = $insert->id;
                            $custom->field_value = $importData[$key];
                            $custom->save();
                        }
                    } else {
                        $duplicate[] = $importData[5];
                    }
                }
            }
        }
        // dd($duplicate);
        if (!empty($duplicate)) {
            return redirect()->route('attendeeList')->with('error', $duplicate);
        } else {
            return redirect()->route('attendeeList')->with('success', 'CSV imported successfully.');
        }
    }
    
    public function offline_csv_import(Request $request) {
        $fileHaveError = false;
        $importSuccess = 0;
        $importError = 0;
        $fileErrorMessage = [];
        $allowed = array('csv');
        $filename = $_FILES['offline_namebadge_csv']['name'];
        if ($_FILES['offline_namebadge_csv']['error'] > 0) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please select an import file first');
        }
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please import only CSV file');
        }
        if (!$fileHaveError) {
            $event_business_owners_details_procced = true;
            $unsuccessEmailContainer = [];
            $csv_data = [];
            $company_data_check = [];
            $profiler = [];
            $file = $_FILES['offline_namebadge_csv']['tmp_name'];
            $csvdata = $this->csvToArray($file);
            if (isset($csvdata) && !empty($csvdata)) {
                $offlineData = [];
                foreach ($csvdata as $d) {
                    $offlineData[] = [
                        'event_name' => $d[0],
                        'reg_id' => $d[1],
                        'reg_email' => $d[2],
                        'created_at' => $d[3],
                    ];
                }
                DB::table('offline_namebadge_print_temp_data')->insert($offlineData);
                Session::flash('success', "Data have been successfully imported.");
                $redirect_url = 'admin/offline_csv_uploader_view/' . $request->event_url;
                return redirect($redirect_url);
            } else {
                array_push($fileErrorMessage, 'Please import only CSV file');
                $errorText = '';
                foreach ($fileErrorMessage as $error) {
                    $errorText .= $error;
                    $errorText .= "\n";
                }
                return redirect('admin/offline_csv_uploader_view/' . $request->event_url)
                                ->with('error', $errorText)
                                ->withInput();
            }
        } else {
            $errorText = '';
            foreach ($fileErrorMessage as $error) {
                $errorText .= $error;
                $errorText .= "\n";
            }
            return redirect('admin/offline_csv_uploader_view/' . $request->event_url)
                            ->with('error', $errorText)
                            ->withInput();
        }
    }
    
    public function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        $count = 1;
        if (($handle = fopen($filename, 'r')) !== false) {
            while ($row = fgetcsv($handle)) {
                if ($count == 1) {
                    $count++;
                    continue;
                }
                $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
    }

    // Sample CSV

    public function sampleCSV() {
        $filename = "attendee.csv";
        $handle = fopen($filename, 'w+');
        $default_field = array('serial_number', 'event_id', 'salutation', 'first_name', 'last_name', 'email', 'type_id', 'country', 'company');
        $custom_fields = custom_fields::where(['module' => 'attendee', 'field_visibility' => 1])->pluck('field_slug')->toArray();
        $all_fields = array_merge($default_field, $custom_fields);
        fputcsv($handle, $all_fields);

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'attendee.csv', $headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function show(Attendee $attendee) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendee $attendee_id) {
        $salutations = DB::table('salutations')->get();
        $countries = DB::table('countries')->get();
        $row = Attendee::find($attendee_id->id);
        $events = Event::get()->pluck('name', 'id');
        $userTypes = Usertype::get()->pluck('type_name', 'id');
        $customFields = getCustomFieldByModule('attendee');
        return view('attendee.edit', compact(['row', 'events', 'userTypes', 'customFields', 'countries', 'salutations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function update(attendeeStore $request, Attendee $attendee_id) {
        $update                     = Attendee::find($attendee_id->id);        
        if(isset($update->vcard_path) && !empty($update->vcard_path)){
            $vcardFullPath  =   public_path('vcards/'.$update->vcard_path);
            if (file_exists($vcardFullPath)) {
                unlink($vcardFullPath);;
            }
        }
        
        $attendee_photo_path    =   (isset($request->attendee_photo) && !empty($request->attendee_photo) ? $request->attendee_photo : '');
        if(isset($_FILES['attendee_photo']['name']) && !empty($_FILES['attendee_photo']['name'])){
            $file_name      =   'attendee_photo';
            $store_path     =   public_path('/uploads/');
            $photo_response =   upload_attendee_photo($file_name,$store_path);
            if($photo_response->status == 'error'){
                return redirect()->route('attendeeList')->with('error', $photo_response->message);
            }else{
                $attendee_photo_path    =   $photo_response->name;
            }
        }
        
        
        
        $update->serial_number      = $request->serial_number;
        $update->event_id           = $request->event_id;
        $update->salutation         = $request->salutation;
        $update->first_name         = $request->first_name;
        $update->last_name          = $request->last_name;
        $update->email              = $request->email;
        $update->type_id            = $request->type_id;
        $update->country            = $request->country;
        $update->company            = $request->company;
        
        $update->designation        = $request->designation;
        $update->mobile             = $request->mobile;
        $update->office_number      = $request->office_number;
        $update->postal_code        = $request->postal_code;
        $update->fax        = $request->fax;
        
        $update->zone               = $request->zone;
        $update->table_name         = $request->table_name;
        $update->seat               = $request->seat;
        $update->attendee_photo     = $attendee_photo_path;
        $update->zone_bg_color      = (isset($request->zone) && !empty($request->zone) ? get_seat_item_color_name_by_name($request->zone) : '');
        
        $update->edited_by = Auth::User()->id;
        
        $vcardName          =   'attendee_vcard_'.$request->event_id.'_'.$update->id.'.png';        
        $vcardParam         =   (object)[
            'lastName'          =>  $request->last_name,
            'fastName'          =>  $request->first_name,
            'salutation'        =>  $request->salutation,
            'fullName'          =>  $request->first_name. ' ' .$request->last_name,
            'organizationName'  =>  $request->company,
            'mobile'            =>  $request->mobile,
            'office_number'     =>  $request->office_number,
            'email'             =>  $request->email,
            'pathName'          =>  public_path('vcards/'.$vcardName)
        ];
        
        create_attendee_qr_vcard($vcardParam);
        $update->vcard_path = $vcardName;
        $update->save();

        //Other field Add Code
        $other = $request->custom;
        if (!empty($other)) {
            foreach ($other as $key => $value) {
                $value = $other[$key];
                $findRow = custom_field_metas::where(['module' => 'attendee', 'reference_record' => $attendee_id->id, 'custom_fields_id' => $key])->first();
                if (empty($findRow)) {
                    $custom = new custom_field_metas;
                    $custom->user_id = Auth::User()->id;
                    $custom->custom_fields_id = $key;
                    $custom->module = 'attendee';
                    $custom->reference_record = $attendee_id->id;
                    $custom->field_value = $value;

                    $custom->save();
                } else {
                    $ok = custom_field_metas::where(['module' => 'attendee', 'reference_record' => $attendee_id, 'custom_fields_id' => $key])->update(['field_value' => $value]);
                }
            }
        }

        return redirect()->route('attendeeList')->with('success', 'Attendee edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function destroy($attendee_id) {
        $attendee = Attendee::find($attendee_id);
        if ($attendee->delete()) {
            return redirect()->route('attendeeList')->with('success', 'Attendee deleted successfully.');
        }
    }
    
    
    public function delete_all_attendee(Request $request){
        $deleteContainer    =   0;        
        $deleteVcard        =   0;        
        $attendees          = DB::table('attendees')->select('id', 'vcard_path')->get();        
        if(!$attendees->isEmpty()){
            foreach ($attendees as $update) {
                if(isset($update->vcard_path) && !empty($update->vcard_path)){
                    $vcardFullPath  =   public_path('vcards/'.$update->vcard_path);
                    
                    if (file_exists($vcardFullPath)){
                        if(unlink($vcardFullPath)){
                            $deleteVcard++;                            
                        }
                    }
                }
                
                $attendee = Attendee::find($update->id);
                if ($attendee->delete()) {
                    $deleteContainer++;
                }
            }
        }
        
        $feedback       =   [
            'status'    =>   'success',
            'message'   =>   $deleteContainer.' Data have been successfully deleted',
        ];
        
        echo json_encode($feedback);
    }

}
