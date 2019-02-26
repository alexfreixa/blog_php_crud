<?php

    class PagesController {

        public function home() {
            //Simulación de datos obtenidos de un modelo
            $first_name = 'Àlex';
            $last_name = 'Freixa';
            require_once('views/pages/home.php'); //Retorna la vista home
        }

        public function error() {
            require_once('views/pages/error.php'); //Retorna la pàgina d'error en cas d'error
        }
    }

?>