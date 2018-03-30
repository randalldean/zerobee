<?php

/** 
 * @package 	ZeroBee
 * @since  		0.0.1
 * @abstract
 */
abstract class ZB_Records_Records {
	
	/** 
	 * A Unique Identifier - this should match the table name (minus the prefix)
	 * 
	 * @since    0.0.1
	 * @access   protected
	 * @var      string
	 */
	protected $slug = 'records';
	
	/** 
	 * The result set
	 * 
	 * @since    0.0.1
	 * @access   protected
	 * @var      array
	 */
	protected $records = [];

	/**
	 * @since   0.0.1
	 * @access 	public
	 * @param 	array 	$query_atts
	 * @return	void
	 */
	public function __construct( $query_atts = [] ) {
		$this->inflate( $query_atts );
	} // __construct()
	
	
	/**
	 * Returns this record type's slug
	 *
	 * @access 	public
	 * @return 	string
	 */
	public function slug() : string { 
		return $this->slug; 
	} // slug()


	/**
	 * fetch the records for this user as an array
	 * 
	 * @access 	public
	 * @param 	array 	$query_atts
	 * @return 	void
	 */
	public function inflate( $query_atts = [] ){

		$query_atts = (array)$query_atts;

		$defaults = [
			'order_by'	=> 'created',
			'order'		=> 'DESC',
			'limit'		=> 0
		];

        foreach ($defaults as $slug => $default) {
			if ( !array_key_exists( $slug, $query_atts ) ){
           		$query_atts[ $slug ] = $defaults[ $slug ];
           	}
        }

        $limit = $query_atts[ 'limit' ] ? ' LIMIT ' . $query_atts[ 'limit' ] : '';

		$query = ZB_DB::prepare( 'SELECT * FROM ' . ZB_DB::table( $this->slug ) . ' WHERE created_by = %d ORDER BY ' . $query_atts['order_by'] . ' ' . $query_atts['order'] . $limit, ZB_User::id() );

		$this->records = ZB_DB::get_results( $query );

		// @TODO ERROR CHECK HERE

		$this->records = (array)$this->results;

	} // inflate()


	/**
	 * List the records.
	 * 
	 * @access 	public
	 * @return 	array
	 */
	public function list(){
		return $this->records;
	} // list()


	/**
	 * Is the result set empty?
	 * 
	 * @access 	public
	 * @return 	boolean
	 */
	public function empty(){
		return empty( $this->records );
	} // empty()



	
} // ZB_Records_Records

