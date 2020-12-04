<table style="width: 100%; border:1px solid black;">
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
        foreach($reportDatas as $row){
        ?>
        <tr>
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