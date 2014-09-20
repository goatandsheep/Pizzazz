<?php
		$connection = mysqli_connect("mysql.freehostingnoads.net","u476951036_cris","HQz8XvH3ZC","u476951036_login");     
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}     
	
	$result = mysqli_query($connection,"SELECT * FROM Slices ORDER BY Date DESC"); 
	$userXPos=$_GET['xPos'];
	$userYPos=$_GET['yPos'];
	
	$DEFAULT_SEARCH_RADIUS=1000;
	
	while($row = mysqli_fetch_array($result)) {
		$eventXPos=$row['XPos'];
		$eventYPos=$row['YPos'];
		if(($eventXPos <= ($userX+$DEFAULT_SEARCH_RADIUS))&&($eventXPos<=($userXPos-$DEFAULT_SEARCH_RADIUS))&&($eventYPos<=($userYPos+$DEFAULT_SEARCH_RADIUS))&&($eventYPos<=($userYPos-$DEFAULT_SEARCH_RADIUS))){
			$distanceX=$eventXPos-$userXPos;
			$distanceY=$eventYPos-$userYPos;
			$distanceR=sqrt(pow($distanceX,2)+pow($distanceY,2));
			
		}
	}	


	
	
	function isUserWithin($mFromEvent,$eventX,$eventY){
		
	}
?>