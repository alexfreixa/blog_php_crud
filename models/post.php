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
            //AFEGIR: image, title, creation_date, update_date
            $db = Db::getInstance();
            $id = intval($id); //Comprovem que el id es un enter
            $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
            $req->execute(array('id' => $id)); // Es prepara la sentencia amb el valor de :id per $id.
            $post = $req->fetch(); 
            return new Post($post['id'], $post['author'], $post['content'], $post['title'], $post['create_date'], $post['update_date'], $post['image'], $post['section_id']);

        }

        public static function create($author, $content, $title, $section_id, $image){
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO posts SET author = :author, content = :content, title = :title, create_date = :create_date, section_id = :section_id, image=:image');

            $create_date = date('Y-m-d H:i:s');

            $req->bindParam(":author", $author);
            $req->bindParam(":content", $content);
            $req->bindParam(":title", $title);
            $req->bindParam(":create_date", $create_date);
            $req->bindParam(":image", $image);
            $req->bindParam(":section_id", $section_id);
            
            $req->execute();
        }
        
        public static function update($title,$author,$content, $image, $section_id, $id) {
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
            //Este es el metodo que crea la foto dentro del directorio(el de la otra practica pero un poco adaptado a esto)
            $result_message="";
         
            // now, if image is not empty, try to upload the image
            if($image){
         
                // sha1_file() function is used to make a unique file name
                $target_directory = "uploads/";
                $target_file = $target_directory . $image;
                $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
         
                // error message is empty
                $file_upload_error_messages="";
                // make sure that file is a real image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check!==false){
                    // submitted file is an image
                }else{
                    $file_upload_error_messages.="<div>Submitted file is not an image.</div>";
                }
                 
                // make sure certain file types are allowed
                $allowed_file_types=array("jpg", "jpeg", "png", "gif");
                if(!in_array($file_type, $allowed_file_types)){
                    $file_upload_error_messages.="<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
                }
                              
                // make sure submitted file is not too large, can't be larger than 1 MB
                if($_FILES['image']['size'] > (1024000)){
                    $file_upload_error_messages.="<div>Image must be less than 1 MB in size.</div>";
                }
                 
                // make sure the 'uploads' folder exists
                // if not, create it
                if(!is_dir($target_directory)){
                    mkdir($target_directory, 0777, true);
                }
    
                // if $file_upload_error_messages is still empty
                if(empty($file_upload_error_messages)){
                    // it means there are no errors, so try to upload the file
                    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                        // it means photo was uploaded
                        $result_message = true; //si la foto se sube el resultado es true, si no pasamos el texto de error
                    }else{
                        $result_message.="<div class='alert alert-danger'>";
                            $result_message.="<div>Unable to upload photo.</div>";
                            $result_message.="<div>Update the record to upload photo.</div>";
                        $result_message.="</div>";
                    }
                }
                 
                // if $file_upload_error_messages is NOT empty
                else{
                    // it means there are some errors, so show them to user
                    $result_message.="<div class='alert alert-danger'>";
                        $result_message.="{$file_upload_error_messages}";
                        $result_message.="<div>Update the record to upload photo.</div>";
                    $result_message.="</div>";
                }
         
            }
         
            return $result_message;
        }

    }
?>

