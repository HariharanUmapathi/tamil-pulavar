<?php
include_once("connection.php");
$qry	=	mysqli_query($connection,"SELECT `eword` FROM `palsdict` WHERE  `eword` LIKE 'a%' AND `meaning` = '' ")or die(mysqli_error($connection));

while($fet	=	mysqli_fetch_array($qry))
{
$ewords[]	=	$fet['eword'];
}
$i=1;
foreach($ewords as $eword)
{
	$eword  =	trim($eword);
	$url	=	"http://www.tamilvu.org/slet/pmdictionary/palsfse.jsp?serword=$eword";
	$cnt	=	file_get_contents($url);
	$pos	=	strpos($cnt,"The word not found in Dictionary");
	//echo $i;
	//echo "<br>";
	if($pos === false)
	{
		
	$pos1 = strpos($cnt,"<HE>");
	$pos2 = strrpos($cnt,"</tr>");	
	$txt  = substr($cnt,$pos1,$pos2);
	$pos4 = strpos($txt,'<b>');
	$txt  = substr($txt,$pos4);
	$txt  = str_replace($eword,"",$txt);
	$txt  = str_replace("&nbsp;","",$txt);
	$txt  = strip_tags($txt);
	$txt  = trim($txt);	
	$txt  = mysqli_real_escape_string($connection,$txt);
	//$txt  = str_replace("\r","",$txt);
	mysqli_query($connection,"UPDATE `palsdict` SET `meaning` = '$txt' WHERE `eword` = '$eword'")or die(mysqli_error($connection));
	//echo $txt; 
	//echo "</br>";
	/*if($i==10)
	exit;
	else
	$i++;*/
	echo $i;
	echo "<br>";
	$i++;
	}
	
}
?>
</body>
</html>