<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Template;
use App\Usertype;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class ExcelController extends Controller{
    
    public function export_template_configuration(Request $request){
        $id                     =   $request->id;
        $namebadgeConfigData    =   Template::select('*')->where("id", $id)->first();
        $userLabelData          =   Usertype::select('*')->where("id", $namebadgeConfigData->type_id)->first();
        
        $configdatas     =   [
            'template_name'         =>  $namebadgeConfigData->template_name,
            'event_id'              =>  $namebadgeConfigData->event_id,
            'type_id'               =>  $namebadgeConfigData->type_id,
            'page_height'           =>  $namebadgeConfigData->page_height,
            'page_width'            =>  $namebadgeConfigData->page_width,
            'header_image'          =>  $namebadgeConfigData->header_image,
            'namebadge_print_data'  =>  $namebadgeConfigData->namebadge_print_data,
            'type_name'             =>  $userLabelData->type_name,
            'background_color'      =>  $userLabelData->background_color,  
            'text_clor'             =>  $userLabelData->text_clor,
        ];
        $configdata    =   (object)$configdatas;
        if (isset($configdata) && !empty($configdata)) {
            Excel::create('template_config_export', function($excel) use ($configdata){
                $excel->sheet('template_config_export', function($sheet) use ($configdata){
                    $sheet->loadView('export.template_config_export')->with('configdata',$configdata);
                    $sheet->setOrientation('landscape');
                });
            })->export('csv');
        }
    }
    
    public function export_namebadge_print_details(){
        $reportDatas        = Session::get('reportDatas');
        if (isset($reportDatas) && !empty($reportDatas)) {
            Excel::create('attendee_print_details_export', function($excel) use ($reportDatas){
                $excel->sheet('attendee_print_details_export', function($sheet) use ($reportDatas){
                    $sheet->loadView('export.attendee_print_details_export')->with('reportDatas',$reportDatas);
                    $sheet->setOrientation('landscape');
                });
            })->export('csv');
        }
    }
}
