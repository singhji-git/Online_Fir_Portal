<html>
<head>
</head>
<title>ch</title>
<body>
<form action="insertpolice.php" method="post">
Id: <input type="text" name="Id"><br/>
Officer: <input type="text" name="Officer"><br/>
Oplace: <input type="text" name="Oplace"><br/>
Designation: <input type="text" name="Designation"><br/>
Email: <input type="text" name="Email"><br/>
Phone: <input type="text" name="Phone"><br/>
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
	$sql="INSERT INTO station (Id,Officer,Oplace,Designation,Email,Phone) VALUES ('$_POST[Id]','$_POST[Officer]','$_POST[Oplace]','$_POST[Designation]','$_POST[Email]','$_POST[Phone]')";
	mysql_query($sql,$con);
	mysql_close($con);
}
?>
</body>
</html>

