<?php
include("../../connection.php");
if($_POST['id'])
{
$id=$_POST['id'];
$check = $id."finished";
mysqli_query($connection,"DELETE FROM `members` WHERE `user_id`='$id'")or die(mysqli_error($connection));
mysqli_query($connection,"ALTER TABLE `sentance` DROP COLUMN `$id`")or die(mysqli_error($connection));
mysqli_query($connection,"ALTER TABLE `sentance` DROP COLUMN `$check`")or die(mysqli_error($connection));

}
?>