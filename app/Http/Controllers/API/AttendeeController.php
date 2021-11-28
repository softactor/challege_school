<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AttendeeController extends Controller
{
    //

    public function get_attendee_data_by_regid(Request $request){
        $reg_id     =   trim($request->attendee_id);

        $table_data =   DB::table('attendees')->where('serial_number',$reg_id)->first();
        if(isset($table_data) && !empty($table_data)){

            $attendee_data  =   [
                'event_id'          =>$table_data->event_id,
                'serial_digit'      =>$table_data->serial_number,
                'salutation'        =>$table_data->salutation,
                'first_name'        =>$table_data->first_name,
                'last_name'         =>$table_data->last_name,
                'email'             =>$table_data->email,
                'country_name'      =>$table_data->country,
                'company'           =>$table_data->company,
                'namebadge_user_label'=>getTypeName($table_data->type_id),
                'attendee_photo'    =>(isset($table_data->attendee_photo) && !empty($table_data->attendee_photo) ? asset('public/uploads/' . $table_data->attendee_photo) : '')
            ];


            $status     =   'success';
            $message    =   'Data Found';
            $data       =   $attendee_data;
        }else{
            $status     =   'error';
            $message    =   'Data Not Found';
            $data       =   '';
        }

        return  $response =   [
            'status'    =>  $status,
            'message'   =>  $message,
            'data'      =>  $data,
        ];
    }
}
