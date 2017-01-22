<html>
<head>
</head>
<title>ch</title>
<body>
<form action="mail1.php" method="post">
Type: <input type="text" name="Type"><br/>
Place: <input type="text" name="Place"><br/>
<input type="submit" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{
	$con=mysql_connect("localhost","root","");
		if(!$con)
		{
			die("can't connect now" . mysql_error());
		}
	mysql_select_db("policeofficers",$con);
	$x = 5; // Amount of digits
	$min = pow(10,$x);
	$max = pow(10,$x+1)-1;
	$Fid = rand($min, $max);
	$status=0;
	date_default_timezone_set("Asia/Dili");
	$Tlimit=time()+5*60;
	$sq="SELECT * FROM station WHERE Oplace='$_POST[Place]' AND Designation='MIN(Designation)'";
	$dif=mysql_query($sq,$con);
	if(! $dif)
	{
		die('no such Officer in the place'.mysql_error());
	}
	else
	{
		$rec=mysql_fetch_array($dif);
		$Pofficer=$rec['Id'];
		//$msg="You are being assigned a FIR investigation having id no:-".$Fid.".Kindly look into the matter as soon as possible";
		//$msq=wordwrap($msg,70);
		//mail("$rec['Email']","FIR REPORT",$msg,"From : avsashutosh@gmail.com");
	}
	$sql="INSERT INTO fir (Fid,Type,Place,Pofficer,Status,Tlimit) VALUES ('$Fid','$_POST[Type]','$_POST[Place]','$Pofficer','$Status','$Tlimit')";
	mysql_query($sql,$con);
	mysql_close($con);
}
?>
</body>
</html>

