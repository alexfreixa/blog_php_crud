<?php

    class Section {

        // Definimos tres atributos
        // Los declaramos como públicos para acceder directamente $section->section_id
        public $section_id;
        public $section_name;
        public $edat;
        public $creation_date;

        public function __construct($section_id, $section_name, $edat, $creation_date) {
            $this->section_id = $section_id;
            $this->section_name = $section_name;
            $this->edat = $edat;
            $this->creation_date = $creation_date;
        }

        public static function all() {

            $list = [];
            $db = Db::getInstance();
            
            $query = "SELECT * FROM sections";
            $req = $db->query($query);

            foreach($req->fetchAll() as $section) {
                $list[] = new Section($section['section_id'], $section['section_name'], $section['edat'], $section['creation_date']);
            }
            return $list;
        }

        public static function find($section_id) {
            //AFEGIR: image, title, creation_date, update_date
            $db = Db::getInstance();
            $section_id = intval($section_id); //Comprovem que el section_id es un enter
            $req = $db->prepare('SELECT * FROM sections WHERE section_id = :section_id');
            $req->execute(array('section_id' => $section_id)); // Es prepara la sentencia amb el valor de :section_id per $section_id.
            $section = $req->fetch(); 
            return new Section($section['section_id'], $section['section_name'], $section['edat'], $section['creation_date']);

        }

        public static function create($section_name, $edat){
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO sections SET section_name = :section_name, edat = :edat, creation_date = :creation_date');

            $creation_date = date('Y-m-d H:i:s');

            $req->bindParam(":section_name", $section_name);
            $req->bindParam(":edat", $edat);
            $req->bindParam(":creation_date", $creation_date);
            
            $req->execute();
        }
        
        public static function update($section_name, $edat, $section_id) {

            $db = Db::getInstance();
            $sentence = "UPDATE sections SET section_name = :section_name, edat = :edat WHERE section_id =:section_id";

            $req = $db->prepare($sentence); 
            $req->bindParam(":section_name", $section_name);
            $req->bindParam(":edat", $edat);
            $req->bindParam(":section_id", $section_id);
            
            $req->execute();

        }

        
        public static function delete($section_id){
            $db = Db::getInstance();
            $req = $db->prepare('DELETE FROM sections WHERE section_id=:section_id'); 

            $req->bindParam(":section_id", $section_id);
            $req->execute();
        }


    }
?>

