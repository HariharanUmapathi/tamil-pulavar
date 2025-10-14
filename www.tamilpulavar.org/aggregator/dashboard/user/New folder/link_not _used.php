<?php 
;
ini_set('max_execution_time',0);
@session_start();
if($_SESSION['user_id'] == "")
{
	?>
	<script>
	window.location.href="../index.php";
	</script>
	<?php
}
$user_id = $_SESSION['user_id'];
?>

<?php
	include("blogspotcheck.php");
	include('../../simple_html_dom.php');
	//require('sentance_aggregation_dom.php');
	//ini_set('max_execution_time', 300);
	date_default_timezone_set("Asia/Kolkata"); 
	include("../../connection.php");
	$url1=$_POST['url'];
	$dupesql_check = mysqli_query($connection,"SELECT * FROM `links` where (links='$url1')");
	if(mysqli_num_rows($dupesql_check) != 0)
	{
		echo "0";
		exit;
	}
	if($url1 != "")
	{
	$base_url=$url1;
	$seg = explode('/', $url1);
	$ur=$seg[0];
	$ur1=@$seg[2];
	$base=$ur."//".$ur1;
	$dupesql = "SELECT * FROM `links` where (links='$base_url')";
	$r=0; $rr = 0;
	  	$duperaw = mysqli_query($dupesql);
	    if( mysqli_num_rows($duperaw) ) 
		{
        //echo nl2br("$string already exists \n");
   		 } 
    	else 
		{
			$link_id = time() . rand(12*55, 134*54);
			$date = date('d-m-Y H:i:s');
			mysqli_query($connection,"INSERT INTO `links` (`id`,`links`,`links_id`,`user_id`,`created_at`) VALUES ('NULL','$url1','$link_id','$user_id','$date')");
		}
	
	
	$url2=substr($url1,0,4);
	
	//exit;
	if($url2=="http")
	{
	$html = file_get_contents($url1);
	}
	else
	{
		$html = file_get_contents('http://'.$url1);
	}
	
	$path = parse_url($url1, PHP_URL_PATH);
	$segments = explode('/', $path);
	$url1=$segments[0];
	$dom = new DOMDocument();
	@$dom->loadHTML($html);

	// grab all the on the page
	$xpath = new DOMXPath($dom);
	$hrefs = $xpath->evaluate("/html/body//a");
	
	for ($i = 0; $i < $hrefs->length; $i++) 
	{
       $href = $hrefs->item($i);
       $url = $href->getAttribute('href');
       //echo $url.'<br />';
	   $pattern = '/^(?:[;\/?:@&=+$,]|(?:[^\W_]|[-_.!~*\()\[\] ])|(?:%[\da-fA-F]{2}))*$/';
	   $string1=substr($url,0,4);
	   if($string1!="http")
	   {
		   
		  $string = $base_url."/".$url;
		  
		  // echo $string."<br>";
	    }
		elseif($string1=="http")
		{
			
			$exlink2=$url;
			$seg1 = explode('/', $exlink2);
			$ur2=$seg1[0];
			$ur3=$seg1[2];
			$base1=$ur2."//".$ur3;
			//echo $base1."base1<br>";
			//echo $base."base<br>";			
			if($base1==$base)
			{
				$string2=$exlink2;
				//echo $string2."<br>";
				$random = time() . rand(10*48, 100*98);
	  	$dupesql = "SELECT * FROM `sublinks` where (sublink='$string2')";
	  	$duperaw = mysqli_query($dupesql);
	    if( mysqli_num_rows($duperaw) ) 
		{
        //echo nl2br("$string already exists \n");
   		 } 
    	else 
		{
		$id=mysqli_query($connection,"SELECT `links_id` FROM `links` WHERE `links`='$base_url'")or die(mysqli_error($connection));;
		$row = mysqli_fetch_array($id);
		$final_id=$row['links_id'];
	 	mysqli_query($connection,"INSERT INTO `sublinks` (`sno`,`sublink`,`sublink_id`,`mainlink_id`,`checked`,`finished`,`user_id`) VALUES ('NULL','$string2','$random','$final_id','0','0','$user_id')")or die(mysqli_error($connection));
	  	
		}
		}	
		else
		{
		}

		}
		if(preg_match($pattern,$string ) == 1) 
	  	{
   	   //echo $string."<br>";
		$random = time() . rand(10*48, 100*98);
	  	$dupesql = "SELECT * FROM `sublinks` where (sublink='$string')";
	  	$duperaw = mysqli_query($dupesql);
	    if( mysqli_num_rows($duperaw) ) 
		{
        //echo nl2br("$string already exists \n");
   		 } 
    	else 
		{
		$id=mysqli_query($connection,"SELECT `links_id` FROM `links` WHERE `links`='$base_url'")or die(mysqli_error($connection));;
		$row = mysqli_fetch_array($id);
		$final_id=$row['links_id'];
	  	mysqli_query($connection,"INSERT INTO `sublinks` (`sno`,`sublink`,`sublink_id`,`mainlink_id`,`checked`,`finished`,`user_id`) VALUES ('NULL','$string','$random','$final_id','0','0','$user_id')")or die(mysqli_error($connection));
		
	  	}
		}
	}
	
	
	

	include('sentance_aggregation_dom.php');
	//include('word_aggregation.php');
	
	// for continous execution of link
	$v = 0;
	function recu($user_id,$final_id)
	{
		/*//echo $final_id;?><script>
		alert("hai");
		</script>
        <?php*/
	$r=0;
	$results = mysqli_query($connection,"SELECT * FROM `sublinks` WHERE `user_id`='$user_id' AND `checked` = '0' AND `mainlink_id`='$final_id'");
	while($row_link = mysqli_fetch_assoc($results))
	{
		$link_sub[$r] = $row_link['sublink'];
		$sublink_id[$r] = $row_link['sublink_id'];
		$r++;
	}
	for($p=0;$p < $r;$p++)
	{
		
		$url1 = $link_sub[$p];
		$base_url1=$url1;
			$seg = explode('/', $url1);
			$ur=$seg[0];
			$ur1=@$seg[2];
			$base=$ur."//".$ur1;
		
	$url2=substr($url1,0,4);
	
	if($url2=="http")
	{
	$html = file_get_contents($url1);
	}
	else
	{
		$html = file_get_contents('http://'.$url1);
	}
	
	$path = parse_url($url1, PHP_URL_PATH);
	$segments = explode('/', $path);
	$url1=$segments[0];
	$dom = new DOMDocument();
	@$dom->loadHTML($html);

	// grab all the on the page
	$xpath = new DOMXPath($dom);
	$hrefs = $xpath->evaluate("/html/body//a");
	
	for ($i = 0; $i < $hrefs->length; $i++) 
	{
       $href = $hrefs->item($i);
       $url = $href->getAttribute('href');
       //echo $url.'<br />';
	   $pattern = '/^(?:[;\/?:@&=+$,]|(?:[^\W_]|[-_.!~*\()\[\] ])|(?:%[\da-fA-F]{2}))*$/';
	   $string1=substr($url,0,4);
	   if($string1!="http")
	   {
		   
		   $string = $ur."/".$url;
		   
	   // echo $string."<br>";
	    }
		elseif($string1=="http")
		{
			
			$exlink2=$url;
			$seg1 = explode('/', $exlink2);
			$ur2=$seg1[0];
			$ur3=$seg1[2];
			$base1=$ur2."//".$ur3;
			//echo $base1."base1<br>";
			//echo $base."base<br>";			
			if($base1==$base)
			{
				$string2=$exlink2;
				//echo $string2."<br>";
				$random = time() . rand(10*48, 100*98);
	  	$dupesql = "SELECT * FROM `sublinks` where (sublink='$string2')";
	  	$duperaw = mysqli_query($dupesql);
	    if( mysqli_num_rows($duperaw) ) 
		{
        //echo nl2br("$string already exists \n");
   		 } 
    	else 
		{
		$id=mysqli_query($connection,"SELECT `links_id` FROM `links` WHERE `links`='$ur'")or die(mysqli_error($connection));;
		$row = mysqli_fetch_array($id);
		$final_id=$row['links_id'];
	 	mysqli_query($connection,"INSERT INTO `sublinks` (`sno`,`sublink`,`sublink_id`,`mainlink_id`,`checked`,`finished`,`user_id`) VALUES ('NULL','$string2','$random','$final_id','0','0','$user_id')")or die(mysqli_error($connection));
		
	  	}
		}	
		else
		{
		}
	  
	}
		if( preg_match($pattern,$string ) == 1) 
	  	{
   	   //echo $string."<br>";
		$random = time() . rand(10*48, 100*98);
	  	$dupesql = "SELECT * FROM `sublinks` where (sublink='$string')";
	  	$duperaw = mysqli_query($dupesql);
	    if( mysqli_num_rows($duperaw) ) 
		{
        //echo nl2br("$string already exists \n");
   		 } 
    	else 
		{
		$id=mysqli_query($connection,"SELECT `links_id` FROM `links` WHERE `links`='$ur'")or die(mysqli_error($connection));;
		$row = mysqli_fetch_array($id);
		$final_id=$row['links_id'];
	  	mysqli_query($connection,"INSERT INTO `sublinks` (`sno`,`sublink`,`sublink_id`,`mainlink_id`,`checked`,`finished`,`user_id`) VALUES ('NULL','$string','$random','$final_id','0','0','$user_id')")or die(mysqli_error($connection));
		
	  	}
		}
	}
	mysqli_query($connection,"UPDATE `sublinks` SET `checked`='1' WHERE `sublink_id` = '$sublink_id[$p]' ");	
	//echo "No Of files processed".$v++;	
	}
	}
	
	
	
	link:
	$id=mysqli_query($connection,"SELECT `links_id` FROM `links` WHERE `links`='$ur'")or die(mysqli_error($connection));
	$row = mysqli_fetch_array($id);
	$finals_ids=$row['links_id'];
	$results_final = mysqli_query($connection,"SELECT * FROM `sublinks` WHERE `user_id`='$user_id' AND `checked` = '0' AND `mainlink_id`='$finals_ids'");
	$count_final = mysqli_num_rows($results_final);
	if($count_final != 0)
	{
	    recu($user_id,$finals_ids);
	$results_final11 = mysqli_query($connection,"SELECT * FROM `sublinks` WHERE `user_id`='$user_id' AND `checked` = '1' AND `mainlink_id`='$finals_ids'");
	//mb_internal_encoding("UTF-8");
	while($res_row = mysqli_fetch_assoc($results_final11))
	{
		$string = $res_row['sublink'];
		$pass2 = $res_row['sublink_id'];
		sentance($string,$pass2);
		//word($string);
		include("../../connection.php");
	}
		goto link;
	}
	else
	{
	}
	//include('simple_html_dom.php');
	}
	echo "10";
	exit;
?>
