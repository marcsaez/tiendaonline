<?php
require_once("database.php");
class categoria extends database{
    private $nombre;
    private $categoriaPadre;

    public function __construct($nombre, $categoriaPadre) {
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
            $stmt = $db->prepare("SELECT * FROM categories");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            if($categoriaPadre){
                $stmt = $this->db->prepare("INSERT INTO categories (categoryname, fkfathercategory) VALUES (:nombre, :categoriaPadre)");
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':categoriaPadre', $this->categoriaPadre);
            }else {
                $stmt = $this->db->prepare("INSERT INTO categories (categoryname) VALUES (:nombre)");
                $stmt->bindParam(':nombre', $this->nombre);
            }
            $retorno = true;
        } catch (Exception $e){
            echo "error: $e";
            $retorno = false;
        }
        return $retorno;
    }
    // public function anadirCategoria($nombre, $categoriaPadre){
    //     try{
    //         if ($categoriaPadre) {
    //             $stmt = $this->db->prepare("INSERT INTO categories (categoryName, fkFatherCategory) VALUES (:nombreCategoria, :idCategoriaPadre)");
        
                
    //             $stmt->bindParam(':nombreCategoria', $nombre);
    //             $stmt->bindParam(':idCategoriaPadre', $categoriaPadre);
                
    //             $stmt->execute();
    //             return true;
    //         }else {
    //             $stmt = $this->db->prepare("INSERT INTO categories (categoryName) VALUES (:nombreCategoria)");
        
                
    //             $stmt->bindParam(':nombreCategoria', $nombre);
                
    //             $stmt->execute();
    //             return true;
    //         }
        
    //     } catch (Exception $e){
    //         echo "error en la insercion de categorias: $e";
    //     }
    // }
    //Editar categoria
    public function editarCategoria(){
        try{
            if ($categoriaPadre) {
                $stmt = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria, fkFatherCategory = :idCategoriaPadre WHERE idCategoria = :idCategoria;");
                
                $stmt->bindParam(':nombreCategoria', $nombre);
                $stmt->bindParam(':idCategoriaPadre', $categoriaPadre);
                $stmt->bindParam(':idCategoria', $IDCategoria);
                
                $stmt->execute();
                 
            }else{
                $stmt = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria WHERE idCategoria= :idCategoria;");
        
                $stmt->bindParam(':nombreCategoria', $nombre);
                $stmt->bindParam(':idCategoria', $IDCategoria);

                $stmt->execute();
            }
            return true;
        }catch(Exception $e){
            echo "error en la edicion de categorias: $e";
        }
    }
    //Eliminar categoria
    public function eliminarCategoria(){
        try{
            $stmt = $this->db->prepare("DELETE FROM categories WHERE idCategoria = :idCategoria; ");
            
            $stmt->bindParam(':idCategoria', $IDCategoria);
            
            $stmt->execute();
            
            return true;
        }catch(Exception $e){
            echo "error en la edicion de categorias: $e";
        }
    }
}
?>
