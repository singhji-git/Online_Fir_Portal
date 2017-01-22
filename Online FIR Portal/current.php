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
				alert('OOOPS!!! INVALID USERNAME OR PASSWORD!! <br /> PLEASE TRY AGAIN');
			</script>
			<?php
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>JHARKHAND POLICE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img 
  {
      width: 70%;
      margin: auto;
  }
  </style>
  <script>
		function callMe()
		{
			$.ajax({
				   type: "GET",
				   url: "http://localhost/cur/mainfile.php",
				   data: "id=1",
				   method: "POST",
				   success: function(response){
					   console.log("sucesss");
					  //$("#testDiv").html(response);
					}
		   });
		}

		$(document).ready(function(){
			setInterval(callMe,60000);
		});
	</script>
</head>
<body style="background:#1a0d00;">
<h1 style="display:inline; color:white;"><center>ONLINE WEB PORTAL(JHARKHAND POLICE)</center></h1>
 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
	
      <li class="active" style="align="center;"><a href="">Home</a></li>
	  <li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
     <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">About Us <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="history.html">History</a></li>
          <li><a href="motto.html">Motto</a></li>
          <li><a href="achievements.html">Achievement</a></li>
        </ul>
      </li>
	  <li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Services <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal">Missing children</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal1">Missing person</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal2">Unidentified persons found</a></li>
		  <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal3">Unidentified deadbodies</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal4">Senior citizen registration</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal5">Stolen vehicles search</a></li>
		  <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal6">Missing / Stolen mobile phone search</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal7">SMS service</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal8">Most wanted</a></li>
		  <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal9">Info in passport verification</a></li>
          <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal10">Downloadable forms</a></li>
		  <li><a class="a a-info a-lg" data-toggle="modal" data-target="#myModal11">Govt. service verification</a></li>
          
        </ul>
      </li>
	  <li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Choose your location<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#form1" onclick="my(1)">Garhwa</a></li>
          <li><a href="#form1" onclick="my(2)">Palamu</a></li>
          <li><a href="#form1" onclick="my(3)">Latehar</a></li>
		  <li><a href="#form1" onclick="my(4)">Chatra</a></li>
          <li><a href="#form1" onclick="my(5)">Hazaribagh</a></li>
          <li><a href="#form1" onclick="my(6)">Koderma</a></li>
		  <li><a href="#form1" onclick="my(7)">Giridh</a></li>
          <li><a href="#form1" onclick="my(2)">Ramgarh</a></li>
          <li><a href="#form1" onclick="my(9)">Bokaro</a></li>
		  <li><a href="#form1" onclick="my(10)">Dhanbad</a></li>
		  <li><a href="#form1" onclick="my(11)">Lohardaga</a></li>
		  <li><a href="#form1" onclick="my(2)">Gumia</a></li>
		  <li><a href="#form1" onclick="my(13)">Simdega</a></li>
		  <li><a href="#form1" onclick="my(2)">Ranchi</a></li>
		  <li><a href="#form1" onclick="my(14)">Khunti</a></li>
		  <li><a href="#form1" onclick="my(15)">West Singhbhum</a></li>
		  <li><a href="#form1" onclick="my(2)">Saraikela Kharasawan</a></li>
		  <li><a href="#form1" onclick="my(17)">East Singhbhum</a></li>
		  <li><a href="#form1" onclick="my(1)">Jamatra</a></li>
		  <li><a href="#form1" onclick="my(18)">Deoghar</a></li>
		  <li><a href="#form1" onclick="my(1)">Jamatara</a></li>
		  <li><a href="#form1" onclick="my(19)">Dumka</a></li>
		  <li><a href="#form1" onclick="my(20)">Pakur</a></li>
		  <li><a href="#form1" onclick="my(21)">Godda</a></li>
		  <li><a href="#form1"  onclick="my(22)">Sahibganj</a></li>
        </ul>
      </li>
	  <li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
	  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" >
	  <img src="user-man-circle-invert-512.png" height="25" width="25" /> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#" data-toggle="modal" data-target="#myM">Log in</a></li>
          <li><a href="#" data-toggle="modal" data-target="#myM1">Sign up</a></li>
         
        </ul>
		
		<li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
		<li> &nbsp </li>
		 <li  style="align:right;"><img alt="" class="img-zoom" align="right"; onmouseout="this.width='200';this.height='95'" onmouseover="this.width='250';this.height='161'" src="logo Jharkhand-Police.png" style="width: 84px; height: 54px;float:right;" /> </li>
      </li>
    </ul>
  </div>
