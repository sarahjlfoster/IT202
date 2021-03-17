<?php
session_start();
//unset session "pinpassed;

unset($_SESSION["pinpassed"]);

//REMEMBER THIS IS PSEUDO CODE I AM WRITING, NOT COMLETE PHP 

/*
code to redirect  back to KB1.php
if $_SESSION["pin"]  not defined
*/

/*
Checks if you submitted correct pin sent to your email.
If does not match then redirects to pin1.php
If does  match then redirects sets  session "pinpassed" to true and redirects to services.1.php
*/

setcookie("doneBy","sf339",time()+(86400*30),"/");

	setcookie("doneAt", date('ljS\of F Y h:i:s A'),time()+(86400*30),"/");

	error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);

	ini_set('display_errors',1);

	include ("account.php");


	$db=mysqli_connect($hostname, $username, $password, $project);

	if (mysqli_connect_errno())

	  {	  echo "Failed to connect to MySQL: ".mysqli_connect_error();
		  Exit ( );
	  }
	mysqli_select_db ($db, $project); 

include(  "myfunctions.php"   );

$ucid  = $_SESSION["ucid"];
$ucid = mysqli_real_escape_string($db, $ucid);
$pin = $_SESSION["pin"];
$answer = $_GET["answer"];

if(!correctpin($db, $ucid, $pin, $answer))
{
	echo "<br> Wrong Answer. <br>";
	header("refresh:3, url=pin1.php");
	exit("<br>bad");
}
else{
	echo "<br> Redirecting to services <br>";
	$_SESSION["pinpassed"]=true;
	header("refresh:3 url=services1.php");
	exit("<br>good");
}

?>
