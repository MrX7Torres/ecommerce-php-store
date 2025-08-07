<?php

function getMes($valor){
    switch($valor) {
        case 1:   $mes_txt = 'Enero';    break;
        case 2:   $mes_txt = 'Febrero';    break;
        case 3:   $mes_txt = 'Marzo';    break;
        case 4:   $mes_txt = 'Abril';    break;
        case 5:   $mes_txt = 'Mayo';    break;
        case 6:   $mes_txt = 'Junio';    break;
        case 7:   $mes_txt = 'Julio';    break;
        case 8:   $mes_txt = 'Agosto';    break;
        case 9:   $mes_txt = 'Septiembre';    break;
        case 10:   $mes_txt = 'Octubre';    break;
        case 11:   $mes_txt = 'Noviembre';    break;
        case 12:   $mes_txt = 'Diciembre';    break;
    }
    return $mes_txt;
}
?>