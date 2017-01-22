<?php
if(isset($_POST['submit']))
{
	$con=mysql_connect("localhost","root","");
		mysql_select_db("policeofficers",$con);
	//$id1="SELECT * FROM users";
	
	$user=$_POST['username'];
	$pass=$_POST['password'];
	
	$id1="SELECT * FROM users WHERE username='$user' AND password='$pass' LIMIT 1";
	$qh=mysql_query($id1,$con);
	if(count($qh)>=1)
	{
		$q=mysql_fetch_array($qh);
		if($q['message']==NULL)
		{
			?>
			<script>
			alert('you have no messages');
			</script>
			<?php
			//echo "you don't have any messages <br />";
		}
		else
		{
			?>
			<script>
			alert('you have been assigned a task:');
			</script>
			<?php
			//echo "you have been assigned a task: <br />".$qh['message']."<br /> KINDLY LOOK AFTER THIS MATTER";
		}
	}
	else
	{
		echo "OOOPS!!! INVALID USERNAME OR PASSWORD!! <br /> PLEASE TRY AGAIN";
		echo "<br />";
		exit();
	}
}
?>
<html>
<head>
</head>
<title>ch</title>
<body>
<form action="login.php" method="post">
username: <input type="text" name="username" /> <br /><br />
password: <input type="text" name="password" /> <br /><br />
<input type="submit" name="submit" value="LOGIN" />
</form>
</body>
</html>
