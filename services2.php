<?php
session_start();



//REMEMBER THIS IS PSEUDO CODE I AM WRITING, NOT COMLETE PHP 

/*
code to redirect  back to services1.php 
if $_SESSION["pinpassed"]  not defined
*/



setcookie("doneBy","sf339",time()+(86400*30),"/");

setcookie("doneAt", date('ljS\of F Y h:i:s A'),time()+(86400*30),"/");

include(  "myfunctions.php"   );
	

if(!isset($_SESSION["pinpassed"])){

	 "<br> Access Restricted.";

	 "<br> Redirected to pin1.php";

	header("refresh:3,url=pin1.php ");

	exit("");	
}

/*
Connect to $db etc

*/

error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);

	ini_set('display_errors',1);

	include ("account.php");

$db=mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
{	 
	echo "Failed to connect to MySQL: ".mysqli_connect_error();
	Exit ( );
}
mysqli_select_db ($db, $project); 

/*

Use $_session array to access ucid value

Use $_GET with mysqli_real_escape_string and  echo to get inputs from services1.php Form

Use if-else logic or case-statement to execute requested service functions

		list_transactions ($db  ...
		ist_transactions_wrapper  ($db, 
		perform_transaction ( $db , $user, $account, $amount
		clear   TBD
		unknown TBD 

*/

$ucid=$_SESSION["ucid"];
$ucid=mysqli_real_escape_string($db, $ucid);
$option = $_GET["options"];
$amount = $_GET["amount"];

if($option == "LA")
{	
	list_accounts($db, $ucid);
}elseif($option == "LT"){
	//echo "<div id="radiogroup">";
	list_transactions($db, $ucid);
}elseif($option == "C"){
	clear_accounts($db, $ucid);
}elseif($option == "D"){
	$account = $_GET["account"];\
	deposit($db, $ucid, $account, $amount);
}elseif($option == "W"){
	$account = $_GET["account"];
	withdrawal($db, $ucid, $account, $amount);
}elseif($option == "B"){
	$account = $_GET["account1"];
	balance($db, $ucid, $account);
}elseif($option == "N"){
	$account = $_GET["account1"];
	addAccount($db, $ucid, $account);
}elseif($option == "R"){
	$account = $_GET["account1"];
	reset_account($db, $ucid, $account);
}elseif($option == "P"){
	$phone = $_GET["newnum"];
	updatePhoneNumber($db, $ucid, $phone);
}elseif($option == "E"){
	$email = $_GET["newemail"];
	updateemail($db, $ucid, $email);
}

?>
<html>

<style>
    body{
        margin:auto;
        width: 50%;
        border: 1px solid blue;
        padding: 20px;
    }
	td {
		 text-align: center;
	}
</style>
<body>
</body>

<br><br><br>
<a href="services1.php" > Back to Services </a><br>
<a href="logout.php" > Logout Link </a><br><br>

</html>
