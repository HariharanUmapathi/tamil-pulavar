
<?php
include("connection.php");
$val    =    $_POST['val'];
$val    =    mysqli_real_escape_string($connection, $val);
mysqli_query($connection, "INSERT INTO `repositary` (`sno`,`word`) values('','$val') ") or die(mysqli_error($connection));
?>
