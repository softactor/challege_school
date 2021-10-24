@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="float-left">Attendee Print Report</h5>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?php
                        $totalUserType          =   0;
                        $totalUserTypePrinted   =   0;
                        $sl             =   1;
                        $table          =   'usertypes';
                        $order_by['order_by_column']    =   'type_name';
                        $order_by['order_by']           =   'ASC';
                        $detals     = get_table_data_by_table($table, $order_by);    
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered list-table-custom-style table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Type</th>
                                    <th>Total</th>
                                    <th>Printed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                                
                                foreach($detals as $row){
                                ?>
                                <tr>
                                    <td><?php echo $sl++.'.'; ?></td>
                                    <td><?php echo $row->type_name ?></td>
                                    <td>
                                        <?php
                                            $dataParam['field']     =   'id';
                                            $dataParam['table']     =   'attendees';
                                            $dataParam['where']     =   [
                                                'type_id'           =>  $row->id
                                            ];
                                            $tut    =    getTableTotalRows($dataParam)->total;
                                            $totalUserType =    $totalUserType+$tut;
                                            echo $tut;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $dataParam['field']     =   'id';
                                            $dataParam['table']     =   'print_history';
                                            $dataParam['where']     =   [
                                                'type_id'           =>  $row->id
                                            ];
                                            $tutp    =    getTableTotalRows($dataParam)->total;
                                            $totalUserTypePrinted =    $totalUserTypePrinted+$tutp;
                                            echo $tutp;
                                        ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" style="text-align: right">Total</td>
                                    <td style="text-align: right"><?php echo $totalUserType; ?></td>
                                    <td style="text-align: right"><?php echo $totalUserTypePrinted; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right">Last Printed</td>
                                    <td colspan="2" style="text-align: right">
                                        <?php
                                            $lastPrintedDate    =   get_namebadge_last_printed_time();
                                            if(isset($lastPrintedDate) && !empty($lastPrintedDate)){
                                                $lastPrintedTime    =   calculate_time_span($lastPrintedDate->created_at);
                                                echo $lastPrintedTime.' at '.$lastPrintedDate->created_at;
                                            }
                                            
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-align: center;">
                        Namebadge Print Details Report
                        <a title="Export Template Configuration" href="<?php echo route('export_namebadge_print_details') ?>" class="btn btn-sm btn-success">
                            <i class="fas fa-file-export"></i> Export
                        </a>
                    </h2>
                    <?php
                    
                        if(!$nameBadgedetals->isEmpty()){
                    
                    ?>
                    <div class="table-responsive">
                        <table id="NamebadgePrintDetailsReport" class="table table-bordered list-table-custom-style table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Salutation</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Country</th>
                                    <th>Company</th>
                                    <th>Designation</th>
                                    <th>Mobile</th>
                                    <th>Office Number</th>
                                    <th>Postal Code</th>
                                    <th>Zone</th>
                                    <th>Table</th>
                                    <th>Print Status</th>
                                    <th>Print Date</th>
                                    <th>Add Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sl             =   1;
                                foreach($nameBadgedetals as $row){
                                ?>
                                <tr style="background-color: <?php echo (($row->add_type == 1 ) ? '' : 'yellow') ?>">
                                    <td><?php echo $sl++.'.'; ?></td>
                                    <td><?php echo $row->salutation ?></td>
                                    <td><?php echo $row->first_name ?></td>
                                    <td><?php echo $row->last_name ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo getTypeName($row->type_id) ?></td>
                                    <td><?php echo $row->country ?></td>
                                    <td><?php echo $row->company ?></td>
                                    <td><?php echo $row->designation ?></td>
                                    <td><?php echo $row->mobile ?></td>
                                    <td><?php echo $row->office_number ?></td>
                                    <td><?php echo $row->postal_code ?></td>
                                    <td><?php echo $row->zone ?></td>
                                    <td><?php echo $row->table_name ?></td>
                                    <td><?php echo (($row->print_status) ? 'Printed': '') ?></td>
                                    <td><?php echo $row->print_date ?></td>
                                    <td><?php echo (($row->add_type == 1 ) ? 'CSV' : 'Manual') ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php
                        }else{
                    ?>
                    <div class="alert alert-info">
                        <strong>No data found</strong>
                    </div>
                    <?php } ?>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script>
    $(document).ready(function () {
        $('#NamebadgePrintDetailsReport').DataTable();
    });
</script>
@endsection