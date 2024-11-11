<?php

  class JSONView {
    public function response ($body, $status){
        //envia un contenido de tipo json
        header("Content-Type: application/json");
        //declara que tipo de respuesta es
        $statusText = $this->_requestStatus($status);
        //es la version
        header("HTTP/1.1 $status");
        //imprime la respuesta
        echo json_encode($body);
    }

    private function _requestStatus($code){
      $status = [
        200 => 'OK',
        201 => 'Created',
        400 => 'Bad Request',
        404 => 'Not Found',
        429 => 'Too Many Requests',
        500 => 'Internal Server Error',
        ];
    if (!isset($status[$code])){
      $code = 500;
    }
    return ($status[$code]);
    }
}
