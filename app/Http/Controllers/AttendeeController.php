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

class AttendeeController extends Controller {

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
        $events = Event::get()->pluck('name', 'id');
        $userTypes = Usertype::get()->pluck('type_name', 'id');
        $CustomFields = getCustomFieldByModule('attendee');
        return view('attendee.create', compact(['event_id', 'events', 'serial_number', 'userTypes', 'CustomFields', 'countries', 'salutations']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(attendeeStore $request) {
        $insert = new attendee();
        $insert->serial_number = $request->serial_number;
        $insert->event_id = $request->event_id;
        $insert->salutation = $request->salutation;
        $insert->first_name = $request->first_name;
        $insert->last_name = $request->last_name;
        $insert->email = $request->email;
        $insert->type_id = $request->type_id;
        $insert->country = $request->country;
        $insert->company = $request->company;
        $insert->created_by = Auth::User()->id;
        $insert->edited_by = Auth::User()->id;
        $insert->save();
        // Other field Add Code
        $other = $request->custom;
        if (!empty($other)) {
            foreach ($other as $key => $value) {
                $value = $other[$key];
                $custom = new custom_field_metas;
                $custom->user_id = Auth::User()->id;
                $custom->custom_fields_id = $key;
                $custom->module = "attendee";
                $custom->reference_record = $insert->id;
                $custom->field_value = $value;
                $custom->save();
            }
        }

        return redirect()->route('attendeeList')->with('success', 'Attendee Added successfully.');
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
            $file = $_FILES['attendee_csv']['tmp_name'];
            $csvdata = $this->csvToArray($file);
            if (isset($csvdata) && !empty($csvdata)) {
                $offlineData = [];
                foreach ($csvdata as $importData) {
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
                    } else {
                        $duplicate[] = $importData[5];
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
        $update = Attendee::find($attendee_id->id);
        $update->serial_number = $request->serial_number;
        $update->event_id = $request->event_id;
        $update->salutation = $request->salutation;
        $update->first_name = $request->first_name;
        $update->last_name = $request->last_name;
        $update->email = $request->email;
        $update->type_id = $request->type_id;
        $update->country = $request->country;
        $update->company = $request->company;
        $update->edited_by = Auth::User()->id;
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

}
