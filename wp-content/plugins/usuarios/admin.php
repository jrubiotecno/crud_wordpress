<?php
/**
 * @des Clase para gestionar la seccion de administracion de usuarios
 *
 * @author Jorge Rubio rubioruizjorge@gmail.com
 * @version 1.0
 * @copyright www.jorgerubio.me Febrero 2012
 */

class admin {
    var $linkAdmin = null;

    /**
     * @desc Constructor de la clase admin a partir del GET se decide la opcion a ejecutar
     */
    function admin() {
        $opcionUno = $_GET['op1'];
        $opcionDos = $_GET['op2'];
        $this -> linkAdmin = get_bloginfo('url') . "/wp-admin/options-general.php?page=usuariocrud_options";

        switch ($opcionUno) {
            case 'forma' :
                $this -> formulario($opcionDos);
                break;

            case 'update' :
                $this -> update();
                break;

            case 'save' :
                $this -> save();
                break;

            case 'borrar' :
                $this -> delete($opcionDos);
                break;

            default :
            //se listan los usuarios
                $this -> listadousurios();
                break;
        }
    }

    /**
     * @desc lista los usuarios desde la base de datos
     * @param $msg string informacion del proceso de guardado de usuario en bd
     */
    function listadousurios($msg = "") {
        global $wpdb;
        $resulSet = $wpdb -> get_results("SELECT * FROM usuario");
        //ejecuta una consulta y regresa un arreglo de tuplas
        require_once dirname(__FILE__) . '/templates/listadoadmin.php';
        listadoAdmin::listadoAdmin($resulSet, $msg, $this -> linkAdmin);
    }

    /**
     * @desc pinta el formulario para actualizar o agregar un nuevo usuario
     * @param $tipo string valor del id del usuario a buscar
     */
    function formulario($tipo) {
        global $wpdb;
        //se busca el usuario si existira
        if ((int)$tipo > 0) {
            $resulSet = $wpdb -> get_row("SELECT * FROM usuario where idusuario='" . $tipo . "'");
            $infoUsuario[idusuario] = $resulSet -> idusuario;
            $infoUsuario[nombre] = $resulSet -> nombre;
            $infoUsuario[email] = $resulSet -> email;
            $infoUsuario[fechanacimiento] = $resulSet -> fechanacimiento;
            $infoUsuario[method] = 'update';
        } else {
            $infoUsuario[method] = 'save';
        }

        //ejecuta una consulta y regresa un arreglo de tuplas
        require_once dirname(__FILE__) . '/templates/formulariousuario.php';
        usuarioFormulario::usuarioFormulario($infoUsuario, $msg, $this -> linkAdmin);

    }

    /**
     * @desc actualiza el usuario segun la informacion via $_POST
     */
    function update() {
        global $wpdb;

        $wpdb -> update('usuario', array('nombre' => $_POST['nombre'], 'email' => $_POST['email'], 'fechanacimiento' => $_POST['fechanacimiento']), array('idusuario' => $_POST['id']));

        $this -> listadousurios("Usuario actualizado!");

    }

    /**
     * @desc guarda el nuevo usuario segun la informacion del post
     */
    function save() {
        global $wpdb;

        $wpdb -> insert('usuario', array('nombre' => $_POST['nombre'], 'email' => $_POST['email'], 'fechanacimiento' => $_POST['fechanacimiento'], 'fecharegistro' => date('Y-m-d H:i:s')));

        $this -> listadousurios("Usuario registrado!");
    }

    /**
     * @desc elimina el registro de la bd
     * @param $opcionDos string id del registro a borrar
     */
    function delete($opcionDos) {
        global $wpdb;

        $wpdb -> query("DELETE FROM usuario WHERE idusuario = '" . $opcionDos . "'");

        $this -> listadousurios("Usuario eliminado!");
    }

}
?>