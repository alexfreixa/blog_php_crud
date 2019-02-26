<?php

include "models/section.php";

    class PostsController {

        public function index() {

            // Guardamos todos los posts en una variable
            if(isset($_GET['sort'])) { //si obtenemos el get de sort significa que queremos que nos ordene

                $_GET['sort'] =='desc' ? $sort='desc' : $sort = 'asc'; //si get sort es desc, la variable sort sera desc, si no asc
                if($_GET['order']=='title') $field = "title"; //despues comprobamos cual es el field que queremos ordenar
                if($_GET['order']=='author') $field = "author";
                if($_GET['order']=='create_date') $field = "create_date";
                
                $posts = Post::all($field,$sort); //pasamos las dos variables para que nos ordene dicho field como queramos
                
            } else {    

                $posts = Post::all("",""); //si no nos han pasado nada dejamos los parametros vacios

            }

            require_once('views/posts/index.php');

        }

        public function show() {

            // Esperamos una url del tipo ?controller=posts&action=show&id=x
            // Si no nos pasan el id redirecionamos hacia la pagina de error, el id tenemos que buscarlo en la BBDD
            if (!isset($_GET['id'])) {
                return call('pages', 'error');
            }
            
            $sections = Section::all();
            $post = Post::find($_GET['id']); // Utilizamos el id para obtener el post correspondiente
            require_once('views/posts/show.php');

        }

        public function create() {

            if(!empty($_POST)){

            $image=!empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : ""; //Comprovem que s'hagi pujat una imatge
            $post = Post::create($_POST['title'], $_POST['author'], $_POST['content'], $_POST['section_id'], $image);
            $uploadedPhoto = Post::uploadPhoto($image); //subimos la foto a nuestra carpeta
                
            if($post == false) { //si el insert en la base de datos ha salido bien

                $posts = Post::all("","");
                require_once('views/posts/index.php');

            } else { //si tenemos algun error llamamos a la pagina de error
                return call('pages', 'error');
            }
            
            } else {
                $sections = Section::all('');
                require_once('views/posts/create.php'); //Mostrem formulari per crear un nou post
            }


        }

        public function update() {

            if(!empty($_POST)) { //Si es passen parametres es fa la consulta.
                $image=!empty($_FILES["image"]["name"]) ? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"]) : "";

                $id = $_GET['id'];
                $post = Post::update($_POST['title'], $_POST['author'], $_POST['content'], $_POST['section_id'], $image, $id);
                $uploadedPhoto = Post::uploadPhoto($image);

                if($post == false) {
                    
                    $posts = Post::all("","");
                    require_once('views/posts/index.php');
                    
                } else {
                    
                    return call('pages', 'error'); // Pàgina d'error en cas d'error.
                    
                    
                }

            } else { //Si no se'ns passen parametres mostrem el formulari.
                
                $sections = Section::all('');
                $post = Post::find($_GET['id']);
                require_once('views/posts/update.php');
                
            }

        }


        public function delete() {

            if (!isset($_GET['id'])) {
                return call('pages', 'error');
            }
            
            $post = Post::delete($_GET['id']); // Utilizamos el id para obtener el post correspondienteç

            $posts = Post::all("","");
            require_once('views/posts/index.php');

        }


    }
?>