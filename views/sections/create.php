
<form action="?controller=sections&action=create" method="post" enctype="multipart/form-data">

<h5 class=""><strong>Creando nueva seccion</strong></h5><br>
    <table>
        <tr>
            <th>Section name</th>
            <td><input type="text" name="section_name" class="form-control" required/></td>
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

            <th></th>
            <td><button type="submit" class="btn btn-primary">Create post</button></td>
        </tr>
    </table>
</form>