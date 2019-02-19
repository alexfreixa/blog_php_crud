<?php
    class PostsController {

        public function index() {

            // Guardamos todos los posts en una variable
            $posts = Post::all();
            require_once('views/posts/index.php');
            
        }

        public function show() {

            // Esperamos una url del tipo ?controller=posts&action=show&id=x
            // Si no nos pasan el id redirecionamos hacia la pagina de error, el id tenemos que buscarlo en la BBDD
            if (!isset($_GET['id'])) {
                return call('pages', 'error');
            }
            
            $post = Post::find($_GET['id']); // Utilizamos el id para obtener el post correspondiente
            require_once('views/posts/show.php');

        }

        public function create() {

            if(!empty($_POST)){
                
            $author = $_POST['author'];
            $content = $_POST['content'];
            Post::create($author, $content);

            $posts = Post::all();
            require_once('views/posts/index.php');
            
            } else {
                require_once('views/posts/create.php');
            }


        }

        public function update() {

            if(!empty($_POST)) { //Si pasan parametros haremos la consulta

                $id = $_GET['id'];
                $post = Post::update($_POST['author'], $_POST['content'], $id);

                if($post == true) {
                    
                    require_once('views/posts/index.php');
                    
                } else { 
                    
                    $posts = Post::all();
                    require_once('views/posts/index.php');
                    
                }

            } else { //si no nos pasan parametros por post significa que no hemos hecho aun el formulario por lo tanto buscamos el id que queremos editar por get y mostramos el formulario
                
                $post = Post::find($_GET['id']);
                require_once('views/posts/update.php');
                
            }

        }

        public function delete() {

            if (!isset($_GET['id'])) {
                return call('pages', 'error');
            }
            
            $post = Post::delete($_GET['id']); // Utilizamos el id para obtener el post correspondienteç

            $posts = Post::all();
            require_once('views/posts/index.php');

        }


    }
?>