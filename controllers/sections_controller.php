<?php
    class SectionsController {

        public function index() {

            $sections = Section::all(); //si no nos han pasado nada dejamos los parametros vacios
            require_once('views/sections/index.php');

        }

        public function create() {

            if(!empty($_POST)){

            $section = Section::create($_POST['section_name'],$_POST['edat']);
                
            if($section == false) { //si el insert en la base de datos ha salido bien

                $sections = Section::all();
                require_once('views/sections/index.php');

            } else { //si tenemos algun error llamamos a la pagina de error
                return call('pages', 'error');
            }
            
            } else {
                require_once('views/sections/create.php'); //Mostrem formulari per crear un nou section
            }


        }

        public function update() {

            if(!empty($_POST)) { //Si es passen parametres es fa la consulta.

                $section_id = $_GET['section_id'];
                $section = Section::update($_POST['section_name'], $_POST['edat'], $section_id);

                if($section == false) {

                    $sections = Section::all();
                    require_once('views/sections/index.php');
                    
                } else {
                    
                    return call('pages', 'error'); // Pàgina d'error en cas d'error.
                    
                    
                }

            } else { //Si no se'ns passen parametres mostrem el formulari.
                
                $section = Section::find($_GET['section_id']);
                require_once('views/sections/update.php');
                
            }

        }


        public function delete() {

            if (!isset($_GET['section_id'])) {
                return call('pages', 'error');
            }
            
            $section = Section::delete($_GET['section_id']); // Utilizamos el section_id para obtener el section correspondienteç

            $sections = Section::all();
            require_once('views/sections/index.php');

        }


    }
?>