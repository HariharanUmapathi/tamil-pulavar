<?php
    $key=trim($_POST['key']);
    $array = array();
    include("connection.php");	
    $query=mysqli_query($connection,"select `hdwrd` from `hwrd` WHERE `hdwrd` LIKE '{$key}%' LIMIT 5");
	//echo "select `tword` from `kazhakam` WHERE `tword` LIKE '%{$key}%'";
    while($row=mysqli_fetch_assoc($query))
    {
      $val = $row['hdwrd'];
	  ?>
      <div class="show" align="left">
    <span class="name"><?php echo $val; ?></span>
    </div>
      <?php
	  
    }
	//print_r($array);
   // echo json_encode($array);
?>
