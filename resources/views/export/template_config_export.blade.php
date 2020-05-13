<table style="width: 100%; border:1px solid black;">
    <thead>
        <tr>
            <th style="text-align: center;">Template Name</th>
            <th style="text-align: center;">Event ID</th>
            <th style="text-align: center;">Type id</th>
            <th style="text-align: center;">Page Height</th>
            <th style="text-align: center;">Page width</th>
            <th style="text-align: center;">Header image</th>
            <th style="text-align: center;">Namebadge Print</th>
            <th style="text-align: center;">Type Name</th>
            <th style="text-align: center;">Background color</th>
            <th style="text-align: center;">Text color</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td><?php echo $configdata->template_name; ?></td>
                <td><?php echo $configdata->event_id; ?></td>
                <td><?php echo $configdata->type_id; ?></td>
                <td><?php echo $configdata->page_height; ?></td>
                <td><?php echo $configdata->page_width; ?></td>
                <td><?php echo $configdata->header_image; ?></td>
                <td><?php echo $configdata->namebadge_print_data; ?></td>
                <td><?php echo $configdata->type_name; ?></td>
                <td><?php echo $configdata->background_color; ?></td>
                <td><?php echo $configdata->text_clor; ?></td>
            </tr>
    </tbody>
</table>