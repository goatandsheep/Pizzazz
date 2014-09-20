<?php
	session_start();
	
	$connection = mysqli_connect("mysql.freehostingnoads.net","u476951036_cris","HQz8XvH3ZC","u476951036_login");     
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}     
	 
	$sessionUsername=strtolower($_SESSION['username']);
	$sliceName = $_POST["eventName"];
	$sliceDescription= $_POST["eventDescription"]; 

	
	$evenName=  cleanStringFromInjection ($eventName);
	$evenName = cleanStringFromInjection ($evenName);
	$date = (string)date("m/d/Y h:i:s a", time());
	
	$XPos=123123123;
	$YPos=123123123;
	
	
	 $sendSlice = "INSERT INTO Slices (Username,SliceName,SliceDescription,DatePosted,XPos,YPos) VALUES ($sessionUsername,$sliceName,$sliceDescription,$date,$XPos,$YPos)";
	 mysqli_query($connection,$sendSlice);	
	
	
	
	function cleanStringFromInjection($dirtyString){
		$cleanString =  str_replace("'","",$dirtyString);
		$cleanString =  str_replace(";","",$cleanString);
		$cleanString =  str_replace("/","",$cleanString);
		$cleanString =  str_replace("\"","",$cleanString);
		$cleanString =  str_replace("\\","",$cleanString);
		$cleanString =  str_replace("=","",$cleanString);
		$cleanString =  str_replace("==","",$cleanString);
		$cleanString =  str_replace("!","",$cleanString); 
		$cleanString =  str_replace("<","",$cleanString);
		$cleanString =  str_replace(">","",$cleanString); 		
		return $cleanString;
	}
?>