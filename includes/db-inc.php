<?php

    $servername = "localhost";
    $dbusername = "alpha";
    $dbpwd = "";
    $dbname = "loginsystem";

    //connect to the database
	$conn = mysqli_connect($servername, $dbusername, $dbpwd, $dbname);

	// check connection
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
    }
    
?>