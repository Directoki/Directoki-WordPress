<?php


/**
 *
 * @link https://github.com/directoki Directoki Open Source Software
 * @license https://github.com/Directoki/Directoki-WordPress/blob/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2017, JMB Technology Limited, http://jmbtechnology.co.uk/
 */


function Directoki_database_setup() {
    global $wpdb;

    $currentVersion = 1;
    $installedVersion = get_option( "directoki_db_version" );

    if ($installedVersion != $currentVersion) {

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta(  "CREATE TABLE ".$wpdb->prefix."directoki_link  (
			id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
			title VARCHAR(255) DEFAULT '' NOT NULL,
			d_baseurl VARCHAR(255) NOT NULL,
			d_project VARCHAR(255) NOT NULL,
			d_directory VARCHAR(255) NOT NULL,
			wp_post_type VARCHAR(255) NOT NULL,
			active TINYINT(1) NOT NULL DEFAULT 1,
			UNIQUE KEY id (id)
		 ) CHARSET=".DB_CHARSET.";" );



        update_option( "directoki_db_version", $currentVersion );
    }

}

