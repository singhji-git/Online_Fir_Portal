<html>
<head>
</head>
<title>ch</title>
<body>
<form action="status.php" method="post">
Fid: <input type="text" name="Fid"><br/>
<input type="submit" name="submit">
</form>
<?php
if(isset($_POST['submit']))
{
$con=mysql_connect("localhost","root","");
if(!$con)
{
	die("can't connect" . mysql_error());
}
mysql_select_db("policeofficers",$con);
$fin="SELECT * FROM fir WHERE Fid='$_POST[Fid]'";
$record=mysql_query($fin,$con);
if(! $record)
{
	die('no such fir in the directory'. mysql_error());
}
	$sql="UPDATE fir SET Status='1' WHERE Fid='$_POST[Fid]'";
	mysql_query($sql,$con);
mysql_close($con);
}
?>
</body>
</html>

