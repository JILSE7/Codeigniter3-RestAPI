<?php

function paginar_tabla($tabla, $pagina, $porPagina, $select = array()){
    //APUNTAR A LA INSTANCIA
    $CI =& get_instance();
    //CARGAR LA BASE DE DATOS
    $CI->load->database();

    if(!isset($porPagina))$porPagina = 20;
    if(!isset($pagina))$pagina = 1;
    

    $totalRegistros = $CI->db->count_all($tabla);
    $totalPaginas = ceil($totalRegistros / $porPagina);

    //si se solicita una pagina mayor a las que existen
    if($pagina > $totalPaginas){
        $pagina = $totalPaginas;
    }

    $pagina -= 1;
    $desde = $pagina * $porPagina;

    //Aumentando Paginas
    if($pagina >= $totalPaginas - 1){
        $pagSiguiente = 1;
    }else{
        $pagSiguiente = $pagina + 2;
    }

    //Regresando Pagina
    if($pagina < 1) {
        $pagAnterior = $totalPaginas;
    }else{
        $pagAnterior = $pagina;
    }


    //SELECT OPCIONAL
    $CI->db->select($select);
    $query = $CI->db->get($tabla, $porPagina, $desde);


    //Respuesta
    $respuesta = array(
                'err' => FALSE, 
                'totalRegistros' => $totalRegistros, 
                'totalPaginas' => $totalPaginas,
                'pagActual' => ($pagina + 1),
                'pagSiguiente' => $pagSiguiente,
                'pagAnterior' => $pagAnterior,
                $tabla => $query->result()
            );

    return $respuesta;

}




?>