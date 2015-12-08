<?php 
include 'login.php';
validate_creds_patient();
include 'header_patient.html';
?>
<h1>Change Password</h1>
<?php

$conn = new mysqli('stardock.cs.virginia.edu', 'cs4750igs3pw', 'fall2015','cs4750igs3pw');

if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);

}
else if (isset($_REQUEST['SUBMIT'])) {
	//diagnosis, diagnosis treatment, Patient, Patient Visit, 
	//Physician, Physician visit, treatment, visit, visit diagnosis, visit treatment 
	$name = $_SESSION['current_user'];
	$pass = $_REQUEST['PASSWORD'];
	$sql = "UPDATE Patient SET Password = ? WHERE Email = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $pass, $name);
	if ($stmt->execute()) {
		echo "<h2>Password successfully changed</h2>";
	} else {
		echo "<h2>Failed to change password: " . $conn->error . "</h2>";
	}
}

$conn->close();
?>

<form>
	<input type='hidden' name='SUBMIT' value='1' />
	<input type='password' name='PASSWORD' />
	<input type='submit' />
</form>

<?php
include 'footer_patient.html';
?>