</nav>

<!--------------------login modals----------------------->



<div class="modal fade" id="myM" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">LOG In</h4>
        </div>
        <div class="modal-body">
		<form role="form" action="current.php" method="post">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="text" class="form-control" id="email" name="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" id="pwd" name="pwd">
  </div>
  <div class="checkbox">
    <label><input type="checkbox"> Remember me</label>
  </div>
  <input type="submit" class="btn btn-default" name="submit4">
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  
  
  <div class="modal fade" id="myM1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SIGN UP</h4>
        </div>
        <div class="modal-body">
		<form role="form" action="current.php" method="post">
  <div class="form-group">
    <label for="namex">Name:</label>
    <input type="text" class="form-control" name="namex">
  </div>
  <div class="form-group">
    <label for="placex">Place:</label>
    <input type="text" class="form-control" name="placex">
  </div>
  <div class="form-group">
    <label for="desx">Designation:</label>
    <input type="text" class="form-control" name="desx">
  </div>
  <div class="form-group">
    <label for="userx">UserName:</label>
    <input type="text" class="form-control" name="userx">
  </div>
  <div class="form-group">
    <label for="pwdx">Password:</label>
    <input type="password" class="form-control" name="pwdx">
  </div>
  <input type="submit" class="btn btn-default" name="submit3">
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  
  
  
  <!----------------login modals-------------------->
  

  
<!---------------------modals----------------->



  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Missing Children cases solved:</h4>
        </div>
        <div class="modal-body">
		<b> Operation Muskaan:</b>
          <p>The name of the mission, Operation Muskaan, sums up the cause taken up by Jharkhand Police, which is the only force in the country to run
		  a state-wide coordinated operation, with its nodal authority being the state's Criminal Investigation Department (CID).</p>
		  <p> The operation has till now been carried out in two stages and at least 700 children have been rescued by the Jharkhand Police till July 29, 2015.
		  </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Missing Person Cases solved:</h4>
        </div>
        <div class="modal-body">
          <p>The team of police officials from the Ranchi police has managed to reunited a 13 year-old minor girl with her family members after
		  10 day long hard work of finding her family members who stayed in a Naxalite infested area in Jharkhand on 21st July,2015.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

    <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Unidentified Persons Found:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Unidentified Deadbodies found:</h4>
        </div>
        <div class="modal-body">
          <p><ul>
		  <li>A deadbody of age 30 was found from Jamshedpur .</l1>
		  <li>A deadbody of age 50 was found from Jamshedpur .</l1>
		  <li>A deadbody of age 32 was found from Jamshedpur .</l1>
		  <li>A deadbody of age 73 was found from Jamshedpur .</l1></ul>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Senior Citizens Registration:</h4>
        </div>
        <div class="modal-body">
          <p>Senior Citizens can be registered in the Jharkhand Police website.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Stolen Vehicles Search:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal6" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Missing Mobile Phone Search:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal7" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SMS Service:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
    <div class="modal fade" id="myModal8" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Most Wanted:</h4>
        </div>
        <div class="modal-body">
          <p>Most Wanted List will be uploaded soon in the website.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
      <div class="modal fade" id="myModal9" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Info in passport verification:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
      <div class="modal fade" id="myModal10" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Downloadable Forms:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
      <div class="modal fade" id="myModal11" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Govt. Service Verification:</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  

<!---------------------modals----------------->


  
<div class="jumbo" style="background:lightblue">




<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="chinesecops.jpg" width="700" height="400" >
        <div class="carousel-caption">
          <h3>Our achievement</h3>
          <p>Trust of citizens and support from people are the achievements.</p>
        </div>
      </div>

      <div class="item">
        <img src="Document.jpg" width="700" height="400" >
        <div class="carousel-caption">
          <h3>Cops never lose</h3>
          <p>If not investigated, your file will be upgraded soon.</p>
        </div>
      </div>
    
      <div class="item">
        <img src="wendys-1024.jpg" width="700" height="400" >
        <div class="carousel-caption">
          <h3>Online FIR</h3>
          <p>FIR can be filed by just a couple of clicks now.</p>
        </div>
      </div>

      <div class="item">
        <img src="Orig.src_.Susanne.Posel_.Daily_.News-riot-police-1024x768.jpg" width="700" height="400" >
        <div class="carousel-caption">
          <h3>Automatic status update</h3>
          <p>Status of corresponding FIR will be updated time to time.</p>
        </div>
      </div>
  
    </div>

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
	 </a>
    
  </div>
