<?php

namespace App\Http\Controllers;

use auth;
use App\Event;
use App\Attendee;
use Illuminate\Http\Request;
use App\Http\Requests\EventStore;

class EventController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $events = Event::all();
        return view("event.index", compact(['events']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("event.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStore $request) {
        $insert = new Event();
        $insert->name = $request->name;
        $insert->event_date = date('Y-m-d H:i', strtotime($request->event_date));
        $insert->created_by = Auth::user()->id;
        if ($insert->save()) {
            return redirect()->route('eventList')->with('success', 'Event Added successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event_id) {
        $row = Event::find($event_id->id);
        return view('event.edit', compact(['row']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event_id) {
        $update = Event::find($event_id->id);
        $update->name = $request->name;
        $update->event_date = date('Y-m-d H:i', strtotime($request->event_date));
        if ($update->save()) {
            return redirect()->route('eventList')->with('success', 'Event has been successfully updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $attendee = Attendee::where("event_id", $request->event_id)->count();
        if ($attendee) {
            $status  = "error";
            $message = "You cant delete Event, Dependency found with Attendee.";
        }else {
            $type = Event::find($request->event_id);
            if ($type->delete()) {
                $status  = "success";
                $message = "Event has been successfully deleted";
            }
        }        
        $feedback  = [
            'status'  => $status,
            'message' => $message
        ];
        
        echo json_encode($feedback);
    }
    
    /**
      Import CSV
     */
    public function importCSV() {
        return view('event.importCSV');
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
        $filename = $_FILES['event_csv']['name'];
        if ($_FILES['event_csv']['error'] > 0) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please select an import file first');
        }
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $fileHaveError = true;
            array_push($fileErrorMessage, 'Please import only CSV file');
        }
        if (!$fileHaveError) {
            $file = $_FILES['event_csv']['tmp_name'];
            $csvdata = $this->csvToArray($file);
            if (isset($csvdata) && !empty($csvdata)) {
                $offlineData = [];
                foreach ($csvdata as $importData) {
                    $attendee_exist = Event::where('id', $importData[0])->count();
                    if ($attendee_exist == 0) {
                        $insert = new Event();
                        $insert->id = $importData[0];
                        $insert->name = $importData[1];
                        $insert->event_date = $importData[2];
                        $insert->event_id = $importData[3];
                        $insert->event_short_code = $importData[4];
                        $insert->created_by = Auth::User()->id;
                        $insert->edited_by = Auth::User()->id;
                        $insert->save();
                    } else {
                        $duplicate[] = $importData[1];
                    }
                } // Foreach csv end;
                if (!empty($duplicate)) {
                    return redirect()->route('eventList')->with('error', $duplicate);
                } else {
                    return redirect()->route('eventList')->with('success', 'CSV imported successfully.');
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
