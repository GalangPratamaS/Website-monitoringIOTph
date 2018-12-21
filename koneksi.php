<?php

	$conn = new mysqli("localhost","root","","monitoring");
	
	if($conn->connect_error){
		die("connection failed: ".$conn->connect_error);
	}
?>