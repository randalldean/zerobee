<?php

class ZB_User {
	 
	/**
	 * The current user
	 *
	 * @since	0.0.1
	 * @access	private
	 * @static	
	 * @var		WP_User
	 */
	static private $user;
	 
	/**
	 * Is the current user logged in?
	 *
	 * @since	0.0.1
	 * @access	private
	 * @static	
	 * @var		WP_User
	 */
	static private $logged_in = false;

	/**
	 * @access	public
	 * @return	void
	 */
	public function __construct(){

		if(!function_exists('wp_get_current_user')) {
		    include(ABSPATH . "wp-includes/pluggable.php"); 
		}

		self::$user = wp_get_current_user();

		$logged_in = ( self::id() );

	} // __construct() 	

	/**
	 * Is the current user logged in?
	 *
	 * @access 	public
	 * @static
	 * @return 	bool
	 */
	static public function valid(){
		return self::$logged_in;
	} // valid()

	/**
	 * Return the user id 
	 *
	 * @access 	public
	 * @static
	 * @return 	bool
	 */
	static public function id(){
		return self::$user->ID;
	} // id()

	
} // Kepro_User
