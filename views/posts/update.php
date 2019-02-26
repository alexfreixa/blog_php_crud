<h5 class=""><strong>Editando post</strong></h5><br>

<form action='?controller=posts&action=update&section_id=<?php echo $post->id; ?>' method="post" enctype="multipart/form-data">
    
    <table>
        <tr>
            <th>Author</th>
            <td colspan="2"><input type="text" name="author" class="form-control" value="<?php echo $post->author; ?>"/></td>
        </tr>
        <tr>
            <th>Title</th>
            <td colspan="2"><input type="text" name ="title" class="form-control" value="<?php echo $post->title; ?>"/></td>
        </tr>
        <tr>
            <th>Content</th>
            <td colspan="2"><textarea name="content" class="form-control" ><?php echo $post->content; ?></textarea></td>
        </tr>

        <tr>

            <th>Section</th>
            
            <td>
                <select name="section_id" class="form-control">
                    <?php foreach($sections as $section) { ?>
                        <option value="<?php echo $section->section_id; ?>"><?php echo $section->section_name; ?></option>
                    <?php } ?>
                </select>
            </td>

            
            <?php foreach($sections as $section) {
                    if ($section->section_id == $post->section_id) { ?>
                    <td>Actual section: <b><?php echo $section->section_name; ?></b></td>
                <?php } 
                } ?>

        </tr>

        <tr>
            <th>Photo</th>
            <td  colspan="2">
            <?php if($post->image) { //si el post que queremos editar tiene foto la mostramos
                echo "<img src='uploads/{$post->image}' class='showimg'/>";
            }?>
            <input type="file" name="image" accept="image/*"/>
            </td>
        </tr>
        <tr>
            <th></th>
            <td  colspan="2" style="border-top: 1.5px solid darkgray;"><button type="submit" class="btn btn-primary ">Update</button></td>
        </tr>
        </table>    
</form>