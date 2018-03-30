<?php

/**
 * ZB Comm
 * 
 * Keeps track and displays all UI messages. Requires Ham Salad classes
 * 
 * @package 	ZeroBee
 * @since 		1.0.0
 */
class ZB_Comms {
	 
	/** 
	 * Convenience method for adding a message.
	 * 
	 * @static
	 * @access	public
	 * @param 	string 	$header 	Optional message header.
	 * @param 	string 	$message 	Optional message.
	 * @return	void
	 */
	public static function message( $header = '', $message = ''  ){
		if( '' == $header && '' == $message ) return;
		hamsalad_message( $message, $header );
	} // message()
	

	/** 
	 * Convenience method for adding an error.
	 * 
	 * @static
	 * @access	public
	 * @param 	string 	$header 	Optional message header.
	 * @param 	string 	$message 	Optional message.
	 * @return	void
	 */
	public static function error( $header = '', $message = '' ){
		if( '' == $header && '' == $message ) return;
		hamsalad_error( $message, $header );
	} // error()
	

	/** 
	 * Convenience method for adding a warning.
	 * 
	 * @static
	 * @access	public
	 * @param 	string 	$header 	Optional message header.
	 * @param 	string 	$message 	Optional message.
	 * @return	void
	 */
	public static function warning( $header = '', $message = '' ){
		if( '' == $header && '' == $message ) return;
		hamsalad_warning( $message, $header );
	} // warning()
	

	/** 
	 * Convenience method for adding a success message.
	 * 
	 * @static
	 * @access	public
	 * @param 	string 	$header 	Optional message header.
	 * @param 	string 	$message 	Optional message.
	 * @return	void
	 */
	public static function success( $header = '', $message = '' ){
		if( '' == $header && '' == $message ) return;
		hamsalad_success( $message, $header );
	} // success()
	
} // HamSalad_Helpers_Messages()
