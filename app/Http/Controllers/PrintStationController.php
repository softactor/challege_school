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
use Illuminate\Support\Facades\Session;
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
    



    public function get_attendee_print_table_data(Request $request) {
        //$all    =   $request->all();

        /*

        <th>Type</th>
                                    <th title="Printing Status">P.Status</th>
                                    <th title="Number Of Printing">NOP</th>
                                    <th title="Printing Date">P.Date</th>
                                    <th>Namebadge</th>
                                    <th>Action</th>

        */

        $master_table   =   'attendees';
        $columns = array(
            0 => 'serial_number',
            1 => 'name',
            2 => 'email',
            3 => 'country',
            4 => 'type',
            5 => 'printing_status',
            6 => 'num_of_printing',
            7 => 'printing_date',
            8 => 'namebadge',
            9 => 'action',
        );

        $totalData = DB::table($master_table)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if (empty($request->input('search.value'))) {
            if(isset($limit) && $limit!=-1){
                $postsQuery = DB::table($master_table)->offset($start);
                $postsQuery->limit($limit);
            }else{
                $postsQuery = DB::table($master_table);
            }
            $postsQuery->orderBy('created_at', 'asc');
            $posts      =   $postsQuery->get();
            $totalFiltered = DB::table($master_table)->count();
        } else {
            $search = $request->input('search.value');
            $postsquery = DB::table($master_table)
                    ->where('serial_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%");
                    $postsquery->offset($start)
                        ->limit($limit)
                        ->orderBy($order, $dir);
            $posts  =   $postsquery->get();
            $totalFiltered = DB::table($master_table)
                        ->where('serial_number', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%")
                        ->count();
        }


        $data = array();

        if ($posts) {
            foreach ($posts as $r) {

                $nestedData['serial_number']        = $r->serial_number;
                $nestedData['name']                 = $r->salutation . " " . $r->first_name . " " . $r->last_name;
                $nestedData['email']                = $r->email;
                $nestedData['country']              = $r->country;
                $nestedData['type']                 = getTypeName($r->type_id);

                $printing_status                    = "<span id='printing_status_".$r->id."'>".getAttendeePrintedStatus($r->id)."</span>";
                $num_of_printing                    = "<span id='printing_not_".$r->id."'>".getAttendeenop($r->id)."</span>";
                $printing_date                      = "<span id='printing_date_".$r->id."'>".getAttendeePrintedDate($r->id)."</span>";
                $namebadge                          = "<div id='print_preview_".$r->id."'>".$this->get_user_namebadge($r)."</div>";
                
                
                $nestedData['printing_status']        = $printing_status;
                $nestedData['num_of_printing']        = $num_of_printing;
                $nestedData['printing_date']          = $printing_date;
                $nestedData['namebadge']              = $namebadge;
                
                $abc = '<a class="btn btn-sm btn-success" onclick="confirm_namebadge_print(\''.$r->id.'\');" href="javascript:void(0)"><i class="fas fa-print"></i></a>';
                
                
                $nestedData['action'] = $abc;

                $data[] = $nestedData;
            } //End of foreach
        }

        $json_data = array(
            "draw"              => intval($request->input('draw')),
            "recordsTotal"      => intval($totalData),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );
        echo json_encode($json_data);
    }



    
    public function get_user_namebadge($attendee) {
        $namebadge  =   make_attendee_namebadge($attendee);
        return $namebadge;
    }
    
    public function print_namebadge_by_serial_number(Request $request){
        $serial_number      =   trim($request->serial_number);
        $attendee           =   DB::table('attendees')->where('serial_number', $serial_number)->first();
        $attendee_id        =   '';

        if(isset($attendee) && !empty($attendee)){
            $status             =   'success';
            $data               =   $this->get_user_namebadge($attendee);
            $attendee_id        =   $attendee->id;
        }else{
            $status             =   'error';
            $data               =   '';
        }
        
        $feedBack               =   [
            'status'            =>  $status,
            'attendee_id'       =>  $attendee_id,
            'data'              =>  $data
        ];
        
        echo json_encode($feedBack);
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
            'created_by'        =>  Auth::user()->id,
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
    
    public function print_report(){
        $table                          =   'attendees';
        $order_by['order_by_column']    =   'first_name';
        $order_by['order_by']           =   'ASC';
        $nameBadgedetals                = get_table_data_by_table($table, $order_by);
        Session::put('reportDatas', $nameBadgedetals);
        return view('report.attendee_print_report', compact('nameBadgedetals'));
    }
}
