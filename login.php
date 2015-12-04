<?php
session_start();


if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
  	check_login();
}

if (isset($_POST["logout"])) {
	logout();		
}

function check_login(){
	$username = $_REQUEST['username'];
  	$password = $_REQUEST['password'];
  	$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    else{
  		$sql = "SELECT * from User WHERE Username='$username' AND Password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
        	while($row = $result->fetch_assoc()):
	  			$_SESSION['current_user'] = $username;
	  				######################################NEED TO CHANGE FOR WHAT YOU USE############
	  			 	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
	        	header("Location: http://localhost:8080/cs4750/cs4750-hospital-records/main.php");
	   			exit();
	   		endwhile;
        } else {
        		######################################NEED TO CHANGE FOR WHAT YOU USE############
  			 	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
        	header("Location: http://localhost:8080/cs4750/cs4750-hospital-records/");
   			exit();

        }
    }
   	######################################NEED TO CHANGE FOR WHAT YOU USE############
   	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
   	
}

function logout(){
	session_unset();
	header("Location: http://localhost:8080/cs4750/cs4750-hospital-records/");
    exit();
}
function validate_creds(){
	if (!isset($_SESSION['current_user'])){
		#####################AGAIN MUST CHANGE#########################
		header("Location: http://localhost:8080/cs4750/cs4750-hospital-records/");
		exit();
	}
}
?>
