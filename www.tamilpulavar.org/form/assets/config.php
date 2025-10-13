<?php
/*--------------------------------------------------------------------------------------------
|	@desc:		simple php pagination
|	@author:	Aravind Buddha
|	@url:		http://www.techumber.com
|	@date:		12 August 2012
|   @email       aravind@techumber.com
|	@license:	Free!, to Share,copy, distribute and transmit , 
|               but i'll be glad if i my name listed in the credits'
---------------------------------------------------------------------------------------------*/
$mysqli_hostname = "localhost";  //your mysql host name
$mysqli_user = "ultisg2t_root1";			//your mysql user name
$mysqli_password = "root1";			//your mysql password
$mysqli_database = "ultisg2t_tamdict";	//your mysql database

$bd = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("Opps some thing went wrong");
mysqli_select_db($mysqli_database, $bd) or die("Error on database connection");

mysqli_query($connection,"SET NAMES 'utf8'");









