<?php
session_start();
/*
make some personal cookies as illustrated in notes
*/



setcookie("doneBy","sf339",time()+(86400*30),"/");

setcookie("doneAt", date('ljS\of F Y h:i:s A'),time()+(86400*30),"/");
	
/*
code to redirect  back to authenticate.php
if session authenticated not defined
*/

if(!isset($_SESSION["authenticated"])){

	 "<br> Access Restricted.";

	 "<br> Redirected to authenticate.html";

	header("refresh:3,url=authenticate.html ");

	exit("");	

}


//must do standard $db and functions file setup, etc


error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);

	ini_set('display_errors',1);

	include ("account.php");


	$db=mysqli_connect($hostname, $username, $password, $project);

	if (mysqli_connect_errno())

	  {	  echo "Failed to connect to MySQL: ".mysqli_connect_error();
		  Exit ( );
	  }
	mysqli_select_db ($db, $project); 




$ucid=$_SESSION["ucid"];
$ucid=mysqli_real_escape_string($db, $ucid);

/*
 PHP algorithm to  confirm personal knowledge.
 Generates random personal question.
 Must have HTML form  after PHP section 
 where user submits answer
 to personal knowledge question.
 
 Remember correct "answer" in session array and  value of  $randomAI session array "AI"

 */

$s = "select MIN(AI) as smallest from `security-questions` where ucid = '$ucid'";

$p = "select MAX(AI) as biggest from `security-questions` where ucid = '$ucid'";


  ($t = mysqli_query($db, $s )) or die(mysqli_error($db));

  ($g = mysqli_query($db, $p )) or die(mysqli_error($db));

$r = mysqli_fetch_array ($t, MYSQLI_ASSOC);

$h = mysqli_fetch_array ($g, MYSQLI_ASSOC);

$AI_Low = $r["smallest"];

$AI_High = $h["biggest"];

$randomAI = mt_rand ($AI_Low, $AI_High);

$a = "select * from `security-questions` where AI ='$randomAI'";

($f = mysqli_query($db, $a )) or die(mysqli_error($db));

$z = mysqli_fetch_array ($f, MYSQLI_ASSOC);

$question = $z["question"];

$correctAnswer  =  $z["answer"];

$_SESSION["AI"] = $randomAI;

$_SESSION["question"] = $question;
 

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
    <form method = "GET" action="KP2.php">
        <p><?php echo $question; ?> :  </p>
		<label for="answer"> Answer: </label>
        <input type="answer" id ="answer" name="answer"> <br>
		<p> Correct Answer: <?php echo $correctAnswer; ?> </p><br>
        <input type="submit" value="Submit"><br>
    </form>

	<br><br><br>

<a href="logout.php" > Logout Link </a><br><br>
</body>

</html>