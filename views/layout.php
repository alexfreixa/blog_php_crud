<DOCTYPE html>
<html>
    <head>


    </head>

    <body>

      <header>

        <a href='/blog_php_mvc'>Home</a>
        <a>-</a>
        <a href='?controller=posts&action=index'>Posts</a>
        <a>-</a>
        <a href='?controller=posts&action=create'>Crear post</a>

      </header>
      
      <?php require_once('routes.php'); ?>

      <footer>Copyright</footer>

    </body>
</html>
