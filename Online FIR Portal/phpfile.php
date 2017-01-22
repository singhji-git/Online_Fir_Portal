<?php
	if(isset($_POST['submit1']))
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
			$Name=$rec['Officer'];
			$msg="You are being assigned a FIR investigation having id no:-".$Fid.".Kindly look into the matter as soon as possible";
			$sqlc="UPDATE users SET message='$msg' WHERE Name='$Name'";
			mysql_query($sqlc,$con);
			$sql="INSERT INTO fir (Fid,Type,Place,Pofficer,Status,Tlimit) VALUES ('$Fid','$_POST[pwd]','$_POST[splace]','$Pofficer','$Status',NOW()+ INTERVAL 5 MINUTE)";
			mysql_query($sql,$con);
		}
		mysql_close($con);
	}
	if(isset($_POST['submit2']))
	{
		$con=mysql_connect("localhost","root","");
		if(!$con)
		{
			die("can't connect" . mysql_error());
		}
		mysql_select_db("policeofficers",$con);
		$id=$_POST['Fid'];
		$fin="SELECT * FROM fir WHERE Fid='$id'";
		$record=mysql_query($fin,$con);
		if(! $record)
		{
			die('no such fir in the directory'. mysql_error());
		}
			$nm=$_POST['Name'];
			$sql="UPDATE fir SET Status='1' WHERE Fid='$id'";
			mysql_query($sql,$con);
			$msg="NULL";
			$sql2="UPDATE users SET message='$msq' WHERE Name='$nm'";
			mysql_query($sql2,$con);
		mysql_close($con);
	}
	if(isset($_POST['submit3']))
	{
		$con=mysql_connect("localhost","root","");
		if(!$con)
		{
			die("can't connect now" . mysql_error());
		}
		mysql_select_db("policeofficers",$con);
		$temp="NIL";
		$sql="INSERT INTO users (Name,Place,Designation,message,username,password) VALUES('$_POST[namex]','$_POST[placex]','$_POST[desx]','$temp','$_POST[userx]','$_POST[pwdx]')";
		mysql_query($sql,$con);
		mysql_close($con);
	}
	if(isset($_POST['submit4']))
	{
		$con=mysql_connect("localhost","root","");
			mysql_select_db("policeofficers",$con);
		//$id1="SELECT * FROM users";
		
		$user=$_POST['email'];
		$pass=$_POST['pwd'];
		
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
			?>
			<script>
				alert('OOOPS!!! INVALID USERNAME OR PASSWORD!! . PLEASE TRY AGAIN');
			</script>
			<?php
		}
	}
	header('Location: http://localhost/cur/current.html');
?>