</div>





<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">
  <h2>Achievements</h2><br>
  <h4>What we have done</h4>
  <div class="row text-center slideanim">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="paris.jpg" alt="Paris" width="400" height="300">
        <p><strong>Understand</strong></p>
        <p>Liable to citizens</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="newyork.jpg" alt="New York" width="400" height="300">
        <p><strong>Anticipate</strong></p>
        <p>Realise beforehand</p>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="sanfran.jpg" alt="San Francisco" width="400" height="300">
        <p><strong>Change</strong></p>
        <p>We are here for the change</p>
      </div>
    </div>
  </div><br>
  <h3> Our team in various districts </h3>
  <div class="container">
  <br>
  <div id="myCarouse" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
   

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="btn-group btn-group-justified">
  <a  class="btn btn-primary" onclick="my(1)">Jamaitara</a>
  <a  class="btn btn-primary" onclick="my(2)">Palamu</a>
  <a class="btn btn-primary" onclick="my(3)">Latehar</a>
   <a  class="btn btn-primary" onclick="my(4)">Chatra</a>
  <a  class="btn btn-primary" onclick="my(5)">Hazaribagh</a>
  <a  class="btn btn-primary" onclick="my(6)">Koderma</a>
   <a class="btn btn-primary" onclick="my(7)">Giridh</a>
  <a  class="btn btn-primary" onclick="my(8)">dumri</a>
 
</div>
      </div>

      <div class="item">
        <div class="btn-group btn-group-justified">
  <a  class="btn btn-primary" onclick="my(9)">barahiya</a>
  <a class="btn btn-primary" onclick="my(10)">Dhanbad</a>
  <a class="btn btn-primary" onclick="my(11)">Loharda</a>
   
  <a  class="btn btn-primary" onclick="my(12)">Gumla</a>
  <a  class="btn btn-primary" onclick="my(13)">Simdega</a>
  <a class="btn btn-primary" onclick="my(14)">Khunti</a>
  
  <a  class="btn btn-primary" onclick="my(15)">West Singbhum</a>
  <a class="btn btn-primary" onclick="my(16)">gangasarai</a>
  
</div>
      </div>
    
      <div class="item">
        <div class="btn-group btn-group-justified">
  <a  class="btn btn-primary" onclick="my(17)">East Singbhum</a>
  <a  class="btn btn-primary" onclick="my(18)">Deoghar</a>
  <a class="btn btn-primary" onclick="my(19)">Dumka</a>
  
  <a class="btn btn-primary" onclick="my(20)">Pakur</a>
  <a  class="btn btn-primary" onclick="my(21)">Godda</a>
  <a class="btn btn-primary" onclick="my(22)">Sahebganj</a>
   
  
  <a  class="btn btn-primary" onclick="my(23)">Ramgarh</a>
  <a  class="btn btn-primary" onclick="my(24)">Domra</a>
</div>
      </div>

      
    </div>
</div>
</div>


<br><br>
<div id="demo">
<div class="row">
	<div class="col-sm-4">
		<img id="abc" src="images (1).jpg" class="img-circle" width="304" height="304" title="INSPECTOR GENERAL OF POLICE"/> 
	</div>


	<div class="col-sm-4">
		<img id="abc1" src="images (2).jpg" class="img-circle" width="304" height="304" title="INSPECTOR GENERAL OF POLICE"/> 
	</div>


	<div class="col-sm-4">
		<img id="abc2" src="images (3).jpg" class="img-circle" width="304" height="304" title="INSPECTOR GENERAL OF POLICE"/> 
	</div>
</div>
</div>
<br> <br> <br> <br>

