<?php
class database{
    public function conectar(){
        $host = 'localhost';
        $dbname = 'mangahouse';
        $user = 'postgres';
        $password = 'password';


            $this->db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;    
    }
}

