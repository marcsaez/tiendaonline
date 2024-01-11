<?php
require_once("database.php");
class Categoria extends database{
    private $nombre;
    private $categoriaPadre;
    private $IDCategoria;

    public function __construct($id, $nombre, $categoriaPadre) {
        $this->IDCategoria = $id;
        $this->nombre = $nombre;
        $this->categoriaPadre = $categoriaPadre;
    }
    
    //GETTERS Y SETTERS
    function getNombre(){
        return $this->nombre;
    }
    function getCategoriaPadre(){
        return $this ->categoriaPadre;
    }
    function getIDCategoria(){
        return $this -> IDCategoria;
    }
    function setNombre($nombre){
        $this->nombre = $nombre;
    }
    function setCategoriaPadre($categoriaPadre){
        $this->categoriaPadre = $categoriaPadre;
    }
    function setIDCategoria($IDCategoria){
        $this-> IDCategoria = $IDCategoria;
    }

    // FUNCIONES QUE EJECUTARA ESTA CLASE

    // Listar categorias
    public static function listarTodasCategorias($db){
        try{
            $stmt = $db->prepare("SELECT * FROM categories WHERE active=1 ORDER BY categoryid");
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


    // Añadir categoria
    public function anadir(){
        try{ 
        $categoriaPadre = $this->categoriaPadre;
        $nombre = $this->nombre;
            if($categoriaPadre){
                $stmt = $this->db->prepare("INSERT INTO categories (categoryname, fkfathercategory) VALUES (:nombre, :categoriaPadre)");
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':categoriaPadre', $this->categoriaPadre);
                $stmt->execute();
            }else {
                $stmt = $this->db->prepare("INSERT INTO categories (categoryname) VALUES (:nombre)");
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->execute();
            }
            $retorno = true;
        } catch (Exception $e){
            echo "error: $e";
            $retorno = false;
        }
        return $retorno;
    }
    
    //Editar categoria
    public function editarCategoria(){
        try{
            if ($this->categoriaPadre) {
                $stmt = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria, fkFatherCategory = :idCategoriaPadre WHERE idCategoria = :idCategoria;");
                
                $stmt->bindParam(':nombreCategoria', $this->nombre);
                $stmt->bindParam(':idCategoriaPadre', $this->categoriaPadre);
                $stmt->bindParam(':idCategoria', $this->IDCategoria);
                
                $stmt->execute();
                 
            }else{
                $stmt = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria WHERE idCategoria= :idCategoria;");
        
                $stmt->bindParam(':nombreCategoria', $this->nombre);
                $stmt->bindParam(':idCategoria', $this->IDCategoria);

                $stmt->execute();
            }
            return true;
        }catch(Exception $e){
            echo "error en la edicion de categorias: $e";
        }
    }
    //Eliminar categoria
    public function actualizarCategoria() {
        
        if ($this->IDCategoria) {
            // $id = $this->IDCategoria;
            
            $sql = "UPDATE categories SET active = 0 WHERE categoryid = :idCategoria";
            
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':idCategoria', $this->IDCategoria);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "La categoría con ID {$this->IDCategoria} ha sido actualizada correctamente.";
                return true;
            } else {
                return "No se encontró ninguna categoría con el ID {$this->IDCategoria}.";
            }
        } else {
            echo "IDCategoria no proporcionado.";
        }
        
        
    }
    public static function navCategorias($db){
        try{
            $stmt = $db->prepare("SELECT categoryname FROM categories WHERE active=1 AND fkfathercategory is NULL");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $totalCategorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $totalCategorias = null;
            }
        }catch (Exception $e){
            $totalCategorias = null;
        }
        return $totalCategorias;
    }
    public static function nombreCategorias($db, $idcategoria){
        try{
            $stmt = $db->prepare("SELECT categoryname FROM categories WHERE categoryid = :idcategoria");
            $stmt->bindParam(':idcategoria', $idcategoria);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $nombreCategoria = $stmt->fetchColumn();
            }else{
                $nombreCategoria = "Error,el id de la categoria no corresponde a ningun nombre";
            }
        }catch (Exception $e){
            echo $e;
            $nombreCategoria = $e;
        }
        return $nombreCategoria;
    }
}
?>
