<?php
if(isset($_POST['submit3']))
{
	$con=mysql_connect("localhost","root","");
		if(!$con)
		{
			die("can't connect now" . mysql_error());
		}
	mysql_select_db("policeofficers",$con);
	$temp="NIL";
    $sql="INSERT INTO users (username,password,message,Name,Designation,Place) VALUES('$_POST[userx]','$_POST[pwdx]','$temp','$_POST[namex]','$_POST[desx]','$_POST[placex]')";
    mysql_query($sql,$con);
     mysql_close($con);
}
?>
