<?php
	session_start();

	unset($_SESSION["authenticated"]);

/*
 CODE TO AUTHENTICATE ucid and pass  
 includes myfunctions.php file
 connect to $db
 needs account.php in same directory
 includes error-report-connect-db.php 
 
 Redirects back to autenticate.html if wrong creds
 
 Redirects to KB1.php if correct  creds
 and defines necessary session array variables.

*/
	error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);

	ini_set('display_errors',1);

	include ("account.php");


	$db=mysqli_connect($hostname, $username, $password, $project);

	if (mysqli_connect_errno())

	  {	  echo "Failed to connect to MySQL: ".mysqli_connect_error();
		  Exit ( );
	  }
	mysqli_select_db ($db, $project); 

	$ucid  = $_GET["ucid"];
	$ucid = mysqli_real_escape_string($db, $ucid);
	$pass=$_GET["pass"];

	include(  "myfunctions.php"   );
	
	if(!authenticate($db, $ucid, $pass))
	{
		echo "<br> Invalid credentials. Please re-enter. <br>";
		header("refresh:3, url=authenticate.html");
		exit("<br>bad");
	}
	else{
		echo "<br> Redirecting to KB <br>";
		$_SESSION["authenticated"]=true;
		$_SESSION["ucid"]=$ucid;
		header("refresh:3 url=KP1.php");
		exit("<br>good");
	}

?>