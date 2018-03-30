<?php

/**
 * ZeroBee DB 
 * 
 * @since     0.0.1
 * @package   ZeroBee
 */
class ZB_DB {

	/**
	 * Returns a properly prefixed table name.
	 * 
	 * @static
	 * @access	public
	 * @param	string	$table
	 * @return	void
	 */
	 public static function table( $table ){
		global $wpdb;
		return $wpdb->prefix . 'zb_' . $table;
	 } // table()


	/**
	 * Returns the table definitions.
	 * 
	 * @static
	 * @access	private
	 * @return	void
	 */
	 private static function tables(){

		return [ 
			'budgets' => 
				"`name` VARCHAR(200) NOT NULL,\n" .
				"start_date DATE NOT NULL,\n" .
				"end_date DATE NOT NULL,\n",
			'inflows' => 
				"budget_id BIGINT(20) UNSIGNED NOT NULL,\n" . 
				"`name` VARCHAR(200) NOT NULL,\n" . 
				"amount INT UNSIGNED NOT NULL,\n",
			'categories' =>
				"`name` VARCHAR(200) NOT NULL,\n",
			'line_items' =>
				"category_id BIGINT(20) UNSIGNED NOT NULL,\n" . 
				"`name` VARCHAR(200) NOT NULL,\n" . 
				"amount INT UNSIGNED NOT NULL,\n",
			'payments' =>
				"line_item_id BIGINT(20) UNSIGNED NOT NULL,\n" . 
				"inflow_id BIGINT(20) UNSIGNED NOT NULL,\n" . 
				"amount INT UNSIGNED NOT NULL,\n",
			'notes' => 
				"object_id BIGINT(20) UNSIGNED NOT NULL,\n" .
				"object VARCHAR(255) NOT NULL,\n" .
				"note text NOT NULL,\n",
			'recurring' => 
				"category_id BIGINT(20) UNSIGNED NOT NULL,\n" . 
				"`name` VARCHAR(200) NOT NULL,\n" .
				"amount INT UNSIGNED NOT NULL,\n"
		];

	} // table()


	/**
	 * Create Tables
	 * 
	 * @since	0.0.1
	 * @access	public	
	 * @static
	 * @return	void
	 */
	public static function create_tables(){
		
		// Create the DB Tables
		global $wpdb, $charset_collate;
		
		// We need this file for the dbDelta function.
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		// initialize the query.
		$query = '';

		foreach( self::tables() as $table => $definitions ){
			$query .= "CREATE TABLE " . self::table( $table ) . "(\n";
			$query .= "id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,\n";
			$query .= $definitions;
			$query .= "created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n";
			$query .= "created_by BIGINT(20) UNSIGNED NOT NULL,\n";
			$query .= "modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,\n";
			$query .= "modified_by BIGINT(20) UNSIGNED NOT NULL,\n";
			$query .= "PRIMARY KEY (id)";
			$query .= "\n) $charset_collate;\n\n";
		}

		dbDelta( $query );
		
	} // create_tables
	 
	 
	/**
	 * DELETE Tables
	 * 
	 * @since	0.0.1
	 * @access	public	
	 * @static
	 * @return	void
	 */
	public static function delete_tables(){
		
		global $wpdb;
		
		foreach( array_keys( self::tables() ) as $table ){
			$wpdb->query("DROP TABLE IF EXISTS " . self::table( $table ) );
		}

	} // delete_tables
	
	
	/**
	 * Delete Records
	 * 
	 * @since	0.0.1
	 * @access	public
	 * @static
	 * @param	string 	$table	Which db table to delete from.
	 * @param	array 	$delete_ids	An array of record ID's to be deleted.
	 * @return 	int		The number of records deleted.
	 */
	static public function delete_records( $table, $delete_ids ){
		
		global $wpdb;
		
		$count_deleted = 0;
		
		foreach( $delete_ids as $id ){
			if( $wpdb->delete( self::table( $table ), array( 'id' => intval( $id ) ), '%d' ) ){
				$count_deleted++;
			}
		}
		
		return $count_deleted;
		
	} // delete_records()
	
		 
		 
	/**
	 * TABLE EXISTS
	 *
	 * Determines if a given table exists in the database
	 * 
	 * @since	0.0.1
	 * @access	public
	 * @static
	 * @param	string 	$table
	 * @return 	bool	
	 */
	static public function table_exists( $table ){
		
		global $wpdb;
		
		$result = $wpdb->query( 'SHOW TABLES LIKE "' . self::table( $table ) . '"');

 		return ( $wpdb->num_rows );
		
	} // table_exists()


	  /*******************/
   	 /*  WPDB WRAPPERS  */
	/*******************/

		 
	/**
	 * GET RESULTS
	 *
	 * A wrapper for wpdb::get_results 
	 * 
	 * @since	0.0.1
	 * @access	public
	 * @static
	 * @param 	string 	$query
	 * @param 	string 	$output
	 * @return 	array|object|null Database query results
	 */
	static public function get_results( $query = null, $output = OBJECT ){
		global $wpdb;
		return $wpdb->get_results( $query, $output );
	} //get_results()

		 
	/**
	 * PREPARE
	 *
	 * A wrapper for wpdb::prepare 
	 * 
	 * @since	0.0.1
	 * @access	public
	 * @static
	 * @param 	string 	$query
	 * @param 	string 	array|mixed $args
	 * @return 	string|void
	 */
	static public function prepare( $query, $args ){
		global $wpdb;
		return $wpdb->prepare( $query, $args );
	} // prepare()

		 
	/**
	 * GET ROW
	 *
	 * A wrapper for wpdb::get_row 
	 * 
	 * @since	0.0.1
	 * @access	public
	 * @static
	 * @param 	string 	$query
	 * @param 	string 	array|mixed $args
	 * @param 	int 	$y
	 * @return 	array|object|null|void Database query result in format specified by $output or null on failure
	 */
	static public function get_row( $query = null, $output = OBJECT, $y = 0 ){
		global $wpdb;
		return $wpdb->get_row( $query, $output, $y );
	} // get_row()

		 
	/**
	 * QUERY
	 *
	 * A wrapper for wpdb::query 
	 * 
	 * @since	0.0.1
	 * @access	public
	 * @static
	 * @param 	string 	$query
	 * @return 	int|false Number of rows affected/selected or false on error
	 */
	static public function query( $query ){
		global $wpdb;
		return $wpdb->query( $query );
	} // query()

} // ZB_DB()