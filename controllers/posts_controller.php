<?php

include "models/section.php";

    class PostsController {

        public function index() {

            // Guardamos todos los posts en una variable
            if(isset($_GET['sort'])) { //

                $_GET['sort'] =='desc' ? $sort='desc' : $sort = 'asc'; //Depenen del que rebem per GET serà o asc o desc.
                if($_GET['order']=='title') $field = "title"; //despues comprobamos cual es el field que queremos ordenar
                if($_GET['order']=='author') $field = "author";
                if($_GET['order']=='create_date') $field = "create_date";
                if($_GET['order']=='section') $field = "section_id";
                
                $posts = Post::all($field,$sort); //pasamos las dos variables para que nos ordene dicho field como queramos
                
            } else {    

                $posts = Post::all("",""); //si no nos han pasado nada dejamos los parametros vacios

            }
            
            $sections = Section::all('');
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
                
            if($post == false) {

                $posts = Post::all("","");
                $sections = Section::all('');
                require_once('views/posts/index.php');

            } else { 
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

                if($post == false) { //S'actualitza i se'ns retorna la vista index, cridant tots els posts i sections amb les funcions all del seu model corresponent
                    
                    $posts = Post::all("","");
                    $sections = Section::all('');
                    require_once('views/posts/index.php');
                    
                } else {
                    
                    return call('pages', 'error'); // Pàgina d'error en cas d'error.
                    
                    
                }

            } else { //Si no se'ns passen parametres mostrem el formulari a modificar
                
                $sections = Section::all('');
                $post = Post::find($_GET['id']);
                require_once('views/posts/update.php');
                
            }

        }


        public function delete() {

            if (!isset($_GET['id'])) {
                return call('pages', 'error'); //Si no hi ha id ens retorna la pagina d'error
            }
            
            $post = Post::delete($_GET['id']); //Passem al model el id rebut per GET desde el formulari per eliminar
            $sections = Section::all(''); //Carreguem el model de Section i la seva funcio all per obtenir totes les seccions
            $posts = Post::all("",""); //Carreguem el model de Post i la seva funcio all per obtenir totes les seccions
            require_once('views/posts/index.php'); //recarrega la vista de tots els posts

        }


    }
?>