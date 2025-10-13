<?php
include("../connection.php");
if($_POST['info_id'])
{
$id	    =	$_POST['info_id'];
$process   = 	$_POST['process'];
$res_se	=	mysqli_query($connection,"SELECT `user_id` FROM `antonyms` WHERE `sno`='$id'");
$row_se 	=	mysqli_fetch_array($res_se);
$u_id	  =	$row_se['user_id'];
$res_id	=	mysqli_query($connection,"SELECT `email` FROM `members` WHERE `sno`='$u_id'");
$row_id 	=	mysqli_fetch_array($res_id);
$u_email   =	$row_id['email'];

//$check = $id."finished";
if($process == 'delete')
{
	mysqli_query($connection,"DELETE FROM `antonyms` WHERE `sno`='$id'")or die(mysqli_error($connection));
	mail($u_email, 'Reg Word Submitted',"sir/madam,\n Due to inappropriate your word has been deleted by admin ", "From:admin@tamilpulavar.org");

}
elseif($process == 'update')
{
	mysqli_query($connection,"UPDATE `antonyms` SET `admin_checked`='1' WHERE `sno`='$id'")or die(mysqli_error($connection));
	mail($u_email, 'Reg Word Submitted',"sir/madam,\n your word has been Added to tamilpulavar database.Thanks for your Support\n
	Regards,\n Admin", "From:admin@tamilpulavar.org");
}
//mysqli_query($connection,"DELETE FROM `for_admin` WHERE `sentance_no`='$id'")or die(mysqli_error($connection));
//mysqli_query($connection,"ALTER TABLE `sentance` DROP COLUMN `$id`")or die(mysqli_error($connection));
//mysqli_query($connection,"ALTER TABLE `sentance` DROP COLUMN `$check`")or die(mysqli_error($connection));

}
?>