<script>
function my(str)
{
var v= Number(str);
document.getElementById("tx").value=Date();
switch(v)
{
case 1:
document.getElementById("abc").src="images (1).jpg" ;
document.getElementById("abc1").src="images (2).jpg";
document.getElementById("abc2").src="images (3).jpg";
document.getElementById("splace").value="Jamaitara";
break;
case 2:
document.getElementById("abc").src="images (4).jpg";
document.getElementById("abc1").src="images (5).jpg";
document.getElementById("abc2").src="images (6).jpg";
document.getElementById("splace").value="Palamu";
break;
case 3:
document.getElementById("abc").src="images (7).jpg";
document.getElementById("abc1").src="images (8).jpg";
document.getElementById("abc2").src="images (9).jpg";
document.getElementById("splace").value="Latehar";
break;
case 4:
document.getElementById("abc").src="images (10).jpg";
document.getElementById("abc1").src="images (11).jpg";
document.getElementById("abc2").src="images (12).jpg";
document.getElementById("splace").value="Chatra";
break;
case 5:
document.getElementById("abc").src="images (13).jpg";
document.getElementById("abc1").src="images (14).jpg";
document.getElementById("abc2").src="images (15).jpg";
document.getElementById("splace").value="Hazaribagh";
break;
case 6:
document.getElementById("abc").src="images (16).jpg";
document.getElementById("abc1").src="images (17).jpg";
document.getElementById("abc2").src="images (18).jpg";
document.getElementById("splace").value="Koderma";
break;
case 7:
document.getElementById("abc").src="images (19).jpg";
document.getElementById("abc1").src="images (20).jpg";
document.getElementById("abc2").src="images (21).jpg";
document.getElementById("splace").value="Giridh";
break;
case 8:
document.getElementById("abc").src="images (22).jpg";
document.getElementById("abc1").src="images (23).jpg";
document.getElementById("abc2").src="images (24).jpg";
document.getElementById("splace").value="Dumria";
break;
case 9:
document.getElementById("abc").src="images (1).jpg";
document.getElementById("abc1").src="images (2).jpg";
document.getElementById("abc2").src="images (3).jpg";
document.getElementById("splace").value="Barahia";
break;
case 10:
document.getElementById("abc").src="images (4).jpg";
document.getElementById("abc1").src="images (5).jpg";
document.getElementById("abc2").src="images (6).jpg";
document.getElementById("splace").value="Dhanbad";
break;
case 11:
document.getElementById("abc").src="images (7).jpg";
document.getElementById("abc1").src="images (8).jpg";
document.getElementById("abc2").src="images (9).jpg";
document.getElementById("splace").value="Loharda";
break;
case 12:
document.getElementById("abc").src="images (10).jpg";
document.getElementById("abc1").src="images (11).jpg";
document.getElementById("abc2").src="images (12).jpg";
document.getElementById("splace").value="Gumla";
break;
case 13:
document.getElementById("abc").src="images (13).jpg";
document.getElementById("abc1").src="images (14).jpg";
document.getElementById("abc2").src="images (15).jpg";
document.getElementById("splace").value="Simdega";
break;
case 14:
document.getElementById("abc").src="images (24).jpg";
document.getElementById("abc1").src="images (16).jpg";
document.getElementById("abc2").src="images (17).jpg";
document.getElementById("splace").value="Khunti";
break;
case 15:
document.getElementById("abc").src="images (18).jpg";
document.getElementById("abc1").src="images (19).jpg";
document.getElementById("abc2").src="images (20).jpg";
document.getElementById("splace").value="West Singbhum";
break;
case 16:
document.getElementById("abc").src="images (21).jpg";
document.getElementById("abc1").src="images (22).jpg";
document.getElementById("abc2").src="images (23).jpg";
document.getElementById("splace").value="Gangasarai";
break;
case 17:
document.getElementById("abc").src="images (24).jpg";
document.getElementById("abc1").src="images (23).jpg";
document.getElementById("abc2").src="images (22).jpg";
document.getElementById("splace").value="East Singbhum";
break;
case 18:
document.getElementById("abc").src="images (21).jpg";
document.getElementById("abc1").src="images (20).jpg";
document.getElementById("abc2").src="images (19).jpg";
document.getElementById("splace").value="Deoghar";
break;
case 19:
document.getElementById("abc").src="images (18).jpg";
document.getElementById("abc1").src="images (17).jpg";
document.getElementById("abc2").src="images (16).jpg";
document.getElementById("splace").value="Dumka";
break;
case 20:
document.getElementById("abc").src="images (15).jpg";
document.getElementById("abc1").src="images (14).jpg";
document.getElementById("abc2").src="images (13).jpg";
document.getElementById("splace").value="Pakur";
break;
case 21:
document.getElementById("abc").src="images (12).jpg";
document.getElementById("abc1").src="images (11).jpg";
document.getElementById("abc2").src="images (10).jpg";
document.getElementById("splace").value="Godda";
break;
case 22:
document.getElementById("abc").src="images (9).jpg";
document.getElementById("abc1").src="images (8).jpg";
document.getElementById("abc2").src="images (7).jpg";
document.getElementById("splace").value="Jamaitara";
document.getElementById("splace").value="Sahebganj";
break;
case 23:
document.getElementById("abc").src="images (6).jpg";
document.getElementById("abc1").src="images (5).jpg";
document.getElementById("abc2").src="images (4).jpg";
document.getElementById("splace").value="Ramgarh";
break;
case 24:
document.getElementById("abc").src="images (3).jpg";
document.getElementById("abc1").src="images (2).jpg";
document.getElementById("abc2").src="images (1).jpg";
document.getElementById("splace").value="Domra";
break;
}
}
</script>

