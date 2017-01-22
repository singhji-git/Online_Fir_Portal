<?php
	header('Access-Control-Allow-Origin: *');
	$con=mysql_connect("localhost","root","");
	if(!$con)
	{
		die("can't connect now" . mysql_error());
	}
	mysql_select_db("policeofficers",$con);
	$sql="SELECT * FROM fir WHERE Tlimit<NOW()";
	$dif=mysql_query($sql,$con);
	while($item=mysql_fetch_array($dif))
	{
		if($item['Status']!=1)
		{
			$fir=$item['Fid'];
			$id=$item['Pofficer'];
			$query="SELECT * FROM station WHERE Id='$id'";
			$person=mysql_query($query,$con);
			$fetch=mysql_fetch_array($person);
			$desi=$fetch['Designation'];
			$off=$fetch['Officer'];
			$msg="You have not started the investigation which has been assigned to you ".$item['Fid'].".Hence necessary action must be taken.";
			$sql3="UPDATE users SET message='$msg' WHERE Name='$off'";
			mysql_query($sql3,$con);
			$desi=$desi+1;
			$find="SELECT * FROM station WHERE Designation='$desi'";
			$hperson=mysql_query($find,$con);
			$hfetch=mysql_fetch_array($hperson);
			$person_assigned=$hfetch['Id'];
			$offe=$hfetch['Officer'];
			$msg2="You are being assigned a FIR investigation having id no:-".$Fir.".Kindly look into the matter as soon as possible as your subordinate haven't completed the work ID:-".$id;
			$sql2="UPDATE fir SET Pofficer='$person_assigned',Tlimit=(NOW()+INTERVAL 5 MINUTE) WHERE Fid='$fir'";
			mysql_query($sql2,$con);
			$sql4="UPDATE users SET message='$msg2' WHERE Name='$offe'";
			mysql_query($sql4,$con);
		}
	}
	mysql_close($con);
	echo "sucess";
?>