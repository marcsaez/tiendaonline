<?php
class database{
    public function conectar(){
        $host = 'postgres';
        $dbname = 'mangahouse';
        $user = 'postgres';
        $password = 'root';


            $this->db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;    
    }

    public static function staticConectar(){
        $host = 'postgres';
        $dbname = 'mangahouse';
        $user = 'postgres';
        $password = 'root';


            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;    
    }
}



