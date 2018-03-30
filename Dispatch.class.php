<?php

/**
 * ZeroBee Dispatch 
 * 
 * @since     0.0.1
 * @package   ZeroBee
 */
class ZB_Dispatch {

	/**
	 * Class Constructor
	 *
	 * @since   0.0.1
	 * @access 	public
	 * @return	void
	 */
	public function __construct() {

		add_shortcode( 'zerobee', array( $this, 'shortcode' ) );
	//	$this->state = $this->current_state();

	} // __construct()


	/**
	 * The Shortcode
	 *
	 * The shortcode method. Anything done in here should be returned; not echoed.
	 *
	 * @access 	public
	 * @return 	string
	 */
	public function shortcode( $atts ){

		ob_start();

		$Budgets = new ZB_Records_Budgets();

		if( $Budgets->empty() ){
			// Create a budget for this month.
			
		} else {
			
		}
		return ob_get_clean();

	} // zerobee()


} // ZB_Dispatch