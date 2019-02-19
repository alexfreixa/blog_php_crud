<?php
function call($controller, $action) {
 require_once('controllers/' . $controller . '_controller.php');
 switch($controller) {
 case 'pages':
 $controller = new PagesController();
 break;
 case 'posts':
 // necesitamos el modelo para después consultar a la BBDD
// desde el controlador
 require_once('models/post.php');
 $controller = new PostsController();
 break;
 }
 // llama al método guardado en $action
 $controller->{ $action }();
}
// lista de controladores que tenemos y sus acciones
// consideramos estos valores "permitidos"
// agregando una entrada para el nuevo controlador y sus acciones.
$controllers = array( 'pages' => ['home', 'error'],
 'posts' => ['index', 'show']);
// verifica que tanto el controlador como la acción solicitados estén permitidos
// Si alguien intenta acceder a otro controlador y/o acción, será redirigido al
//método de error del controlador de pages.
if (array_key_exists($controller, $controllers)) {
 if (in_array($action, $controllers[$controller])) {
 call($controller, $action);
 } else {
 call('pages', 'error');
 }
} else {
 call('pages', 'error');
}
?>