<html>
<head>
</head>
<body>
<form role="form" name="fm1" action="kkwe.php" method="post">
    <div class="form-group">
      <label for="email">Name:</label>
      <input type="text" class="form-control" name="email" placeholder="Enter name">
    </div>
    <div class="form-group">
      <label for="splace">Place:</label>
      <input type="text" class="form-control" name="splace" placeholder="Enter place">
    </div>
	<div class="form-group">
      <label for="tx">Date:</label>
      <input type="text" class="form-control" name="tx" placeholder="Enter date">
    </div>
	<div class="form-group">
      <label for="pwd">Details of incident:</label>
      <input type="text" class="form-control" name="pwd" placeholder="Enter description">
    </div>
    
    <input type="submit" class="btn btn-default" name="submit">
  </form>
 </body>
</html>
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
	$Status=0;
	//date_default_timezone_set("Asia/Calcutta");
	//$t=localtime();
	//$Tlimit=$t;
	$sq="SELECT * FROM station WHERE Oplace='$_POST[splace]' ORDER BY Designation ASC LIMIT 1";
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
		$sql="INSERT INTO fir (Fid,Type,Place,Pofficer,Status,Tlimit) VALUES ('$Fid','$_POST[pwd]','$_POST[splace]','$Pofficer','$Status',NOW()+ INTERVAL 5 MINUTE)";
		mysql_query($sql,$con);
	}
	mysql_close($con);
}
?>

