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
    public function returnIceCreams($req) {
        $page= 1;//pagina actual
        $limitPage=5;//limite por pagina
        $order = 'ID_Helados';
        $sort = 'ASC';
        $filtro = 1;
        $queryFiltro= "ID_Heladerias";
        // Filtro
        if(isset($req->query->queryFiltro) && isset($req->query->filtro) ){
            if($req->query->queryFiltro!='ID_Helados'||$req->query->queryFiltro!='Nombre'||$req->query->queryFiltro!='Subcategorias'||$req->query->queryFiltro!='Peso'||$req->query->queryFiltro!='Precio_Costo'||$req->query->queryFiltro!='Precio_Venta'||$req->query->queryFiltro!='ID_Heladerias') {
                $queryFiltro = $req->query->queryFiltro;
                $filtro = $req->query->filtro;
            }else {
                return $this->view->response("No se puede filtrar por " .  $req->query->queryFiltro , 400);
            }
        }
        // Ordenamiento
        if(isset($req->query->order)){
            if($req->query->order!='ID_Helados'||$req->query->order!='Nombre'||$req->query->order!='Subcategorias'||$req->query->order!='Peso'||$req->query->order!='Precio_Costo'||$req->query->order!='Precio_Venta'||$req->query->order!='ID_Heladerias') {
                $order = $req->query->order;
            }else {
                return $this->view->response("No se puede ordenar por " .  $req->query->order , 400);
            }
        }
        if(isset($req->query->sort)){
            if (($req->query->sort != 'DESC') || ($req->query->sort != 'ASC')){
                $sort = $req->query->sort;
            }else { 
                return $this->view->response("No se puede ordenar de manera " . $req->query->sort, 400);
            }
        }
        //paginado
        if(isset($req->query->limitPage) || isset($req->query->page)){
            if(isset($req->query->limitPage)){
                if (($req->query->limitPage > 0)){
                    $limitPage = intval($req->query->limitPage);
                }else{
                    $this->view->response("El limite no puede ser " . $req->query->limitPage, 400);
                }
            }
            if(isset($req->query->page)){
                if (($req->query->page > 0)){
                    $page = intval($req->query->page);
                }else{
                    $this->view->response("El numero de la pagina no puede ser " . $req->query->page, 400);
                }
            }
        }
        $offset = ($page - 1) * $limitPage; //Formula el cual calcula cuantos elementos salteara
        //solicitud
        $iceCreams = $this->model->getIceCreams($sort, $order, $limitPage, $offset, $queryFiltro, $filtro);        
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