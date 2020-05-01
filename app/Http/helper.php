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

function image_file_store($file_data) {
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


?>