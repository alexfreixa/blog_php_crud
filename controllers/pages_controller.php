<?php

    class PagesController {

        public function home() {
            //Simulación de datos obtenidos de un modelo
            $first_name = 'Alex';
            $last_name = 'Freixa';
            require_once('views/pages/home.php');
        }

        public function error() {
            require_once('views/pages/error.php');
        }
    }

?>