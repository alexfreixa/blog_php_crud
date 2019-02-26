<table class="table-hover">

    <tr>
        <th>       
                <a>Section</a>
        </th>
        <th> 
                <a>Age</a>
        </th>
        <th>
                <a>Creation date</a>
        </th>
        <th>
                <a>Actions</a>
        </th>
    </tr>
    
    <tbody>
    
    <?php foreach($sections as $section) { ?>

    <tr>
    
        <td><?php echo $section->section_name; ?></td>
        <td><?php echo $section->edat; ?></td>
        <td><?php echo $section->creation_date; ?></td>

        <td>
            <a href='?controller=sections&action=update&section_id=<?php echo $section->section_id; ?>'><div class="btn btn-info">Edit</div></a>
            <a href='?controller=sections&action=delete&section_id=<?php echo $section->section_id; ?>'><div class="btn btn-danger">Delete</div></a>
        </td>

    </tr>

    <?php } ?>

    <tr>
        <td colspan="4">
            <div class="d-flex justify-content-center">
                <a href="?controller=sections&action=create">
                <div class="btn btn-primary">New section</div></a>
            </div>  
        </td>
    </tr>

    <tbody>
</table>
<br>