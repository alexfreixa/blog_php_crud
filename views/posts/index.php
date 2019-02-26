<table class="table-hover">

    <tr>
        <th>
            <a href="?controller=posts&action=index&order=title&sort=asc"><img class="icon" src="icons/sort-asc.png"/></a>        
                <a>Title</a>
            <a href="?controller=posts&action=index&order=title&sort=desc"><img class="icon" src="icons/sort-desc.png"/></a>
                
        </th>
        <th>
            <a href="?controller=posts&action=index&order=author&sort=asc"><img class="icon" src="icons/sort-asc.png"/></a>    
                <a>Author</a>
            <a href="?controller=posts&action=index&order=author&sort=desc"><img class="icon" src="icons/sort-desc.png"/></a>
                
        </th>

        <th>
            <a href="?controller=posts&action=index&order=create_date&sort=asc"><img class="icon" src="icons/sort-asc.png"/></a>
                <a>Creation date</a>
            <a href="?controller=posts&action=index&order=create_date&sort=desc"><img class="icon" src="icons/sort-desc.png"/></a>
        </th>

        <th>
            <a href="?controller=posts&action=index&order=section&sort=asc"><img class="icon" src="icons/sort-asc.png"/></a>
                <a>Section</a>
            <a href="?controller=posts&action=index&order=section&sort=desc"><img class="icon" src="icons/sort-desc.png"/></a>
        </th>

        <th>Options</th>
    </tr>
    
    <tbody>

    <?php foreach($posts as $post) { ?>

    <tr>
    
        <td><?php echo $post->title; ?></td>
        <td><?php echo $post->author; ?></td>
        <td><?php echo $post->create_date; ?></td>

        <td>
        <?php foreach($sections as $section) {
                    if ($section->section_id == $post->section_id) { ?>
                    <?php echo $section->section_name; ?>
                <?php } 
                } ?>
        </td>

        <td><a href='?controller=posts&action=show&id=<?php echo $post->id; ?>'><div class="btn btn-primary">Read Post</div></a>
            <a href='?controller=posts&action=update&id=<?php echo $post->id; ?>'><div class="btn btn-info">Edit</div></a>
            <a href='?controller=posts&action=delete&id=<?php echo $post->id; ?>'><div class="btn btn-danger">Delete</div></a>
        </td>

    </tr>

    <?php } ?>

    <tr>
        <td colspan="5">
            <div class="d-flex justify-content-center">
                <a href="?controller=posts&action=create">
                <div class="btn btn-primary">New Post</div></a>
            </div>  
        </td>
    </tr>

    <tbody>
</table>
<br>