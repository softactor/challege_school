<?php

namespace App\Http\Controllers;
 
use DB;
use Auth;
use \Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreCustomfield;
use App\custom_fields;
use App\custom_field_dropdown_metas;
use App\custom_field_sequences;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Gate;

class CustomController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	 // Custom Field List Code
	 
    public function index()
    {
		$custom = custom_fields::where('field_visibility','!=',2)->get();
		return view('custom_field.custom',compact('custom'));
    }
	
	// Custom Field Add Form View Code
	
	public function add()
    {
        return view('custom_field.custom_add');
    }
	
	// Custom Field Add Database Code
	public function store(StoreCustomfield $request)
    {	
		$custom = new custom_fields;
		$custom->module = $request->module_name;
		$custom->field_slug = strtolower(str_replace(" ","_",$request->label));
		$custom->field_label = $request->label;
		$custom->field_type = $request->type;
		$custom->field_visibility = 1;
		
		if(!empty($request->validation))
		{
			$custom->field_validation = implode('|',$request->validation);
		}
		
		$custom->created_by = Auth::User()->id;
		$custom->save();	
		return redirect('custom_field')->with('success','Custom field created successfully');
    }
	
	// Custom Field Edit Form View Code
	public function edit($id)
	{
		$editid = $id;
		$custom = custom_fields::where('id',$id)->first();
		if($custom){
			$id=$custom->id;
			return view('custom_field.custom_edit',compact('editid','custom'));
		}
		else
		{
			return Redirect::back()->with('Error', _i('Record Not Found'));	
		}	
	}
	
	// Custom Field Update Database Code
	
	public function update(StoreCustomfield $request,$id)
    {
		// Data Update Code //
		$custom = custom_fields::find($id);
		$custom->field_slug = strtolower(str_replace(" ","_",$request->label));
		$custom->field_label = $request->label;
		if(!empty($request->validation))
		{
			$custom->field_validation = implode('|',$request->validation);
		}
		$custom->edited_by = Auth::User()->id;
		$custom->save();
		
		return redirect('custom_field')->with('success','Custom field updated successfully');
    }
	
	// Custom Field Visibility Code
	public function custom_visibility(Request $request)
	{
		$value = $request->value;
		$mod_id = $request->mod_id;
		
		$custom = custom_fields::find($mod_id);
		$custom->field_visibility = $value;
		$custom->save();
		
		if($value == 1)
		{
			$act = "Enable";
		}
		else
		{
			$act = "Disable";
		}
		
	}
	
	// Custom Field Delete Database Code
	
	public function destroy($id)
	{
		$value = 2;
		$data = custom_fields::find($id);
		$data->field_visibility = $value;
		$data->save();
	
		return redirect('custom_field')->with('success','Custom field deleted successfully');
	}
	
	// Delete Dropdown Option value code 
	public function delete_label_data(Request $request)
	{
		$id = $request->label_id;
		DB::table('custom_field_dropdown_metas')->where('id',$id)->delete();
	}
}