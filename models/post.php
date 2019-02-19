<?php
    class Post {

        // Definimos tres atributos
        // Los declaramos como públicos para acceder directamente $post->author
        public $id;
        public $author;
        public $content;

        public function __construct($id, $author, $content) {
            $this->id = $id;
            $this->author = $author;
            $this->content = $content;
        }

        public static function all() {

            $list = [];
            $db = Db::getInstance();
            $req = $db->query('SELECT * FROM posts');

            // Creamos una lista de objectos post y recorremos la respuesta de la consulta
            foreach($req->fetchAll() as $post) {
                $list[] = new Post($post['id'], $post['author'], $post['content']);
            }

            return $list;
        }

        public static function find($id) {

            $db = Db::getInstance();
            $id = intval($id); // Nos aseguramos que $id es un entero
            $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
            $req->execute(array('id' => $id)); // Preparamos la sentencia y reemplazamos :id con el valor de $id
            $post = $req->fetch(); 
            return new Post($post['id'], $post['author'], $post['content']);

        }

        public static function create($author, $content){
            $db = Db::getInstance();
            $req = $db->prepare('INSERT INTO posts SET author = :author, content = :content');
            
            $req->bindParam(":author", $author);
            $req->bindParam(":content", $content);
            $req->execute();
        }

        public static function update($author, $content, $id){
            $db = Db::getInstance();
            $req = $db->prepare('UPDATE posts set author=:author, content=:content where id=:id'); 
            
            $req->bindParam(":id", $id);
            $req->bindParam(":author", $author);
            $req->bindParam(":content", $content);
            $req->execute();
        }

        
        public static function delete($id){
            $db = Db::getInstance();
            $req = $db->prepare('DELETE FROM posts WHERE id=:id'); 

            $req->bindParam(":id", $id);
            $req->execute();
        }

    }
?>