<!-- fir form-->
<a href="#form1"><button type="button" class="btn btn-info" onclick="f1()"> File an FIR </button></a>
<a href="#form2"><button type="button" class="btn btn-info" onclick="f2()"> Status Update</button></a>

<div class="container" >
  <h2><a name="form1">File an FIR</a></h2>
  <form role="form" name="fm1" action="current.php" method="post">
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
    
    <input type="submit" class="btn btn-default" name="submit1">
  </form>
</div>
<div class="container">
  <h2><a name="form2">Update Status</a></h2>
  <form role="form" name="fm2" action="current.php" method="post">
    <div class="form-group">
      <label for="name">Investigated By:</label>
      <input type="text" class="form-control" id="name1" name="Name" placeholder="Enter name">
	   <label for="name">FIR Id No. :</label>
      <input type="text" class="form-control" id="name2" name="Fid" placeholder="FIR Id No.">
    </div>
    
    <div class="checkbox">
      <label><input type="checkbox"> Investigated or Not</label>
    </div>
    <input type="submit" class="btn btn-default" name="submit2">
  </form>
</div>
<!---- fir    form-->
<br><br>
</div>

<!--up arrow-->
<div style="background:#000000;">
<footer class="text-center">

<div class="row">
<div class="col-md-4">
<td><h2>USEFUL LINKS</h2></td><br>
<td><a href="http://lawmin.nic.in/">Ministry of Laws and Justice</a></td><br>
<td><a href="http://jharkhandhighcourt.nic.in/">Jharkhand High Court</a></td><br>
<td><a href="http://pcserver.nic.in/iapmis/login.aspx">Iap planning commission</a></td><br>
<td><a data-toggle="modal" data-target="#myModalyy ">other police websites</a></td><br>
</div>


<div class="col-md-4">
<td><h2>About Us</h2></td><br>
<td></td><a href="image rotator.html#demo">About us</a><br>
<td><a href="#" >Contact Us</a></td><br>
<td><a href="#" data-toggle="modal" data-target="#myModa">Feedback</a></td><br>
<td><a href="#" data-toggle="modal" data-target="#myModa">sitemap</a></td><br>
</div>
<div class="col-md-4">
<td><h2>POLICIES</h2></td><br>
<td><a href="#" data-toggle="modal" data-target="#myModa">Website Policies</a></td><br>
<td><a href="#" data-toggle="modal" data-target="#myModa">Hyperlinking Policies</a></td><br>
<td><a href="#" data-toggle="modal" data-target="#myModa">Privacy Policies</a></td><br>
<td><a href="#" data-toggle="modal" data-target="#myModa">copyright Policies</a></td><br>
</div>
</div>


<!-- Modal -->
<div id="myModa" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div class="modal fade" id="myModaly" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Other Police Websites</h4>
        </div>
        <div class="modal-body">
          <div class="row">
		  
		  <div class="col-md-4">Bihar police</div><div class="col-md-4">Mumbai police</div>
		  <div class="col-md-4">DELHI police</div><div class="col-md-4">ANDRHA PRADESH police</div>
		  <div class="col-md-4">GUJARAT police</div><div class="col-md-4">HYDERABAD police</div>
		  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  




  <a class="up-arrow" href="#" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br>
  <p style="color:white;">WE ARE HERE TO HELP YOU <img src="logo Jharkhand-Police.png" width=20px; height=20px;>
</footer>
</div>
<!--up arrow-->

</body>
</html>
