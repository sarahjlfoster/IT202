<?php
session_start();
/*
code to redirect  back to KB1.php
if $_SESSION["KBpassed"]  not defined
*/

if(!isset($_SESSION["KBpassed"])){

	 "<br> Access Restricted.";

	 "<br> Redirected to KP1.php";

	header("refresh:3,url=KP1.php ");

	exit("");	

}

error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);

	ini_set('display_errors',1);

	include ("account.php");


	$db=mysqli_connect($hostname, $username, $password, $project);

	if (mysqli_connect_errno())

	  {	  echo "Failed to connect to MySQL: ".mysqli_connect_error();
		  Exit ( );
	  }
	mysqli_select_db ($db, $project); 


echo "Admitted to KB1.php<br>";



$ucid=$_SESSION["ucid"];
$ucid=mysqli_real_escape_string($db, $ucid);

$s = "select * from users where ucid = '$ucid'";
($t = mysqli_query($db, $s )) or die(mysqli_error($db));
$r = mysqli_fetch_array ($t, MYSQLI_ASSOC);
$email = $r["email"];

//you only get here if u passed personal knowledge inquiry  

//must do standard functions file setup, etc

/*
 Generates random 4 digit pin and mails to yourself
 
 For instructor's grading convenience must also echo pin  here too.
 Sets session "pin"  to true pin value
 
 You  submit pin from your  njit mail in form below.
 */

 $pin = rand(1000,9999);
 $_SESSION["pin"] = $pin;

include(  "myfunctions.php"   );

//mail($pin);

?>

<br><br><br>

<html>
	<style>
		form{
			margin:auto;
			width: 50%;
			border: 1px solid blue;
			padding: 20px;
		}
    </style>

    <body>
    <form method = "GET" action="pin2.php">
		<label for="answer"> A four digit pin has been sent to <?php echo $email; ?>. <br> Enter pin: </label>
        <input type="answer" id ="answer" name="answer"> <br>
		<p> Correct Answer: <?php echo $pin; ?> </p><br>
        <input type="submit" value="Submit"><br>
    </form>

	<br><br><br>

    <a href="logout.php" > Logout Link </a><br><br>
    </body>
</html>