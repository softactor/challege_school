<?php

namespace App\Http\Controllers;

use Auth;
use App\Usertype;
use App\Template;
use App\Attendee;
use Illuminate\Http\Request;
use App\Http\Requests\UserTypeStore;

class UsertypeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $types = Usertype::all();
        return view('usertype.index', compact(['types']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('usertype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserTypeStore $request) {
        $insert = new Usertype();
        $insert->type_name = $request->typename;
        $insert->text_clor = $request->text_clor;
        $insert->background_color = $request->background_color;
        $insert->created_by = Auth::user()->id;
        if ($insert->save()) {
            return redirect()->route('userTypes')->with('success', 'User Type Added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function show(Usertype $usertype) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function edit(Usertype $type_id) {
        $row = userType::find($type_id->id);
        return view('usertype.edit', compact(['row']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function update(UserTypeStore $request, Usertype $type_id) {
        $update = userType::find($type_id->id);
        $update->type_name = $request->typename;
        $update->text_clor = $request->text_clor;
        $update->background_color = $request->background_color;
        if ($update->save()) {
            return redirect()->route('userTypes')->with('success', 'Type updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usertype  $usertype
     * @return \Illuminate\Http\Response
     */
    public function destroy($usertype_id) {
        $template = Template::where("type_id", $usertype_id)->count();
        $attendee = Attendee::where("type_id", $usertype_id)->count();
        if ($template && $attendee) {
            return redirect()->route('userTypes')->with('warning', 'You cant delete this type, Dependency found with template and attendee.');
        } else if ($template) {
            return redirect()->route('userTypes')->with('warning', 'You cant delete this type, Dependency found with template.');
        } else if ($attendee) {
            return redirect()->route('userTypes')->with('warning', 'You cant delete this type, Dependency found with attendee.');
        } else {
            $type = Usertype::find($usertype_id);
            if ($type->delete()) {
                return redirect()->route('userTypes')->with('success', 'Type deleted successfully.');
            }
        }
    }

    /**
      Import CSV
     */
    public function importCSV() {
        return view('usertype.importCSV');
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
        $filename = $_FILES['user_type_csv']['name'];
        if ($_FILES['user_type_csv']['error'] > 0) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please select an import file first');
        }
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please import only CSV file');
        }
        if (!$fileHaveError) {
            $file = $_FILES['user_type_csv']['tmp_name'];
            $csvdata = $this->csvToArray($file);
            if (isset($csvdata) && !empty($csvdata)) {
                $offlineData = [];
                foreach ($csvdata as $importData) {
                    $attendee_exist = Usertype::where('id', $importData[0])->count();
                    if ($attendee_exist == 0) {
                        $insert = new Usertype();
                        $insert->id = $importData[0];
                        $insert->type_name = $importData[1];
                        $insert->background_color = $importData[2];
                        $insert->text_clor = $importData[3];
                        $insert->created_by = Auth::User()->id;
                        $insert->edited_by = Auth::User()->id;
                        $insert->save();
                    } else {
                        $duplicate[] = $importData[1];
                    }
                } // Foreach csv end;
                if (!empty($duplicate)) {
                    return redirect()->route('userTypes')->with('error', $duplicate);
                } else {
                    return redirect()->route('userTypes')->with('success', 'CSV imported successfully.');
                }
            }
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
}
