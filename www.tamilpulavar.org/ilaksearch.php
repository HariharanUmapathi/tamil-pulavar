<?php
include("connection.php");
$key = trim($_POST['key']);
$array = array();
$query = mysqli_query($connection, "select `hdwrd` from `ilak_hdwrd` WHERE `hdwrd` LIKE '{$key}%' LIMIT 5");
while ($row = mysqli_fetch_assoc($query)) {
  $val = $row['hdwrd'];
?>
  <div class="show" align="left" style="white-space: nowrap; cursor: pointer;">
    <span class="name"><?php echo $val; ?></span>
  </div>
<?php

}

?>