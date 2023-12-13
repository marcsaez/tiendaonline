<?php
require_once("database.php");
class categoria extends database{
    private $nombre;
    private $categoriaPadre;
    
    //GETTERS Y SETTERS
    function getNombre(){
        return $this->nombre;
    }
    function getCategoriaPadre(){
        return $this ->categoriaPadre;
    }
    function setNombre($nombre){
        $this->nombre = $nombre;
    }
    function setCategoriaPadre($categoriaPadre){
        $this->categoriaPadre = $categoriaPadre;
    }

    // FUNCIONES QUE EJECUTARA ESTA CLASE

    // Añadir categoria
    public function anadir($nombre, $categoriaPadre){
        try{
            if ($categoriaPadre) {
                $stmt = $this->db->prepare("INSERT INTO categories (categoryName, fkFatherCategory) VALUES (:nombreCategoria, :idCategoriaPadre)");
        
                
                $stmt->bindParam(':nombreCategoria', $nombre);
                $stmt->bindParam(':idCategoriaPadre', $categoriaPadre);
                
                $stmt->execute();
                return true;
            }else {
                $stmt = $this->db->prepare("INSERT INTO categories (categoryName) VALUES (:nombreCategoria)");
        
                
                $stmt->bindParam(':nombreCategoria', $nombre);
                
                $stmt->execute();
                return true;
            }
        
        } catch (Exception $e){
            echo "error: $e";
            return false;
        }
    }
}
?>
