<?php
class database{
    public function conectar(){
        $host = 'postgres';
        $dbname = 'mangahouse';
        $user = 'postgres';
        $password = 'password';


            $this->db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;    
    }

    public static function staticConectar(){
        $host = 'postgres';
        $dbname = 'mangahouse';
        $user = 'postgres';
        $password = 'password';


            $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;    
    }
}

// INSERT INTO customers (email, customerphone, customername, customersurname, customeraddress, customerpassword)
// VALUES ('msaez@email.com', '1234567890', 'Marc', 'Saez', '123 Calypso', '123');

// INSERT INTO purchases (purchaseid, customeremail, status, totalcost, creationdate, senddate)
// VALUES (1, 'msaez@email.com', 0, NULL, CURRENT_DATE, NULL);

// INSERT INTO cart (cartid, fkpurchase, fkproduct, amount, totalprice)
// VALUES (1, 1, 'MA001-ON', 3, 30);

