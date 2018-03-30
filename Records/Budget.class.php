<?php

/** 
 * @package 	ZeroBee
 * @since  		0.0.1
 */
class ZB_Records_Budgets extends ZB_Records_Records {
	
	/** 
	 * A Unique Identifier - this should match the table name (minus the prefix)
	 * 
	 * @since    0.0.1
	 * @access   protected
	 * @var      string
	 */
	protected $slug = 'budgets';


	/**
	 * @since   0.0.1
	 * @access 	public
	 * @return	void
	 */
	public function __construct() {
		parent::__construct();
	} // __construct()
	

	
} // ZB_Records_Budgets

