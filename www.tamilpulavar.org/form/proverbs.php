<?php
session_start();
include('../connection.php');
include('../yapp/transliterate.php');
if($_SESSION['id'] == '')
{
	header('location:permission.php');
}
else
{
	$u_id   		= 	$_SESSION['id'];	
	$pala_wrd 	=	$_POST['pala_wrd'];
	$syn 		 = 	'';
	$qry    	 =	mysqli_query($connection,"SELECT `proverb` FROM `proverbs` WHERE `proverb` = '$pala_wrd'")or die(mysqli_error($connection));
	if(mysqli_num_rows($qry) == 0)
	{
		$literate = T2R($pala_wrd);
		mysqli_query($connection,"INSERT INTO `proverbs`(`sno`, `proverb`,`user_id`,`literate`) VALUES ('NULL','$pala_wrd','$u_id','$literate')");
		echo "Successfully Inserted";
	}
	else
	{
		echo "Word Already Existed";
	}
}
?>