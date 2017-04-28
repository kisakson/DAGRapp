<?php
function db_connect() {

	// Define connection as a static variable, to avoid connecting more than once 
	static $db;
			
	// Try and connect to the database, if a connection has not been established yet
	if(!isset($db)) {
		// Load configuration as an array. Use the actual location of your configuration file
	        $config = parse_ini_file('../config.ini'); 
	        $db = @mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname'])
	        OR die('Could not connect. .. . .. .' . mysqli_connect_error());
	}
			
	// If connection was not successful, handle the error
	if(!$db) {
		return mysqli_connect_error(); 
	}
	    
	return $db;
}

function db_echoresults($result, $table) {
	
	switch($table) {
	
	case 1:	/* DAGR */
		/* fetch associative array */
	   	while ($row = mysqli_fetch_assoc($result)) {
	        	printf ("%s %s %s %s %s\n", $row["GUID"], $row["Name"], $row["Creator"], $row["Time_created"], $row["Parent_id"]);
	    	}
	    	break;
	case 2: /* Categories */
		/* fetch associative array */
   		while ($row = mysqli_fetch_assoc($result)) {
        		printf ("%s %s\n", $row["Category"], $row["GUID"]);
    		}
    		break;
    	case 3: /* File_contains */
    		/* fetch associative array */
   		while ($row = mysqli_fetch_assoc($result)) {
        		printf ("%s %s\n", $row["parent_id"], $row["child_id"]);
    		}
    		break;
    	case 4: /* File */
    		/* fetch associative array */
   		while ($row = mysqli_fetch_assoc($result)) {
        		printf ("%s %s %s %s %s %s %s %s %s\n", $row["GUID"], $row["Name"], $row["Creator"], $row["Time_created"], $row["Local_or_online"], $row["URL"], $row["Size"], $row["File_type"], $row["Parent_id"]);
    		}
    		break;
    	}

   	/* free result set */
	mysqli_free_result($result);
}

?>
