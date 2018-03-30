<?php

/**
 * ZeroBee Settings 
 * 
 * @since     0.0.1
 * @package   ZeroBee
 */
class ZB_Settings {

	/**
	 * An assoc array of settings
	 * 
	 * @since	0.0.1
	 * @access	private
	 * @static	
	 * @var		array
	 */
	private	static $settings = array();

	/**
	 * Get a single setting value.
	 * 
	 * @since	0.0.1
	 * @static
	 * @param	string	$setting	The setting to retrieve.
	 * @access	public
	 * @return	void
	 */
	public static function get( $setting ){
		
		if( !self::$settings ) self::populate();
		
		return ( isset( self::$settings[ $setting ] ) ) ? self::$settings[ $setting ] : false;

	 } // get()
	 
	 
	/**
	 * Temporary method to populate the settings.
	 * @TODO Replace with the Settings API.
	 * 
	 * @since	0.0.1
	 * @static
	 * @param	string	$setting	The setting to retrieve.
 	 * @access	public
	 * @return	void
	*/
	private static function populate(){
		
		self::$settings['version'] = '0.0.1';
		// self::$settings['url'] = trailingslashit( str_replace( 'src/', '', plugin_dir_url( __FILE__ ) ) );
		// self::$settings['assets'] = trailingslashit( self::$settings['url'] . 'assets' );
		// self::$settings['max_lines'] = 40000;
		// self::$settings['dupe_action'] = 'merge';
		// self::$settings['merge_priority'] = 'newer';
		// self::$settings['parse_full_name'] = true;
		// self::$settings['date_format'] = 'M j, Y';
		// self::$settings['time_format'] = 'g:ia';
		// self::$settings['tag_delimiter'] = ',';
		
	} // populate();
	
} // ZB_Settings()