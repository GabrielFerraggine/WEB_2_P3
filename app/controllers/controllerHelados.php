<?php
require_once './app/model/modelHelados.php';
require_once './app/model/modelHeladerias.php';
require_once './app/view/jsonView.php';

class ControllerHelados {
    private $model;
    private $view;
    private $modelParlor;

    public function __construct() {
        $this->model = new modelHelados();  
        $this->view = new JSONView();
        $this->modelParlor = new modelheladerias();//usada para POST y PUT
    }
    //solicita todos los item de helados
    public function returnIceCreams() {
        $order= 'Nombre';
        $sort = 'DESC';
        // Definir campos y órdenes permitidos
        $allowedFields = ['Nombre'];  
        $allowedOrders = ['ASC', 'DESC'];
        $iceCreams = $this->model->getIceCreams($sort, $order);        
        return $this->view->response($iceCreams, 200);
    }
    //solicita un item de helados
    public function returnIceCream($request){
        $id = $request->params->id;
        $iceCream = $this->model->getIceCream($id);
        if(!$iceCream) {
            return $this->view->response("The ice cream with the id=$id does not exist", 404);
        }
        return $this->view->response($iceCream, 200);
    }


    public function addIceCream($req) {
        if(!isset($req->body->Nombre) || empty($req->body->Nombre)) {
            return $this->view->response('Please complete the name', 404);
        }
        if(!isset($req->body->Subcategorias) || empty($req->body->Subcategorias)) {
            return $this->view->response('Please complete the subcategory', 404);
        }
        if(!isset($req->body->Peso) || empty($req->body->Peso)) {
            return $this->view->response('Please complete the weight', 404);
        }
        if(!isset($req->body->Precio_Costo) || empty($req->body->Precio_Costo)) {
            return $this->view->response('Please complete the price cost', 404);
        }
        if(!isset($req->body->Precio_Venta) || empty($req->body->Precio_Venta)) {
            return $this->view->response('Please complete the price sale', 404);
        }
        $id_parlor = $req->body->ID_Heladerias;
        if(!isset($id_parlor) || empty($id_parlor)) {
            return $this->view->response('Please complete the ice cream parlor id', 404);
        } else {
            $parlor = $this->modelParlor->getIceCreamParlor($id_parlor);
            if(!$parlor) {
                return $this->view->response('Please enter an existing ice cream parlor id', 404);
            }
        }
        if(empty($req->body->Foto_Heladerias)) {
            //se agrega una imagen generica
            $illustrative_image = 'https://media.cdn.puntobiz.com.ar/102016/1617293962194.jpg?cw=1200&ch=740';
        } else {
            $illustrative_image = $req->body->Foto_Heladerias;
        }
        $name_helado = $req->body->Nombre;
        $Subcategory = $req->body->Subcategorias;
        $weight = $req->body->Peso;
        $price_cost = $req->body->Precio_Costo;
        $price_sale = $req->body->Precio_Venta;
        $id = $this->model->insertIceCream($name_helado, $Subcategory, $weight,  $price_cost, $price_sale, $id_parlor, $illustrative_image);
        $iceCream = $this->model->getIceCream($id);
        return $this->view->response($iceCream, 200);
    }
    
    public function editIceCream($req) {
        $id = $req->params->id;
        
        $iceCream = $this->model->getIceCream($id);
        //compruebo que exista 
        if(!$iceCream) {
            return $this->view->response("The ice cream with the id=$id does not exist", 404);
        }
        //compruebo los datos
        if(!isset($req->body->Nombre) || empty($req->body->Nombre)) {
            return $this->view->response('Please complete the name', 404);
        }
        if(!isset($req->body->Subcategorias) || empty($req->body->Subcategorias)) {
            return $this->view->response('Please complete the subcategory', 404);
        }
        if(!isset($req->body->Peso) || empty($req->body->Peso)) {
            return $this->view->response('Please complete the weight', 404);
        }
        if(!isset($req->body->Precio_Costo) || empty($req->body->Precio_Costo)) {
            return $this->view->response('Please complete the price cost', 404);
        }
        if(!isset($req->body->Precio_Venta) || empty($req->body->Precio_Venta)) {
            return $this->view->response('Please complete the price sale', 404);
        }
        $id_parlor = $req->body->ID_Heladerias;
        if(!isset($id_parlor) || empty($id_parlor)) {
            return $this->view->response('Please complete the ice cream parlor id', 404);
        } else {
            $parlor = $this->modelParlor->getIceCreamParlor($id_parlor);
            if(!$parlor) {
                return $this->view->response('Please enter an existing ice cream parlor id', 404);
            }
        }
        if(empty($req->body->Foto_Heladerias)) {
            //se agrega una imagen generica
            $illustrative_image = 'https://media.cdn.puntobiz.com.ar/102016/1617293962194.jpg?cw=1200&ch=740';
        } else {
            $illustrative_image = $req->body->Foto_Heladerias;
        }
        //obtengo los datos
        $name_helado = $req->body->Nombre;
        $Subcategory = $req->body->Subcategorias;
        $weight = $req->body->Peso;
        $price_cost = $req->body->Precio_Costo;
        $price_sale = $req->body->Precio_Venta;
        $id_heladeria = $req->body->ID_Heladerias;
        //actualizo el helado
        $this->model->updateIceCreams ($id, $name_helado, $Subcategory, $weight,  $price_cost, $price_sale, $id_parlor, $illustrative_image);
        //devuelvo el helado modificado como respuesta
        $iceCream = $this->model->getIceCream($id);
        return $this->view->response($iceCream, 200);
    }

    public function delete($req) {
        $id = $req->params->id;

        $iceCream = $this->model->getIceCream($id);

        if (!$iceCream) {
            return $this->view->response("The ice cream with the id=$id does not exist", 404);
        }
        $this->model->remove($id);
        $this->view->response("The ice cream with the id=$id it´s delete", 200);
    }
}
?>