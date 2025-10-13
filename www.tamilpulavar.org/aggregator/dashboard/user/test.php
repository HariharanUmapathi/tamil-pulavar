<?php 
;
include("../../connection.php");
$result = mysqli_query($connection,"SELECT * FROM `sentance` LIMIT 1000 ");
while($row= mysqli_fetch_assoc($result))
{
	echo $row['sentances']."<br>";
}
?>
