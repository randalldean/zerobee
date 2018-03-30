<?php

/**
 * ZeroBee
 *
 * @since             0.0.1
 * @package           ZeroBee
 *
 * @wordpress-plugin
 * Plugin Name:       ZeroBee
 * Description:       Simple Budgeting Beta
 * Version:           0.0.1
 * Author:            Randy Runnels
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       zerobee
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) )  die;

/**
 * Make sure required plugins are loaded and active.
 *
 * @since 	0.0.1
 * @package ZeroBee
 * @return 	void
 */
function zerobee_required_plugins() {

	$required = [
		'Ham Salad' 	=> 'hamsalad/hamsalad.php'
	];

	$valid = true;

	foreach( $required as $label => $path ){
		if ( !is_plugin_active( $path ) ) {
        	$valid = false;
        	add_action( 'admin_notices', function() use( $label){
        		?><div class="error"><p><?php echo sprintf( __( 'Sorry, but <strong>Zerobee</strong> requires the plugin <strong>%s</strong> to be installed and active.', 'zerobee' ), $label ); ?></p></div><?php
        	});
		}
        	
    }

    if( !$valid && is_admin() && current_user_can( 'activate_plugins' ) ){
        deactivate_plugins( plugin_basename( __FILE__ ) ); 
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
       
} add_action( 'admin_init', 'zerobee_required_plugins' );


/**
 * Set up Autoloading
 * 
 * @see http://www.smashingmagazine.com/2015/05/29/how-to-use-autoloading-and-a-plugin-container-in-wordpress-plugins/
 * 
 * @since	0.0.1
 * @package	ZeroBee
 * @param	string	$class_name
 * @return	void
 */
function zerobee_autoloader( $class_name ) {

	if ( false !== strpos( $class_name, 'ZB_' ) ) {
    	$classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
		$class_name = str_replace( 'ZB_', '', $class_name );
    	$class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.class.php';
    	require_once $classes_dir . $class_file;
  	}

} spl_autoload_register( 'zerobee_autoloader' );

// Set the assets location relative to this plugin.
ZB_Assets::set_url( plugin_dir_url( __FILE__ ) . 'assets/' );
ZB_Assets::frontend();

$Front = new ZB_Dispatch();


/**
 * Activate Plugin
 * 
 * @since	0.0.1
 * @package	ZeroBee
 * @return	void
 */
function zerobee_activate(){

	// Skip this step if we're already up-to-date
	if ( get_option( 'zerobee_version' ) == ZB_Settings::get('version') ) return;

	// Update the database.	
	ZB_DB::create_tables();
	
	//update_option( 'zerobee_version', ZB_Settings::get('version') );

} register_activation_hook( __FILE__, 'zerobee_activate' );


/**
 * Deactivate Plugin.
 * 
 * @since	0.0.1
 * @package	ZeroBee
 * @return	void
 */
function zerobee_deactivate(){

	ZB_DB::delete_tables();
	
	// Remove the version
	delete_option('zerobee_version');

} register_deactivation_hook( __FILE__, 'zerobee_deactivate' );