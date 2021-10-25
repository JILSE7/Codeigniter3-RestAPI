<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blog extends CI_Controller {

     public function index(){
        echo 'Hello World!';
     }

     public function comentarios($id){

        //Validar id numerico
        if(!is_numeric($id)){
          $respuesta = array('err' => true, 'mensaje' => "El id tiene que ser numerico");
          echo json_encode($respuesta);

          return;
        }
        
        $comentarios = array(
                array('id' => 1, 'mensaje' => 'Este es el mensaje 1'),
                array('id' => 1, 'mensaje' => 'Este es el mensaje 2'),
                array('id' => 1, 'mensaje' => 'Este es el mensaje 3'),
                array('id' => 1, 'mensaje' => 'Este es el mensaje 4'),
                array('id' => 1, 'mensaje' => 'Este es el mensaje 5', "hola" => array("futa","hola"))
        );

        //Validar si el id esta dentro del rango de la data

        if($id >= count($comentarios) OR $id < 0){
          $respuesta = array('err' => true, 'mensaje' => "Registro no encontrado");
          echo json_encode($respuesta);
          return;
        }

        
        echo json_encode($comentarios[$id]);
     }


}