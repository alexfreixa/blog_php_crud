<?php

    require_once('connection.php');
    
    if (isset($_GET['controller']) && isset($_GET['action'])) {

        $controller = $_GET['controller']; //Intenta conseguir per get el controlador
        $action = $_GET['action']; //Intenta conseguir per get el metode

    } else { // En cas que no cridem cap controlador i metode, per defecte se'ns dirigeix a la pagina principal home.

        $controller = 'pages'; //Controlador pages
        $action = 'home';  //Funcio home
        
    }

    require_once('views/layout.php');

?>