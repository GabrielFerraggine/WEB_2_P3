<?php
require_once './app/model/model.php';
class modelheladerias extends Model{
    //inserta los datos de un nuevo helado en la db
    public function insertIceCreamParlor($name_heladeria, $address, $association_date, $illustrative_image) {
        $query = $this->db->prepare('INSERT INTO `heladerias` (`Nombre`, `Direccion`, `Fecha_Asociacion`, `Foto_Heladerias`) VALUES (?, ? , ? , ?)');
        $query->execute([$name_heladeria, $address, $association_date, $illustrative_image]);
    }
    //solicita una heladeria a la db por id
    public function getIceCreamParlor($ID_Heladerias) {
            $query = $this->db->prepare('SELECT * FROM heladerias WHERE ID_Heladerias = ?');
            $query->execute([$ID_Heladerias]);   
            $IceCream = $query->fetch(PDO::FETCH_OBJ);
            return $IceCream;
    }
    //solicita toda la tabla de Heladeria
    public function getIceCreamParlors() {
        $query = $this->db->prepare('SELECT * FROM heladerias');
        $query->execute();
        $IceCreams = $query->fetchAll(PDO::FETCH_OBJ); 
        return $IceCreams;
    }
    //Actualiza una heladeria
    public function updateIceCreamParlor ($ID_Heladerias, $name_heladeria, $address, $association_date, $Foto_Heladerias){
        $query = $this->db->prepare("UPDATE heladerias SET Nombre = ?, Direccion = ?, Fecha_Asociacion = ?, Foto_Heladerias = ? WHERE ID_Heladerias = ?");
        $query->execute([$name_heladeria, $address, $association_date, $Foto_Heladerias, $ID_Heladerias]);
    }
    //elimina una heladeria de la db
    public function RemoveParlor($ID_Heladerias) {
        $query = $this->db->prepare('DELETE FROM heladerias WHERE ID_Heladerias = ?');
        $query->execute([$ID_Heladerias]);
    }
}