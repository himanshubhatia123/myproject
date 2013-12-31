<?php 
include("connection.php");
	//echo 'gfgyed';
$imageurl='http://demo.inextsolutions.com/pucciandpurrrada/upload/';
$ur='http://demo.inextsolutions.com/pucciandpurrrada/';
//$url= 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
   $values=$_REQUEST['xyz'];	
$pieces = explode(",", $values);
//audience=FriendsGroup,topic=Best Freinds143,friends=["ritesh chopra","ashish gupta","danish kaushal"],creator=Nam,datetime=2013-11-20 18:19:25
//print_r($pieces);
//echo "<pre>";print_r($pieces);die;
  count($pieces);
 
$r=array();
for($i=0;$i<count($pieces);$i++)
{
 $tes=$pieces[$i];

$r[] = explode("=", $tes);
}

//print_r($r);
//echo "<pre>"; print_r($r);

 count($r);
 
     $audience= $r[0][1];
	 $topic= $r[1][1];
	 $creator= $r[2][1];
	$datetime= $r[3][1];

 $userfile=$_FILES['userfile']['name'];
	 echo	 "Upload: " . $_FILES["userfile"]["name"] . "<br>";
  	echo 	 "Type: " . $_FILES["userfile"]["type"] . "<br>";
	 echo	"Size: " . ($_FILES["userfile"]["size"]/1024) . " kB<br>";
	echo	 "Temp file: " . $_FILES["userfile"]["tmp_name"] . "<br>";
		
		//move_uploaded_file($_FILES["userfile"]["tmp_name"],
    												//  "publicgroup/".$topic."/". $_FILES["userfile"]["name"]);
    		  //Stored in: 'publicgroup/'.$topic . $_FILES["userfile"]["name"];
	 
	  if($audience=="PublicGroup")
	  {
	  
	  	if(!is_dir("publicgroup/".$topic))
          {

 			 mkdir("publicgroup/".$topic, 0755);
			 mkdir("publicgroup/".$topic."/".$topic."topicgallery", 0755);
  
 		 }
		 $topi="select topic from  pucci_Events where topic='$topic' and audience='$audience'";
		$results = mysql_query($topi);
		 $topc=mysql_num_rows($results);
		$urls='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/publicgroup/'.$topic.'/'. $_FILES["userfile"]["name"]; 
		$url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/publicgroup/'.$topic.'/'.$topic."topicgallery/". $_FILES["userfile"]["name"];
		 if($topc==0)
		 {
		
		 move_uploaded_file($_FILES["userfile"]["tmp_name"],
    												  "publicgroup/".$topic."/". $_FILES["userfile"]["name"]);
										 
		copy("publicgroup/".$topic."/". $_FILES["userfile"]["name"],"publicgroup/".$topic."/".$topic."topicgallery/".$_FILES["userfile"]["name"]);
 	   $sql="INSERT INTO pucci_Events (audience, topic, userfile, creator, datetime) VALUES ('$audience','$topic','$urls','$creator','$datetime')";
			mysql_query($sql);
			 $topicgalleryid=mysql_insert_id();
			 $sql="INSERT INTO TopicGallery (topicid,TopicGallery,Imagecreator) VALUES ('$topicgalleryid','$url','$creator')";
			mysql_query($sql);
			}
			
		}
	if($audience=="FriendsGroup")
	  {
	  	$a=explode(",",$values,3);
		  //print_r($a);die;
		  $b=count($a);
		  $c=$a[0];
		  $d=$a[1];
		 $e=$a[2];
	
		 $u=strrpos($e, "],");
		 $str1 = substr($e,$u);
		 $create=explode(",",$str1);
		 $create1=explode("=",$create[1]);
		 $date1=explode("=",$create[2]);
		 echo "creater is=".$creator_frnd=$create1[1];
		 echo "date=".$datetime_frnd=$date1[1];
		$f=explode("=",$c);
		$g=explode("=",$d);
		$h=explode("=",$e);
		
		 $f[1];
		 $g[1];
		 $j= $h[1];
		 $r=explode("\\\"",$j);
		 print_r($r);
		   count($r);
		$odd=array();
		$even=array();
		$cout=1;
		foreach($r as $p)
		{
			if($cout%2==1)
			{
				$odd[]=$p;
			
			}
			else
			{
				$even[]=$p;
			
			}
			$cout++;
		
		
		}
		 $t=array();
			foreach ($even as $v)
			{
			//echo $v;
			$t[]=substr($v,0);
			}
	  		echo  $friends=implode(",", array_values($t));
	  
	  
	  
	  
		if(!is_dir("FriendsGroup/".$topic))
          {
			  mkdir("FriendsGroup/".$topic, 0755);
			  mkdir("FriendsGroup/".$topic."/".$topic."topicgallery", 0755);
  
 		 }
		 $urlss='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/FriendsGroup/'.$topic.'/'. $_FILES["userfile"]["name"];
		  $url= 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/FriendsGroup';
		  $top="select topic from  pucci_Events where topic='$topic' and audience='$audience'";
		  $results = mysql_query($top);
		  $topc=mysql_num_rows($results);
		if($topc==0)
		 {
		// echo "dsdd";
		  move_uploaded_file($_FILES["userfile"]["tmp_name"],
    												  "FriendsGroup/".$topic."/". $_FILES["userfile"]["name"]);
			copy("FriendsGroup/".$topic."/". $_FILES["userfile"]["name"],"FriendsGroup/".$topic."/".$topic."topicgallery/".$_FILES["userfile"]["name"]);
		
		
		 $sql="INSERT INTO pucci_Events (audience, topic, userfile, Friends, creator, datetime) VALUES ('$audience','$topic','$urlss','$friends','$creator_frnd','$datetime_frnd')";
		
			mysql_query($sql);
			echo "inserted";
			echo $topicgalleryid=mysql_insert_id();
			 echo $sql="INSERT INTO TopicGallery (topicid,TopicGallery,Imagecreator) VALUES ('$topicgalleryid','$urlss','$creator_frnd')";
			mysql_query($sql);
			}
		
	}
	if($audience=="PrivateGroup")
	  {		    
	 
//xyz=audience=PrivateGroup,topic=First%20Private%20Topic,GroupsName=[{"GroupName":"Test","Friends":"(\n%20\"danish%20kaushal\")"},{"GroupName":"xyz","Friends":"(\n%20\"ritesh%20chopra\",\n%20\"danish%20kaushal\"\n)"}],creator=Nam,datetime=2013-11-25%2013:44:54
		  $frnds=explode("=",$values);
		  //print_r($frnds);
		  $group_name=str_replace(",creator", "", $frnds[3]);
		  
		  $frnds1=str_replace("\\n", "", $group_name);
		  $new_frnd = str_replace(str_split('[{"}\]'), ' ', $frnds1);
		  //print_r($new_frnd);
		  $frnds3=str_replace(':', "=", $new_frnd);
		  $frnds4=str_replace("n)", ")", $frnds3);
		$frnds5=str_replace(",n", ";", $frnds4);
		$frnds6=str_replace(")", ")]", $frnds5);
		//print_r($frnds6);		  
		//echo "<pre>";
		//print_r($frnds6);	
		$abc= explode(")]   ,",$frnds6);
		//print_r($abc);
		foreach($abc as $ab)
		{
		$adc[]=explode(",  Friends  =  (",$ab); 
	    }
		//print_r($adc);
		foreach($adc as $key=>$mvc)
		{
		
			
			foreach($mvc as $xyz)
			{
			
			$dta=explode(",",$xyz);
			$mvc[1]=$dta;
			}			
			
			$mynewarray[]=$mvc;		
		}
		$abcde= json_encode($mynewarray);
		$ab=mysql_real_escape_string($abcde);
		
		//print_r($mvc);		
		$frnds_private=str_replace("G", "[G", $frnds6);
		//$str=explode('],[',$frnds_private);
		//$group=array();
		//foreach($str as $key=>$str1)
		//{			
			//$sub=explode('[GroupName',$str1);
		//}
			//foreach($sub as $key2=> $str2)
			//{
				//$str3=explode(',',$str1);
				//echo "<pre>";print_r($str3);	
			//}		 
		  $group_name2=str_replace("\\n", "", $group_name);
		  $group_name3=str_replace("\\", "", $group_name);
		  $frnds1=str_replace(":", "=", $group_name3);
		  $frnds2=str_replace("(n", "", $frnds1);
		  $frnds3=str_replace(",n ", ";", $frnds2);
		  //echo $frnds3=str_replace('",n "', ";", $frnds1);
		  
		  $createor_private1=explode(",",$frnds[4]);
		  echo "creator is=".$createor_private=$createor_private1[0];
		  echo "Date is=".$private_date=$frnds[5];
	  	
		if(!is_dir("PrivateGroup/".$topic))
          {
 			mkdir("PrivateGroup/".$topic, 0755);
  			$url= 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/PrivateGroup';
			echo $urlss='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/PrivateGroup/'.$topic.'/'. $_FILES["userfile"]["name"];
		   $topic_query="select topic from  pucci_Events where topic=$topic and audience=$audience";
			$results = mysql_query($topic_query);
			$topc=mysql_num_rows($results);
			if($topc==0)
		 	{
		  	move_uploaded_file($_FILES["userfile"]["tmp_name"],
    												  "PrivateGroup/".$topic."/". $_FILES["userfile"]["name"]);
		
		 	echo  $sql="INSERT INTO pucci_Events (audience, topic, userfile, Friends, creator, datetime) VALUES ('$audience','$topic','$urlss','$ab','$createor_private','$private_date')";
			mysql_query($sql);
			echo $topicgalleryid=mysql_insert_id(); 
			echo $sql="INSERT INTO TopicGallery (topicid,TopicGallery,Imagecreator) VALUES ('$topicgalleryid','$urlss','$creator_frnd')";
			mysql_query($sql);
			}
		  }		
	}



?>