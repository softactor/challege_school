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
                                $totalUserType          =   0;
                                $totalUserTypePrinted   =   0;
                                $sl             =   1;
                                $table          =   'usertypes';
                                $order_by['order_by_column']    =   'type_name';
                                $order_by['order_by']           =   'ASC';
                                $detals     = get_table_data_by_table($table, $order_by);
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
                                            $lastPrintedTime    =   calculate_time_span($lastPrintedDate->created_at);
                                            echo $lastPrintedTime;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    $(document).ready(function () {
        $('#eventTable').DataTable();
    });
</script>
@endsection

