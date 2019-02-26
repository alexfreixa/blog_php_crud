<form action="?controller=posts&action=create" method="post" enctype="multipart/form-data">
<h5 class=""><strong>Creando nuevo post</strong></h5><br>
    <table>
        <tr>
            <th>
            Author
            </th>
            <td><input type="text" name="author" class="form-control" required/></td>
        </tr>
        <tr>
            <th>
            Title
            </th>
            <td><input type="text" name="title" class="form-control" required/></td>
        </tr>
        <tr>
            <th>Content</th>
            <td><textarea name="content" class="form-control" required></textarea></td>
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
        </tr>

        
        <tr>
            <th>Photo</th>
            <td><input type="file" name="image" accept="image/*"/></td>
        </tr>
        <tr>
            <th></th>
            <td><button type="submit" class="btn btn-primary">Create post</button></td>
        </tr>
    </table>
</form>