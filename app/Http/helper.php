<?php

use App\Event;
use App\Template;
use App\Usertype;
use App\custom_fields;
use App\custom_field_metas;

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
?>