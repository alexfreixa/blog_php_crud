<h5 class=""><strong>Editando section</strong></h5><br>

<form action='?controller=sections&action=update&section_id=<?php echo $section->section_id; ?>' method="post" enctype="multipart/form-data">
    
    <table>
        <tr>
            <th>Section name</th>
            <td><input type="text" name="section_name" class="form-control" value="<?php echo $section->section_name; ?>"/></td>
        </tr>
        <tr>
            <th>Age</th>
            <td>
                <select name="edat" class="form-control" required>
                    <option value="0">0</option>
                    <option value="12">12</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                    <option value="21">21</option>
                </select>
            </td>
        </tr>

        <tr>
            <th></th>
            <td style="border-top: 1.5px solid darkgray;"><button type="submit" class="btn btn-primary ">Update</button></td>
        </tr>
        </table>    
</form>