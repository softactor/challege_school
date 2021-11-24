<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;

class NamebadgeSettingsController extends Controller
{
   
    public function namebadge_event_settings_view(){
        $events = Event::select('id', 'name')->get();
        
        return view('settings.settings_namebadge_event_view', compact('events'));
    }
    
    public function get_event_settings_data(Request $request){
        $status     =   'error';
        $message    =   'Settings Data Not Found';
        $data       =   '';
        $event_id   =   $request->event_id;
        
        $settings   =   DB::table('app_settings')->where('event_id', $event_id)->first();
        
        if(isset($settings) && !empty($settings)){
            $status     =   'success';
            $message    =   'Settings Data Found';
            $data       =   $settings;                    
        }
        
        $response       =   [
            'status'    =>  $status,
            'message'   =>  $message,
            'data'      =>  $data,
        ];
        
        
        echo json_encode($response);
        
    }
    
    function saveEventSettings(Request $request){
        $all    =   $request->all();
        
        
        $event_id                   =   $request->event_id;
        $enable_vcard               =   (isset($request->enable_vcard) && !empty($request->enable_vcard) ? $request->enable_vcard : 0);
        $enable_qrcode              =   (isset($request->enable_qrcode) && !empty($request->enable_qrcode) ? $request->enable_qrcode : 0);
        $qrcode_type                =   (isset($request->qrcode_type) && !empty($request->qrcode_type) ? $request->qrcode_type : 0);
        $enable_barcode             =   (isset($request->enable_barcode) && !empty($request->enable_barcode) ? $request->enable_barcode : 0);
        $enable_sync_dashboard      =   (isset($request->enable_sync_dashboard) && !empty($request->enable_sync_dashboard) ? $request->enable_sync_dashboard : 0);
        
        
        
        $table_data     =   [
            'event_id'              => $event_id,
            'enable_vcard'          => $enable_vcard,
            'enable_qrcode'         => $enable_qrcode,
            'qrcode_type'           => $qrcode_type,
            'enable_barcode'        => $enable_barcode,
            'enable_sync_dashboard' => $enable_sync_dashboard,
            'sync_dashboard_api'    => 'http://dashboard.registella.asia/api/v1/store_namebadge_manual_entry_attendee',
            'registro_dashboard_url'=> 'http://dashboard.registella.asia/',
        ];
        
        
        
        $check_table    =   DB::table('app_settings')->where('event_id', $event_id)->first();
        if(isset($check_table) && !empty($check_table)){
            DB::table('app_settings')->where('event_id', $event_id)->update($table_data);
            $message    =   "Event settings have been successfully updated";
        }else{
            DB::table('app_settings')->insert($table_data);
            $message    =   "Event settings have been successfully inserted";
        }
        
        
        return redirect()->route('namebadge_event_settings_view')->with('success', $message);
    }
}
