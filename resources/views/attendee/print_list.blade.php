@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">Attendee Print List</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="attendeePrintTable" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Type</th>
                                <th title="Printing Status">P.Status</th>
                                <th title="Number Of Printing">NOP</th>
                                <th title="Printing Date">P.Date</th>
                                <th>Namebadge</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script>
    $(document).ready(function() {

        $('#attendeePrintTable').DataTable({
            language: {
				paginate: {
					next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
					previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
				}
			},
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo url('get_attendee_print_table_data'); ?>",
                type: 'GET',
                dataType: 'json'
            },
            'fnCreatedRow': function(nRow, aData, iDataIndex) {
                $(nRow).attr('id', 'my' + aData.serial_number); // or whatever you choose to set as the id
            },
            "columns": [{
                    "data": "serial_number"
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "country"
                },
                {
                    "data": "type"
                },
                {
                    "data": "printing_status"
                },
                {
                    "data": "num_of_printing"
                },
                {
                    "data": "printing_date"
                },
                {
                    "data": "namebadge"
                },
                {
                    "data": "action"
                },
            ],
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
            }],
            "lengthMenu": [
                [10, 250, 500, -1],
                [10, 250, 500, "All"]
            ]
        });






    });
</script>
@endsection