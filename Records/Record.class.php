<?php

/** 
 * @package 	ZeroBee
 * @since  		0.0.1
 * @abstract
 */
abstract class ZB_Records_Record {
	
	/** 
	 * A Unique Identifier - this should match the table name (minus the prefix)
	 * 
	 * @since    0.0.1
	 * @access   protected
	 * @var      string
	 */
	protected $slug = 'record';
	
	/** 
	 * The record id. 
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      int
	 */
	protected $id = 0;
	
	/** 
	 * Is this record valid? 
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      boolean
	 */
	protected $valid = false;
	
	/** 
	 * The record values. 
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      array
	 */
	protected $values;
	
	/**
	 * @since   0.0.1
	 * @access 	public
	 * @return	void
	 */
	public function __construct( $id = 0 ) {
		if( $id ){
			$this->id = $id;
			$this->inflate();
		}
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
	 * @return 	void
	 */
	public function inflate(){

		$query = ZB_DB::prepare( 'SELECT * FROM ' . ZB_DB::table( $this->slug ) . ' WHERE id = %d LIMIT 1', $this->id );

		$this->values = ZB_DB::get_results( $query, ARRAY_A );

		if( !is_array( $this->values ) ){
			$this->valid = false;
			ZB_Comms::error( 'Ruhroh, a record does not exist.', 'Unable to retreive record #' . $this->id . ' of type ' . $this->slug . '.' );
		} else {
			$this->valid = true;
		}

	} // inflate()


	/**
	 * Is the record valid?
	 * 
	 * @access 	public
	 * @return 	boolean
	 */
	public function is_valid(){
		return $this->valid;
	} // is_valid()



	
} // ZB_Records_Records

