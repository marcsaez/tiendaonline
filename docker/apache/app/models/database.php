<?php
class database{
    public function conectar(){
        $host = 'localhost';
        $dbname = 'mangahouse';
        $user = 'postgres';
<<<<<<< HEAD
        $password = 'root';
=======
        $password = 'password';
>>>>>>> e6adcbc9809e65aa58ed0df530e00a3ee91d8360


            $this->db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;    
    }

    public static function staticConectar(){
        $host = 'localhost';
        $dbname = 'mangahouse';
        $user = 'postgres';
<<<<<<< HEAD
        $password = 'root';
=======
        $password = 'password';
>>>>>>> e6adcbc9809e65aa58ed0df530e00a3ee91d8360


            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;    
    }
}

