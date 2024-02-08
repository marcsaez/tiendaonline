<?php
class database{
    public function conectar(){
        $host = 'localhost';
        $dbname = 'mangahouse';
        $user = 'postgresql';
        $password = 'password';


        $this->db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->db;    
    }

    public static function staticConectar(){
        $host = 'localhost';
        $dbname = 'mangahouse';
        $user = 'postgresql';
        $password = 'password';


        $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;    
    }
}



