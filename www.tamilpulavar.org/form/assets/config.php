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
$mysqli_user = "";			//your mysql user name
$mysqli_password = "";			//your mysql password
$mysqli_database = "tamilpulavar";	//your mysql database

$connection = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password,$mysqli_database) or die("Opps some thing went wrong");
mysqli_query($connection,"SET NAMES 'utf8'");