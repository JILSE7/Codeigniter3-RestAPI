<?php

function obtener_mes($mes){
    $meses = array(
        'enero',
        'febrero',
        'marzo',
        'abril',
        'mayo',
        'junio',
        'julio',
        'agosto',
        'septiembre',
        'octubre',
        'noviembre',
        'diciembre' 
      );

      return $meses[$mes-1];
};



function upperCase($data, $camposCapitalizar){


    $data_lista = $data;


    foreach ($data as $nombre_campo => $valor_campo) {
        
        if(in_array($nombre_campo, array_values($camposCapitalizar))){
            $data_lista[$nombre_campo] = strtoupper($valor_campo);
        }
    }


    return $data_lista;

}







?>