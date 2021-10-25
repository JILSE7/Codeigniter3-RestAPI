<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Clientes extends REST_Controller {

       //CONTRUCTOR
       public function __construct(){
        //Llamado del constructor del padre
        parent::__construct();
        //Base de datos
        $this->load->database();
        //Modelo
        $this->load->model('Cliente_model');
        //Helpers
        $this->load->helper('paginacion');
        //FORM-VALIDATION
        $this->load->library('form_validation');
    }

    /* public function index_get(){

        $this->load->helpers('utilidades');

        $data = array(
            'nombre' => 'Said Mandujano',
            'contacto' => 'melissa flores',
            'direccion' => 'residencial villa de las hadas'
        );
        
        $capi = array('nombre', 'contacto');

        echo json_encode(upperCase($data, $capi));

    } */


    
    //GETS

    public function cliente_get(){
        
        $cliente_id = $this->uri->segment(3);

        //Validar el id del cliente
        if(!$cliente_id){
            $respuesta = array('err' => TRUE, 'msg' => 'Id vacio');
            $this->response($respuesta, REST_Controller::HTTP_BAD_REQUEST); //MANDAR EL ESTATUS
            return;
        };

        $cliente = $this->Cliente_model->get_cliente($cliente_id);
        if(isset($cliente)){
            $respuesta = array('err' => FALSE, 'msg' => 'Registro encontrado correctamente', 'Cliente' => $cliente);
            //Retorno
            $this->response($respuesta);
            return;
        }else{
            $respuesta = array('err' => TRUE, 'msg' => 'Registro no encontrado');
            //Retorno
            $this->response($respuesta, REST_Controller::HTTP_NOT_FOUND);
            return;
        }
    }

    //Paginar
    public function paginar_get(){

        try {
            $pagina = $this->uri->segment(3);
            $por_pagina = $this->uri->segment(4);
    
            //Campos a mostrar
            $campos = array('id', 'nombre');
    
            $respuesta = paginar_tabla('clientes', $pagina, $por_pagina, $campos);
            
            $this->response($respuesta);
            
        } catch (\Throwable $th) {
            $this->response($th);
        }

    }

    //POST AND PUT

    public function cliente_post(){
        $data = $this->post();

        $this->form_validation->set_data($data);

        //DEFINIR REGLAS
  /*       $this->form_validation->set_rules('correo', 'correo electronico', 'required|valid_email');
        $this->form_validation->set_rules('nombre', 'nombre', 'required|min_length[2]'); */

        //UTILIZAR REGLAS
        if($this->form_validation->run('cliente_post')){//REGRESA TRUE SI TODO GOOD || FALSE SI ALGUNA FALLA
            //TODO BIEN
            $this->response('TODO BIEN');

        }else{
            //ALGO MAL

            $respuesta = array('ok'=>TRUE, 'err' =>$this->form_validation->get_errores_arreglo() );
            $this->response($respuesta,  REST_Controller::HTTP_BAD_REQUEST);
        }

        
    }




}
