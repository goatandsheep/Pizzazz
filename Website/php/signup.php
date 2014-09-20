<?php
	include_once "passHashing.php";
	session_start();
	
	$connection = mysqli_connect("mysql.freehostingnoads.net","u476951036_cris","HQz8XvH3ZC","u476951036_login");     
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}     
	 

	$username = $_POST["username"];
	$password = $_POST["password"]; 

	
	
	$username =  cleanStringFromInjection ($username);
	$UpperUser= strtoupper($username);
	$password = cleanStringFromInjection ($password);
	$date = (string)date("Y-m-d h:i:s a", time());
	$passwordHash = create_hash($password);
	
	
	$query = mysqli_query($connection,"SELECT UpperUser FROM Users WHERE UpperUser='".$UpperUser."'");
	  if (mysqli_num_rows($query) != 0)
	  { 
			$_SESSION["loginStatus"]="userExists";
			header("Location: /index.php");
	  }
	
	  else
	  {  
			$addUser="INSERT INTO Users (UpperUser,Pass,SignupDate,Username)   
			VALUES ('$UpperUser','$passwordHash','$date','$username')";  
			$result = mysqli_query($connection,$addUser);
			$_SESSION["username"]=$username;
			$_SESSION["loginStatus"]="signupGood"; 
			header("Location: /index.php");
	  }
	 

	
	
	
	
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