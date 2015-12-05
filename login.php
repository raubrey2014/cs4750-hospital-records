<?php
session_start();


if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
  	check_user_login();
}
if (isset($_REQUEST['admin_username']) && isset($_REQUEST['admin_password'])){
  	check_admin_login();
}
if (isset($_REQUEST["logout"])) {
	logout();		
}
function check_admin_login(){
	$username = $_REQUEST['admin_username'];
  	$password = $_REQUEST['admin_password'];
  	$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    else{
  		$sql = "SELECT * from AdminUser WHERE admin_username='$username' AND admin_password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
        	while($row = $result->fetch_assoc()):
				  $_SESSION['admin'] = true;
	  			$_SESSION['current_user'] = $username;
	  				######################################NEED TO CHANGE FOR WHAT YOU USE############
	  			 	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
	        	// header("Location: admin_main.php");
          header("Location: admin_main.php");
	   			exit();
	   		endwhile;
        } else {
        		######################################NEED TO CHANGE FOR WHAT YOU USE############
  			 	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
        	header("Location: index.html");
   			exit();

        }
    }
   	######################################NEED TO CHANGE FOR WHAT YOU USE############
   	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
   	
}
function check_user_login(){
	$username = $_REQUEST['username'];
  	$password = $_REQUEST['password'];
  	$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    else{
  		$sql = "SELECT * from PatientUser WHERE Username='$username' AND Password='$password'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
        	while($row = $result->fetch_assoc()):
	  			$_SESSION['current_user'] = $username;
				$_SESSION['current_ssn'] = $row['SSN'];
	  				######################################NEED TO CHANGE FOR WHAT YOU USE############
	  			 	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
	        	header("Location: user_main.php");
	   			exit();
	   		endwhile;
        } else {
        		######################################NEED TO CHANGE FOR WHAT YOU USE############
  			 	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
        	header("Location: index.html");
   			exit();

        }
    }
   	######################################NEED TO CHANGE FOR WHAT YOU USE############
   	#header("Location http://plato.cs.virginia.edu/~rma7qb/cs4750-hospital-records/main.html");
   	
}

function logout(){
	session_unset();
	header("Location: index.html");
    exit();
}
function validate_creds(){
	if (!isset($_SESSION['current_user'])){
		#####################AGAIN MUST CHANGE#########################
		header("Location: index.html");
		exit();
	}
}

function is_admin() {
	return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}
?>
