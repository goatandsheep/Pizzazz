<?php
	include_once "passHashing.php"; 
	
	$connection = mysqli_connect("mysql.freehostingnoads.net","u476951036_cris","HQz8XvH3ZC","u476951036_login");    
	if ($connection->connect_errno) {
	  echo "Failed to connect to MySQL: " .$mysqli->connect_error;
	}  

	session_start();


	$enteredUsername = $_POST["username"];
	$enteredPassword = $_POST["password"]; 
	$UpperUsername =  strtoupper (cleanStringFromInjection($enteredUsername));
	$enteredPassword =  cleanStringFromInjection($enteredPassword);
	 
	$result = mysqli_query($connection,"SELECT * FROM Users WHERE UpperUser='$UpperUsername'");

	$userExists=false;

	if($_SESSION['login tries']>4){
		echo "Too many logins";
	}

	while($row = mysqli_fetch_array($result)) { 
		if($UpperUsername == $row['UpperUser'] AND validate_password($enteredPassword,$row['Pass'])){ 
				$_SESSION["username"]=$row["Username"];
				$_SESSION["loginStatus"]="passGood"; 
				header('Location: /index.html' );
				//echo "good LOGIN";
			}else{
				$_SESSION["loginStatus"]="passWrong";
				$_SESSION["username"]="";
				//echo "badlogin";		
				header('Location: /index.html');
			
		} 
		$userExists=true;
	}
	if(!$userExists){ // user does not exist
		$_SESSION["loginStatus"]="passWrong"; 
		header('Location: /index.html');
					//echo "badlogin"	;		
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
		return $cleanString;
	}
?>