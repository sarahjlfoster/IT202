<?php
session_start();

	unset($_SESSION["KBpassed"]);
// unset  session "KBpassed"

/*
code to redirect  back to KB1.php
if $_SESSION["AI"]  not defined
*/

//you only get here if u were admitted

//must do standard functions file setup, etc

/*
Compares submitted answer from  Form  to true answer stored in session array

If they don't match then redirects to KB1.php
If they do match then sets session "KBpassed" to true  then redirects to pin1.php   
 
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
$AI = $_SESSION["AI"];
$question = $_SESSION["question"];
$answer = $_GET["answer"];



if(!correctan($db, $ucid, $AI, $question, $answer))
{
	echo "<br> Wrong Answer. <br>";
	header("refresh:3, url=KP1.php");
	exit("<br>bad");
}
else{
	echo "<br> Redirecting to pin <br>";
	$_SESSION["KBpassed"]=true;
	header("refresh:3 url=pin1.php");
	exit("<br>good");
}

?>
