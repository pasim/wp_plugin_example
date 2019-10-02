<?php
/**
 * @package Janis
 */
/*
Plugin Name: CSV STAFF Some staff
Plugin URI:
Description: Provides a command line interface to operate with csv.
Version: 1.1.2
Author: Janis Janovskis
Author URI: janis.janovskis@gmail.com
License:  Open Source
Text Domain: Janis
*/

define( 'FCSV_STAF__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if ( defined( 'WP_CLI' ) && WP_CLI ) {
  require_once( FCSV_STAF__PLUGIN_DIR . 'custom-wp-csv-commands.php' );
}
