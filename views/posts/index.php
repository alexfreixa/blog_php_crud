<p><strong>Listado de los posts:</strong></p>
<?php foreach($posts as $post) { ?>
 <p>
 <?php echo $post->author; ?>
 <td>
    <a href='?controller=posts&action=show&id=<?php echo $post->id; ?>'>Ver contenido</a>
    <a href='?controller=posts&action=update&id=<?php echo $post->id; ?>'>Edit</a>
    <a href='?controller=posts&action=delete&id=<?php echo $post->id; ?>'>Delete</a>
</td>

 </p>
<?php } ?>