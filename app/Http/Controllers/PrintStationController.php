<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Response;
use App\Event;
use App\Usertype;
use App\Attendee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class PrintStationController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function print_attendee() {
        $attendees = attendee::all();
        foreach($attendees as $attendee){
            $attendee->namebadgeView    = $this->get_user_namebadge($attendee);
        }
        return view('attendee.print_list', compact(['attendees']));
    }
    
    public function get_user_namebadge($attendee) {
        $namebadge                  =   '<span class="badge badge-warning">No template Found</span>';
        $nameBadgeTemplateParam     =   [
            'event_id'  => $attendee->event_id,
            'type_id'   => $attendee->type_id
        ];
        $templateInfo       =   getNameBadgeTemplatedata($nameBadgeTemplateParam);
        if(isset($templateInfo) && !empty($templateInfo)){
            $nameBadgeConfData  =   json_decode($templateInfo->namebadge_print_data);
            $attendeeData       =   [
                'serial_number'         =>  $attendee->serial_number,
                'event_id'              =>  $attendee->event_id,
                'salutation'            =>  $attendee->salutation,
                'first_name'            =>  $attendee->first_name,
                'last_name'             =>  $attendee->last_name,
                'email'                 =>  $attendee->email,
                'namebadge_user_label'  =>  getTypeName($attendee->type_id),
                'country_id'            =>  $attendee->country,
                'company_name'          =>  $attendee->company,
                'type_id'               =>  $attendee->type_id
            ];  
            $viewParamData['user_id']             = $attendee->id;
            $viewParamData['event_id']            = $attendee->event_id;
            $viewParamData['qrCodeFinalData']     = $attendeeData;
            $viewParamData['templatesDatas']      = $templateInfo;
            $viewParamData['nameBadgeConfData']   = $nameBadgeConfData;
            $viewParam                            = (object)$viewParamData;
            $namebadgeViewData                    =   View::make('attendee.attendee_namebadge', compact('viewParam'));
            $namebadge                            =   $namebadgeViewData->render();
        }
        return $namebadge;
    }
    
    public function update_attendee_printing_history(Request $request) {
        date_default_timezone_set('Asia/Singapore');
        $attendeeData   =   attendee::find($request->attendee_id);
        $printingDate   =   date('Y-m-d H:i:s');
        if($attendeeData->print_status == 0){
            $upPrintingStatus   =   [
                'print_status'      =>  1,
                'print_date'        =>  $printingDate,
            ];
            DB::table('attendees')
              ->where('id', $attendeeData->id)
              ->update($upPrintingStatus);
        }        
        $insertData     =   [
            'event_id'          =>  $attendeeData->event_id,
            'attendee_id'       =>  $attendeeData->id,
            'attendee_email'    =>  $attendeeData->email,
            'type_id'           =>  $attendeeData->type_id,
            'created_at'        =>  $printingDate,
        ];        
        DB::table('print_history')->insert($insertData);     
        
        $wherePrintHis          =   [
            'event_id'          =>  $attendeeData->event_id,
            'attendee_id'       =>  $attendeeData->id,
        ];    
        
        $attendeeData              =   attendee::find($request->attendee_id);
        $attendeeNopHisResp        =   DB::table('print_history')->where($wherePrintHis)->get();
        
        $feedback   =   [
            'status'        =>  'success',
            'printingDate'  =>  human_format_date($attendeeData->print_date),
            'printingStatus'=>  'Printed',
            'nop'           =>  count($attendeeNopHisResp),
            'printingStatus'=>  'Printed'
        ];
        echo json_encode($feedback);
    }
}