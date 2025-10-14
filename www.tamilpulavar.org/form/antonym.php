<?php
session_start();
include('../connection.php');
if($_SESSION['id'] == '')
{
	header('location:permission.php');
}
else
{
	$u_id   = 	$_SESSION['id'];	
	$wrd 	=	$_POST['wrd'];
	$mean   =	$_POST['mean'];
	$anton  =	$_POST['anton'];
	$syn 	= 	'';
	$qry    =	mysqli_query($connection,"SELECT `tword` FROM `antonyms` WHERE `tword` = '$wrd'")or die(mysqli_error($connection));
	if(mysqli_num_rows($qry) == 0)
	{
		$qry1    =	mysqli_query($connection,"SELECT * FROM `synonym` WHERE `tword` = '$anton'")or die(mysqli_error($connection));
		if(mysqli_num_rows($qry1) != 0)
		{	
			
			while($syns = mysqli_fetch_array($qry1))
			{
				  $val    = $syns['meaning'];
				  $syn   .= mysqli_real_escape_string($val).";";
			}
			$con 	=  mysqli_real_escape_string($syn);
			mysqli_query($connection,"INSERT INTO `antonyms` (`sno`,`tword`,`meaning`,`tword_meaning`,`user_id`) values 	('','$wrd','$anton','$mean','$u_id')") or die(mysqli_error($connection));
			$num	=	mysqli_query($connection,"SELECT COUNT(*) FROM `antonyms` WHERE `user_id` = '$u_id'") or die(mysqli_error($connection));
			$ct	 =	mysqli_fetch_array($num);
			$t_words= 	$ct['COUNT(*)'];
			$no	=	mysqli_query($connection,"SELECT * FROM `rank_list` WHERE `user_id` = $u_id");
			if(mysqli_num_rows($no) > 0)
			{
				
				mysqli_query($connection,"UPDATE `rank_list` SET `total_words` = '$t_words' WHERE `user_id` = '$u_id'") or die(mysqli_error($connection));
			} 
			else
			{
				mysqli_query($connection,"INSERT INTO `rank_list` (`sno`,`user_id`,`total_words`) values('','$u_id','$t_words')")or die(mysqli_error($connection));
			}
			echo "Successfully Inserted";
			unset($syn);
		}
		else
		{
			mysqli_query($connection,"INSERT INTO `antonyms` (`sno`,`tword`,`meaning`,`tword_meaning`,`user_id`) values 	('','$wrd','$anton','$mean','$u_id')") or die(mysqli_error($connection));
			$num	=	mysqli_query($connection,"SELECT COUNT(*) FROM `antonyms` WHERE `user_id` = '$u_id'") or die(mysqli_error($connection));
			$ct	 =	mysqli_fetch_array($num);
			$t_words= 	$ct['COUNT(*)'];
			$no	=	mysqli_query($connection,"SELECT * FROM `rank_list` WHERE `user_id` = $u_id");
			if(mysqli_num_rows($no) > 0)
			{
				
				mysqli_query($connection,"UPDATE `rank_list` SET `total_words` = '$t_words' WHERE `user_id` = '$u_id'") or die(mysqli_error($connection));
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `rank_list` (`sno`,`user_id`,`total_words`) values('','$u_id','$t_words')")or die(mysqli_error($connection));
			}
			echo "Successfully Inserted";
		}
	}
	else
	{
		echo "Word Already Existed";
	}
}
?>