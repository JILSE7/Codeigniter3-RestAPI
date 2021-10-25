<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '-1'); //para poder mostrar todos los registros
class Pruebasdb extends CI_Controller {


    //CONTRUCTOR
    public function __construct(){
        //Llamado del constructor del padre
        parent::__construct();
        $this->load->database();
    }



    public function tabla(){
        //get con limites
        //$query = $this->db->get('clientes',11,29); 

        //SELECT
        //$this->db->select('nombre, activo, zip, (select count(*) from clientes) as conteo'); //seleccion de campo y con subqueries
        //$query = $this->db->get_where('clientes', array('id' => 1));

        //SELECT MAX
        $this->db->select_max('zip', 'zip maximo');
        $query = $this->db->get('clientes');


        //SELECT MIN
        $this->db->select_min('zip', 'zip minimo');
        $query = $this->db->get('clientes');

        //PROMEDIO
        $this->db->select_avg('zip', 'zip promedio');
        $query = $this->db->get('clientes');

        //SUMATORIA
        $this->db->select_sum('zip', 'zip promedio');
        $query = $this->db->get('clientes');
        //$query = $this->db->get('PRODUCTION.H_Conectivity_Historic');

        //FROM
        $this->db->select('id, nombre, pais'); //seleccion de campos
        $this->db->from('clientes');
        $query = $this->db->get();

        //WHERE
        $this->db->select('id, nombre, pais'); //seleccion de campos
        $this->db->from('clientes');
        $this->db->where('id <', 10); 
        //$this->db->where('activo', 0);  //AND
        $query = $this->db->get();

        //OR_WHERE
        $this->db->select('id, nombre, pais'); //seleccion de campos
        $this->db->from('clientes');
        $this->db->where('id <', 10); 
        $this->db->or_where('id <', 20); 
        $query = $this->db->get();

        //WHERE_IN - pasando un array para extraer los ids
        $ids = array(1,2,3,4,5,6);
        $this->db->select('id, nombre, pais'); //seleccion de campos
        $this->db->from('clientes');
        $this->db->where_in('id', $ids); 
        $query = $this->db->get();


        //LIKE
        $this->db->like('nombre','s');
        $query = $this->db->get('clientes');

        //OTROS LIKES
        //$this->db->like('title', 'match', 'before');    // Produces: WHERE `title` LIKE '%match' ESCAPE '!'
        //$this->db->like('title', 'match', 'after');     // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
        //$this->db->like('title', 'match', 'none');      // Produces: WHERE `title` LIKE 'match' ESCAPE '!'
        //$this->db->like('title', 'match', 'both');      // Produces: WHERE `title` LIKE '%match%' ESCAPE '!'


        //GROUP_BY
        $this->db->select('pais, count(*) as personas');
        $this->db->group_by("pais"); 
        $query = $this->db->get('clientes');
        
        //DISTINC
        $this->db->distinct();
        $this->db->select('pais');
        $this->db->order_by('pais', 'ASC');
        $query = $this->db->get('clientes');
        
        /* foreach($query->result() as $fila){
            echo $fila->pais . '<br/>';
        } */


        //LIMIT
        $this->db->distinct();
        $this->db->select('pais');
        $this->db->order_by('pais', 'ASC');
        $this->db->limit(10, 20); //TRAEME DE DIEZ, DESDE LA POCISION 20
        //$query = $this->db->get('clientes');

        echo $this->db->count_all_results('clientes');
        echo $this->db->count_all('clientes');
        //echo json_encode($query->result()); //result arreglo - row primer objeto
    }


    public function clientes_beta(){
        //Cargando base de datos
        //$this->load->database();

        $query = $this->db->query('SELECT id,nombre,correo FROM clientes LIMIT 10');

        /* foreach ($query->result() as $row)
        {
            echo $row->id;
            echo $row->nombre;
            echo $row->correo;
        }

        echo 'Total Results: ' . $query->num_rows(); */

        $respuesta = array('err' => FALSE, 
                           'mensaje' => 'Registros cargados correctamente',
                           'total_registros' => $query->num_rows(),
                           'clientes' => $query->result()
                            );
        
        echo json_encode($respuesta);

    }


    public function getCliente($id){
        //$this->load->database();
        $query = $this->db->query('SELECT id,nombre,correo FROM clientes WHERE id='.$id);

        //query row siempre retorna la primera linea, si no existe nada retorna null
        //$query->row()

        if(!$query->row()){
            $respuesta = array('err' => TRUE, 
                                'mensaje' => 'Usuario con '.$id.' no encontrado',
                                'cliente' => null
             );

            echo json_encode($respuesta); 
        }else{
            $respuesta = array('err' => FALSE, 
                           'mensaje' => 'Usuario encontrado',
                           'cliente' => $query->row()
                            );

        echo json_encode($respuesta);
        }

        /* $respuesta = array('err' => FALSE, 
                           'mensaje' => 'Usuario encontrado',
                           'cliente' => $query->result()
                            );

        echo json_encode($respuesta); */
        
    }

}