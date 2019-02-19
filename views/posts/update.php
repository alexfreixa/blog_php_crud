<p><strong>Editando post</strong></p>

<form action='?controller=posts&action=update&id=<?php echo $post->id; ?>' method="post" enctype="multipart/form-data">
    
            <p>Author</p>
            <input type="text" name="author" value="<?php echo $post->author; ?>"/>

            <p>Content</p>
            <textarea name="content"><?php echo $post->content; ?></textarea>

            <button type="submit" class="btn btn-primary ">Update</button>

</form>