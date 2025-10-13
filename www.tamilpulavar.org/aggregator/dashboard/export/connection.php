<?php

	$hostname = "localhost";
	$username = "ultisg2t_root1";
	$password = "root1";
	$database = "ultisg2t_sentence";


	 $conn = mysqli_connect("$hostname","$username","$password") or die(mysqli_error($connection));
	mysqli_select_db("$database", $conn) or die(mysqli_error($connection));

?>