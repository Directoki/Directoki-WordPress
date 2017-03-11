<?php
/**
Plugin Name: Directoki
Plugin URI: https://github.com/directoki
Description: Incorporate data from an Directoki site into your Wordpress.
Version: DEV
Author: JMB Technology Ltd
Author URI: http://jmbtechnology.co.uk/
License: BSD https://github.com/Directoki/Directoki-WordPress/blob/master/LICENSE.txt
 */


// ################################################## Libs
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'models.php');
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'process.php');



// ################################################## Database
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'setup.php');
add_action( 'plugins_loaded', 'Directoki_database_setup' );
register_activation_hook(dirname(__FILE__).DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'setup.php', 'Directoki_database_setup' );



// ################################################## Admin menu

function directoki_admin_menu_init() {
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'admin.php');
    add_options_page( 'Directoki options', 'Directoki', 'manage_options', 'directoki-admin-menu', 'Directoki_admin_menu' );
}
add_action( 'admin_menu', 'directoki_admin_menu_init' );


