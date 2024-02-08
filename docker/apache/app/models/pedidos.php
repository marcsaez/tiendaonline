<?php
require_once("database.php");
class Pedido extends database{
    private $mail;
    private $status;
    private $total;
    private $creation;
    private $send;

    public function __construct($mail, $status, $total, $creation, $send) {
        $this->mail = $mail;
        $this->status = $status;
        $this->total = $total;
        $this->creation = $creation;
        $this->send = $send;

    }
    
    //GETTERS Y SETTERS
    function getMail(){
        return $this->mail;
    }
    function getStatus(){
        return $this ->status;
    }
    function getTotal(){
        return $this -> total;
    }
    function getCreation(){
        return $this -> creation;
    }
    function getSend(){
        return $this -> send;
    }
    function setMail($mail){
        $this->mail = $mail;
    }
    function setStatus($status){
        $this->status = $status;
    }
    function setTotal($total){
        $this-> total = $total;
    }
    function setCreation($creation){
        $this -> creation = $creation;
    }
    function setSend($send){
        $this -> send = $send;
    }

    public static function listarPedidosPendientes($db){
        try{
            $stmt = $db->prepare("SELECT * FROM purchases WHERE status=0 ORDER BY purchaseid");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $resultados = null;
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }

    public static function listarPedidosFinalizados($db){
        try{
            $stmt = $db->prepare("SELECT * FROM purchases WHERE status=1 ORDER BY purchaseid");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $resultados = null;
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }
    
}

?>