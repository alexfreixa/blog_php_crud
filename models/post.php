<?php

    class Post {

        // Definims els atributos
        // Els declarem com a publics per accedir-hi directament: $post->author
        public $id;
        public $author;
        public $content;
        public $title;
        public $create_date;
        public $update_date;
        public $image;
        public $section_id;

        public function __construct($id, $author, $content, $title, $create_date, $update_date, $image, $section_id) {
            $this->id = $id;
            $this->author = $author;
            $this->content = $content;
            $this->title = $title;
            $this->create_date = $create_date;
            $this->update_date = $update_date;
            $this->image = $image;
            $this->section_id = $section_id;
        }
        
        public static function all($field,$sort) {

            $list = [];
            $db = Db::getInstance();

            $ordenar = "";

            if(!empty($field) && !empty($sort)) { //Si hi ha els parametres per ordenar
                $ordenar = "order by {$field} {$sort}"; //Definim la variable $ordenar amb $field i $sort per afegir-ho a la query. Si no hi ha parametres, es passaran buits.
            }
            
            $query = "SELECT * FROM posts {$ordenar}"; //La consulta amb la variable $ordenar
            $req = $db->query($query);

            // Per cada post l'afegeix a l'array list, que despres desplegara a la vista
            foreach($req->fetchAll() as $post) {
                $list[] = new Post($post['id'], $post['author'], $post['content'], $post['title'], $post['create_date'], $post['update_date'], $post['image'], $post['section_id']);
            }

            return $list;
        }

        public static function find($id) {
            $db = Db::getInstance();
            $id = intval($id);
            $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
            $req->execute(array('id' => $id)); // Es prepara la sentencia amb el valor de id per $id que rebem per parametre a la funcio
            $post = $req->fetch(); 
            return new Post($post['id'], $post['author'], $post['content'], $post['title'], $post['create_date'], $post['update_date'], $post['image'], $post['section_id']);

        }
        
        public static function create($title, $author, $content, $section_id, $image){
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO posts SET author = :author, content = :content, title = :title, create_date = :create_date, section_id = :section_id, image=:image');

            $create_date = date('Y-m-d H:i:s'); //defineix la data actual dins la mateixa funció, no arriba per parametre

            $req->bindParam(":author", $author);
            $req->bindParam(":content", $content);
            $req->bindParam(":title", $title);
            $req->bindParam(":create_date", $create_date);
            $req->bindParam(":image", $image);
            $req->bindParam(":section_id", $section_id);
            
            $req->execute(); //Executa la query un cop definits els parametres i fa el insert
        }
        
        public static function update($title,$author,$content, $section_id, $image, $id) {
            $db = Db::getInstance();
            $img = "";

            if(!empty($image))  $img = ",image=:image";

            $sentence = "UPDATE posts set title=:title, author=:author, content=:content, update_date=:update_date, section_id = :section_id {$img} where id=:id"; 
            $req = $db->prepare($sentence); 
    
            $update_date = date('Y-m-d H:i:s');
            $req->bindParam(":id", $id);
            $req->bindParam(":title",$title);
            $req->bindParam(":author", $author);
            $req->bindParam(":content", $content);
            $req->bindParam(":update_date",$update_date);
            $req->bindParam(":section_id",$section_id);
            if(!empty($image)) $req->bindParam(":image",$image);

            $req->execute();

        }

        
        public static function delete($id){
            $db = Db::getInstance();
            $req = $db->prepare('DELETE FROM posts WHERE id=:id'); 

            $req->bindParam(":id", $id);
            $req->execute();
        }

        public static function uploadPhoto($image) {
         
            // now, if image is not empty, try to upload the image
            if($image){
         
                // sha1_file() function is used to make a unique file name
                $target_directory = "uploads/";
                $target_file = $target_directory . $image;
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);

                // make sure that file is a real image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check!==false){
                    // L'arxiu submited es un file
                }
                 
                // make sure the 'uploads' folder exists
                // if not, create it
                if(!is_dir($target_directory)){
                    mkdir($target_directory, 0777, true);
                }

                // Try to upload the file
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                    // Photo was uploaded
                }
                
                
            }

        }

    }
?>

