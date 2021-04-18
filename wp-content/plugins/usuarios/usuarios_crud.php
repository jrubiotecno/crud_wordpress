<?php
/**
 Plugin Name: Crud usuario
 Plugin URI: http://www.snicol.com/
 Description: Plugin para administrar tabla de usuarios
 Version: 1.0
 Author: Jorge Rubio Ruiz
 Author URI: http://www.jorgerubio.me/
 */
//include 'admin.php';
if (is_admin())
    require_once dirname(__FILE__) . '/admin.php';
else
    require_once dirname(__FILE__) . '/public.php';

class usuariocrud {
    var $opt;
    var $tableName;

    function setTableName($tableName) {
        $this -> tableName = $tableName;
    }

    function getTableName() {
        return $this -> tableName;
    }

    /**
     * @desc Esta función es ejecutada automáticamente cuando se crea un objeto de la clase, puesto que tiene el mismo nombre.
     * inicializamos plugin
     */
    function usuariocrud() {
        global $wpdb;

        $this -> setTableName('usuario');

        //gancho para instalar
        register_activation_hook(__FILE__, array(&$this, 'install'));

        //gancho para desinstalar
        register_deactivation_hook(__FILE__, array(&$this, 'uninstall'));

        add_action('admin_menu', array(&$this, 'config_page'));
        add_shortcode('usuariocrud', array(&$this, 'init'));

    }

    /**
     * @desc instalar cosas del plugin
     * Se crea la tabla de usuarios
     */
    function install() {
        global $wpdb;

        $sql = "CREATE TABLE IF NOT EXISTS " . $this -> getTableName() . " (
				  `idusuario` int(11) NOT NULL auto_increment,
				  `nombre` varchar(250) NOT NULL,
				  `email` varchar(200) NOT NULL,
				  `fechanacimiento` date NOT NULL,
				  `fecharegistro` datetime NOT NULL,
				  PRIMARY KEY  (`idusuario`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
        $wpdb -> query($sql);
        $fecha = date('Y-m-d H:i:s');
        $wpdb -> insert($this -> getTableName(), array('nombre' => 'Nuevo', 'email' => 'email@email.com', 'fecharegistro' => $fecha));

    }

    /**
     * @desc desinstalar cosas del plugin
     * Se elimina la tabla de usuarios
     */
    function uninstall() {
        global $wpdb;
        $sql = "DROP TABLE " . $this -> getTableName() . "";
        $wpdb -> query($sql);

    }

    /**
     * @desc Se configura la opcion del menu en la que aparece
     * página de configuración
     */
    function config_page() {
        add_options_page('Usuario crud', 'Usuario crud', 8, 'usuariocrud_options', array(&$this, 'options_plugin'));
    }

    /**
     * @desc Metodo que se instancia en el admin, se incluyen estilos css y archivos javascript necesarios.
     * Manejador de panel del admin
     */
    function options_plugin() {
        wp_register_style('adminusuariocrud.css', plugin_dir_url(__FILE__) . 'resources/adminusuariocrud.css');
        wp_enqueue_style('adminusuariocrud.css');

        wp_register_script('jquery', plugin_dir_url(__FILE__) . 'resources/jquery-1.6.2.min.js');
        wp_enqueue_script('jquery');

        wp_register_style('jquery-ui.css', plugin_dir_url(__FILE__) . 'resources/jquery-ui.css');
        wp_enqueue_style('jquery-ui.css');

        wp_register_style('validationEngine.jquery.css', plugin_dir_url(__FILE__) . 'resources/validationEngine.jquery.css');
        wp_enqueue_style('validationEngine.jquery.css');

        wp_register_script('jquery-ui.min.js', plugin_dir_url(__FILE__) . 'resources/jquery-ui.min.js');
        wp_enqueue_script('jquery-ui.min.js');

        wp_register_script('jquery.validationEngine.js', plugin_dir_url(__FILE__) . 'resources/jquery.validationEngine.js');
        wp_enqueue_script('jquery.validationEngine.js');

        wp_register_script('jquery.validationEngine-es.js', plugin_dir_url(__FILE__) . 'resources/jquery.validationEngine-es.js');
        wp_enqueue_script('jquery.validationEngine-es.js');

        $admin = new admin();
    }

    //panel publico
    function init() {
        wp_register_style('publicusuariocrud.css', plugin_dir_url(__FILE__) . 'resources/publicusuariocrud.css');
        wp_enqueue_style('publicusuariocrud.css');
        $partepublic = new partepublica();
    }

}

$usuariocrud = new usuariocrud();
?>