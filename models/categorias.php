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
                
                // foreach ($resultados as &$categoria) {
                //     $idPadre = $categoria['fkfathercategory'];
                //     $nombrePadre = self::obtenerNombreCategoriaPorID($db, $idPadre);
                //     $categoria['nombrePadre'] = $nombrePadre;
                // }
            }else{
                $resultados = null;
            }
        }catch (Exception $e){
            $resultados = null;
        }
        return $resultados;
    }

    //Sustituir ID Padre por nombre
    // public static function obtenerNombreCategoriaPorID($db, $idCategoria){
    //     try {
    //         $stmt = $db->prepare("SELECT categoryname FROM categories WHERE categoryid = :idCategoria");
    //         $stmt->bindParam(':idCategoria', $idCategoria);
    //         $stmt->execute();
    
    //         if ($stmt->rowCount() > 0) {
    //             $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    //             return $resultado['categoryname'];
    //         } else {
    //             return null;
    //         }
    //     } catch (Exception $e) {
    //         return null;
    //     }
    // }


    // Añadir categoria
    public function anadir(){
        try{ 
        $categoriaPadre = $this->categoriaPadre;
        $nombre = $this->nombre;
            if($categoriaPadre){
                $sql = "SELECT categoryname FROM categories WHERE categoryid = :idCategoriaPadre";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':idCategoriaPadre', $categoriaPadre);
                $stmt->execute();
                $rowcount= $stmt->rowCount();
                if ($rowcount>0){
                    $stmt = $this->db->prepare("INSERT INTO categories (categoryname, fkfathercategory) VALUES (:nombre, :categoriaPadre)");
                    $stmt->bindParam(':nombre', $this->nombre);
                    $stmt->bindParam(':categoriaPadre', $this->categoriaPadre);
                    $stmt->execute();
                } else {
                    echo "<script>alert('No existe un registro con el ID de categoriaPadre.');</script>";
                }
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
    public function editar(){
        try{
            $id = $this->IDCategoria;
            $categoriaPadre = $this->categoriaPadre;
            $nombre = $this->nombre;
            // echo $id, $nombre, $categoriaPadre;
            if ($categoriaPadre!='null') {
                
                $sql = "SELECT categoryname FROM categories WHERE categoryid = :idCategoriaPadre";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':idCategoriaPadre', $categoriaPadre);
                $stmt->execute();
                $rowcount= $stmt->rowCount();
                if ($rowcount>0){
                    $stmt1 = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria, fkFatherCategory = :idCategoriaPadre WHERE categoryid = :idCategoria;");
                
                    $stmt1->bindParam(':nombreCategoria', $nombre);
                    $stmt1->bindParam(':idCategoriaPadre', $categoriaPadre);
                    $stmt1->bindParam(':idCategoria', $id);
                    
                    $stmt1->execute();
                    header("Location: index.php?Controller=Categorias&action=listarCategorias");
                } else {
                    echo "<script>alert('No existe ninguna categoria con el siguient ID: $categoriaPadre');</script>";
                    echo "<script>window.location.href = 'index.php?Controller=Categorias&action=listarCategorias';</script>";
                }

                // $stmt1 = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria, fkFatherCategory = :idCategoriaPadre WHERE idCategoria = :idCategoria;");
                
                // $stmt1->bindParam(':nombreCategoria', $this->nombre);
                // $stmt1->bindParam(':idCategoriaPadre', $this->categoriaPadre);
                // $stmt1->bindParam(':idCategoria', $this->IDCategoria);
                
                // $stmt1->execute();
                 
            }else{
                $stmt1 = $this->db->prepare("UPDATE categories SET categoryName = :nombreCategoria WHERE categoryid = :idCategoria;");
                $stmt1->bindParam(':nombreCategoria', $nombre);
                $stmt1->bindParam(':idCategoria', $id);
                $stmt1->execute();
                header("Location: index.php?Controller=Categorias&action=listarCategorias");
            }
            return true;
        }catch(Exception $e){
            echo "error en la edicion de categorias: $e";
        }
    }
    //Eliminar categoria
    public function actualizarCategoria() {
        
        if ($this->IDCategoria) {
            $sql = "UPDATE categories SET active = 0 WHERE categoryid = :idCategoria";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idCategoria', $this->IDCategoria);
            $stmt->execute();
            
            // $sqlcomprobar = "SELECT * FROM categories WHERE fkfathercategory = :idCategoria";
            // $stmtcomprobar = $this->db->prepare($sqlcomprobar);
            // $stmtcomprobar->bindParam(':idCategoria', $this->IDCategoria);
            // $stmtcomprobar->execute();
            // if ($stmtcomprobar->rowCount() > 0) {
            //     echo "hola";
            // } 
            //UPDATE de CATEGORIAS HIJO ACTIVE = 0
            $sqlcascade = "UPDATE categories set active = 0 WHERE fkfathercategory = :idCategoria";

            $stmtcascade = $this->db->prepare($sqlcascade);

            $stmtcascade->bindParam(':idCategoria', $this->IDCategoria);

            $stmtcascade->execute();

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
            $stmt = $db->prepare("SELECT categoryid,categoryname FROM categories WHERE active=1 AND fkfathercategory is NULL");
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
            $nombreCategoria = "Error,el id de la categoria no corresponde a ningun nombre";
        }
        return $nombreCategoria;
    }

    public static function filtroCategorias($db, $id){
        try{
            //Subcategorias
            $stmtsubcat = $db->prepare("SELECT * FROM categories WHERE fkfathercategory = :id AND active = 1");
            $stmtsubcat->bindParam(':id', $id);
            $stmtsubcat->execute();
            if($stmtsubcat->rowCount() > 0){
                $subcat = $stmtsubcat->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $subcat = null;
            }
            // Productos asociados a categoria
            $stmt = $db->prepare("SELECT * FROM products WHERE fkcategories = :id AND active = 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $productosCategoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $productosCategoria = null;
            }
        }catch (Exception $e){
            echo $e;
            $productosCategoria = $e;
        }
        $resultado = array($subcat, $productosCategoria);
        return $resultado;
    }
}
?>
