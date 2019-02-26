
<table class="show">
    <tr>
        <th>Post</th>
        <td>#<?php echo $post->id; ?></td>
    </tr>
    <tr>
        <th>Title</th>
        <td><?php echo $post->title; ?></td>
    </tr>
    <tr>
        <th>Author</th>
        <td><?php echo $post->author; ?></td>
    </tr>

    <tr>
        <th>Content</th>
        <td><?php echo $post->content; ?></td>
    </tr>

    <tr>
        <th>Section</th>
        <?php foreach($sections as $section) {
                if ($section->section_id == $post->section_id) { ?>
                <td><?php echo $section->section_name; ?></td>
            <?php } 
            } ?>
    </tr>

    


    <tr>
        <th>Creation</th>
        <td><?php echo $post->create_date; ?></td>
    </tr>
    <tr>
        <th>Modification</th>
        <td><?php echo $post->update_date; ?></td>
    </tr>
    <tr>
        <th>Image</th>
            <!--ternario que si la imagen no es null, la muestra, y si si es null muestra el texto de no image found-->
        <td><?php echo $post->image !=null ?  "<img src='uploads/{$post->image}' class='showimg'/>" :  "No image found" ; ?></td>
    </tr>
    </table>