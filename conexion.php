<?php
	$host = "localhost";
	$port = "5432"; // Puerto predeterminado de PostgreSQL
	$dbname = "AmorMX";
	$user = "postgres";
	$password = "postgres";

	// Connect to db
	$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

	if (!$conn) {
    		die("Error");
	} else {
		//echo "OK OK";
	}

	// Close connection
	//pg_close($conn);
?>