<?php
require_once './app/model/model.php';

class ModelHelados extends Model {
    //inserta un helado en la db
    public function insertIceCream($name_helado, $name_subcategory, $weight,  $price_cost, $price_sale, $ID_Heladerias, $illustrative_image) {
        $query = $this->db->prepare('INSERT INTO `helados`(`Nombre`, `Subcategorias`, `Peso`, `Precio_Costo`, `Precio_Venta`, `Foto_Helados`, `ID_Heladerias`)
        VALUES (?, ? , ? , ? , ?, ?, ?)');
        $query->execute([$name_helado, $name_subcategory, $weight, $price_cost, $price_sale, $illustrative_image, $ID_Heladerias]);
        return $this->db->lastInsertId();
    } 
    //elimina un helado de la db
    public function remove($id) {
        $query = $this->db->prepare('DELETE FROM helados WHERE ID_Helados = ?');
        $query->execute([$id]);
    }
    //elimina todos los helados de una heladeria
    public function removes($id_heladerias) {
        $query = $this->db->prepare('DELETE FROM helados WHERE ID_Heladerias = ?');
        $query->execute([$id_heladerias]);
    }
    //actualiza un helado en la db
    public function updateIceCreams ($ID_Helados, $name_helado, $name_subcategory, $weight,  $price_cost, $price_sale, $ID_Heladerias, $Foto_Helados){
        $query = $this->db->prepare("UPDATE helados SET nombre = ?, subcategorias = ?, peso = ?, precio_costo = ?, precio_venta = ?, id_heladerias = ?, Foto_Helados = ? WHERE ID_Helados = ?");
        $query->execute([$name_helado, $name_subcategory, $weight, $price_cost, $price_sale, $ID_Heladerias, $Foto_Helados, $ID_Helados]);
    }
    //devuelve todos los helados de la db
    public function getIceCreams($sort, $order, $page, $offset, $queryFiltro, $filtro) {
        $sql = 'SELECT * FROM helados WHERE ' . $queryFiltro . ' = ? ';
        if($order) {
            switch($order) {
                case 'ID_Helados':
                    $sql .= ' ORDER BY ID_Heladerias';
                break;
                case 'Nombre':
                    $sql .= ' ORDER BY Nombre';
                break;
                case 'Subcategorias':
                    $sql .= ' ORDER BY Subcategorias';
                break;
                case 'Peso':
                    $sql .= ' ORDER BY Peso';
                break;
                case 'Precio_Costo':
                    $sql .= ' ORDER BY Precio_Costo';
                break;
                case 'Precio_Venta':
                    $sql .= ' Precio_Venta';
                break;
                case 'ID_Heladerias':
                    $sql .= ' ORDER BY ID_Heladerias';
                break;
            }
            if($sort==='ASC') {
                $sql .=' ASC';
            } 
            if($sort==='DESC') {
                $sql .=' DESC';
            }
        }
        $sql .= ' LIMIT ' . $page . ' OFFSET ' . $offset;
         // 2. Ejecuto la consulta
         $query = $this->db->prepare($sql);
         $query->execute([$filtro]);
         $IceCreams = $query->fetchAll(PDO::FETCH_OBJ); 
         return $IceCreams;
    }
    //devuelve un helado de la db por id
    public function getIceCream($id) {
        $query = $this->db->prepare('SELECT * FROM helados WHERE ID_Helados = ?');
        $query->execute([$id]);   
        $IceCream = $query->fetch(PDO::FETCH_OBJ);    
        return $IceCream;
    }
    //devuelve helados basado en la heladeria pasada por id
    public function detailsIceCreams($ID_Heladerias){
        $query = $this->db->prepare('SELECT * FROM helados WHERE ID_Heladerias = ?');
        $query->execute([$ID_Heladerias]);
        $IceCreams = $query->fetchAll(PDO::FETCH_OBJ);  
        return $IceCreams;
    }
}
?>
