

<?php
session_start();

setcookie("doneBy","sf339",time()+(86400*30),"/");

setcookie("doneAt", date('ljS\of F Y h:i:s A'),time()+(86400*30),"/");

include(  "myfunctions.php"   );
	

if(!isset($_SESSION["pinpassed"])){

	 "<br> Access Restricted.";

	 "<br> Redirected to pin1.php";

	header("refresh:3,url=pin1.php ");

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


$ucid=$_SESSION["ucid"];
$ucid=mysqli_real_escape_string($db, $ucid);
/*
code to redirect  back to pin1.php
if $_SESSION["pinpassed"]  not defined
*/

//you only get here if u passed KB and pin test and authenticated  

//Has HTML form after PHP section with JavaScript visibility effects.


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


<form method="GET" action="services2.php"><br>



    <div>
        <div>
          <input type="radio" name="options" id="LA" value="LA" onclick="nottoggle(this);" required>
          <label for="LA">List Accounts</label>
        </div>

        <div>
          <input type="radio" name="options" id="LT" value="LT" onclick="nottoggle(this);" required>
          <label for="LT">List Transactions</label>
        </div>

        <div>
          <input type="radio" name="options" id="C" onclick="nottoggle(this);">
          <label for="C">Clear Accounts</label>
        </div>

	    <div>
          <input type="radio" name="options" id="D" value="D"  onclick="toggle(this);">
          <label for="D">Deposit to Account</label>
        </div>

        <div>
          <input type="radio" name="options" id="W" value="W"  onclick="toggle(this);">
          <label for="W">Withdrawal Account</label>
        </div>

        <div>
          <input type="radio" name="options" id="B" value="B" onclick="tooggle(this);">
          <label for="B">Check Balance of Account</label>
        </div>

        <div>
          <input type="radio" name="options" id="R" value="R" onclick="tooggle(this);">
          <label for="R">Reset Account</label>
        </div>

        <div>
          <input type="radio" name="options" id="N" value="N" onclick="tooggle(this);">
          <label for="N">New Account</label>
        </div>

        <div>
          <input type="radio" name="options" id="P" value="P" onclick="phone(this);">
          <label for="P">Update Phone Number </label>
        </div>

         <div>
          <input type="radio" name="options" id="E" value="E" onclick="email(this);">
          <label for="E">Update Email </label>
        </div>

        <div id="desc" style="display: none;">
            <label for="account"> Enter Account: </label>
            <input type="text" id="account" name="account" > <br>
            <label for="amount"> Enter Amount: </label>
		    <input type="text" id="amount" name="amount"><br> 
        </div>

        <div id="disc" style="display: none;">
            <label for="account1"> Enter Account: </label>
            <input type="text" id="account1" name="account1" > <br>
        </div>

        <div id="phone" style="display: none;">
            <label for="newnum"> New Phone Number: </label>
            <input type="text" id="newnum" name="newnum" > <br>
        </div>

        <div id="email" style="display: none;">
            <label for="newemail"> New Email: </label>
            <input type="text" id="newemail" name="newemail" > <br>
        </div>

    </div>
    <input type="submit">


</form>

<br><br><br>

<a href="logout.php" > Logout Link </a><br><br>

</html>


<script>

var accounts = document.getElementById("desc")
var accounts2 = document.getElementById("disc")
var noomber = document.getElementById("phone")
var emaiil = document.getElementById("email")

function toggle() {

    accounts.style.display='block'
    accounts2.style.display='none'
    noomber.style.display='none'
    emaiil.style.display='none'
}

function tooggle() {

    accounts2.style.display='block'
    accounts.style.display='none'
    noomber.style.display='none'
    emaiil.style.display='none'
}

function phone() {

    accounts2.style.display='none'
    accounts.style.display='none'
    noomber.style.display='block'
    emaiil.style.display='none'
}

function email() {

    accounts2.style.display='none'
    accounts.style.display='none'
    noomber.style.display='none'
    emaiil.style.display='block'
}

function nottoggle(){
    accounts.style.display='none'
    accounts2.style.display='none'
    noomber.style.display='none'
    emaiil.style.display='none'
}


</script>



