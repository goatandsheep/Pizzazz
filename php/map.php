<?php
	include_once("include_html/displayMap.html");
	$connection = mysqli_connect("mysql.freehostingnoads.net","u476951036_cris","HQz8XvH3ZC","u476951036_login");     
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}   
	
	$result = mysqli_query($connection,"SELECT * FROM Slices"); 
	
	$userXPos=$_GET['xPos'];
	$userYPos=$_GET['yPos'];
	$DEFAULT_SEARCH_RADIUS=1000000;
	//echo "<script>"; // will be responsible of calling the functions to draw each event
	while($row = mysqli_fetch_array($result)) {
		$eventXPos=$row['XPos'];
		$eventYPos=$row['YPos'];
		$eventName=$row['SliceName'];
		$eventDescription=$row['SliceDescription'];
		$distanceX=$eventXPos-$userXPos;
		$distanceY=$eventYPos-$userYPos;
		$distanceR=sqrt(pow($distanceX,2)+pow($distanceY,2));
		if($distanceR<$DEFAULT_SEARCH_RADIUS){
			echo "drawCircleEvent(".$eventXPos.",".$eventYPos.", 1500);";	
			echo "drawText('".$eventName."', '<p>".$eventDescription."</p>',".$eventXPos.", ".$eventYPos.");";
		}
		
	}	
	echo '}google.maps.event.addDomListener(window, \'load\', initialize);
</script><div id="map-canvas"></div>';
	

?>