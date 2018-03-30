<?php

/**
 * ZeroBee Assets
 * 
 * Static class which handles enqueing common files.
 *
 * @package 	ZeroBee
 * @since 		0.0.1
 */
class ZB_Assets {

	/**
	 * The URL to the assets folder
	 *
	 * @static
	 * @access 	private
	 * @var 	string 	
	 */
	private static $assets_url;

	/**
	 * Whether or not the frontend assets have been loaded
	 *
	 * @static
	 * @access 	private
	 * @var 	string 	
	 */
	private static $frontend_assets_loaded = false;


	/** 
	 * Setter for $assets_url
	 * 
	 * @static
	 * @access	public
	 * @param 	string 	$url
	 * @return	void
	 */
	public static function set_url( $url ){
		self::$assets_url = $url;
	} // set_url() 

	
	/** 
	 * Enqueue the css & js for the frontend
	 * 
	 * @static
	 * @access	public
	 * @return	void
	 */
	public static function frontend(){

		if( self::$frontend_assets_loaded ) return;

		// FRONTEND SCRIPTS
		wp_enqueue_script(  
			'zerobee-frontend-js', 
			self::$assets_url . 'frontend.js',
			'jquery',
			'0.0.1',
			true
		);

		wp_enqueue_style(  
			'zerobee-frontend', 
			self::$assets_url . 'frontend.css',
			null,
			'0.0.1'
		);

		self::$frontend_assets_loaded = true;

	} // frontend() 
	
	
} // ZB_Assets()
