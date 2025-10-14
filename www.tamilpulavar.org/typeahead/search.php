<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect("localhost","root","");
    $db=mysqli_select_db("directory",$con);
  $query=mysqli_query($connection,"select * from `air_crafts_act_1934` where `name` LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['name'];
    }
    echo json_encode($array);
?>
