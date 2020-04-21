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

}
