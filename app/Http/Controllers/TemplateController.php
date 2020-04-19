<?php

namespace App\Http\Controllers;

use auth;
use App\Event;
use App\Template;
use App\Usertype;
use Illuminate\Http\Request;
use App\Http\Requests\templateStore;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$templates = Template::all();
        return view('template.index', compact(['templates']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$events = Event::get()->pluck('name','id');
		$userTypes = Usertype::get()->pluck('type_name','id');
		
		return view('template.create', compact(['events','userTypes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(templateStore $request)
    {
        $insert = new Template();
		$insert->template_name = $request->template_name;
		$insert->event_id = $request->event_id;
		$insert->type_id = $request->type_id;
		$insert->page_height = $request->page_height;
		$insert->page_width = $request->page_width;
		$insert->created_by = Auth::User()->id;
		$img = $request->file('header_image');
		if(!empty($img))
		{
			$extension = $img->getClientOriginalExtension();
			$data = base64_decode($img);
			$name = time() . '.'. $extension;
			Storage::put('public/header_image/' . $name, file_get_contents($img -> getRealPath()), 'public');
			$insert->header_image = $name;
		}else{
			$insert->header_image = '';
		}
		if($insert->save()){
			return redirect()->route('templateList')->with('success', 'Template Added successfully.');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
	
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit($template_id)
    {
        $row = Template::find($template_id);
		$events = Event::get()->pluck('name','id');
		$userTypes = Usertype::get()->pluck('type_name','id');
		return view('template.edit', compact(['row','events','userTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(templateStore $request,$template_id)
    {
        $update = Template::find($template_id);
		$update->template_name = $request->template_name;
		$update->event_id = $request->event_id;
		$update->type_id = $request->type_id;
		$update->page_height = $request->page_height;
		$update->page_width = $request->page_width;
		$update->edited_by = Auth::User()->id;
		$img = $request->file('header_image');
		
		if(!empty($img))
		{
			$extension = $img->getClientOriginalExtension();
			$data = base64_decode($img);
			$name = time() . '.'. $extension;
			Storage::put('public/header_image/' . $name, file_get_contents($img -> getRealPath()), 'public');
			$update->header_image = $name;
		}
		
		if($update->save()){
			return redirect()->route('templateList')->with('success', 'Template edited successfully.');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy($template_id)
    {
		$template = Template::find($template_id);
		if($template->delete()){
			return redirect()->route('templateList')->with('success', 'Template deleted successfully.');
		}
    }
	
	public function designTemplate($template_id)
    {
		$row = Template::find($template_id);
        return view('template.designTemplate', compact(['template_id','row']));
    }
	
	public function saveDesignTemplate(request $request)
	{
		$template_id = $request->template_id;
		$insert = Template::find($template_id);
		$insert->template_data = $request->json;
		if($insert->save())
		{
			return response()->json(['success'=>'Template save successfully.']);
		}
	}
	
	public function exportTemplate($template_id)
	{
		// $data = json_encode(['Text 1','Text 2','Text 3','Text 4','Text 5']);
		$row = Template::find($template_id);
		$data = $row->template_data;
		$file = $row->template_name . '.json';
		$destinationPath="/upload/json/";
	  
		// Storage::put($destinationPath . $file, $data, 'public');
		Storage::put('public/header_image/' . $file, $data, 'public');
		// if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
		// Storage::put($destinationPath.$file,$data);
		return response()->download('public/storage/header_image/' .$file);
	}
}
