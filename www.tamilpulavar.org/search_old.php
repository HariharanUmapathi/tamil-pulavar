<?php
     include("connection.php");
    $key=trim($_GET['key']);
    $array = array();
	
    $query=mysqli_query($connection,"select `hdwrd` from `hwrd` WHERE `hdwrd` LIKE '{$key}%'");
	//echo "select `tword` from `kazhakam` WHERE `tword` LIKE '%{$key}%'";
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = trim($row['hdwrd']);
    }
	//print_r($array);
    echo json_encode($array);
?>
