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
    public function edit(Event $event) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event) {
        //
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

}
