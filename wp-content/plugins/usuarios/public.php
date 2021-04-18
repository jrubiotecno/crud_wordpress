<?php
/**
 * @des Clase para gestionar la seccion de publica de usuarios
 *
 * @author Jorge Rubio rubioruizjorge@gmail.com
 * @version 1.0
 * @copyright www.jorgerubio.me Febrero 2012
 */

class partepublica {
    var $linkAdmin = null;

    /**
     * @desc Constructor de la clase publica
     * pinta el listado de usuarios
     */
    function partepublica() {
        global $wpdb;
        $resulSet = $wpdb -> get_results("SELECT * FROM usuario");
        //ejecuta una consulta y regresa un arreglo de tuplas
        require_once dirname(__FILE__) . '/templates/listadopublic.php';
        listadoPublic::listadoPublic($resulSet);
    }

}
?>