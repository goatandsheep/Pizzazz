<?php
	$connection = mysqli_connect("mysql.freehostingnoads.net","u476951036_cris","HQz8XvH3ZC","u476951036_login");     
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}     
	

	include_once("../displayMap.html");

	$result = mysqli_query($connection,"SELECT * FROM Slices"); 

	$userXPos=$_GET['xPos'];
	$userYPos=$_GET['yPos'];
	$DEFAULT_SEARCH_RADIUS=1000000;
	echo "<script>"; // will be responsible of calling the functions to draw each event
	while($row = mysqli_fetch_array($result)) {
		$eventXPos=$row['XPos'];
		$eventYPos=$row['YPos'];
		$distanceX=$eventXPos-$userXPos;
		$distanceY=$eventYPos-$userYPos;
		$distanceR=sqrt(pow($distanceX,2)+pow($distanceY,2));
		echo "drawCircle2(".$eventXPos.",".$eventYPos.", 50000);";	
		if($distanceR<$DEFAULT_SEARCH_RADIUS){
			echo "drawCircle2(".$eventXPos.",".$eventYPos.", 50000);";	
		}
		
	}	
	echo "</script>";

?>